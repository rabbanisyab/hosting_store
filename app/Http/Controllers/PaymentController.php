<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Booking; // Jika Anda ingin menyimpan data booking

class PaymentController extends Controller
{
    public function __construct()
    {
        // Set konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function create(Request $request)
    {
        // Simpan data booking ke database (opsional)
        $booking = Booking::create([
            'travel_package_id' => $request->travel_package_id,
            'name' => $request->name,
            'email' => $request->email,
            'number_phone' => $request->phone,
            'date' => $request->payment_date,
            'total_price' => $request->total_price,
            'status' => 'pending', // Status awal
        ]);

        // Data transaksi Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => $booking->id, // Gunakan ID booking sebagai order ID
                'gross_amount' => $request->total_price,
            ],
            'customer_details' => [
                'first_name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ],
        ];

        // Dapatkan Snap Token
        $snapToken = Snap::getSnapToken($params);

        // Redirect ke halaman pembayaran
        return view('payment', [
            'snapToken' => $snapToken,
            'travel_package' => $request->travel_package_id,
        ]);
    }

    public function callback(Request $request)
    {
        $payload = $request->getContent();
        $notification = json_decode($payload, true);

        // Ambil data transaksi
        $orderId = $notification['order_id'];
        $statusCode = $notification['status_code'];
        $transactionStatus = $notification['transaction_status'];

        // Update status booking di database
        $booking = Booking::find($orderId);
        if ($booking) {
            $booking->status = $transactionStatus;
            $booking->save();
        }

        return response()->json(['status' => 'success']);
    }
}
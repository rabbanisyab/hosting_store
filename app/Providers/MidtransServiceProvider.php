<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MidtransServiceProvider extends ServiceProvider
{
    public function register()
    {
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = false; // Ubah ke true jika sudah di mode live
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
    }

    public function boot()
    {
        //
    }
}

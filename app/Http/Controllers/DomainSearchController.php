<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class DomainSearchController extends Controller
{
    /**
     * Search domain using external API.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
{
    // Validasi input
    $request->validate([
        'domain' => 'required|string',
        'zone' => 'nullable|string',
    ]);

    // Ambil input dari pengguna
    $domain = $request->input('domain');
    $zone = $request->input('zone', 'com'); // Default ke .com jika zone tidak diisi

    // URL API
    $apiUrl = "https://api.domainsdb.info/v1/domains/search";

    // Buat request ke API
    try {
        $client = new Client();
        $response = $client->get($apiUrl, [
            'query' => [
                'domain' => $domain,
                'zone' => $zone,
            ],
        ]);

        // Decode hasil response
        $data = json_decode($response->getBody(), true);
        $domains = $data['domains'] ?? [];

        // If the request is AJAX, return JSON data
        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'data' => $domains,
            ]);
        }

        // Otherwise, return the view with the data
        return view('frontend.domain_search', compact('domains'));

    } catch (\Exception $e) {
        // Handle error
        return response()->json([
            'status' => 'error',
            'message' => 'Failed to fetch data from the API.',
            'error' => $e->getMessage(),
        ], 500);
    }
}

}
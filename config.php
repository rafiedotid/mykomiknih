<?php
define('API_URL', 'https://unofficial-shinigami-api.vercel.app/api/get');

// Fungsi untuk melakukan request ke API menggunakan cURL
function get_api_data($endpoint, $params = []) {
    $url = API_URL . '/' . $endpoint;
    if (!empty($params)) {
        $url .= '?' . http_build_query($params);
    }

    // Inisialisasi cURL
    $ch = curl_init($url);

    // Set cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Mengembalikan hasil sebagai string
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Mengikuti redirect jika ada
    curl_setopt($ch, CURLOPT_TIMEOUT, 30); // Timeout 30 detik

    // Eksekusi request dan simpan hasilnya
    $response = curl_exec($ch);

    // Cek jika ada error saat melakukan request
    if ($response === false) {
        // Log error jika terjadi kesalahan cURL
        error_log("cURL Error: " . curl_error($ch));
        return null; // Return null jika gagal
    }

    // Tutup koneksi cURL
    curl_close($ch);

    // Decode JSON response
    return json_decode($response, true);
}
?>
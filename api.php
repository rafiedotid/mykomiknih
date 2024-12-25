<?php
include 'config.php';

// Fungsi untuk mendapatkan data terbaru
function get_latest_shinigami() {
    return get_api_data('get/latest');
}

// Fungsi untuk mendapatkan daftar chapter berdasarkan URL komik
function get_chapters_by_url($url) {
    return get_api_data('get/readurl', ['url' => $url]);
}

// Fungsi untuk mendapatkan gambar dari chapter berdasarkan URL
function get_chapter_images($url) {
    return get_api_data('get/readchapter', ['url' => $url]);
}

// Contoh penggunaan
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Menangani permintaan untuk mendapatkan komik terbaru
    if (isset($_GET['action']) && $_GET['action'] == 'latest') {
        $latestData = get_latest_shinigami();
        echo json_encode($latestData);
        exit;
    }

    // Menangani permintaan untuk mendapatkan daftar chapter berdasarkan URL
    if (isset($_GET['action']) && $_GET['action'] == 'chapters' && isset($_GET['url'])) {
        $chapterData = get_chapters_by_url($_GET['url']);
        echo json_encode($chapterData);
        exit;
    }

    // Menangani permintaan untuk mendapatkan gambar chapter berdasarkan URL
    if (isset($_GET['action']) && $_GET['action'] == 'chapterimag

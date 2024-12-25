<?php
include 'config.php';

$chapterUrl = isset($_GET['url']) ? urldecode($_GET['url']) : '';
$chapterImages = get_api_data('readchapter', ['url' => $chapterUrl]);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Baca Chapter</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <header>
        <div class="container">
            <h1>Baca Chapter</h1>
        </div>
    </header>

    <main class="container">
        <?php if ($chapterImages && $chapterImages['status']) : ?>
            <div class="chapter-images">
                <?php foreach ($chapterImages['result']['imageList'] as $image) : ?>
                    <div class="chapter-image-wrapper">
                        <img src="<?= htmlspecialchars($image) ?>" alt="Gambar Chapter" class="chapter-image">
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <p class="error-message">Gagal memuat gambar chapter. Silakan coba lagi nanti.</p>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2024 Web Komik - All Rights Reserved</p>
    </footer>
</body>
</html>
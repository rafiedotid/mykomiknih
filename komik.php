<?php
include 'config.php';

// Ambil data URL komik dari query string
$komikUrl = isset($_GET['url']) ? urldecode($_GET['url']) : '';

// Gunakan API readurl untuk mengambil data detail komik dan chapter
$chapterData = get_api_data('readurl', ['url' => $komikUrl]);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Komik</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <header>
        <div class="container">
            <h1>Detail Komik</h1>
        </div>
    </header>

    <main class="container">
        <?php if (isset($chapterData['status']) && $chapterData['status']) : ?>
            <h3>Sinopsis:</h3>
            <p><?= nl2br(htmlspecialchars($chapterData['result']['synopsis'])) ?></p>

            <div class="detail-list">
                <h3>Detail:</h3>
                <ul>
                    <?php 
                    // Pastikan detailList ada sebelum ditampilkan
                    if (isset($chapterData['result']['detailList'])):
                        foreach ($chapterData['result']['detailList'] as $detail) : ?>
                            <li><strong><?= htmlspecialchars($detail['name']) ?>:</strong> <?= htmlspecialchars($detail['value']) ?></li>
                        <?php endforeach; 
                    else: ?>
                        <li>Detail tidak tersedia.</li>
                    <?php endif; ?>
                </ul>
            </div>

            <h3>Daftar Chapter:</h3>
            <div class="grid">
                <?php 
                // Memastikan chapterList ada sebelum menampilkan
                if (isset($chapterData['result']['chapterList'])):
                    foreach ($chapterData['result']['chapterList'] as $chapter) : ?>
                        <div class="card">
                            <img src="<?= htmlspecialchars($chapter['cover']) ?>" alt="Cover Chapter" class="chapter-cover">
                            <div class="card-body">
                                <h4><?= htmlspecialchars($chapter['title']) ?></h4>
                                <p>Rilis: <?= htmlspecialchars($chapter['releaseDate']) ?></p>
                                <a href="chapter.php?url=<?= urlencode($chapter['url']) ?>" class="btn">Baca Chapter</a>
                            </div>
                        </div>
                    <?php endforeach; 
                else: ?>
                    <p>Daftar chapter tidak tersedia.</p>
                <?php endif; ?>
            </div>
        <?php else : ?>
            <p>Gagal mengambil data detail komik atau chapter.</p>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2024 Komik Baca - All Rights Reserved</p>
    </footer>
</body>
</html>
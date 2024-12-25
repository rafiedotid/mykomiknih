<?php
include 'config.php';

// Ambil data komik terbaru
$komikData = get_api_data('latest');

// Fitur pencarian
$searchQuery = isset($_GET['q']) ? $_GET['q'] : '';
$searchResults = [];
if ($searchQuery) {
    $searchResults = get_api_data('search', ['q' => $searchQuery]);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komik Terbaru</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <header>
        <div class="container">
            <h1>Daftar Komik</h1>
            <form method="get" action="index.php" class="search-form">
                <input type="text" name="q" placeholder="Cari komik..." value="<?= htmlspecialchars($searchQuery) ?>" autocomplete="off">
                <button type="submit">Cari</button>
            </form>
        </div>
    </header>

    <main class="container">
        <?php if ($searchQuery && isset($searchResults['status']) && $searchResults['status']) : ?>
            <h2>Hasil Pencarian: "<?= htmlspecialchars($searchQuery) ?>"</h2>
            <div class="grid">
                <?php foreach ($searchResults['result'] as $komik) : ?>
                    <div class="card">
                        <img src="<?= htmlspecialchars($komik['cover']) ?>" alt="<?= htmlspecialchars($komik['title']) ?>" class="card-img">
                        <div class="card-body">
                            <h3><?= htmlspecialchars($komik['title']) ?></h3>
                            <p>Chapter Terbaru: <a href="komik.php?url=<?= urlencode($komik['url']) ?>"><?= htmlspecialchars($komik['latestChapter']) ?></a></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php elseif (isset($komikData['status']) && $komikData['status']) : ?>
            <h2>Komik Terbaru</h2>
            <div class="grid">
                <?php foreach ($komikData['result'] as $komik) : ?>
                    <div class="card">
                        <img src="<?= htmlspecialchars($komik['cover']) ?>" alt="<?= htmlspecialchars($komik['title']) ?>" class="card-img">
                        <div class="card-body">
                            <h3><?= htmlspecialchars($komik['title']) ?></h3>
                            <p>Chapter Terbaru: <a href="komik.php?url=<?= urlencode($komik['url']) ?>"><?= htmlspecialchars($komik['latestChapter']) ?></a></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <p>Tidak ada data komik terbaru yang tersedia.</p>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2024 Web Komik</p>
    </footer>
</body>
</html>
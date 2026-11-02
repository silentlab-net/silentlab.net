<?php
$pageTitle = 'Videos - Silentlab';
$canonicalUrl = 'https://silentlab.net/videos.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php require __DIR__ . '/head.php'; ?>
</head>

<body>
  <?php require __DIR__ . '/toc.php'; ?>

  <div class="top-line">
    <div class="images"><svg class="icons" aria-hidden="true"><use href="/icons.svg#youtube"></use></svg></div>
    <h1>Videos</h1>
    <div class="images"><svg class="icons" aria-hidden="true"><use href="/icons.svg#youtube"></use></svg></div>
  </div>

  <div class="video-list">
    <?php foreach (['CGXePr3IMEg', 'tdpcyPqI4os', 'v8axkyLSGFk', '4GMEBjUOkgA'] as $videoId): ?>
      <div class="yt">
        <iframe src="https://youtube.com/embed/<?php echo htmlspecialchars($videoId, ENT_QUOTES, 'UTF-8'); ?>" title="Silentlab video" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen loading="lazy"></iframe>
      </div>
    <?php endforeach; ?>
  </div>

  <?php require __DIR__ . '/footer.php'; ?>
</body>
</html>

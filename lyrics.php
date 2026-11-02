<?php
$pageTitle = 'Lyrics - Silentlab';
$canonicalUrl = 'https://silentlab.net/lyrics.php';
$lyricsPath = __DIR__ . '/data/lyrics.json';
$lyricsContent = file_get_contents($lyricsPath);
if ($lyricsContent === false) {
  error_log('Unable to read Silentlab lyrics from ' . $lyricsPath);
  http_response_code(500);
  exit('Unable to load lyrics.');
}

try {
  $lyricsData = json_decode($lyricsContent, true, 512, JSON_THROW_ON_ERROR);
} catch (JsonException $error) {
  error_log('Unable to decode Silentlab lyrics: ' . $error->getMessage());
  http_response_code(500);
  exit('Unable to load lyrics.');
}

if (!is_array($lyricsData) || !isset($lyricsData['entries']) || !is_array($lyricsData['entries'])) {
  error_log('Silentlab lyrics data has an invalid structure.');
  http_response_code(500);
  exit('Unable to load lyrics.');
}

foreach ($lyricsData['entries'] as $entry) {
  if (!is_array($entry) || !isset($entry['title'], $entry['lines']) ||
    !is_string($entry['title']) || !is_array($entry['lines']) ||
    count(array_filter($entry['lines'], 'is_string')) !== count($entry['lines'])) {
    error_log('Silentlab lyrics data contains an invalid entry.');
    http_response_code(500);
    exit('Unable to load lyrics.');
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php require __DIR__ . '/head.php'; ?>
</head>

<body>
  <?php require __DIR__ . '/toc.php'; ?>

  <div class="top-line">
    <div class="images"><svg class="icons" aria-hidden="true"><use href="/icons.svg#lp"></use></svg></div>
    <h1>Lyrics</h1>
    <div class="images"><svg class="icons" aria-hidden="true"><use href="/icons.svg#lp"></use></svg></div>
  </div>

  <?php foreach ($lyricsData['entries'] as $entry): ?>
    <article class="lyrics-entry padded colored">
      <h2><?php echo htmlspecialchars($entry['title'], ENT_QUOTES, 'UTF-8'); ?></h2>
      <div class="lyrics-text"><?php echo htmlspecialchars(implode("\n", $entry['lines']), ENT_QUOTES, 'UTF-8'); ?></div>
    </article>
  <?php endforeach; ?>

  <?php require __DIR__ . '/footer.php'; ?>
</body>
</html>

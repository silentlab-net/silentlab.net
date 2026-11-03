<?php
$pageTitle = 'Releases - Silentlab';
$canonicalUrl = 'https://silentlab.net/releases';
$isReleasePage = $isReleasePage ?? false;
$releasesPath = __DIR__ . '/data/releases.json';
$releasesContent = file_get_contents($releasesPath);
if ($releasesContent === false) {
  error_log('Unable to read Silentlab releases from ' . $releasesPath);
  http_response_code(500);
  exit('Unable to load releases.');
}

try {
  $releasesData = json_decode($releasesContent, true, 512, JSON_THROW_ON_ERROR);
} catch (JsonException $error) {
  error_log('Unable to decode Silentlab releases: ' . $error->getMessage());
  http_response_code(500);
  exit('Unable to load releases.');
}

if (!is_array($releasesData) || !isset($releasesData['entries']) || !is_array($releasesData['entries'])) {
  error_log('Silentlab releases data has an invalid structure.');
  http_response_code(500);
  exit('Unable to load releases.');
}

foreach ($releasesData['entries'] as $entry) {
  if (!is_array($entry) || !isset($entry['title'], $entry['cover'], $entry['url']) ||
    !is_string($entry['title']) || !is_string($entry['cover']) || !is_string($entry['url']) ||
    !preg_match('~^/photos_disco/[a-z0-9_]+\.png$~', $entry['cover']) ||
    !filter_var($entry['url'], FILTER_VALIDATE_URL) || parse_url($entry['url'], PHP_URL_SCHEME) !== 'https') {
    error_log('Silentlab releases data contains an invalid entry.');
    http_response_code(500);
    exit('Unable to load releases.');
  }
}

$release = null;
if ($isReleasePage) {
  $requestedId = $_GET['a'] ?? '';
  foreach ($releasesData['entries'] as $entry) {
    if (is_string($requestedId) && pathinfo($entry['cover'], PATHINFO_FILENAME) === $requestedId) {
      $release = $entry;
      break;
    }
  }
  if ($release === null) {
    http_response_code(404);
    $pageTitle = 'Release not found - Silentlab';
    $canonicalUrl = 'https://silentlab.net/release.php';
  } else {
    $pageTitle = $release['title'] . ' - Silentlab';
    $canonicalUrl = 'https://silentlab.net/release.php?a=' . rawurlencode($requestedId);
    $ogImage = 'https://silentlab.net' . $release['cover'];
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
    <h1><?php echo htmlspecialchars($isReleasePage ? ($release['title'] ?? 'Release not found') : 'Releases', ENT_QUOTES, 'UTF-8'); ?></h1>
    <div class="images"><svg class="icons" aria-hidden="true"><use href="/icons.svg#lp"></use></svg></div>
  </div>

  <?php if ($isReleasePage): ?>
    <article class="release-detail padded colored">
      <?php if ($release !== null): ?>
        <a class="release-cover-link" href="<?php echo htmlspecialchars($release['url'], ENT_QUOTES, 'UTF-8'); ?>" title="Spotify">
          <img src="<?php echo htmlspecialchars($release['cover'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($release['title'], ENT_QUOTES, 'UTF-8'); ?>">
        </a>
        <p><a href="<?php echo htmlspecialchars($release['url'], ENT_QUOTES, 'UTF-8'); ?>">Listen on Spotify</a></p>
      <?php endif; ?>
      <p><a href="/releases">All releases</a></p>
    </article>
  <?php else: ?>
  <div class="featured-releases">
    <?php foreach ($releasesData['entries'] as $entry): ?>
      <article class="featured-release">
        <a href="/release.php?a=<?php echo rawurlencode(pathinfo($entry['cover'], PATHINFO_FILENAME)); ?>">
          <img src="<?php echo htmlspecialchars($entry['cover'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($entry['title'], ENT_QUOTES, 'UTF-8'); ?>" loading="lazy">
        </a>
      </article>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>

  <?php require __DIR__ . '/footer.php'; ?>
</body>
</html>

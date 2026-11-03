<?php
require_once __DIR__ . '/live-data.php';
$events = loadLiveEntries();
usort($events, fn(array $left, array $right): int => strcmp(liveEntrySortKey($left), liveEntrySortKey($right)));

$requestedId = $_GET['a'] ?? '';
$currentIndex = false;
if (is_string($requestedId) && preg_match('/\A[A-Za-z0-9_-]+\z/', $requestedId)) {
  $currentIndex = array_search($requestedId, array_column($events, 'id'), true);
}

$event = $currentIndex === false ? null : $events[$currentIndex];
$pageTitle = $event === null ? 'Event - Silentlab' : $event['date'] . ' - Silentlab';
$canonicalUrl = $event === null
  ? 'https://silentlab.net/event.php'
  : 'https://silentlab.net/event.php?a=' . rawurlencode($event['id']);
$setlist = null;
if ($event !== null) {
  $setlistPath = __DIR__ . '/setlists/' . $event['id'] . '.txt';
  if (is_file($setlistPath)) {
    $setlist = file_get_contents($setlistPath);
    if ($setlist === false) {
      error_log('Unable to read live setlist ' . $setlistPath);
      http_response_code(500);
      exit('Unable to load setlist.');
    }
  }
}
if ($event === null) {
  http_response_code(404);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php require __DIR__ . '/head.php'; ?>
</head>

<body>
  <?php require __DIR__ . '/toc.php'; ?>

  <?php if ($event === null): ?>
    <div class="top-line">
      <div class="images"><svg class="icons" aria-hidden="true"><use href="/icons.svg#calendar"></use></svg></div>
      <h1>Event not found</h1>
      <div class="images"><svg class="icons" aria-hidden="true"><use href="/icons.svg#calendar"></use></svg></div>
    </div>
  <?php else: ?>
    <?php
    $previousIndex = ($currentIndex - 1 + count($events)) % count($events);
    $nextIndex = ($currentIndex + 1) % count($events);
    $posterPath = __DIR__ . '/live_posters_small/' . $event['id'] . '.png';
    $posterUrl = is_file($posterPath) ? '/live_posters_small/' . rawurlencode($event['id']) . '.png' : '/img/lp.png';
    ?>
    <div class="top-line">
      <div class="images"><a href="/event.php?a=<?php echo rawurlencode($events[$previousIndex]['id']); ?>">Previous</a></div>
      <h1><?php echo htmlspecialchars($event['date'], ENT_QUOTES, 'UTF-8'); ?></h1>
      <div class="images"><a href="/event.php?a=<?php echo rawurlencode($events[$nextIndex]['id']); ?>">Next</a></div>
    </div>

    <article class="padded colored">
      <div class="live-detail-photo">
        <img src="<?php echo htmlspecialchars($posterUrl, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars((trim($event['event']) !== '' ? $event['event'] : 'Silentlab event') . ' poster', ENT_QUOTES, 'UTF-8'); ?>">
      </div>
      <div class="entry-text">
        <?php if (trim($event['event']) !== ''): ?>
          <h2><?php echo htmlspecialchars($event['event'], ENT_QUOTES, 'UTF-8'); ?></h2>
        <?php endif; ?>
        <p><strong>Artist:</strong> <?php echo htmlspecialchars($event['artist'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p><strong>Location:</strong> <?php echo htmlspecialchars($event['location'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p><strong>City:</strong> <?php echo htmlspecialchars($event['city'], ENT_QUOTES, 'UTF-8'); ?></p>
        <?php if (!empty($event['tracks'])): ?>
          <p><strong>Tracks:</strong> <?php echo htmlspecialchars($event['tracks'], ENT_QUOTES, 'UTF-8'); ?></p>
        <?php endif; ?>
        <?php if (!empty($event['facebook']) && filter_var($event['facebook'], FILTER_VALIDATE_URL)): ?>
          <p><a href="<?php echo htmlspecialchars($event['facebook'], ENT_QUOTES, 'UTF-8'); ?>">Facebook event</a></p>
        <?php endif; ?>
      </div>
    </article>

    <?php if ($setlist !== null): ?>
      <section class="padded colored">
        <h2>Setlist</h2>
        <div class="lyrics-text"><?php echo htmlspecialchars($setlist, ENT_QUOTES, 'UTF-8'); ?></div>
      </section>
    <?php endif; ?>
  <?php endif; ?>

  <?php require __DIR__ . '/footer.php'; ?>
</body>
</html>

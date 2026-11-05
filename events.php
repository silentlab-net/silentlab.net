<?php
$pageTitle = 'Events - Silentlab';
$canonicalUrl = 'https://silentlab.net/events';
$view = $_GET['view'] ?? 'grid';
if (!is_string($view) || !in_array($view, ['grid', 'details'], true)) {
  error_log('Invalid events archive view.');
  http_response_code(400);
  exit('Invalid events view.');
}
require_once __DIR__ . '/live-data.php';
$events = loadLiveEntries();
usort($events, fn(array $left, array $right): int => strcmp(liveEntrySortKey($right), liveEntrySortKey($left)));
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php require __DIR__ . '/head.php'; ?>
</head>

<body>
  <?php require __DIR__ . '/toc.php'; ?>
  <?php require __DIR__ . '/live_toc.php'; ?>

  <div class="<?php echo $view === 'grid' ? 'live-grid' : 'live-details'; ?>">
    <?php foreach ($events as $event): ?>
      <?php
      $posterPath = __DIR__ . '/live_posters_small/' . $event['id'] . '.png';
      $posterUrl = is_file($posterPath) ? '/live_posters_small/' . rawurlencode($event['id']) . '.png' : '/img/lp.png';
      $eventName = trim($event['event']) !== '' ? $event['event'] : $event['artist'];
      ?>
      <article class="<?php echo $view === 'grid' ? 'live-card' : 'section-entry padded colored'; ?>">
        <a href="/event?a=<?php echo rawurlencode($event['id']); ?>">
          <img class="<?php echo $view === 'details' ? 'entry-cover entry-event-photo' : ''; ?>" src="<?php echo htmlspecialchars($posterUrl, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($eventName . ' live poster', ENT_QUOTES, 'UTF-8'); ?>" loading="lazy">
        </a>
        <div class="entry-text">
        <h2><a href="/event?a=<?php echo rawurlencode($event['id']); ?>"><?php echo htmlspecialchars($event['date'], ENT_QUOTES, 'UTF-8'); ?></a></h2>
        <?php if (trim($event['event']) !== ''): ?>
          <div><?php echo htmlspecialchars($event['event'], ENT_QUOTES, 'UTF-8'); ?></div>
        <?php endif; ?>
        <div><?php echo htmlspecialchars($event['location'], ENT_QUOTES, 'UTF-8'); ?></div>
        <div><svg class="entry-metadata-icon" aria-hidden="true"><use href="/icons.svg#world"></use></svg> <?php echo htmlspecialchars($event['city'], ENT_QUOTES, 'UTF-8'); ?></div>
        </div>
      </article>
    <?php endforeach; ?>
  </div>

  <?php require __DIR__ . '/footer.php'; ?>
</body>
</html>

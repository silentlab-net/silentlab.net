<?php
$pageTitle = 'Events - Silentlab';
$canonicalUrl = 'https://silentlab.net/live_grid.php';
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

  <div class="live-grid">
    <?php foreach ($events as $event): ?>
      <?php
      $posterPath = __DIR__ . '/live_posters_small/' . $event['id'] . '.png';
      $posterUrl = is_file($posterPath) ? '/live_posters_small/' . rawurlencode($event['id']) . '.png' : '/img/lp.png';
      $eventName = trim($event['event']) !== '' ? $event['event'] : $event['artist'];
      ?>
      <article class="live-card">
        <a href="/live.php?a=<?php echo rawurlencode($event['id']); ?>">
          <img src="<?php echo htmlspecialchars($posterUrl, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($eventName . ' live poster', ENT_QUOTES, 'UTF-8'); ?>" loading="lazy">
        </a>
        <h2><a href="/live.php?a=<?php echo rawurlencode($event['id']); ?>"><?php echo htmlspecialchars($event['date'], ENT_QUOTES, 'UTF-8'); ?></a></h2>
        <?php if (trim($event['event']) !== ''): ?>
          <div><?php echo htmlspecialchars($event['event'], ENT_QUOTES, 'UTF-8'); ?></div>
        <?php endif; ?>
        <div><?php echo htmlspecialchars($event['location'], ENT_QUOTES, 'UTF-8'); ?></div>
        <div><?php echo htmlspecialchars($event['city'], ENT_QUOTES, 'UTF-8'); ?></div>
      </article>
    <?php endforeach; ?>
  </div>

  <?php require __DIR__ . '/footer.php'; ?>
</body>
</html>

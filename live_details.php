<?php
$pageTitle = 'Events details - Silentlab';
$canonicalUrl = 'https://silentlab.net/live_details.php';
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

  <?php foreach ($events as $event): ?>
    <?php
    $posterPath = __DIR__ . '/live_posters_small/' . $event['id'] . '.png';
    $posterUrl = is_file($posterPath) ? '/live_posters_small/' . rawurlencode($event['id']) . '.png' : '/img/lp.png';
    $eventName = trim($event['event']) !== '' ? $event['event'] : $event['artist'];
    ?>
    <article class="section-entry padded colored">
      <a href="/live.php?a=<?php echo rawurlencode($event['id']); ?>">
        <img class="entry-cover entry-event-photo" src="<?php echo htmlspecialchars($posterUrl, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($eventName . ' event poster', ENT_QUOTES, 'UTF-8'); ?>" loading="lazy">
      </a>
      <div class="entry-text">
        <h2><a href="/live.php?a=<?php echo rawurlencode($event['id']); ?>"><?php echo htmlspecialchars($event['date'], ENT_QUOTES, 'UTF-8'); ?></a></h2>
        <?php if (trim($event['event']) !== ''): ?>
          <p><?php echo htmlspecialchars($event['event'], ENT_QUOTES, 'UTF-8'); ?></p>
        <?php endif; ?>
        <p><?php echo htmlspecialchars($event['location'], ENT_QUOTES, 'UTF-8'); ?><br><?php echo htmlspecialchars($event['city'], ENT_QUOTES, 'UTF-8'); ?></p>
      </div>
    </article>
  <?php endforeach; ?>

  <?php require __DIR__ . '/footer.php'; ?>
</body>
</html>

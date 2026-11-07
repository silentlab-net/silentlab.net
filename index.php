<!DOCTYPE html>
<html lang="en">
<head>
  <?php
  $pageTitle = 'Silentlab';
  $pageDescription = 'The official website for the band Silentlab, with events, videos, lyrics and music.';
  $canonicalUrl = 'https://silentlab.net/';
  require __DIR__ . '/head.php';
  ?>
</head>

<body>
  <?php require __DIR__ . '/toc.php'; ?>

  <div class="top-line">
    <div class="images"><svg class="icons" aria-hidden="true"><use href="/icons.svg?v=<?php echo filemtime(__DIR__ . '/icons.svg'); ?>#t-shirt"></use></svg></div>
    <h1>Merch</h1>
    <div class="images">
      <svg class="icons show-pointer" role="button" tabindex="0" aria-label="Expand/collapse" onclick="toggleDiv('wearContainer')">
        <title>Expand/collapse</title><use href="/icons.svg#triangle_down"></use>
      </svg>
    </div>
  </div>
  <div class="padded center-on-medium-screen colored" id="wearContainer">
    <a href="https://pekowear.myspreadshop.no">T-shirts available on Peko Wear</a>.
    <a class="merch-image-link" href="https://pekowear.myspreadshop.no" title="Peko Wear">
      <img class="home-logo" src="/img/t-shirt_peko_wear_capture.png" alt="Peko Wear">
    </a>
  </div>

  <section class="label-feature padded colored">
    <a href="https://fuzzpop.no" title="Fuzz Pop">
      <img class="label-logo" src="/img/fuzz_pop.svg" alt="Fuzz Pop">
    </a>
    <p>Silentlab is an artist on the Fuzz Pop label.</p>
  </section>

  <?php require __DIR__ . '/footer.php'; ?>
</body>
</html>

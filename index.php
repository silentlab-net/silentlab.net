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

  <section class="page-introduction padded center-on-medium-screen colored">
    <img class="home-logo" src="/img/logo.png" alt="Silentlab">
  </section>

  <div class="top-line">
    <div class="images"><svg class="icons" aria-hidden="true"><use href="/icons.svg#spotify"></use></svg></div>
    <h1>Music</h1>
    <div class="images">
      <button class="section-toggle" type="button" aria-controls="musicContainer" aria-expanded="true" aria-label="Minimize music" title="Minimize" data-expanded-label="Minimize music" data-collapsed-label="Restore music" data-expanded-title="Minimize" data-collapsed-title="Restore" onclick="toggleDiv('musicContainer', this)">
        <svg class="icons" aria-hidden="true" focusable="false"><use href="/icons.svg#triangle_down"></use></svg>
      </button>
    </div>
  </div>

  <div class="featured-releases" id="musicContainer">
    <article class="featured-release">
      <a href="https://open.spotify.com/album/36rZz7FclkfnC3HoZ8kP7S">
        <img src="/photos_disco/the_day_we_spent_in_spain_mc_peko_remix.png" alt="The Day We Spent In Spain (MC Peko Remix)" loading="lazy">
      </a>
    </article>
    <article class="featured-release">
      <a href="https://open.spotify.com/album/7oesEs2buuVx0D1RdyIIXU">
        <img src="/photos_disco/lonesome_town_mc_peko_remix.png" alt="Lonesome Town (MC Peko Remix)" loading="lazy">
      </a>
    </article>
    <article class="featured-release">
      <a href="https://open.spotify.com/album/2YcW2MMKnbXzpXDcYB1kzg">
        <img src="/photos_disco/sundays.png" alt="Sundays" loading="lazy">
      </a>
      <p>Buy the debut EP CD released on Fuzz Pop in 2016!</p>
    </article>
  </div>

  <div class="top-line">
    <div class="images"><svg class="icons" aria-hidden="true"><use href="/icons.svg#soundcloud"></use></svg></div>
    <h1>Follow Silentlab</h1>
    <div class="images">
      <svg class="icons show-pointer" role="button" tabindex="0" aria-label="Expand/collapse" onclick="toggleDiv('followContainer')">
        <title>Expand/collapse</title><use href="/icons.svg#triangle_down"></use>
      </svg>
    </div>
  </div>

  <div class="padded center-on-medium-screen colored site-links" id="followContainer">
    <a href="https://facebook.com/silentlab">Facebook</a>
    <a href="https://soundcloud.com/silentlab">SoundCloud</a>
  </div>

  <div class="top-line">
    <div class="images"><svg class="icons" aria-hidden="true"><use href="/icons.svg#calendar"></use></svg></div>
    <h1>Events</h1>
    <div class="images">
      <svg class="icons show-pointer" role="button" tabindex="0" aria-label="Expand/collapse" onclick="toggleDiv('liveContainer')">
        <title>Expand/collapse</title><use href="/icons.svg#triangle_down"></use>
      </svg>
    </div>
  </div>
  <div class="padded center-on-medium-screen colored" id="liveContainer">
    <a href="/live_grid.php">Events and posters</a>.
  </div>

  <div class="top-line">
    <div class="images"><svg class="icons" aria-hidden="true"><use href="/icons.svg#youtube"></use></svg></div>
    <h1>Videos</h1>
    <div class="images">
      <svg class="icons show-pointer" role="button" tabindex="0" aria-label="Expand/collapse" onclick="toggleDiv('videosContainer')">
        <title>Expand/collapse</title><use href="/icons.svg#triangle_down"></use>
      </svg>
    </div>
  </div>
  <div class="padded center-on-medium-screen colored" id="videosContainer">
    <a href="/videos.php">Silentlab videos</a>.
  </div>

  <div class="top-line">
    <div class="images"><svg class="icons" aria-hidden="true"><use href="/icons.svg#lp"></use></svg></div>
    <h1>Lyrics</h1>
    <div class="images">
      <svg class="icons show-pointer" role="button" tabindex="0" aria-label="Expand/collapse" onclick="toggleDiv('lyricsContainer')">
        <title>Expand/collapse</title><use href="/icons.svg#triangle_down"></use>
      </svg>
    </div>
  </div>
  <div class="padded center-on-medium-screen colored" id="lyricsContainer">
    <a href="/lyrics.php">Lyrics</a>.
  </div>

  <section class="label-feature padded colored">
    <h2>Fuzz Pop</h2>
    <p>Silentlab is an artist on the Fuzz Pop label.</p>
    <a href="https://fuzzpop.no" title="Visit Fuzz Pop">
      <img class="label-logo" src="/img/fuzz_pop.svg" alt="Fuzz Pop">
    </a>
  </section>

  <div class="top-line">
    <div class="images"><svg class="icons" aria-hidden="true"><use href="/icons.svg#asterisk"></use></svg></div>
    <h1>Peko Wear</h1>
    <div class="images">
      <svg class="icons show-pointer" role="button" tabindex="0" aria-label="Expand/collapse" onclick="toggleDiv('wearContainer')">
        <title>Expand/collapse</title><use href="/icons.svg#triangle_down"></use>
      </svg>
    </div>
  </div>
  <div class="padded center-on-medium-screen colored" id="wearContainer">
    <a href="https://pekowear.myspreadshop.no">T-shirts available on Peko Wear</a>.
    <a href="https://pekowear.myspreadshop.no">
      <img class="home-logo" src="/img/t-shirt_peko_wear_capture.png" alt="Peko Wear">
    </a>
  </div>

  <?php require __DIR__ . '/footer.php'; ?>
</body>
</html>

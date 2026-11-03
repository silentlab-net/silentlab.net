<nav class="top-line" aria-label="Events views">
  <div class="images">
    <svg class="icons" aria-hidden="true"><use href="/icons.svg#calendar"></use></svg>
  </div>
  <h1>Events</h1>
  <div class="live-view-links">
    <a href="/events?view=details"<?php echo $view === 'details' ? ' aria-current="page"' : ''; ?>>Details</a>
    <a href="/events"<?php echo $view === 'grid' ? ' aria-current="page"' : ''; ?>>Grid</a>
  </div>
</nav>

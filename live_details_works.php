<!DOCTYPE html>
<html>
<head>
  <?php require($_SERVER['DOCUMENT_ROOT'] . "/head.php"); ?>
</head>
<body>

<?php require($_SERVER['DOCUMENT_ROOT'] . "/toc.php"); ?>
<?php require($_SERVER['DOCUMENT_ROOT'] . "/live_toc.php"); ?>

<div class="standard colored">
  <?php
  $liveFiles = glob('live/*.txt'); // Get text files from folder
  ?>
  <p>
    <?php echo "Concerts: " . count($liveFiles) . ". Sorting is chronological."; ?>
  </p>
</div>

<br>

<style>
  .list-item {
    display: flex;
    align-items: flex-start; /* Align items to the top of the div */
  }

  .list-item img {
    width: 200px;
    height: 283px;
    margin-right: 20px; /* Add space between image and content */
  }

  .list-item .content {
    flex-grow: 1; /* Allow content to grow and fill remaining space */
  }

  /* Adjustments for smaller screens */
  @media (max-width: 768px) {
    .list-item {
      flex-direction: column; /* Stack content vertically on smaller screens */
      align-items: center; /* Center align items horizontally on smaller screens */
      text-align: center; /* Center-align text on smaller screens */
    }

    .list-item img {
      margin: auto; /* Remove image margin on smaller screens */
      margin-bottom: 10px; /* Add space below image on smaller screens */
      width: 100%;
      height: auto;
    }
  }
</style>

<div class="standard tight">
  <?php
  $liveFiles = glob('live/*.txt'); // Get text files from folder

  // Create an array to store entries with their dates
  $entries = [];

  foreach ($liveFiles as $index => $txtFile) {
    $liveName = basename($txtFile, '.txt');
    $discoUrl = 'live.php?a=' . urlencode($liveName);

    // Read lines from the text file
    $fileContents = file($txtFile);
    $artist = trim($fileContents[0]); // Artist
    $artistUrl = trim($fileContents[1]); // Artist URL
    $songTitle = trim($fileContents[2]); // Track title
    $catNumber = trim($fileContents[3]); // Catalogue number
    $format = trim($fileContents[4]); // Format
    $price = trim($fileContents[7]); // Price
    $date = trim($fileContents[8]); // Date
    $spotifyUrl = trim($fileContents[9]); // Spotify URL

    // Define the image URL based on the liveName
    $imgUrl = 'live_posters_small/' . $liveName . '.png';
    if (!file_exists($imgUrl)) {
      $imgUrl = 'img/lp.png'; // Use default image if no photo found
    }

    // Store release information in an array
    $entries[] = [
      'liveUrl' => $discoUrl,
      'imgUrl' => $imgUrl,
      'liveName' => $liveName,
      'catNumber' => $catNumber,
      'artistUrl' => $artistUrl,
      'artist' => $artist,
      'spotifyUrl' => $spotifyUrl,
      'songTitle' => $songTitle,
      'format' => $format,
      'price' => $price,
      'date' => $date,
    ];
  }

  // Sort entries by date in descending order (latest first)
  usort($entries, function($a, $b) {
    return strtotime($b['date']) - strtotime($a['date']);
  });

  // Display the sorted entries
foreach ($entries as $release) {
    echo sprintf(
        '<div class="list-item tight">
            <a href="%s">
                <img src="%s" alt="%s" title="%s">
            </a>
            <div class="content">
                <h1 class="release_heading">',
        $release['discoUrl'],
        $release['imgUrl'],
        $release['liveName'],
        $release['catNumber']
    );

    // Check if $artistUrl is empty
    if (!empty($release['artistUrl'])) {
        echo '<a href="' . $release['artistUrl'] . '">' . $release['artist'] . '</a>';
    } else {
        echo $release['artist'];
    }

    // Check if $spotifyUrl is empty for the title
    if (!empty($release['spotifyUrl'])) {
        echo ' - <a href="' . $release['spotifyUrl'] . '" target="_blank">' . $release['songTitle'] . '</a>';
    } else {
        echo ' - ' . $release['songTitle'];
    }

    echo sprintf(
        '</h1>
                <div><span title="Location, Event, City">LOCATION:</span> %s</div>
                <div><span title="City">CITY:</span> coming</div>
                <div><span title="Format">FORMAT:</span> %s</div>
                <div><span title="Price in Norwegian Kroners">PRICE:</span> %s</div>
                <div><span title="Release date">DATE:</span> %s</div>
            </div>
        </div><br><br>',
        $release['catNumber'],
        $release['format'],
        $release['price'],
        $release['date']
    );
}

  ?>
</div>

<?php require($_SERVER['DOCUMENT_ROOT'] . "/footer.php"); ?>

</body>
</html>
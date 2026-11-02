Spot any errors in this document?

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
    	<br>
      <?php echo
    	"Events: " . count($liveFiles) . ".
    	Sorting is alphabetical."; 
    	?>
    	<br>
    	<br>
    </p>
</div>

<br>

<div class="grid-container" id="gridContainer">
	
<?php

$liveFiles = glob('live/*.txt'); // Get text files from folder

foreach ($liveFiles as $index => $txtFile) {
    $liveName = basename($txtFile, '.txt');
    $liveUrl = 'live.php?a=' . urlencode($liveName);
    
    $imgUrl = 'live_posters_small/' . $liveName . '.png';
    if (!file_exists($imgUrl)) {
        $imgUrl = 'img/lp.png'; // Use default image if no photo found

$date = trim($liveFiles[0]); // Date       

    }

    echo sprintf(
        '<div class="grid-item">
            <a href="%s">
                <img src="%s" alt="%s" title="%s" style="width: 100px; height: 130px;">
            </a>
        </div>',
        $liveUrl,
        $imgUrl,
        $liveName,
        $date
    );
}
?>

</div>

<?php require($_SERVER['DOCUMENT_ROOT'] . "/footer.php"); ?>

</body>
</html>
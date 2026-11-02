<!DOCTYPE html>
<html lang="en">
<head>

<?php
require($_SERVER['DOCUMENT_ROOT'] . "/head.php");
?>

    <style>
        /* Add space between the skip buttons */
        .skip-buttons {
            text-align: center; /* Center the buttons horizontally */
        }

        .skip-button {
            margin: 0 50px; /* Add space between the buttons */
        }
    </style>
</head>
<body>

<?php
require($_SERVER['DOCUMENT_ROOT'] . "/toc.php");
require($_SERVER['DOCUMENT_ROOT'] . "/live_toc.php");

// Get the requested concert's filename from the URL parameter
$disco = isset($_GET['a']) ? $_GET['a'] : '';
$disco_path = 'live/' . $disco . '.txt';

// Check if the requested concert file exists
if (file_exists($disco_path)) {
    // Read the contents of the concert file
    $contents = file($disco_path);

    // Extract and format the concert date and identifier
    $date_raw = trim($contents[0]);
    $date_match = [];
    if (preg_match('/^(\d{2}-\d{2}-\d{4})_(\d{2})$/', $date_raw, $date_match)) {
        $date_formatted = $date_match[1]; // Extract the date part
        $event_identifier = $date_match[2]; // Extract the event identifier
    } else {
        $date_formatted = $date_raw; // Use the original date if format is invalid
        $event_identifier = ''; // No identifier
    }
?>

    <div class="standard colored">
        <!-- Display the skip left and right buttons -->
        <h1>
            <br>
            <div class="skip-buttons">
                <?php
                // Get the list of concert files and sort them chronologically
                $concert_files = glob('live/*.txt');
                $sorted_concerts = [];

                foreach ($concert_files as $concert_file) {
                    $file_contents = file($concert_file);
                    $file_date_raw = trim($file_contents[0]);
                    $file_date_match = [];

                    // Extract date and identifier using regex
                    if (preg_match('/^(\d{2}-\d{2}-\d{4})_(\d{2})$/', $file_date_raw, $file_date_match)) {
                        $file_timestamp = strtotime($file_date_match[1]); // Extract the date part
                        $file_event_identifier = $file_date_match[2]; // Extract the event identifier
                        $sorted_concerts["$file_timestamp_$file_event_identifier"] = basename($concert_file, '.txt');
                    }
                }

                // Sort the concerts by date and event identifier in ascending order
                ksort($sorted_concerts);

                // Find the current concert's position in the sorted list
                $current_position = array_search("$disco_$event_identifier", array_keys($sorted_concerts));
                $prev_position = ($current_position - 1 + count($sorted_concerts)) % count($sorted_concerts);
                $next_position = ($current_position + 1) % count($sorted_concerts);

                $prev_concert_file = $sorted_concerts[array_values($sorted_concerts)[$prev_position]];
                $next_concert_file = $sorted_concerts[array_values($sorted_concerts)[$next_position]];

                $prev_concert = basename($prev_concert_file, '.txt');
                $next_concert = basename($next_concert_file, '.txt');
                ?>

                <span id="skip-left-btn" class="skip-button">
                    <a href="<?php echo 'live.php?a=' . $prev_concert; ?>"><img src="img/prev.png" title="PREV"></a>
                </span>

                <span id="skip-right-btn" class="skip-button">
                    <a href="<?php echo 'live.php?a=' . $next_concert; ?>"><img src="img/next.png" title="NEXT"></a>
                </span>
            </div>

            <?php echo $date_formatted; ?>
            <br>
            <br>
        </h1>
    </div>

    <br>

    <?php
    // Check if there is a poster for this event
    $poster_path = 'live_posters_small/' . $disco . '.png';
    if (file_exists($poster_path)) {
        echo "<img src='$poster_path' title='$date_formatted' style='width: 1018px;' class='full'>";
    } else {
        echo "<img src='img/lp.png' title='No poster for this event' style='width: 1018px;' class='full'>";
    }
    ?>

    <div class="black">
        <br>
        <br>

        <?php
        // Display event details
        $event = trim($contents[3]);
        if (!empty($event)) {
            echo "<span title='Event'>EVENT: </span>" . $event . "<br>";
        }

        $location = trim($contents[4]);
        if (!empty($location)) {
            echo "<span title='Location'>LOCATION: </span>" . $location . "<br>";
        }

        $city = trim($contents[5]);
        if (!empty($city)) {
            echo "<span title='City'>CITY: </span>" . $city . "<br>";
        }

        $tracks = trim($contents[6]);
        if (!empty($tracks)) {
            echo "<span title='Number of tracks'>TRACKS: </span>" . $tracks . "<br>";
        }

        $facebook = trim($contents[7]);
        if (!empty($facebook)) {
            echo "<span title='Facebook event'>FACEBOOK: </span><a href='" . $facebook . "'>" . $facebook . "</a><br>";
        } else {
            echo $facebook;
        }

        $tracklistFile = 'setlists/' . $disco . '.txt';

        if (file_exists($tracklistFile)) {
            echo "<br><br><h1>SETLIST</h1>";
            $lines = file($tracklistFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            if ($lines !== false) {
                foreach ($lines as $line) {
                    echo $line . "<br>";
                }
                echo "<br><br>";
            } else {
                echo "Could not read the setlist file.";
            }
        }
        ?>

    </div>

<?php
} else {
    // Handle the case when the requested concert file doesn't exist
    echo "Concert not found for '$disco'.";
}
?>

<?php require($_SERVER['DOCUMENT_ROOT'] . "/footer.php"); ?>
</body>
</html>

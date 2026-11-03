<?php
$query = $_GET;
$query['view'] = 'details';
header('Location: /events?' . http_build_query($query), true, 301);
exit;

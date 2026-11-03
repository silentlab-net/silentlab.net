<?php
$pageTitle = isset($pageTitle) ? $pageTitle : 'Silentlab';
$pageDescription = isset($pageDescription) ? $pageDescription : 'The official website for the band Silentlab.';
$requestUri = $_SERVER['REQUEST_URI'] ?? '/';
$canonicalUri = preg_replace('~^/index\.php(?=\?|$)~', '/', $requestUri);
$canonicalUrl = isset($canonicalUrl) ? $canonicalUrl : 'https://silentlab.net' . $canonicalUri;
?>
<title><?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></title>
<meta charset="utf-8">
<link rel="icon" href="/favicon.png" type="image/png">
<link rel="stylesheet" type="text/css" href="/style.css?v=<?php echo filemtime(__DIR__ . '/style.css'); ?>">
<link rel="canonical" href="<?php echo htmlspecialchars($canonicalUrl, ENT_QUOTES, 'UTF-8'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta property="og:title" content="<?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?>">
<meta property="og:type" content="website">
<meta property="og:url" content="<?php echo htmlspecialchars($canonicalUrl, ENT_QUOTES, 'UTF-8'); ?>">
<meta property="og:image" content="<?php echo htmlspecialchars($ogImage ?? ('https://silentlab.net/img/logo.png?v=' . filemtime(__DIR__ . '/img/logo.png')), ENT_QUOTES, 'UTF-8'); ?>">
<meta property="og:image:type" content="image/png">
<meta property="og:description" content="<?php echo htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8'); ?>">
<meta name="keywords" content="Silentlab, Silentlab band, Marie Viktoria Borge-Eriksen, Marie Viktoria Eriksen, Marie Eriksen">
<meta name="description" content="<?php echo htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8'); ?>">

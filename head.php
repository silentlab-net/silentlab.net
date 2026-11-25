<?php
$pageTitle = isset($pageTitle) ? $pageTitle : 'Silentlab';
$pageDescription = isset($pageDescription) ? $pageDescription : 'The official website for the band Silentlab.';
$requestUri = $_SERVER['REQUEST_URI'] ?? '/';
$canonicalUri = preg_replace('~^/index\.php(?=\?|$)~', '/', $requestUri);
$canonicalUrl = isset($canonicalUrl) ? $canonicalUrl : 'https://silentlab.net' . $canonicalUri;
$ogImage = $ogImage ?? ('https://silentlab.net/img/logo.png?v=' . filemtime(__DIR__ . '/img/logo.png'));
$ogImagePath = parse_url($ogImage, PHP_URL_PATH);
$ogImageSize = is_string($ogImagePath) && is_file(__DIR__ . $ogImagePath)
    ? getimagesize(__DIR__ . $ogImagePath) : false;
?>
<title><?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></title>
<meta charset="utf-8">
<script src="/resize_table.js?v=<?php echo filemtime(__DIR__ . '/resize_table.js'); ?>" defer></script>
<link rel="icon" href="/favicon.svg?v=<?php echo filemtime(__DIR__ . '/favicon.svg'); ?>" type="image/svg+xml">
<link rel="stylesheet" type="text/css" href="/style.css?v=<?php echo filemtime(__DIR__ . '/style.css'); ?>">
<link rel="canonical" href="<?php echo htmlspecialchars($canonicalUrl, ENT_QUOTES, 'UTF-8'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta property="og:title" content="<?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?>">
<meta property="og:type" content="website">
<meta property="og:url" content="<?php echo htmlspecialchars($canonicalUrl, ENT_QUOTES, 'UTF-8'); ?>">
<meta property="og:image" content="<?php echo htmlspecialchars($ogImage, ENT_QUOTES, 'UTF-8'); ?>">
<meta property="og:image:type" content="image/png">
<?php if ($ogImageSize !== false): ?>
<meta property="og:image:width" content="<?php echo $ogImageSize[0]; ?>">
<meta property="og:image:height" content="<?php echo $ogImageSize[1]; ?>">
<?php endif; ?>
<meta property="og:description" content="<?php echo htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8'); ?>">
<meta name="keywords" content="Silentlab, Silentlab band, Marie Viktoria Borge-Eriksen, Marie Viktoria Eriksen, Marie Eriksen">
<meta name="description" content="<?php echo htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8'); ?>">
<?php require __DIR__ . '/site_ui.php'; ?>
  

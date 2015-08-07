<!DOCTYPE html>
<html lang="en">
<head>
	<title><?= $metaTitle; ?><? if (!empty($uri[1])): ?> - CHTSHT.io<? endif; ?></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
	<meta name="viewport" content="width=device-width">
	<meta name="description" content="<?= $metaDescription ?>" />

	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	<link rel="icon" href="/favicon.ico" type="image/x-icon">

	<link rel="apple-touch-icon" sizes="57x57" href="/icons/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/icons/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/icons/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/icons/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/icons/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/icons/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/icons/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/icons/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/icons/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="/icons/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/icons/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/icons/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/icons/favicon-16x16.png">
	<link rel="manifest" href="/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/icons/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">

	<link rel="stylesheet" href="/css/main.css" />
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
	<script src="/js/plugins/head.load.min.js"></script>
	<script>
		head.js(
			"/js/plugins/jquery-2.0.3.min.js",
			"/js/plugins/jquery-ui-1.10.3.custom.min.js",
			// "/js/plugins/ZeroClipboard.min.js",
			"/js/new.js"
		);
	</script>
</head>

<body>
	<div id="wrap">
		<div class="container">
			<header>
				<a href="/" class="logo"><img src="/img/chtsht.png" alt="CHTSHT.io" title="CHTSHT.io" /></a>

				<nav>
					<div class="user">
						<? if (isset($User['id'])): ?>
						<? if ($User['avatar']): ?>
						<img src="<?= $User['avatar'] ?>&s=25" title="<?= $User['display_name'] ?>" alt="<?= $User['display_name'] ?>" />
						<? endif; ?>
						<span data-id="<?= $User['id'] ?>"><?= $User['display_name'] ?></span>
						<a href="/logout" class="sign-in"><i class="fa fa-sign-out"></i></a></p>
						<? else: ?>
						<a href="/login" class="sign-in">Login <i class="fa fa-sign-in"></i></a></p>
						<? endif; ?>
					</div>

					<div class="search">
						<input type="text" id="search" autocomplete="off" placeholder="What are you looking for?" />
					</div>
				</nav>
			</header>
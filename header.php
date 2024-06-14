<!DOCTYPE html>
<html <?php language_attributes(); ?> <?php blankslate_schema_type(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="wrapper" class="hfeed">
	<div id="hero">
		<header id="header" role="banner">
			<div id="branding">
				<div id="site-title" itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
					<img src="/wp-content/themes/boomerang-instawp/assets/images/logo.png">
				</div>
			</div>
			<nav id="menu" role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
				<ul>
					<li><a href="/">Home</a></li>
					<li><p>Shows</p></li>
					<li><p>Tickets</p</li>
					<li><a href="/feedback">Feedback</a></li>
				</ul>
			</nav>
		</header>

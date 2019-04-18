<?php

//WPML translations
//$my_home_url = apply_filters( 'wpml_home_url', get_option( 'home' ) );
$keywords = "";
$favicon = "";

$currentlang = "pt";


//
if ( defined( 'ICL_LANGUAGE_CODE' ) && ICL_LANGUAGE_CODE == 'en' ) {
	$currentlang = "en";
} 	

if( is_single() || is_page() ) {
	$post_id = get_queried_object_id();
	$url = get_permalink($post_id);
	$image = get_the_post_thumbnail_url($post_id);
}

//icons svg
$menusvg = '<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 26"><defs></defs><title>Hamburguer</title><rect class="cls-1" x="0.5" y="11.71" width="25" height="1.32" rx="0.34"/><rect class="cls-1" x="0.5" y="15.68" width="25" height="1.32" rx="0.34"/><rect class="cls-1" x="0.5" y="7.74" width="25" height="1.32" rx="0.34"/></svg>';

$menuclosesvg = '<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
viewBox="0 0 212.982 212.982" style="enable-background:new 0 0 212.982 212.982;" xml:space="preserve">
<g id="Close">
<path style="fill-rule:evenodd;clip-rule:evenodd;" d="M131.804,106.491l75.936-75.936c6.99-6.99,6.99-18.323,0-25.312
 c-6.99-6.99-18.322-6.99-25.312,0l-75.937,75.937L30.554,5.242c-6.99-6.99-18.322-6.99-25.312,0c-6.989,6.99-6.989,18.323,0,25.312
 l75.937,75.936L5.242,182.427c-6.989,6.99-6.989,18.323,0,25.312c6.99,6.99,18.322,6.99,25.312,0l75.937-75.937l75.937,75.937
 c6.989,6.99,18.322,6.99,25.312,0c6.99-6.99,6.99-18.322,0-25.312L131.804,106.491z"/>
</g>
</svg>';

//social icons svg
$instasvg = '<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
viewBox="0 0 26 26" style="enable-background:new 0 0 26 26;" xml:space="preserve">
<g>
<path  d="M20,7c-0.551,0-1-0.449-1-1V4c0-0.551,0.449-1,1-1h2c0.551,0,1,0.449,1,1v2c0,0.551-0.449,1-1,1H20z
 "/>
<path  d="M13,9.188c-0.726,0-1.396,0.213-1.973,0.563c0.18-0.056,0.367-0.093,0.564-0.093
 c1.068,0,1.933,0.865,1.933,1.934c0,1.066-0.865,1.933-1.933,1.933s-1.933-0.866-1.933-1.933c0-0.199,0.039-0.386,0.094-0.565
 C9.4,11.604,9.188,12.274,9.188,13c0,2.107,1.705,3.813,3.813,3.813c2.105,0,3.813-1.705,3.813-3.813S15.105,9.188,13,9.188z"/>
<g>
 <path  d="M13,7c3.313,0,6,2.686,6,6s-2.688,6-6,6c-3.313,0-6-2.686-6-6S9.687,7,13,7 M13,5
	 c-4.411,0-8,3.589-8,8s3.589,8,8,8s8-3.589,8-8S17.411,5,13,5L13,5z"/>
</g>
<path d="M21.125,0H4.875C2.182,0,0,2.182,0,4.875v16.25C0,23.818,2.182,26,4.875,26h16.25
 C23.818,26,26,23.818,26,21.125V4.875C26,2.182,23.818,0,21.125,0z M24,9h-6.537C18.416,10.063,19,11.461,19,13
 c0,3.314-2.688,6-6,6c-3.313,0-6-2.686-6-6c0-1.539,0.584-2.938,1.537-4H2V4.875C2,3.29,3.29,2,4.875,2h16.25
 C22.711,2,24,3.29,24,4.875V9z"/>
</g>
</svg>';

$facebooksvg = '<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
width="90px" height="90px" viewBox="0 0 90 90" style="enable-background:new 0 0 90 90;" xml:space="preserve">
<g>
<path id="Facebook__x28_alt_x29_" d="M90,15.001C90,7.119,82.884,0,75,0H15C7.116,0,0,7.119,0,15.001v59.998
 C0,82.881,7.116,90,15.001,90H45V56H34V41h11v-5.844C45,25.077,52.568,16,61.875,16H74v15H61.875C60.548,31,59,32.611,59,35.024V41
 h15v15H59v34h16c7.884,0,15-7.119,15-15.001V15.001z"/>
</g>
</svg>';

$redditsvg = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 512 512">
<g>
	<path d="m338.2,191.3c9.3,0 16.9-7.6 16.9-16.9 0-9.4-7.6-17-16.9-17s-16.9,7.6-17,17c0,9.3 7.6,16.9 17,16.9z"/>
	<path d="m374,0h-236c-76.2,0-138,61.8-138,138v236c0,76.2 61.8,138 138,138h236c76.2,0 138-61.8 138-138v-236c0-76.2-61.8-138-138-138zm-1.9,293.1c-4.2,42.1-54.2,75.5-115.2,75.5-60.6,0-110.4-32.9-115.2-74.7-11.8-7-19.7-20-19.7-34.9 0-22.3 17.6-40.5 39.2-40.5 7.9,0 15.2,2.4 21.3,6.5-0.3,0.3-0.6,0.5-1,0.8 18.2-11.1 41.4-18.2 66.9-19.5l20.4-58.5 43.7,10.5c5.4-8.7 14.9-14.6 25.9-14.6 16.9,0 30.6,13.7 30.6,30.6s-13.8,30.6-30.6,30.6c-16.9,0-30.6-13.8-30.6-30.6 0-1 0.2-2 0.3-3l-30.6-7.3-14.8,42.4c25.6,0.9 49,7.6 67.6,18.4 6-3.8 13-6.1 20.6-6.1 21.6,0 39.2,18.2 39.2,40.5 5.68434e-14,14.3-7.3,26.9-18,33.9z"/>
	<path d="m169.8,234c-2.7-1-5.6-1.7-8.7-1.7-14.1,0-25.6,12.1-25.6,26.8 0,6.9 2.5,13.2 6.6,18 3-16.4 12.9-31.2 27.7-43.1z"/>
	<path d="m350.9,232.3c-2.7,0-5.2,0.6-7.7,1.4 14.5,11.6 24.5,26 27.8,42 3.4-4.6 5.5-10.3 5.5-16.5 0-14.8-11.5-26.9-25.6-26.9z"/>
	<path d="m256.7,219.8c-56.3,0-102.1,30.4-102.1,67.7s45.8,67.7 102.1,67.7 102-30.4 102-67.7-45.7-67.7-102-67.7zm-58.7,54c0-9.996 8.104-18.1 18.1-18.1 9.996,0 18.1,8.104 18.1,18.1 0,9.996-8.104,18.1-18.1,18.1-9.996-5.68434e-14-18.1-8.104-18.1-18.1zm100.4,51.6c-15.5,10.3-30.3,13.7-43,13.7-25.6,0-43.2-13.9-43.5-14.1-2.9-2.4-3.3-6.7-1-9.6 2.3-2.9 6.6-3.4 9.5-1 1.3,1.1 32.2,24.9 70.5-0.4 3.1-2.1 7.3-1.2 9.4,2 2.1,3.1 1.2,7.3-1.9,9.4zm-4.6-33.5c-9.996,0-18.1-8.104-18.1-18.1 0-9.996 8.104-18.1 18.1-18.1 9.996,0 18.1,8.104 18.1,18.1-5.68434e-14,9.996-8.104,18.1-18.1,18.1z"/>
</g>
</svg>';

$twittersvg = '<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
viewBox="0 0 486.392 486.392" style="enable-background:new 0 0 486.392 486.392;" xml:space="preserve">
<g>
<g>
 <g>
	 <path  d="M395.193,0H91.198C40.826,0,0,40.826,0,91.198v303.995c0,50.372,40.826,91.198,91.198,91.198
		 h303.995c50.372,0,91.198-40.827,91.198-91.198V91.198C486.392,40.826,445.565,0,395.193,0z M364.186,188.598l0.182,7.752
		 c0,79.16-60.221,170.359-170.359,170.359c-33.804,0-65.268-9.91-91.776-26.904c4.682,0.547,9.454,0.851,14.288,0.851
		 c28.059,0,53.868-9.576,74.357-25.627c-26.204-0.486-48.305-17.814-55.935-41.586c3.678,0.669,7.387,1.034,11.278,1.034
		 c5.472,0,10.761-0.699,15.777-2.067c-27.39-5.533-48.031-29.7-48.031-58.701v-0.76c8.086,4.499,17.297,7.174,27.116,7.509
		 c-16.051-10.731-26.63-29.062-26.63-49.825c0-10.974,2.949-21.249,8.086-30.095c29.518,36.236,73.658,60.069,123.422,62.562
		 c-1.034-4.378-1.55-8.968-1.55-13.649c0-33.044,26.812-59.857,59.887-59.857c17.206,0,32.771,7.265,43.714,18.908
		 c13.619-2.706,26.448-7.691,38.03-14.531c-4.469,13.984-13.953,25.718-26.326,33.135c12.069-1.429,23.651-4.682,34.382-9.424
		 C386.073,169.659,375.889,180.208,364.186,188.598z"/>
 </g>
</g>
</svg>';

//desc from homepage
$facebook  = get_field('facebook',icl_object_id(5, 'page', false,ICL_LANGUAGE_CODE));
$reddit  = get_field('reddit',icl_object_id(5, 'page', false,ICL_LANGUAGE_CODE));
$twitter  = get_field('twitter',icl_object_id(5, 'page', false,ICL_LANGUAGE_CODE));
$instagram  = get_field('instagram',icl_object_id(5, 'page', false,ICL_LANGUAGE_CODE));

?>

<!DOCTYPE html>
<html lang="<?php echo $currentlang; ?>">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?php wp_title('|',true,'right'); bloginfo('name'); ?></title>
	<!-- stuff -->
	<meta name="description" content="<?php echo get_bloginfo('description'); ?>">
	<meta name="keywords" content="<?php echo $keywords; ?>">
	<!-- og -->
	<meta property="og:title"  content="<?php wp_title('|',true,'right'); bloginfo('name'); ?>" >
	<meta property="og:description" content="<?php echo get_bloginfo('description'); ?>" >
	<meta property="og:url" content="<?php echo esc_url($url); ?>" >
	<?php if($image) { ?><meta property="og:image"  content="<?php echo $image; ?>"> <?php } ?>

	<!--favicon-->
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/assets/favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/assets/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/assets/favicon/favicon-16x16.png">
	<link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/assets/favicon/site.webmanifest">
	<link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/assets/favicon/safari-pinned-tab.svg" color="#5bbad5">
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/assets/favicon/favicon.ico">
	<meta name="msapplication-TileColor" content="#00aba9">
	<meta name="msapplication-config" content="<?php echo get_template_directory_uri(); ?>/assets/favicon/browserconfig.xml">
	<meta name="theme-color" content="#ffffff">


	<?php wp_head(); ?>
	<!--styles-->
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/style.css?v12<?php echo rand(10,100); ?>" inline>
	<script src="<?php echo get_template_directory_uri(); ?>/assets/js/app.js?v1"></script>


</head>
<body>
	<header class="header">
		<div class="header__container withmargins">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="homepage" class="header__logo"><img src="<?php echo get_template_directory_uri(); ?>/assets/media/logo.png" alt="vost"></a>
			<nav class="header__menu">
				<?php wp_nav_menu(['menu'=>'header']); 	?>
				<div class="social">
				<?php if($facebook) { ?><a href="<?php echo $facebook; ?>" rel="nofollow noopener" title="facebook"><?php echo $facebooksvg; ?></a> <?php } ?>
						<?php if($twitter) { ?><a href="<?php echo $twitter; ?>" rel="nofollow noopener" title="twitter"><?php echo $twittersvg; ?></a><?php } ?>
						<?php if($reddit) { ?><a href="<?php echo $reddit; ?>" rel="nofollow noopener" title="reddit"><?php echo $redditsvg; ?></a><?php } ?>
						<?php if($instagram) { ?><a href="<?php echo $instagram; ?>" rel="nofollow noopener" title="instagram"><?php echo $instasvg; ?></a><?php } ?>
				</div>
			</nav>
			<div class="menuicon">
				<div id="open"><?php echo $menusvg; ?></div>
				<div id="close"><?php echo $menuclosesvg; ?></div>
			</div>
		</div>
	</header>


	
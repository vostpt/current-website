<?php
//header
get_header();  
$pagenot = "Página não encontrada";
if ( defined( 'ICL_LANGUAGE_CODE' ) && ICL_LANGUAGE_CODE == 'en' ) {
  $pagenot = "Page not found";
}
?>

	<link rel="stylesheet" href="/assets/css/style.css" inline>
<div class="my404"><h1>404</h1><h2><?php echo $pagenot; ?></h2></div>


<?php get_footer(); ?>

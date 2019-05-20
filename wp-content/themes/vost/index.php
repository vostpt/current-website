<?php
//header
get_header();  
$pagenot = "Página não encontrada";
if ( defined( 'ICL_LANGUAGE_CODE' ) && ICL_LANGUAGE_CODE == 'en' ) {
  $pagenot = "Page not found";
}
?>

<div class="single-page">
    <div class="single-page-header withmargins">
        <h1 style="color:black;"><?php echo $pagenot; ?></h1>
    </div>
</div>
<section class="main-content">
<div class="single-page__content withmargins">
	Temos muita informação, mas esta infelizmente não!
</div>
</section>


<?php get_footer(); ?>


<?php
//header
get_header();  ?>
<?php

if ( have_posts() ) {
    
      the_post();
      $id = $post->ID;
      $titulo = $post->post_title;
      $imagem =  get_the_post_thumbnail($id,'full');
      //$link = get_permalink();
      $author = get_the_author();
      $content = apply_filters('the_content', $post->post_content);
      $date = $post_date = get_the_date( 'F j, Y' );
}

?>

<div class="single-page">
    <div class="single-page-img">
      <?php echo $imagem; ?>
    </div> 
    <div class="single-page-header withmargins">
      <h1><?php echo $titulo; ?></h1>
      <h3><?php echo $author; ?> @ <?php echo $date; ?></h3>
    </div>
</div>
<section class="main-content">
<div class="single-page__content withmargins">
  <?php echo $content; ?>
</div>

<?php 
//footer.php
get_footer(); 
//wp_footer(); 
?>

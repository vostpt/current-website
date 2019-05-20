<?php /* Template Name: arquivo */ ?>

<?php
//header
get_header(); 

$listaimagensheader =  wp_is_mobile() ? get_field('imagens_mobile',icl_object_id(5, 'page', false,ICL_LANGUAGE_CODE)) : get_field('imagens_desktop',icl_object_id(5, 'page', false,ICL_LANGUAGE_CODE));
$imgheader = wp_get_attachment_image($listaimagensheader[mt_rand(0,count($listaimagensheader)-1)]['ID'], 'full');
$titleheader = "Arquivo";
if ( defined( 'ICL_LANGUAGE_CODE' ) && ICL_LANGUAGE_CODE == 'en' ) {
	$titleheader = "Archive";
} 

?>


<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/archive.css?v12" >

<section class="topcontent " style="height:500px">
  <?php echo $imgheader; ?>
  <div class="topcontent__info">
    <div class="headline"><?php echo $titleheader; ?></div>
  </div>
</section>
<section class="main-content" >
<div class="blog__wrap withmargins archive" style="">
  <?php 
   $args = array(
    'post_type' => 'post',
    // 'cat' => '2,6,17,38' ,
    'posts_per_page' => 9,
    'paged' => $paged,
    
  );
  $post_query = new WP_Query($args);
  if($post_query->have_posts() ) {
    while ( $post_query->have_posts() ) {
      $post_query->the_post();
      $titulo = esc_html($post->post_title);
      //$data = date('d.m.Y', strtotime($post->post_date));
      
      $imagem =  get_the_post_thumbnail_url($post);
      $link = get_permalink( $post->ID);
      $excerto = esc_html(get_the_excerpt($post->ID));
      $blogposts = '<!--post-->
                    <div class="blog-post">
                      <a href="'.$link.'" class="image" title="'.$titulo.'"><img src="'.$imagem.'" alt="'.$titulo.'"></a>
                      <a class="title" title="'.$titulo.'" href="'.$link.'">'.$titulo.'</a>
                      <div class="description"><p>'.$excerto.'</p></div>
                    </div>
                    <!-- end post -->';
      echo $blogposts;
    }
  }
  ?>
</div>

<section class="withmargins pagination">
  <?php 
   $args = [
     'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
      'total'        => $post_query->max_num_pages,
      'current'      => max( 1, get_query_var( 'paged' ) ),
      'format'       => '?paged=%#%',
      'show_all'     => false,
      'type'         => 'plain',
      'end_size'     => 2,
      'mid_size'     => 1,
      'prev_next'    => true,
      //'prev_text'    => sprintf( '<i></i> %1$s', __( 'Newer Posts', 'text-domain' ) ),
      //'next_text'    => sprintf( '%1$s <i></i>', __( 'Older Posts', 'text-domain' ) ),
      'add_args'     => false,
      'add_fragment' => '',
    ];
    echo paginate_links( $args);


  ?>
</section>
<!-- style -->

<?php 
//footer.php
get_footer(); 
//wp_footer(); 
?>


<?php
/**
* decibman function !
*/
// Customize login logo
function dnt_login_logo() { ?>
    <style type="text/css">
      #login h1 a {
				background-image: url("<?php echo get_stylesheet_directory_uri(); ?>/images/logo_login.png");
				background-size: auto;
				width: auto;		
				margin: 0;				
		  }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'dnt_login_logo' );
// Custome login title
function new_wp_login_title() {
	return get_option('blogname');
}
add_filter('login_headertitle', 'new_wp_login_title');

//Filter Footer
add_filter('tc_credits_display', 'my_custom_credits');
function my_custom_credits(){
 echo '<div class="span4 credits">
    		    	<p> &middot; <span class="copy-left">©</span> 2009 -'.esc_attr( date( 'Y' ) ).' <a href="'.esc_url( home_url() ).'" title="'.esc_attr(get_bloginfo()).'" rel="bookmark">'.esc_attr(get_bloginfo()).'</a> &middot; Designed by <a href="https://twitter.com/siayi" target="_blank">@siayi</a> &middot;</p></div>';
}
//
add_action('__before_main_container' , 'decibman_add_submenu');

function decibman_add_submenu() {
  global $wp_query;
  if (empty($wp_query->post->post_parent)) {
    $parent = $wp_query->post->ID;
    $is_active = true;
  } else {
    $parent = $wp_query->post->post_parent;
    $is_active = false;
  }
  if (wp_list_pages("child_of=$parent&echo=0" )) {
    echo '<ul class="decibman-submenu nav nav-pills">';
    echo '<li class="' . ($is_active ? 'active' : '') . '"><a href="' . esc_url(get_permalink($parent)) . '">' . get_the_title($parent) . '</a></li>';
    echo str_replace('current_page_item', 'active', wp_list_pages("title_li=&child_of=$parent&echo=0"));
    echo '</ul>';
  }
}
//
add_filter ( 'tc_social_in_header' , 'decibman_add_events_subscribe' );
function decibman_add_events_subscribe() {
  //class
  ob_start();
?>
  <div class="social-block span6">
    <?php if ( 0 != tc__f( '__get_option', 'tc_social_in_header') ) : ?>
      <?php echo tc__f( '__get_socials' ) ?>
        <!-- Begin MailChimp Signup Form -->
        <form action="//desa.us13.list-manage.com/subscribe/post?u=c3143f6e9d065867b372eb0b0&amp;id=4d5d792ad8" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
        	<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="Input email untuk bergabung dengan kami" required>
          <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
          <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_d95a16f47be2acdbbff34e7f8_9bb630e658" tabindex="-1" value=""></div>
          <input type="submit" value="Bergabung" name="subscribe" id="mc-embedded-subscribe" class="button" style>
        </form>     
        <!--End mc_embed_signup-->

      <?php endif; ?>
</div>
<?php
  $html = ob_get_contents();
  ob_end_clean();
  return $html;
}

function decibman_tc_tagline_class($string) {
    return 'span6';
}
add_filter( 'tc_tagline_class', 'decibman_tc_tagline_class', 10, 1 );

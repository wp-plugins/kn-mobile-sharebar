<?php
/**
* Plugin Name: KN Mobile ShareBar
* Plugin URI: http://www.kakinetwork.com
* Description: Displays a floating share bar with custom shared text on Facebook, Twitter and WhatsApp at bottom or top of your website via mobile.
* Version: 1.0.5
* Author: Freddie Aziz Jasbindar
* Author URI: http://www.facebook.com/FreddieAziz
*/
/* define path */
define('kakinetwork_url',plugin_dir_url(__FILE__ ));
define('kakinetwork_path',plugin_dir_path(__FILE__ ));

/* ects */
require_once kakinetwork_path . "kn_ects.php";
register_activation_hook(__FILE__,'install_kn_mobile_sharebar');

/* in action */
add_action( 'wp_enqueue_scripts', 'add_css' );
function add_css() {
	wp_register_style( 'mobile_share', kakinetwork_url . 'css/mobile_sharebar.css');
	wp_enqueue_style( 'mobile_share' );
}

/* more specific isn't? */
if(get_option( 'kn_mobile_small_desktop' )=="on") {
	if(get_option( 'kn_mobile_sharebar_where' )=="top") {
		add_action('wp_head', 'mobile_sharebar_add');
	}
	if(get_option( 'kn_mobile_sharebar_where' )=="bottom") {
		add_action('wp_footer', 'mobile_sharebar_add');
	}
}
if(get_option( 'kn_mobile_small_desktop' )!="on") {
	if ( wp_is_mobile() ) {
		if(get_option( 'kn_mobile_sharebar_where' )=="top") {
			add_action('wp_head', 'mobile_sharebar_add');
		}
		if(get_option( 'kn_mobile_sharebar_where' )=="bottom") {
			add_action('wp_footer', 'mobile_sharebar_add');
		}
	}
}

function mobile_sharebar_add(){
	
	if(get_option( 'kn_mobile_sharebar_visibility_homepage' )=="on") {
		$visibility_homepage = is_front_page();
	}
	if(get_option( 'kn_mobile_sharebar_visibility_post' )=="on") {
		$visibility_single = is_single();
	}
	if(get_option( 'kn_mobile_sharebar_visibility_page' )=="on") {
		$visibility_page = is_page();
	}
	
	if ( $visibility_homepage || $visibility_single || $visibility_page ) {
		$facebook_text = do_shortcode( get_option( 'kn_mobile_sharebar_facebook' ) );
		$twitter_text = do_shortcode( get_option( 'kn_mobile_sharebar_twitter' ) );
		$whatsapp_text = do_shortcode( get_option( 'kn_mobile_sharebar_whatsapp' ) );
			
		echo '
		<div id="mobile-share-box'.get_option( 'kn_mobile_sharebar_where' ).'" style="height: '.get_option( 'kn_mobile_sharebar_height' ).'px;">
			<ul id="horizontal-list" style="height: '.get_option( 'kn_mobile_sharebar_height' ).'px;">
				<li class="knfb" style="height: '.get_option( 'kn_mobile_sharebar_height' ).'px;"><a href="https://www.facebook.com/sharer/sharer.php?u='.$facebook_text.'" target="_blank" class="hyperlink" style="height: '.get_option( 'kn_mobile_sharebar_height' ).'px;">facebook</a></li>
				<li class="kntw" style="height: '.get_option( 'kn_mobile_sharebar_height' ).'px;"><a href="https://twitter.com/intent/tweet?source=tweetbutton&amp;original_referer='.get_permalink()."&amp;text=".$twitter_text.'" target="_blank" class="hyperlink" style="height: '.get_option( 'kn_mobile_sharebar_height' ).'px;">twitter</a></li>
				<li class="knws" style="height: '.get_option( 'kn_mobile_sharebar_height' ).'px;"><a href="whatsapp://send?text='.$whatsapp_text.'" target="_blank" class="hyperlink" style="height: '.get_option( 'kn_mobile_sharebar_height' ).'px;">whatsapp</a></li>
			</ul>
		</div>
		<div id="mobile-sharebar-footer'.get_option( 'kn_mobile_sharebar_where' ).' style="height: '.get_option( 'kn_mobile_sharebar_height' ).'px;"">
			<img class="share-icon" style="height: '.get_option( 'kn_mobile_sharebar_height' ).'px;" src="' . kakinetwork_url . 'images/blank.png" border="0"/>
		</div>
		';
	}
}
?>
<?php
/**
* Plugin Name: KN Mobile ShareBar
* Plugin URI: http://www.kakinetwork.com
* Description: Displays a floating share bar with WhatsApp, Twitter and Facebook on bottom of your wordpress self hosted website via mobile.
* Version: 1.0.2
* Author: Freddie Aziz Jasbindar
* Author URI: http://www.facebook.com/FreddieAziz
*/
define('kakinetwork_url',plugin_dir_url(__FILE__ ));
define('kakinetwork_path',plugin_dir_path(__FILE__ ));

add_action( 'wp_enqueue_scripts', 'add_css' );
function add_css() {
	wp_register_style( 'mobile_share', kakinetwork_url . 'css/mobile_sharebar.css');
	wp_enqueue_style( 'mobile_share' );
}

add_action('wp_footer', 'mobile_sharebar_add');
function mobile_sharebar_add(){
	if ( is_single() ) {
		
			$shared_link_to_facebook = get_permalink()."?utm_source=facebook&amp;utm_medium=chat&amp;utm_content=texts&amp;utm_campaign=social_share";
			
			$share_title_to_twitter = get_the_title()." ";
			$shared_link_to_twitter = get_permalink()."&amp;text=".$share_title_to_twitter."&amp;url=".get_permalink();
			
			$shared_link_to_whatsapp = get_the_title()." - ".get_permalink();
		
		echo '
		<div id="mobile-share-box">
			<ul id="horizontal-list">
				<li class="facebook"><a href="https://www.facebook.com/sharer/sharer.php?u='.$shared_link_to_facebook.'" target="_blank" class="hyperlink">facebook</a></li>
				<li class="twitter"><a href="https://twitter.com/intent/tweet?source=tweetbutton&amp;original_referer='.$shared_link_to_twitter.'" target="_blank" class="hyperlink">twitter</a></li>
				<li class="whatsapp"><a href="whatsapp://send?text='.$shared_link_to_whatsapp.'" target="_blank" class="hyperlink">whatsapp</a></li>
			</ul>
		</div>
		<div id="mobile-sharebar-footer">
			<span class="mobile-sharebar-footer-span"><img class="share-icon" src="' . kakinetwork_url . 'images/blank.png" border="0"/></span>
		</div>
		';
	}
}
?>
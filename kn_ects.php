<?php
/* shortcodes */
add_shortcode('kn-post-url', 'kn_post_url');
function kn_post_url() {
    return get_permalink();
}
add_shortcode('kn-post-title', 'kn_post_title');
function kn_post_title() {
    return get_the_title();
}

/* databases */
function install_kn_mobile_sharebar() {
	$kn_plugin="kn_mobile_sharebar";
	add_option( $kn_plugin."_where", "bottom" );
	add_option( $kn_plugin."_facebook", "[kn-post-url]" );
	add_option( $kn_plugin."_twitter", "Let's read [kn-post-title] by click this [kn-post-url] !! :)" );
	add_option( $kn_plugin."_whatsapp", "Hello my friend! :) I have something nice to share. It's about [kn-post-title]!! Read now by click this link [kn-post-url]" );
	add_option( $kn_plugin."_visibility_homepage", "off" );
	add_option( $kn_plugin."_visibility_post", "on" );
	add_option( $kn_plugin."_visibility_page", "off" );
}

/* menus */
if ( is_admin() ){
	add_action('admin_menu', 'kn_mobile_sharebar_menu');
		function kn_mobile_sharebar_menu() {
			add_submenu_page('options-general.php', 'KN Mobile Sharebar', 'KN Mobile Sharebar', 'administrator', 'kn_mobile_sharebar_settings', 'kn_mobile_sharebar_page');
			add_action( 'admin_init', 'register_kn_mobile_sharebar_settings' );
		}
}

/* settings */
function register_kn_mobile_sharebar_settings() {
	register_setting( 'kn_mobile_sharebar_group', 'kn_mobile_sharebar_where' );
	register_setting( 'kn_mobile_sharebar_group', 'kn_mobile_sharebar_twitter' );
	register_setting( 'kn_mobile_sharebar_group', 'kn_mobile_sharebar_whatsapp' );
	register_setting( 'kn_mobile_sharebar_group', 'kn_mobile_sharebar_visibility_homepage' );
	register_setting( 'kn_mobile_sharebar_group', 'kn_mobile_sharebar_visibility_post' );
	register_setting( 'kn_mobile_sharebar_group', 'kn_mobile_sharebar_visibility_page' );
}

/* page */
function kn_mobile_sharebar_page() {
?>
<div class="wrap">
	<h2>KN Mobile Sharebar Settings</h2>
	<form method="post" action="options.php">
		<?php settings_fields( 'kn_mobile_sharebar_group' ); ?>
		<?php do_settings_sections( 'kn_mobile_sharebar_group' ); ?>
		
<table class="form-table">
	<tbody>
		<!-- twitter -->
		<tr>
			<th scope="row"><label for="blogname">Twitter Text</label></th>
			<td>
			<p class="description">You can use shortcode <strong>[kn-post-url]</strong> and <strong>[kn-post-title]</strong></p>
			<textarea name="kn_mobile_sharebar_twitter" rows="10" cols="50" id="kn_mobile_sharebar_twitter" class="large-text code"><?php echo get_option( 'kn_mobile_sharebar_twitter' ); ?></textarea>
			</td>
		</tr>
		
		<!-- whatsapp -->
		<tr>
			<th scope="row"><label for="blogname">Whatsapp Text</label></th>
			<td>
			<p class="description">You can use shortcode <strong>[kn-post-url]</strong> and <strong>[kn-post-title]</strong></p>
			<textarea name="kn_mobile_sharebar_whatsapp" rows="10" cols="50" id="kn_mobile_sharebar_whatsapp" class="large-text code"><?php echo get_option( 'kn_mobile_sharebar_whatsapp' ); ?></textarea>
			</td>
		</tr>

		<!-- visibility -->
		<tr>
			<th scope="row"><label for="blogname">Sharebar Visibility</label></th>
			<td>
			<fieldset>
					<label for="kn_mobile_sharebar_visibility_homepage">
						<input name="kn_mobile_sharebar_visibility_homepage" type="checkbox" id="kn_mobile_sharebar_visibility_homepage" <?php if(get_option( 'kn_mobile_sharebar_visibility_homepage' )=="on"){ echo "checked='checked'"; } ?>"> Show KN Mobile Sharebar at frontpage.
					</label>
					<br>
					<label for="kn_mobile_sharebar_visibility_post">
						<input name="kn_mobile_sharebar_visibility_post" type="checkbox" id="kn_mobile_sharebar_visibility_post" <?php if(get_option( 'kn_mobile_sharebar_visibility_post' )=="on"){ echo "checked='checked'"; } ?>> Show KN Mobile Sharebar at every blog post.
					</label>
					<br>
					<label for="kn_mobile_sharebar_visibility_page">
						<input name="kn_mobile_sharebar_visibility_page" type="checkbox" id="kn_mobile_sharebar_visibility_page" <?php if(get_option( 'kn_mobile_sharebar_visibility_page' )=="on"){ echo "checked='checked'"; } ?>> Show KN Mobile Sharebar at every page.
					</label>
			</fieldset>
			</td>
		</tr>

		<!-- where -->
		<tr>
			<th scope="row"><label for="blogname">Sharebar Location</label></th>
			<td>
			<select name="kn_mobile_sharebar_where" id="kn_mobile_sharebar_where">
			  <option <?php if(get_option( 'kn_mobile_sharebar_where' )=="top") { echo "selected"; } ?> value="top">Top of the Page</option>
			  <option <?php if(get_option( 'kn_mobile_sharebar_where' )=="bottom") { echo "selected"; } ?> value="bottom">Bottom of the Page</option>
			</select>
			<p class="description">Where to place this Mobile Sharebar?</p>
			</td>
		</tr>
	</tbody>
</table>
		<p class="submit"><input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
		<p>Do you like this plugin? If you do like, can you do me a favor? Please write a review for this plugin by click <a href="https://wordpress.org/support/view/plugin-reviews/kn-mobile-sharebar" target="_blank">here</a>.. And, if you love this plugin, why not you donate me by click <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=WYV2ZRAAAD77Q" target="_blank">here</a> ! Thank you so much for your support! <em>- <a href="https://profiles.wordpress.org/kakinetwork/" target="_blank">Freddie Aziz</a> @ <a href="http://www.kakinetwork.com" target="_blank">KakiNetwork</a></em> :)</p>
	</form>
</div>
<?php } ?>
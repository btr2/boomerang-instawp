<?php
add_action( 'after_setup_theme', 'blankslate_setup' );
function blankslate_setup() {
load_theme_textdomain( 'blankslate', get_template_directory() . '/languages' );
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'responsive-embeds' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'html5', array( 'search-form', 'navigation-widgets' ) );
add_theme_support( 'appearance-tools' );
add_theme_support( 'woocommerce' );
global $content_width;
if ( !isset( $content_width ) ) { $content_width = 1920; }
register_nav_menus( array( 'main-menu' => esc_html__( 'Main Menu', 'blankslate' ) ) );
}
// add_action( 'admin_notices', 'blankslate_notice' );
function blankslate_notice_dismissed() {
$user_id = get_current_user_id();
if ( isset( $_GET['dismiss'] ) )
add_user_meta( $user_id, 'blankslate_notice_dismissed_11', 'true', true );
}

add_action( 'wp_enqueue_scripts', 'blankslate_enqueue' );
function blankslate_enqueue() {
wp_enqueue_style( 'blankslate-style', get_stylesheet_uri() );
wp_enqueue_style( 'main', get_template_directory_uri() . '/assets/css/main.css' );
wp_enqueue_script( 'main', get_template_directory_uri() . '/assets/js/main.js', array('jquery') );
wp_enqueue_script( 'jquery' );
}

add_action( 'wp_footer', 'blankslate_footer' );
function blankslate_footer() {
?>
<script>
jQuery(document).ready(function($) {
var deviceAgent = navigator.userAgent.toLowerCase();
if (deviceAgent.match(/(iphone|ipod|ipad)/)) {
$("html").addClass("ios");
$("html").addClass("mobile");
}
if (deviceAgent.match(/(Android)/)) {
$("html").addClass("android");
$("html").addClass("mobile");
}
if (navigator.userAgent.search("MSIE") >= 0) {
$("html").addClass("ie");
}
else if (navigator.userAgent.search("Chrome") >= 0) {
$("html").addClass("chrome");
}
else if (navigator.userAgent.search("Firefox") >= 0) {
$("html").addClass("firefox");
}
else if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
$("html").addClass("safari");
}
else if (navigator.userAgent.search("Opera") >= 0) {
$("html").addClass("opera");
}
});
</script>
<?php
}
add_filter( 'document_title_separator', 'blankslate_document_title_separator' );
function blankslate_document_title_separator( $sep ) {
$sep = esc_html( '|' );
return $sep;
}
add_filter( 'the_title', 'blankslate_title' );
function blankslate_title( $title ) {
if ( $title == '' ) {
return esc_html( '...' );
} else {
return wp_kses_post( $title );
}
}
function blankslate_schema_type() {
$schema = 'https://schema.org/';
if ( is_single() ) {
$type = "Article";
} elseif ( is_author() ) {
$type = 'ProfilePage';
} elseif ( is_search() ) {
$type = 'SearchResultsPage';
} else {
$type = 'WebPage';
}
echo 'itemscope itemtype="' . esc_url( $schema ) . esc_attr( $type ) . '"';
}
add_filter( 'nav_menu_link_attributes', 'blankslate_schema_url', 10 );
function blankslate_schema_url( $atts ) {
$atts['itemprop'] = 'url';
return $atts;
}
if ( !function_exists( 'blankslate_wp_body_open' ) ) {
function blankslate_wp_body_open() {
do_action( 'wp_body_open' );
}
}
add_action( 'wp_body_open', 'blankslate_skip_link', 5 );
function blankslate_skip_link() {
echo '<a href="#content" class="skip-link screen-reader-text">' . esc_html__( 'Skip to the content', 'blankslate' ) . '</a>';
}
add_filter( 'the_content_more_link', 'blankslate_read_more_link' );
function blankslate_read_more_link() {
if ( !is_admin() ) {
return ' <a href="' . esc_url( get_permalink() ) . '" class="more-link">' . sprintf( __( '...%s', 'blankslate' ), '<span class="screen-reader-text">  ' . esc_html( get_the_title() ) . '</span>' ) . '</a>';
}
}
add_filter( 'excerpt_more', 'blankslate_excerpt_read_more_link' );
function blankslate_excerpt_read_more_link( $more ) {
if ( !is_admin() ) {
global $post;
return ' <a href="' . esc_url( get_permalink( $post->ID ) ) . '" class="more-link">' . sprintf( __( '...%s', 'blankslate' ), '<span class="screen-reader-text">  ' . esc_html( get_the_title() ) . '</span>' ) . '</a>';
}
}
add_filter( 'big_image_size_threshold', '__return_false' );
add_filter( 'intermediate_image_sizes_advanced', 'blankslate_image_insert_override' );
function blankslate_image_insert_override( $sizes ) {
unset( $sizes['medium_large'] );
unset( $sizes['1536x1536'] );
unset( $sizes['2048x2048'] );
return $sizes;
}
add_action( 'widgets_init', 'blankslate_widgets_init' );
function blankslate_widgets_init() {
register_sidebar( array(
'name' => esc_html__( 'Sidebar Widget Area', 'blankslate' ),
'id' => 'primary-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => '</li>',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
}
add_action( 'wp_head', 'blankslate_pingback_header' );
function blankslate_pingback_header() {
if ( is_singular() && pings_open() ) {
printf( '<link rel="pingback" href="%s">' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
}
}
add_action( 'comment_form_before', 'blankslate_enqueue_comment_reply_script' );
function blankslate_enqueue_comment_reply_script() {
if ( get_option( 'thread_comments' ) ) {
wp_enqueue_script( 'comment-reply' );
}
}
function blankslate_custom_pings( $comment ) {
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo esc_url( comment_author_link() ); ?></li>
<?php
}
add_filter( 'get_comments_number', 'blankslate_comment_count', 0 );
function blankslate_comment_count( $count ) {
if ( !is_admin() ) {
global $id;
$get_comments = get_comments( 'status=approve&post_id=' . $id );
$comments_by_type = separate_comments( $get_comments );
return count( $comments_by_type['comment'] );
} else {
return $count;
}
}

function biw_page_top( $id ) {
	$post = get_post();
	?>
	<?php if ( has_shortcode( $post->post_content, 'boomerang') || has_block( 'boomerang-block/shortcode-gutenberg' ) ) : ?>
<div class="infobox">
	<p>This is a Boomerang Board. It's where your Boomerangs live. You can have as many of these as you need, so whether you sell multiple products, have multiple branches, or even have different feedback campaigns though out the year, we've got you covered.</p>
	<p>Try playing with the filters to manage which Boomerangs you see.</p>
	<p>Try adding a new Boomerang.</p>
	<p>Then, when you are ready, click on the title of the pre-built Boomerangs to get to it's dedicated page. Each one demonstrates a particular Boomerang feature.</p>
</div>
	<?php endif; ?>
<?php
}
add_action( 'biw_page_top', 'biw_page_top');

function biw_single_boomerang_top( $id ) {
	?>
		<?php if ( 32 === $id ) : ?>
		<div class="infobox">
			<p>This Boomerang has been linked to an Ignitiondeck Crowdfunding product. You can see how the crowdfund is progressing under the main content. Your users can even support the crowdfund right here - click the 'Support Now' button and donate $50 in the popup that appears. You'll then be taken to an Ignitiondeck page to complete the payment (don't worry - you won't actually be billed).</p>
			<p>Boomerang also supports WP Crowdfunding, so you can choose which crowdfunding solution you wish to use.</p>
		</div>
		<?php elseif ( 30 === $id ) : ?>
		<div class="infobox">
			<p>Sometimes, you receive feedback that isn't about the future of your product or service, but is actually something that just needs to get fixed. For software developers, it may be an error in the code. For authors or journalists, it may be a typo. For physical organisations, such as shops, airports or (you guessed it) concert venues, it may be that something just, broke.</p>
			<p>In Boomerang-speak, we call this a 'bug'. Bugs don't need to be public. They don't need to generate discussion, or analysed any further. Boomerang's 'mark as bug' feature hides the Boomerang from display, and marks it accordingly, so you can take any action required.</p>
			<p>To toggle bug status, click the bug icon in the Admin Actions area.</p>
		</div>
	<?php elseif ( 29 === $id ) : ?>
		<div class="infobox">
			<p>Positive feedback is great too! Boomerang allows administrators to create private notes to record further information, communicate with other administrators, give instructions and so on. In this Boomerang, the private note system is being used to feed back to the heroic staff member's manager. To create a private note, just toggle the switch in the comment box. You can change the color of the private note system in your Board's settings.</p>
			<p>We are exploring ways of streamlining this process further. What should happen when a private note is created? Should the note trigger an automation with another plugin or tool? If you have an idea, please let us know on our very own (Boomerang powered) <a target="_blank" href="https://boomerangwp.com/feature-requests">feature request board</a>.</p>
		</div>
	<?php elseif ( 27 === $id ) : ?>
		<div class="infobox">
			<p>People aren't happy with the climate system at the Nashdale Concert Venue. To prevent Boomerangs focussed on the same issue clogging up the Boomerang archive, you can choose to merge related Boomerangs. This Boomerang has been chosen as the primary Boomerang, and has seen other Boomerangs merged into it. You can view these Boomerangs in the list in the Admin Area. This feature helps to keep all related content in one place, saving administrators from having to duplicate comments or replies, and thus wasting time.</p>
		</div>
	<?php elseif ( 48 === $id ) : ?>
		<div class="infobox">
			<p>Occasionally, you receive feedback that you can't do much with, or is abusive, offensive or discriminatory in nature. You may decide that such feedback is not appropriate. Boomerang comes with two methods of dealing with non-constructive feedback. There is an option to turn pre-approval on, which would mean that a Boomerang such as this would never get approved. However, that can be labour intensive if you have many Boomerangs coming in simultaneously.</p>
			<p>Another method is to lock the Boomerang, making it private. This means that only administrators will be able to see it. You do this from inside the admin area, by clicking visibility, then 'Make Private'.</p>
		</div>
	<?php elseif ( 33 === $id ) : ?>
		<div class="infobox">
			<p>This Boomerang has been merged into another related Boomerang, as it relates to a faulty climate system that has come up before. To merge a Boomerang into another, click on the 'merge' symbol in the Admin Actions area. It will hide the Boomerang from public view, and push it's comments over to the primary Boomerang.</p>
		</div>
	<?php elseif ( 26 === $id ) : ?>
		<div class="infobox">
			<p>You might have been wondering why the Boomerang form has a field asking for the date of the visit. Boomerang is integrated with Advanced Custom Fields, to give you the full range of possibilities to customise your form for your particular circumstances. This Boomerang user has added the date he came to the concert venue, which will make it easier to track whatever his feedback relates to.</p>
			<p>Unlike other tools that only give you the usual custom fields (text, dropdown, radio buttons etc) you can use anything ACF has to offer. For instance, you could be a local council using Boomerang to collect information from residents such as potholes, damaged bus shelters or fallen trees. Using ACF's map field, a Boomerang can have an address attached to it, giving your council the exact location of the reported issue. The possibilities are endless.</p>
		</div>
	<?php endif; ?>

	<?php
}
add_action( 'biw_single_boomerang_top', 'biw_single_boomerang_top');
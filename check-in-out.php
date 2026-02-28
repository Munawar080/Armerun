<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Swissresort
 * @since Swissresort 1.0
 */
/*
*Template Name: 404 Page
*/
get_header();
$top_url = swissresort_get_config('404_top_img');
$style_bg = '';
if(!empty($top_url)){
	$style_bg = 'style=background-image:url("'.$top_url.'")';
}
?>
<section class="page-404 d-flex align-items-center justify-content-center flex-column" <?php echo esc_attr($style_bg); ?> >
	<div id="main-container" class="inner">
		<div id="main-content" class="main-page">
			<div class="container">
				<div class="content-inner d-flex align-items-center justify-content-center flex-column">
					<h1 class="heading-404">
						<?php
						$heading = swissresort_get_config('404_heading');
						if ( !empty($heading) ) {
							echo esc_html($heading);
						} else {
							esc_html_e('404', 'swissresort');
						}
						?>
					</h1>
					<h4 class="title-big">
						<?php
						$title = swissresort_get_config('404_title');
						if ( !empty($title) ) {
							echo esc_html($title);
						} else {
							esc_html_e('Page Not Found', 'swissresort');
						}
						?>
					</h4>
					<div class="description">
						<?php
						$description = swissresort_get_config('404_des');
						if ( !empty($description) ) {
							echo esc_html($description);
						} else {
							esc_html_e(' Sorry but we couldn\'t find the page you are looking for. It might have been moved or deleted.', 'swissresort');
						}
						?>
					</div>
					<div class="return">
						<a class="btn btn-theme" href="<?php echo esc_url( home_url( '/' ) ); ?>"><svg xmlns="http://www.w3.org/2000/svg" class="pre" width="16" height="2" viewBox="0 0 16 2" fill="none"><rect x="0.5" y="0.692383" width="15" height="1" fill="currentColor"></rect></svg><?php esc_html_e('Back to Home','swissresort') ?></a>
					</div>
				</div>
			</div>
		</div><!-- .content-area -->
	</div>
</section>
<?php get_footer(); ?>
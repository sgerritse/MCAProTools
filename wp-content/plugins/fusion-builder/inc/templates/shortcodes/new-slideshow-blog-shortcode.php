<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

global $post, $fusion_library, $fusion_settings;

if ( ! $fusion_settings ) {
	$fusion_settings = Fusion_Settings::get_instance();
}

$featured_image_width = get_post_meta( $post->ID, 'pyre_fimg_width', true );
$featured_image_height = get_post_meta( $post->ID, 'pyre_fimg_height', true );
?>
<?php if ( 'grid' != $atts['layout'] && 'timeline' != $atts['layout'] ) : ?>
	<style type="text/css">
		<?php if ( $featured_image_width && 'auto' !== $featured_image_width ) : ?>
			#post-<?php echo absint( $post->ID ); ?> .fusion-post-slideshow {
				max-width: <?php echo esc_attr( $featured_image_width ); ?> !important;
			}
		<?php endif; ?>

		<?php if ( $featured_image_height && 'auto' !== $featured_image_height ) : ?>
			#post-<?php echo absint( $post->ID ); ?> .fusion-post-slideshow,
			#post-<?php echo absint( $post->ID ); ?> .fusion-post-slideshow .fusion-image-wrapper img {
				max-height: <?php echo esc_attr( $featured_image_height ); ?> !important;
			}
		<?php endif; ?>

		<?php if ( $featured_image_width && 'auto' === $featured_image_width ) : ?>
			#post-<?php echo absint( $post->ID ); ?> .fusion-post-slideshow .fusion-image-wrapper img {
				width: auto;
			}
		<?php endif; ?>

		<?php if ( $featured_image_height && 'auto' === $featured_image_height ) : ?>
			#post-<?php echo absint( $post->ID ); ?> .fusion-post-slideshow .fusion-image-wrapper img {
				height: auto;
			}
		<?php endif; ?>

		<?php if ( $featured_image_height && $featured_image_width && 'auto' !== $featured_image_height && 'auto' !== $featured_image_width ) : ?>
			@media only screen and (max-width: 479px){
				#post-<?php echo absint( $post->ID ); ?> .fusion-post-slideshow,
				#post-<?php echo absint( $post->ID ); ?> .fusion-post-slideshow .fusion-image-wrapper img {
					width :auto !important;
					height :auto !important;
				}
			}
		<?php endif; ?>
	</style>
<?php endif; ?>

<?php
$permalink = get_permalink( $post->ID );

$size = 'blog-large';
if ( class_exists( 'Avada' ) ) {
	$size = ( ! Avada()->template->has_sidebar() || 'yes' === get_post_meta( $post->ID, 'pyre_full_width', true ) ) ? 'full' : 'blog-large';
	$size = ( 'medium' === $atts['layout'] || 'medium-alternate' === $atts['layout'] ) ? 'blog-medium' : $size;
	$size = ( $featured_image_height && $featured_image_width && 'auto' !== $featured_image_height && 'auto' !== $featured_image_width ) ? 'full' : $size;
	$size = ( 'auto' === $featured_image_height || 'auto' === $featured_image_width ) ? 'full' : $size;
	$size = ( 'grid' === $atts['layout'] || 'masonry' === $atts['layout'] || 'timeline' === $atts['layout'] ) ? 'full' : $size;
}
$post_video = fusion_get_page_option( 'video', get_the_ID() );
?>

<?php if ( has_post_thumbnail() || $post_video ) : ?>
	<?php $thumbnail_id = get_post_thumbnail_id(); ?>
	<?php $border_style = ( 'grid' === $atts['layout'] || 'masonry' === $atts['layout'] || 'timeline' === $atts['layout'] ) ? ' style="border-color:'. $atts['grid_element_color'] . '"': ''; ?>
	<div class="fusion-flexslider flexslider fusion-flexslider-loading fusion-post-slideshow"<?php echo $border_style; ?>>
		<ul class="slides">
			<?php if ( $post_video ) : ?>
				<li>
					<?php // @codingStandardsIgnoreLine WordPress.XSS.EscapeOutput.OutputNotEscaped ?>
					<div class="full-video"><?php echo $post_video; ?></div>
				</li>
			<?php endif; ?>

			<?php
			if ( 'grid' === $atts['layout'] || 'masonry' === $atts['layout'] ) {
				$fusion_library->images->set_grid_image_meta(
					array(
						'layout' => $atts['layout'],
						'columns' => $atts['blog_grid_columns'],
						'gutter_width' => $atts['blog_grid_column_spacing'],
					)
				);
			} elseif ( 'timeline' === $atts['layout'] ) {
				$fusion_library->images->set_grid_image_meta( array( 'layout' => $atts['layout'], 'columns' => '2' ) );
			} elseif ( false !== strpos( $atts['layout'], 'large' ) && 'full' == $size ) {
				$fusion_library->images->set_grid_image_meta( array( 'layout' => $atts['layout'], 'columns' => '1' ) );
			}
			?>
			<?php if ( has_post_thumbnail() ) : ?>
				<?php $full_image      = wp_get_attachment_image_src( $thumbnail_id, 'full' ); ?>
				<?php // @codingStandardsIgnoreLine WordPress.XSS.EscapeOutput.OutputNotEscaped ?>
				<li><?php echo fusion_render_first_featured_image_markup( $post->ID, $size, $permalink ); ?></li>
			<?php endif; ?>

			<?php $i = 2; ?>

			<?php while ( $i <= $fusion_settings->get( 'posts_slideshow_number' ) ) : ?>
				<?php $attachment_id = function_exists( 'fusion_get_featured_image_id' ) ? fusion_get_featured_image_id( 'featured-image-' . $i, 'post' ) : ''; ?>
				<?php if ( $attachment_id ) : ?>

					<?php
					$attachment_data = $fusion_library->images->get_attachment_data( $attachment_id );

					$attachment_image = wp_get_attachment_image_src( $attachment_id, $size );
					if ( 'grid' === $atts['layout'] ) {
						$image_size = $fusion_library->images->get_grid_image_base_size( $attachment_id, Fusion_Images::$grid_image_meta['layout'], Fusion_Images::$grid_image_meta['columns'] );
						$attachment_image = wp_get_attachment_image_src( $attachment_id, $image_size );
					}
					?>

					<?php if ( is_array( $attachment_data ) ) : ?>
						<li>
							<div class="fusion-image-wrapper">
								<a href="<?php the_permalink(); ?>" aria-label="<?php the_title(); ?>">
									<?php
									$image_markup = '<img src="' . $attachment_image[0] . '" alt="' . $attachment_data['alt'] . '" class="wp-image-' . $attachment_id . '" role="presentation"/>';
									$image_markup = $fusion_library->images->edit_grid_image_src( $image_markup, $post->ID, $attachment_id, $size );
									if ( function_exists( 'wp_make_content_images_responsive' ) ) {
										// @codingStandardsIgnoreLine WordPress.XSS.EscapeOutput.OutputNotEscaped
										echo wp_make_content_images_responsive( $image_markup );
									} else {
										// @codingStandardsIgnoreLine WordPress.XSS.EscapeOutput.OutputNotEscaped
										echo $image_markup;
									}
									?>
								</a>
								<a style="display:none;" href="<?php echo esc_url_raw( $attachment_data['url'] ); ?>" data-rel="iLightbox[gallery<?php echo absint( $post->ID ); ?>]"  title="<?php echo esc_attr( $attachment_data['caption_attribute'] ); ?>" data-title="<?php echo esc_attr( $attachment_data['title_attribute'] ); ?>" data-caption="<?php echo esc_attr( $attachment_data['caption_attribute'] ); ?>">
									<?php if ( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) : ?>
										<img style="display:none;" alt="<?php echo esc_attr( $attachment_data['alt'] ); ?>" role="presentation" />
									<?php endif; ?>
								</a>
							</div>
						</li>
					<?php endif; ?>
				<?php endif; ?>
				<?php $i++; ?>
			<?php endwhile; ?>
			<?php $fusion_library->images->set_grid_image_meta( array() ); ?>
		</ul>
	</div>
<?php
endif;

/* Omit closing PHP tag to avoid "Headers already sent" issues. */

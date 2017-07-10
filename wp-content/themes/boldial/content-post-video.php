<?php if ( ! is_single() ) { ?>

	<?php

	$color_data = ishyoboy_get_color_data();
	global $blog_style;

	// FULL_WIDTH
	if ( 'fullwidth' == $blog_style ){

		ob_start();
		ishyoboy_the_post_video( get_the_ID() );
		$video = trim( ob_get_contents() );
		ob_end_clean();

		$grid_class = ( ! empty( $video ) ) ? 'ish-grid6' : 'ish-grid12' ;
		$bg_style = ishyoboy_get_item_bg_style();

		?>
		<div id="post-<?php the_ID(); ?>" <?php post_class( 'wpb_row vc_row-fluid ish-row-notfull ish-row_section' . $color_data['bg_class']  . $color_data['text_class'] ); ?> <?php echo $bg_style; ?>>
			<?php if ( has_post_thumbnail() ) { echo '<div class="ish-overlay"></div>'; } ?>
			<div class="ish-vc_row_inner">

				<?php if ( ! empty( $video ) ) { ?>
					<div class="<?php echo $grid_class; ?>">
						<?php echo $video ?>
					</div>
				<?php } ?>

				<div class="<?php echo $grid_class; ?>">
					<h2><a href="<?php the_permalink(); ?>"><i class="ish-icon-movie"></i><?php the_title(); ?></a></h2>

					<?php echo ishyoboy_get_post_details() ?>

					<?php echo ishyoboy_get_blog_excerpt(); ?>

					<span class="ish-blog-post-links">
						<a class="ish-sc_button ish-color1" href="<?php comments_link(); ?>"><i class="ish-icon-chat"></i><?php comments_number('0', '1', '%'); ?></a>
						<?php ishyoboy_the_likes(); ?>
						<a class="ish-sc_button ish-color1" href="<?php the_permalink(); ?>"><?php _e( 'Read more', 'ishyoboy'); ?></a>
					</span>
				</div>

			</div>
		</div>
	<?php

	}


	// MASONRY
	elseif ( 'masonry' == $blog_style ){

		$mas_classes = ishyoboy_get_blog_masonry_size_classes();
		$post_image = ishyoboy_get_masonry_post_thumbnail();
		$post_image_class = ( ! empty( $post_image ) ) ? ' ish-image-cover' : '';

		?>
		<div  id="post-<?php the_ID(); ?>" <?php post_class( 'ish-blog-post-masonry' . $post_image_class . $color_data['bg_class'] . $color_data['text_class'] . $mas_classes ); ?>>
			<div>

				<?php echo $post_image ?>

				<div>
					<h3><a href="<?php the_permalink(); ?>"><i class="ish-icon-movie"></i><?php the_title(); ?></a></h3>

					<?php echo ishyoboy_get_masonry_post_details() ?>

					<?php
					$excerpt_length = get_masonry_excerpt_length( $mas_classes );
					$excerpt = ishyoboy_get_blog_excerpt( $excerpt_length );
					if ( ! empty( $excerpt ) ){
						echo '<div class="ish-excerpt">' . $excerpt . '</div>';
					}
					?>
				</div>
			</div>
		</div>
	<?php

	}

	// CLASSIC
	else{

	?>
		<div id="post-<?php the_ID(); ?>" <?php post_class( 'wpb_row vc_row-fluid ish-row-notfull ish-row_notsection' . $color_data['bg_class'] ); ?>>
			<div class="ish-vc_row_inner">

				<h2><a href="<?php the_permalink(); ?>"><i class="ish-icon-movie"></i><?php the_title(); ?></a></h2>

				<?php echo ishyoboy_get_post_details() ?>

				<?php ishyoboy_the_post_video( get_the_ID() ); ?>

				<?php echo ishyoboy_get_blog_excerpt(); ?>

				<span class="ish-blog-post-links">
					<a href="<?php comments_link(); ?>"><i class="ish-icon-chat"></i><?php comments_number('0', '1', '%'); ?></a>
					<?php ishyoboy_the_likes( false ); ?>
					<a href="<?php the_permalink(); ?>"><?php _e( 'Read more', 'ishyoboy'); ?></a>
				</span>

			</div>
		</div>
	<?php

	}
	?>

<?php } else {

	// BLOG SINGLE VIEW - BLOG DETAIL
	ishyoboy_the_content();

}
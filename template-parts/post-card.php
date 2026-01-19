<?php
/**
 * Blog Post Card Template Part
 *
 * @package author-portfolio
 */
?>

<div class="post-card" data-animate>
	<div style="position: relative;">
		<?php
		if ( has_post_thumbnail() ) {
			the_post_thumbnail( 'blog-archive', array( 'class' => 'post-card__image' ) );
		} else {
			?>
			<img src="<?php echo esc_url( AUTHOR_PORTFOLIO_ASSETS . '/images/placeholder-blog.jpg' ); ?>" alt="" class="post-card__image">
			<?php
		}

		if ( has_category() ) {
			?>
			<span class="post-card__category">
				<?php
				$categories = get_the_category();
				if ( ! empty( $categories ) ) {
					echo esc_html( $categories[0]->name );
				}
				?>
			</span>
			<?php
		}
		?>
	</div>

	<div class="post-card__content">
		<h3 class="post-card__title">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h3>

		<p class="post-card__excerpt">
			<?php echo wp_kses_post( wp_trim_words( get_the_excerpt(), 20 ) ); ?>
		</p>

		<div class="post-card__meta">
			<?php
			$author_id = get_the_author_meta( 'ID' );
			$author_image = get_avatar_url( $author_id );
			if ( $author_image ) {
				?>
				<img src="<?php echo esc_url( $author_image ); ?>" alt="<?php echo esc_attr( get_the_author() ); ?>" class="post-card__author-img">
				<?php
			}
			?>
			<div class="post-card__author">
				<span><?php the_author(); ?></span>
			</div>
			<span>•</span>
			<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
				<?php echo esc_html( get_the_date() ); ?>
			</time>
			<span>•</span>
			<span><?php echo author_portfolio_get_reading_time(); ?></span>
		</div>
	</div>
</div>

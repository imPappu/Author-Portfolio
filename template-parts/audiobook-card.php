<?php
/**
 * Audiobook Card Template Part
 *
 * @package author-portfolio
 * @global WP_Post $post
 */

$post = isset( $args['post'] ) ? $args['post'] : $GLOBALS['post'];
$duration = get_post_meta( $post->ID, 'duration', true );
$narrator = get_post_meta( $post->ID, 'narrator', true );
?>

<div class="audiobook-card">
	<div class="audiobook-card__image-wrapper">
		<?php
		if ( has_post_thumbnail( $post->ID ) ) {
			echo get_the_post_thumbnail( $post->ID, 'audiobook-cover', array( 'class' => 'audiobook-card__image' ) );
		} else {
			?>
			<img src="<?php echo esc_url( AUTHOR_PORTFOLIO_ASSETS . '/images/placeholder-audiobook.jpg' ); ?>" alt="" class="audiobook-card__image">
			<?php
		}
		?>
		<div class="audiobook-card__play-icon"></div>
		<?php if ( $duration ) : ?>
			<div class="audiobook-card__duration"><?php echo esc_html( $duration ); ?></div>
		<?php endif; ?>
	</div>

	<div class="audiobook-card__content">
		<h3 class="audiobook-card__title">
			<a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>">
				<?php echo esc_html( get_the_title( $post->ID ) ); ?>
			</a>
		</h3>

		<?php if ( $narrator ) : ?>
			<p class="audiobook-card__narrator">
				<?php echo sprintf( esc_html__( 'Narrated by %s', 'author-portfolio' ), esc_html( $narrator ) ); ?>
			</p>
		<?php endif; ?>

		<div class="audiobook-card__platforms">
			<a href="#" class="platform-icon" title="Audible" data-platform="audible">A</a>
			<a href="#" class="platform-icon" title="Apple Books" data-platform="apple">🍎</a>
			<a href="#" class="platform-icon" title="Spotify" data-platform="spotify">🎵</a>
			<a href="#" class="platform-icon" title="Google Play" data-platform="google">G</a>
		</div>

		<a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>" class="btn btn-primary btn-sm btn-block">
			<?php esc_html_e( 'Listen Now', 'author-portfolio' ); ?>
		</a>
	</div>
</div>

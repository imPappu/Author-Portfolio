<?php
/**
 * Template part for displaying a message when no content is found
 *
 * @package noir-editorial
 */
?>

<section class="no-results not-found" style="text-align: center; padding: var(--space-3xl) 0; min-height: 50vh; display: flex; flex-direction: column; justify-content: center;">
	<div class="container container-narrow" data-animate="fade">
		
		<header class="page-header" style="margin-bottom: var(--space-2xl);">
			<h1 class="page-title" style="font-size: var(--text-5xl); margin-bottom: var(--space-md);">
				<?php
				if ( is_search() ) :
					esc_html_e( 'Nothing Found', 'noir-editorial' );
				else :
					esc_html_e( 'No Content Available', 'noir-editorial' );
				endif;
				?>
			</h1>
		</header>

		<div class="page-content">
			<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

				<p style="font-size: var(--text-lg); color: var(--noir-muted); margin-bottom: var(--space-xl);">
					<?php
					printf(
						wp_kses(
							__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'noir-editorial' ),
							array(
								'a' => array(
									'href' => array(),
								),
							)
						),
						esc_url( admin_url( 'post-new.php' ) )
					);
					?>
				</p>

			<?php elseif ( is_search() ) : ?>

				<p style="font-size: var(--text-lg); color: var(--noir-muted); margin-bottom: var(--space-xl);">
					<?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'noir-editorial' ); ?>
				</p>

				<div style="max-width: 600px; margin: 0 auto;">
					<?php get_search_form(); ?>
				</div>

			<?php else : ?>

				<p style="font-size: var(--text-lg); color: var(--noir-muted); margin-bottom: var(--space-xl);">
					<?php esc_html_e( 'It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'noir-editorial' ); ?>
				</p>

				<div style="max-width: 600px; margin: 0 auto;">
					<?php get_search_form(); ?>
				</div>

			<?php endif; ?>
		</div>

	</div>
</section>
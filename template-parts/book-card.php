<?php
/**
 * Template part for displaying book cards in the bento gallery
 *
 * @package noir-editorial
 */

$book_meta = author_portfolio_get_book_meta();
$genres = get_the_terms( get_the_ID(), 'genre' );
?>

<div class="bento-item">
	<a href="<?php the_permalink(); ?>">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'book-cover', array( 'class' => 'bento-item-image' ) ); ?>
		<?php else : ?>
			<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/placeholder-book.jpg' ); ?>" 
				 alt="<?php the_title_attribute(); ?>" 
				 class="bento-item-image">
		<?php endif; ?>
	</a>
	
	<div class="bento-item-overlay">
		<h3 class="bento-item-title">
			<a href="<?php the_permalink(); ?>" style="color: inherit;">
				<?php the_title(); ?>
			</a>
		</h3>
		
		<div class="bento-item-meta">
			<?php if ( $genres && ! is_wp_error( $genres ) ) : ?>
				<?php echo esc_html( $genres[0]->name ); ?>
				<?php if ( $book_meta['published_date'] ) : ?>
					<span style="margin: 0 0.5rem;">•</span>
					<?php echo esc_html( date( 'Y', strtotime( $book_meta['published_date'] ) ) ); ?>
				<?php endif; ?>
			<?php endif; ?>
		</div>
		
		<?php if ( $book_meta['description'] ) : ?>
			<p class="bento-item-excerpt">
				<?php echo esc_html( wp_trim_words( $book_meta['description'], 15 ) ); ?>
			</p>
		<?php endif; ?>
	</div>
</div>
<?php
/**
 * Search Form Template
 *
 * @package noir-editorial
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="search-input" class="sr-only">
		<?php esc_html_e( 'Search for:', 'noir-editorial' ); ?>
	</label>
	<input 
		type="search" 
		id="search-input"
		class="search-field" 
		placeholder="<?php echo esc_attr_x( 'Search...', 'placeholder', 'noir-editorial' ); ?>" 
		value="<?php echo get_search_query(); ?>" 
		name="s"
		required
	/>
	<button type="submit" class="search-submit">
		<span class="sr-only"><?php esc_html_e( 'Search', 'noir-editorial' ); ?></span>
		<span aria-hidden="true">→</span>
	</button>
</form>
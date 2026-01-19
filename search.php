<?php
/**
 * Search Results Template
 *
 * @package noir-editorial
 */

get_header();
?>

<div class="search-page-wrapper" style="padding-top: 180px; padding-bottom: 100px;">
    <div class="container">
        
        <header class="section-header text-center" style="margin-bottom: 80px;">
            <span class="pill-tag fade-in-ready">Search Results</span>
            <h1 class="hero-title fade-in-ready" style="font-size: clamp(3rem, 6vw, 5rem);">
                <?php printf( esc_html__( 'Finding: "%s"', 'noir-editorial' ), get_search_query() ); ?>
            </h1>
            
            <div class="search-box-container fade-in-ready" style="max-width: 600px; margin: 40px auto 0;">
                <form role="search" method="get" class="search-form-wrap" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <input type="search" value="<?php echo get_search_query(); ?>" name="s" placeholder="Search again...">
                    <button type="submit">SEARCH</button>
                </form>
            </div>
        </header>

        <?php if ( have_posts() ) : ?>
            <div class="search-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 40px;">
                <?php while ( have_posts() ) : the_post(); ?>
                    <article class="post-card fade-in-ready">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="post-card-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium_large'); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <div class="post-card-content">
                            <span class="pill-tag"><?php echo esc_html( get_post_type_object( get_post_type() )->labels->singular_name ); ?></span>
                            <h2 class="post-card-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <div class="post-card-meta">
                                <?php echo get_the_date(); ?>
                            </div>
                            <div class="post-card-excerpt">
                                <?php echo wp_trim_words( get_the_excerpt(), 20 ); ?>
                            </div>
                            <div style="margin-top: auto;">
                                <a href="<?php the_permalink(); ?>" class="text-crimson italic" style="font-weight: 700;">View Details →</a>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <div class="pagination-wrapper">
                <?php the_posts_pagination([
                    'mid_size'  => 2,
                    'prev_text' => '←',
                    'next_text' => '→',
                ]); ?>
            </div>

        <?php else : ?>
            <div class="no-results text-center fade-in-ready" style="padding: 60px 0;">
                <p style="font-size: 1.5rem; color: var(--text-muted);">No entries found for your query. Try a different word.</p>
            </div>
        <?php endif; ?>

    </div>
</div>

<?php get_footer(); ?>
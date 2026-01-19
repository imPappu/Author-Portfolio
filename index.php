<?php
/**
 * The main template file - Blog Index
 *
 * @package noir-editorial
 */

get_header();
?>

<div class="content-area" style="padding-top: 180px; padding-bottom: 100px;">
    <div class="container">
        
        <?php if ( is_home() && ! is_front_page() ) : ?>
            <header class="section-header text-center" style="margin-bottom: 80px;">
                <span class="pill-tag fade-in-ready">The Archive</span>
                <h1 class="hero-title fade-in-ready" style="font-size: clamp(3rem, 6vw, 5.5rem);">
                    <?php single_post_title(); ?>
                </h1>
            </header>
        <?php endif; ?>

        <?php if ( have_posts() ) : ?>

            <div class="posts-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 40px;">
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'template-parts/content', get_post_format() ); ?>
                <?php endwhile; ?>
            </div>

            <div class="pagination-wrapper">
                <?php
                the_posts_pagination( array(
                    'mid_size'  => 2,
                    'prev_text' => '←',
                    'next_text' => '→',
                ) );
                ?>
            </div>

        <?php else : ?>
            <div class="text-center">
                <p>No stories found.</p>
            </div>
        <?php endif; ?>

    </div>
</div>

<?php get_footer(); ?>
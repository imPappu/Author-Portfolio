<?php
/**
 * Standard Page Template (Liquid Edition)
 *
 * @package noir-editorial
 */

get_header();

while ( have_posts() ) : the_post();
?>

<article id="page-<?php the_ID(); ?>" <?php post_class('static-page-wrapper'); ?> style="padding-top: 180px; padding-bottom: 100px;">
    <div class="container" style="max-width: 900px;">
        
        <header class="page-header text-center" style="margin-bottom: 80px;">
            <h1 class="fade-in-ready" style="font-size: clamp(3rem, 7vw, 6rem); line-height: 1;">
                <?php the_title(); ?>
            </h1>
            <div class="header-line fade-in-ready" style="width: 60px; height: 4px; background: var(--crimson); margin: 30px auto;"></div>
        </header>

        <div class="page-content fade-in-ready" style="font-size: 1.2rem; color: var(--text-main); line-height: 1.8;">
            <?php the_content(); ?>
        </div>

    </div>
</article>

<?php endwhile; ?>

<?php get_footer(); ?>

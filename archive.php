<?php
/**
 * Archive Template (Liquid Edition)
 *
 * @package noir-editorial
 */

get_header();
?>

<div class="archive-page-wrapper" style="padding-top: 180px; padding-bottom: 100px;">
    <div class="container">
        
        <header class="section-header text-center" style="margin-bottom: 80px;">
            <span class="pill-tag fade-in-ready">Collection</span>
            <h1 class="hero-title fade-in-ready" style="font-size: clamp(3rem, 6vw, 5.5rem);">
                <?php the_archive_title(); ?>
            </h1>
            <?php if ( get_the_archive_description() ) : ?>
                <div class="archive-description fade-in-ready" style="max-width: 700px; margin: 20px auto 0; color: var(--text-muted); font-size: 1.1rem;">
                    <?php echo get_the_archive_description(); ?>
                </div>
            <?php endif; ?>
        </header>

        <?php if ( have_posts() ) : ?>
            <div class="archive-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 40px;">
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
                <p>No entries found in this archive.</p>
            </div>
        <?php endif; ?>

    </div>
</div>

<?php get_footer(); ?>
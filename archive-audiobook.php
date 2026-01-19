<?php
/**
 * Audiobooks Archive Template (Liquid Edition - Custom Fields)
 *
 * @package noir-editorial
 */

get_header();
?>

<div class="archive-page-wrapper">
    <div class="container">
        
        <header class="section-header text-center">
            <span class="pill-tag fade-in-ready">Sonic Experiences</span>
            <h1 class="hero-title fade-in-ready">
                The <span class="italic text-crimson">Recordings</span>
            </h1>
            <p class="fade-in-ready">
                Immersive narratives brought to life through masterful vocal performance.
            </p>
        </header>

        <?php if ( have_posts() ) : ?>
            <div class="audiobooks-grid">
                <?php while ( have_posts() ) : the_post(); 
                    $c_title = get_post_meta(get_the_ID(), 'n_audio_custom_title', true);
                    $d_title = !empty($c_title) ? $c_title : get_the_title();
                    $custom_cover = get_post_meta(get_the_ID(), 'n_audio_cover_url', true);
                ?>
                    <article class="post-card fade-in-ready">
                        <div class="post-card-thumb" style="aspect-ratio: 1/1;">
                            <a href="<?php the_permalink(); ?>">
                                <?php if(!empty($custom_cover)): ?>
                                    <img src="<?php echo esc_url($custom_cover); ?>" alt="<?php echo esc_attr($d_title); ?>">
                                <?php elseif(has_post_thumbnail()): the_post_thumbnail('large'); else: ?>
                                    <div style="background:var(--gray-bg); height:100%;"></div>
                                <?php endif; ?>
                            </a>
                        </div>
                        <div class="post-card-content">
                            <h2 class="post-card-title"><a href="<?php the_permalink(); ?>"><?php echo esc_html($d_title); ?></a></h2>
                            <div class="explore-link-container">
                                <a href="<?php the_permalink(); ?>" class="text-crimson explore-link italic">LISTEN NOW →</a>
                            </div>
                        </div>
                    </article>
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
                <p>New recordings are in production.</p>
            </div>
        <?php endif; ?>

    </div>
</div>

<?php get_footer(); ?>
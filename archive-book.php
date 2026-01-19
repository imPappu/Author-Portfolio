<?php
/**
 * Books Archive Template (Liquid Edition)
 *
 * @package noir-editorial
 */

get_header();
?>

<div class="archive-page-wrapper" style="padding-top: 180px; padding-bottom: 100px;">
    <div class="container">
        
        <header class="section-header text-center" style="margin-bottom: 80px;">
            <span class="pill-tag fade-in-ready">Selected Works</span>
            <h1 class="hero-title fade-in-ready" style="font-size: clamp(3rem, 6vw, 5.5rem);">
                The <span class="italic text-crimson">Library</span>
            </h1>
            <p class="fade-in-ready" style="max-width: 600px; margin: 20px auto 0; color: var(--text-muted);">
                A curated selection of novels, journals, and literary explorations.
            </p>
        </header>

        <!-- Genre Quick Filters -->
        <?php
        $genres = get_terms(['taxonomy' => 'genre', 'hide_empty' => true]);
        if (!empty($genres)): ?>
        <div class="genre-nav fade-in-ready" style="display: flex; justify-content: center; gap: 10px; margin-bottom: 60px; flex-wrap: wrap;">
            <a href="<?php echo get_post_type_archive_link('book'); ?>" class="pill-tag" style="background:var(--black); color:white;">All Genres</a>
            <?php foreach($genres as $genre): ?>
                <a href="<?php echo get_term_link($genre); ?>" class="pill-tag"><?php echo $genre->name; ?></a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if ( have_posts() ) : ?>
            <div class="books-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 40px;">
                <?php while ( have_posts() ) : the_post(); 
                    $c_title = get_post_meta(get_the_ID(), 'n_book_custom_title', true);
                    $d_title = !empty($c_title) ? $c_title : get_the_title();
                    $custom_cover = get_post_meta(get_the_ID(), 'n_book_cover_url', true);
                ?>
                    <article class="post-card fade-in-ready">
                        <div class="post-card-thumb" style="aspect-ratio: 2/3;">
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
                            <div class="post-card-meta"><?php echo get_the_term_list(get_the_ID(), 'genre', '', ', ', ''); ?></div>
                            <div style="margin-top: auto; padding-top: 20px;">
                                <a href="<?php the_permalink(); ?>" class="text-crimson italic" style="font-weight: 700;">EXPLORE WORK →</a>
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
                <p>The library is currently being restocked.</p>
            </div>
        <?php endif; ?>

    </div>
</div>

<?php get_footer(); ?>
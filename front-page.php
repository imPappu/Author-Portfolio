<?php get_header(); ?>

<div id="main-content">
    
    <!-- Hero Section (Liquid Carousel) -->
    <section class="hero">
        <!-- Background Carousel -->
        <div class="hero-carousel">
            <?php 
            $hero_images = noir_editorial_get_hero_images();
            if ( ! empty( $hero_images ) ) :
                foreach ( $hero_images as $index => $image_url ) :
            ?>
                <div class="hero-slide <?php echo $index === 0 ? 'active' : ''; ?>" 
                     style="background-image: url('<?php echo esc_url($image_url); ?>');">
                </div>
            <?php 
                endforeach;
            else : 
                // Check single background image fallback
                $fallback_hero = get_theme_mod('author_portfolio_hero_image');
            ?>
                <div class="hero-slide active" style="<?php echo $fallback_hero ? "background-image: url('".esc_url($fallback_hero)."');" : "background-color: var(--black);"; ?>"></div>
            <?php endif; ?>
        </div>

        <!-- Foreground Content -->
        <div class="container">
            <div class="hero-content">
                <span class="hero-label fade-in-ready">EDITORIAL AUTHOR</span>
                <h1 class="hero-title fade-in-ready">
                    <?php 
                    $title = get_theme_mod('author_portfolio_hero_title', 'Redefining {Modern} Fiction');
                    // Find text inside curly braces and wrap it with crimson span
                    echo wp_kses_post(preg_replace('/\{(.*?)\}/', '<span class="italic text-crimson">$1</span>', $title)); 
                    ?>
                </h1>
                <p class="hero-desc fade-in-ready">
                    <?php echo esc_html(get_theme_mod('author_portfolio_hero_description', 'A.V. Noir blends the cinematic intensity of high-fashion editorial aesthetics with the psychological depth of contemporary literature.')); ?>
                </p>
                <div class="hero-actions fade-in-ready" style="margin-top: 40px;">
                    <a href="#library" class="btn-primary">Explore Bibliography</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Ticker Marquee (Rolling Script) -->
    <div class="marquee-container">
        <div class="marquee-content">
            <?php for($i=0; $i<10; $i++): ?>
                <span class="marquee-item">NEW RELEASE 2024 • <span class="italic">THE CRIMSON SCRIPTA</span> •</span>
            <?php endfor; ?>
        </div>
    </div>

    <!-- Selected Bibliography (Liquid Bento Grid) -->
    <section id="library" class="bibliography-section">
        <div class="container">
            <div class="bibliography-header" style="padding: 100px 0 60px;">
                <h2 class="bib-title fade-in-ready">
                    SELECTED <br>
                    <span class="italic text-crimson">Bibliography</span>
                </h2>
                <div class="curated-label fade-in-ready">CURATED LOOP / V.4.0</div>
            </div>

            <div class="bento-grid">
                <?php
                $books = new WP_Query([
                    'post_type' => 'book',
                    'posts_per_page' => 4,
                    'orderby' => 'menu_order',
                    'order' => 'ASC'
                ]);
                $count = 0;
                if ($books->have_posts()) : while ($books->have_posts()) : $books->the_post();
                    $count++;
                    $grid_class = ($count === 1) ? 'tall' : (($count === 2) ? 'wide' : '');
                ?>
                <a href="<?php the_permalink(); ?>" class="bento-item <?php echo $grid_class; ?> fade-in-ready">
                    <?php 
                    $custom_cover = get_post_meta(get_the_ID(), 'n_book_cover_url', true);
                    if ( !empty($custom_cover) ) : ?>
                        <img src="<?php echo esc_url($custom_cover); ?>" class="bento-img" alt="<?php the_title_attribute(); ?>">
                    <?php elseif (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('large', ['class' => 'bento-img']); ?>
                    <?php else : ?>
                        <div class="bento-img" style="background: var(--gray-bg); height: 100%;"></div>
                    <?php endif; ?>
                    <div class="bento-overlay">
                        <div class="pill-tag" style="background:white;"><?php echo get_the_term_list(get_the_ID(), 'genre', '', ', '); ?></div>
                        <?php 
                        $c_title = get_post_meta(get_the_ID(), 'n_book_custom_title', true);
                        $d_title = !empty($c_title) ? $c_title : get_the_title();
                        ?>
                        <h3 class="bento-title"><?php echo esc_html($d_title); ?></h3>
                    </div>
                </a>
                <?php endwhile; wp_reset_postdata(); else: ?>
                    <p class="fade-in-ready">Populate the 'Books' post type to see the gallery.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Author Biography (Architect of Prose) -->
    <section id="biography" class="author-section">
        <div class="container">
            <div class="author-card">
                <div class="author-portrait fade-in-ready">
                    <div class="deco-circle"></div>
                    <div class="img-container">
                        <?php 
                        $author_img = get_theme_mod('author_portfolio_author_image');
                        if ($author_img) : ?>
                            <img src="<?php echo esc_url($author_img); ?>" alt="Author" style="width:100%; height:100%; object-fit:cover; border-radius:inherit;">
                        <?php else : ?>
                            <div style="width:100%; height:100%; background:var(--gray-bg); border-radius:inherit;"></div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="author-bio-content fade-in-ready">
                    <span class="label">THE ARCHITECT OF PROSE</span>
                    <h2><?php echo esc_html(get_theme_mod('author_portfolio_author_name', get_bloginfo('name'))); ?></h2>
                    <div class="author-text">
                        <?php 
                        $bio = get_theme_mod('author_portfolio_author_bio', '<p>Based between Tokyo and Paris, A.V. Noir\'s work focuses on the surgical precision of human emotion through the lens of modern minimalism.</p>');
                        echo wp_kses_post(wpautop($bio)); 
                        ?>
                    </div>

                    <div class="author-stats">
                        <div class="stat-item">
                            <span class="stat-val"><?php echo esc_html(get_theme_mod("author_portfolio_books_published", '25')); ?></span>
                            <span class="stat-lbl"><?php echo esc_html(get_theme_mod("author_portfolio_stat_1_lbl", 'Books Published')); ?></span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-val"><?php echo esc_html(get_theme_mod("author_portfolio_awards_won", '05')); ?></span>
                            <span class="stat-lbl"><?php echo esc_html(get_theme_mod("author_portfolio_stat_2_lbl", 'Awards Won')); ?></span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-val"><?php echo esc_html(get_theme_mod("author_portfolio_years_experience", '20')); ?></span>
                            <span class="stat-lbl"><?php echo esc_html(get_theme_mod("author_portfolio_stat_3_lbl", 'Years Experience')); ?></span>
                        </div>
                    </div>

                    <div class="social-links-list">
                        <?php 
                        $socials = noir_editorial_get_social_links();
                        foreach( $socials as $platform => $url ) : ?>
                            <a href="<?php echo esc_url($url); ?>" class="social-link-item"><?php echo strtoupper($platform); ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- The Inner Circle (Liquid Newsletter) -->
    <section id="contact" class="newsletter-section">
        <div class="container">
            <div class="newsletter-box-liquid fade-in-ready">
                <h2 style="font-size:3rem; margin-bottom:20px;">The Inner Circle</h2>
                <p style="margin-bottom:40px; max-width:600px; margin-left:auto; margin-right:auto;">Join a curated list of readers. Exclusive manuscripts, private first-editions, and monthly missives.</p>
                
                <form class="newsletter-form-container">
                    <input type="email" placeholder="YOUR DIGITAL ADDRESS" required class="newsletter-input">
                    <button type="submit" class="btn-secondary">REQUEST ENTRY</button>
                </form>
            </div>
        </div>
    </section>

</div>

<?php get_footer(); ?>
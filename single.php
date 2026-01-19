<?php
/**
 * Single Blog Post Template (Liquid Edition)
 *
 * @package noir-editorial
 */

get_header();

while ( have_posts() ) : the_post();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('single-post-wrapper'); ?> style="padding-top: 180px; padding-bottom: 100px;">
    <div class="container" style="max-width: 900px;">
        
        <header class="post-header text-center" style="margin-bottom: 60px;">
            <div class="fade-in-ready" style="margin-bottom: 20px;">
                <?php
                $categories = get_the_category();
                if ( ! empty( $categories ) ) {
                    foreach($categories as $cat) {
                        echo '<span class="pill-tag">' . esc_html( $cat->name ) . '</span> ';
                    }
                }
                ?>
            </div>

            <h1 class="fade-in-ready" style="font-size: clamp(2.5rem, 5vw, 4.5rem); margin-bottom: 30px; line-height: 1.1;">
                <?php the_title(); ?>
            </h1>

            <div class="post-meta fade-in-ready" style="color: var(--text-muted); font-size: 0.9rem; text-transform: uppercase; letter-spacing: 2px;">
                <span>Published on <?php echo get_the_date(); ?></span>
                <span style="margin: 0 15px;">•</span>
                <span><?php echo noir_editorial_get_reading_time(); ?></span>
            </div>
        </header>

        <?php if ( has_post_thumbnail() ) : ?>
            <div class="featured-image fade-in-ready" style="margin-bottom: 60px;">
                <?php the_post_thumbnail('large', ['style' => 'width:100%; border-radius: var(--radius-lg); box-shadow: var(--shadow-heavy);']); ?>
            </div>
        <?php endif; ?>

        <div class="entry-content fade-in-ready" style="font-size: 1.2rem; color: var(--text-main); line-height: 1.8;">
            <?php the_content(); ?>
        </div>

        <footer class="post-footer fade-in-ready" style="margin-top: 80px; padding-top: 40px; border-top: 1px solid var(--smoke);">
            <?php if(has_tag()): ?>
                <div class="tags" style="margin-bottom: 30px;">
                    <span style="font-size: 0.7rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; display: block; margin-bottom: 10px;">Tagged in:</span>
                    <?php the_tags('', ' ', ''); ?>
                </div>
            <?php endif; ?>

            <div class="author-info-card" style="display: flex; gap: 30px; align-items: center; background: var(--gray-bg); padding: 40px; border-radius: var(--radius-lg);">
                <div class="author-avatar" style="width: 80px; height: 80px; background: #ddd; border-radius: 50%; overflow: hidden; flex-shrink: 0;">
                    <?php echo get_avatar( get_the_author_meta( 'ID' ), 80 ); ?>
                </div>
                <div class="author-text">
                    <h4 style="margin-bottom: 5px;"><?php echo get_the_author(); ?></h4>
                    <p style="font-size: 0.9rem; color: var(--text-muted);"><?php echo get_the_author_meta('description'); ?></p>
                </div>
            </div>
        </footer>

        <?php if ( comments_open() || get_comments_number() ) : ?>
            <div class="comments-section fade-in-ready" style="margin-top: 80px;">
                <?php comments_template(); ?>
            </div>
        <?php endif; ?>

    </div>
</article>

<?php endwhile; ?>

<?php get_footer(); ?>
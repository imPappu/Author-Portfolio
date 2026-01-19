<?php
/**
 * Template part for displaying posts (Liquid Edition)
 *
 * @package noir-editorial
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card' ); ?>>
    <?php if ( has_post_thumbnail() ) : ?>
        <div class="post-card-thumb">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('medium_large'); ?>
            </a>
        </div>
    <?php endif; ?>
    
    <div class="post-card-content">
        <div class="post-card-meta">
            <?php
            $categories = get_the_category();
            if ( ! empty( $categories ) ) {
                echo '<span class="text-crimson">' . esc_html( $categories[0]->name ) . '</span> • ';
            }
            ?>
            <span><?php echo get_the_date(); ?></span>
        </div>

        <h2 class="post-card-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h2>

        <div class="post-card-excerpt">
            <?php echo wp_trim_words( get_the_excerpt(), 25 ); ?>
        </div>

        <div style="margin-top: auto; padding-top: 20px;">
            <a href="<?php the_permalink(); ?>" class="text-crimson italic" style="font-weight: 700;">READ FULL ARTICLE →</a>
        </div>
    </div>
</article>
<?php
/**
 * Single Audiobook Template (Liquid Edition - Dynamic Platforms)
 *
 * @package noir-editorial
 */

get_header();

while ( have_posts() ) : the_post();
    $custom_title = get_post_meta(get_the_ID(), 'n_audio_custom_title', true);
    $display_title = !empty($custom_title) ? $custom_title : get_the_title();
    $description = get_post_meta(get_the_ID(), 'n_audio_description', true);
    $custom_cover = get_post_meta(get_the_ID(), 'n_audio_cover_url', true);
    $purchase_links = get_post_meta(get_the_ID(), 'n_purchase_links', true) ?: [];
?>

<article id="audiobook-<?php the_ID(); ?>" <?php post_class('book-detail-wrapper'); ?>>
    <div class="container">
        <div class="book-layout">
            <div class="book-cover-container fade-in-ready">
                <?php if ( !empty($custom_cover) ) : ?>
                    <img src="<?php echo esc_url($custom_cover); ?>" class="book-cover-image" alt="<?php echo esc_attr($display_title); ?>">
                <?php elseif ( has_post_thumbnail() ) : ?>
                    <?php the_post_thumbnail('large', ['class' => 'book-cover-image']); ?>
                <?php endif; ?>
            </div>
            
            <div class="book-info">
                <span class="pill-tag fade-in-ready">AUDIO EXPERIENCE</span>
                <h1 class="fade-in-ready"><?php echo esc_html($display_title); ?></h1>
                
                <div class="book-genres fade-in-ready" style="margin-bottom: 30px;">
                    <?php echo get_the_term_list(get_the_ID(), 'genre', '', ' ', ''); ?>
                </div>

                <div class="book-description fade-in-ready">
                    <?php echo !empty($description) ? wpautop(wp_kses_post($description)) : '<p>No audio summary provided.</p>'; ?>
                </div>

                <?php if(!empty($purchase_links)): ?>
                <div class="buy-section fade-in-ready">
                    <h4 style="margin-bottom: 20px; text-transform: uppercase; letter-spacing: 2px; font-size: 0.8rem;">Listen Now On</h4>
                    <div class="buy-buttons">
                        <?php foreach($purchase_links as $link): 
                            $platform = get_post($link['id']);
                            if($platform):
                        ?>
                            <a href="<?php echo esc_url($link['url']); ?>" class="buy-btn" target="_blank">
                                <?php if(has_post_thumbnail($platform->ID)): ?>
                                    <span class="platform-icon"><?php echo get_the_post_thumbnail($platform->ID, [20, 20]); ?></span>
                                <?php endif; ?>
                                <?php echo strtoupper($platform->post_title); ?>
                            </a>
                        <?php endif; endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</article>

<?php endwhile; get_footer(); ?>
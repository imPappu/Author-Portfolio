<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    
    <!-- Google Fonts: Playfair Display & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,700;1,900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- SEO & Schema -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Person",
      "name": "<?php echo esc_attr(get_theme_mod('author_portfolio_author_name', get_bloginfo('name'))); ?>",
      "jobTitle": "Author",
      "description": "<?php echo esc_attr(wp_strip_all_tags(get_theme_mod('author_portfolio_hero_description'))); ?>",
      "url": "<?php echo esc_url(home_url('/')); ?>"
    }
    </script>
    
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="header-wrapper">
    <header class="site-header">
        <div class="logo">
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <?php 
                if (has_custom_logo()) {
                    the_custom_logo();
                } else {
                    $blog_name = get_bloginfo('name');
                    // Transform name to A.V. NOIR style if possible or just use it
                    echo esc_html($blog_name);
                }
                ?>
            </a>
        </div>

        <nav class="main-navigation">
            <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'container' => false,
                'menu_class' => 'nav-menu',
                'fallback_cb' => false,
                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s<li><a href="#contact" class="btn-contact">Contact</a></li></ul>',
                'link_class' => 'nav-link'
            ]);
            ?>
        </nav>

        <!-- Mobile Toggle (simplified for this layout) -->
        <div class="mobile-toggle-wrapper" style="display:none;">
            <div class="mobile-toggle"><span></span></div>
        </div>
    </header>
</div>

<div id="page" class="site">
    <main id="primary" class="site-main">
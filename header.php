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
    <?php noir_editorial_generate_schema(); ?>
    
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="custom-cursor"></div>

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
                'menu_class' => 'nav-menu stagger-container',
                'fallback_cb' => false,
                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s<li class="stagger-item"><a href="#contact" class="btn-contact">Contact</a></li></ul>',
                'link_class' => 'nav-link'
            ]);
            ?>
        </nav>

        <!-- Mobile Toggle -->
        <div class="mobile-toggle-wrapper">
            <button class="mobile-toggle" aria-label="Toggle Navigation">
                <span class="line line-1"></span>
                <span class="line line-2"></span>
                <span class="line line-3"></span>
            </button>
        </div>
    </header>
</div>

<!-- Mobile Navigation Overlay -->
<div class="mobile-nav-overlay">
    <div class="mobile-nav-content">
        <?php
        wp_nav_menu([
            'theme_location' => 'primary',
            'container' => false,
            'menu_class' => 'mobile-nav-menu stagger-container',
            'fallback_cb' => false,
            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s<li class="stagger-item"><a href="#contact" class="btn-contact mobile-nav-contact">Contact</a></li></ul>'
        ]);
        ?>
    </div>
</div>

<div id="page" class="site">
    <main id="primary" class="site-main">
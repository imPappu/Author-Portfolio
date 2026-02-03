<?php
/**
 * Footer Template (Liquid Edition - Centered Version)
 *
 * @package noir-editorial
 */
?>
    </main><!-- #primary -->

    <footer class="site-footer">
        <div class="container text-center">
            
            <!-- Centered Branding -->
            <div class="footer-branding-centered fade-in-ready">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="footer-logo-large">
                    <?php 
                    if (has_custom_logo()) {
                        the_custom_logo();
                    } else {
                        bloginfo('name');
                    }
                    ?>
                </a>
                <p class="footer-motto-centered">
                    <?php echo esc_html(get_theme_mod('author_portfolio_hero_description', 'Crafting narratives at the intersection of psychology and style.')); ?>
                </p>
            </div>

            <!-- Centered Navigation Links -->
            <div class="footer-nav-centered">
                <?php
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'container' => false,
                    'menu_class' => 'footer-menu-pill stagger-container',
                    'fallback_cb' => false
                ]);
                ?>
            </div>

            <!-- Centered Socials -->
            <div class="footer-socials-centered stagger-container">
                <?php 
                $socials = noir_editorial_get_social_links();
                foreach( $socials as $platform => $url ) : ?>
                    <a href="<?php echo esc_url($url); ?>" class="social-circle-link stagger-item" target="_blank" aria-label="<?php echo esc_attr($platform); ?>">
                        <span class="platform-name"><?php echo strtoupper($platform); ?></span>
                    </a>
                <?php endforeach; ?>
            </div>

            <!-- Footer Bottom: Legal -->
            <div class="footer-bottom-centered fade-in-ready">
                <div class="copyright">
                    &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <span class="italic text-crimson">Editorial Noir V.1.1</span>
                </div>
                <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})" class="back-to-top-liquid">
                    BACK TO TOP ↑
                </button>
            </div>
        </div>
    </footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
<?php
/**
 * 404 Error Page Template (Liquid Edition)
 *
 * @package noir-editorial
 */

get_header();
?>

<div class="error-404-wrapper" style="min-height: 80vh; display: flex; align-items: center; padding-top: 100px;">
    <div class="container text-center">
        
        <div class="error-content" style="max-width: 600px; margin: 0 auto;">
            <span class="pill-tag fade-in-ready" style="font-size: 1.5rem; padding: 10px 30px;">ERR 404</span>
            
            <h1 class="hero-title fade-in-ready" style="font-size: 8rem; margin: 40px 0;">Lost in <span class="italic text-crimson">Prose</span>.</h1>
            
            <p class="fade-in-ready" style="font-size: 1.2rem; color: var(--text-muted); margin-bottom: 50px;">
                The chapter you're looking for was never written, or perhaps it was lost in the editorial process.
            </p>

            <div class="search-form-container fade-in-ready" style="margin-bottom: 50px;">
                <form role="search" method="get" class="search-form-wrap" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <input type="search" name="s" placeholder="Search the archives...">
                    <button type="submit">FIND</button>
                </form>
            </div>

            <div class="actions fade-in-ready">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn-request" style="background:var(--crimson); color:white; border:none;">RETURN HOME</a>
            </div>
        </div>

    </div>
</div>

<?php get_footer(); ?>
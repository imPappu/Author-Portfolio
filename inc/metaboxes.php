<?php
/**
 * Custom Meta Boxes for Books and Audiobooks (Noir Editorial)
 *
 * @package noir-editorial
 */

/**
 * Register Meta Boxes
 */
function noir_editorial_add_meta_boxes() {
    add_meta_box('book_details_box', '📖 Book Editorial Details', 'noir_editorial_book_details_cb', 'book', 'normal', 'high');
    add_meta_box('audiobook_details_box', '🎧 Audiobook Editorial Details', 'noir_editorial_audiobook_details_cb', 'audiobook', 'normal', 'high');
}
add_action('add_meta_boxes', 'noir_editorial_add_meta_boxes');

/**
 * Enqueue Admin Assets
 */
function noir_editorial_admin_assets($hook) {
    if ($hook == 'post.php' || $hook == 'post-new.php') {
        wp_enqueue_media();
        wp_enqueue_script('noir-admin-js', get_template_directory_uri() . '/assets/js/admin.js', array('jquery'), NOIR_VERSION, true);
    }
}
add_action('admin_enqueue_scripts', 'noir_editorial_admin_assets');

/**
 * HTML Helper for input fields
 */
function noir_field_row($label, $name, $value, $type = 'text', $desc = '') {
    ?>
    <div style="margin-bottom: 20px;">
        <label style="display:block; font-weight:bold; margin-bottom:5px;"><?php echo esc_html($label); ?></label>
        <?php if($type === 'textarea'): ?>
            <textarea name="<?php echo esc_attr($name); ?>" rows="5" style="width:100%;"><?php echo esc_textarea($value); ?></textarea>
        <?php elseif($type === 'image'): ?>
            <div style="display:flex; gap:10px;">
                <input type="url" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr($value); ?>" style="flex:1; padding:8px;" placeholder="https://...">
                <button type="button" class="button noir-upload-btn">Select Image</button>
            </div>
        <?php else: ?>
            <input type="<?php echo esc_attr($type); ?>" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr($value); ?>" style="width:100%; padding:8px;">
        <?php endif; ?>
        <?php if($desc): ?><p style="font-size:12px; color:#666; margin-top:4px;"><?php echo esc_html($desc); ?></p><?php endif; ?>
    </div>
    <?php
}

/**
 * Platform Selector Helper
 */
function noir_platform_selector($index, $saved_platform = '', $saved_url = '') {
    $platforms = get_posts(['post_type' => 'platform', 'posts_per_page' => -1]);
    ?>
    <div style="display: flex; gap: 15px; margin-bottom: 10px; background: #f9f9f9; padding: 10px; border-radius: 4px;">
        <div style="flex: 1;">
            <label style="display:block; font-size: 11px; text-transform: uppercase;">Platform</label>
            <select name="purchase_platforms[<?php echo $index; ?>][id]" style="width: 100%;">
                <option value="">- Select Platform -</option>
                <?php foreach($platforms as $p): ?>
                    <option value="<?php echo $p->ID; ?>" <?php selected($saved_platform, $p->ID); ?>><?php echo esc_html($p->post_title); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div style="flex: 2;">
            <label style="display:block; font-size: 11px; text-transform: uppercase;">URL</label>
            <input type="url" name="purchase_platforms[<?php echo $index; ?>][url]" value="<?php echo esc_url($saved_url); ?>" style="width: 100%;" placeholder="https://...">
        </div>
    </div>
    <?php
}

/**
 * Book Meta Box Callback
 */
function noir_editorial_book_details_cb($post) {
    wp_nonce_field('noir_book_meta_nonce', 'noir_book_meta_nonce_field');
    
    $title = get_post_meta($post->ID, 'n_book_custom_title', true);
    $desc = get_post_meta($post->ID, 'n_book_description', true);
    $cover = get_post_meta($post->ID, 'n_book_cover_url', true);
    $saved_links = get_post_meta($post->ID, 'n_purchase_links', true) ?: [];

    noir_field_row('Editorial Title', 'n_book_custom_title', $title, 'text', 'Overrides the default post title.');
    noir_field_row('Editorial Description', 'n_book_description', $desc, 'textarea');
    noir_field_row('Custom Cover Image URL', 'n_book_cover_url', $cover, 'image', 'Direct link to an image override or select from library.');

    echo '<label style="display:block; font-weight:bold; margin-bottom:10px;">Purchase Platforms & Links</label>';
    for($i=0; $i<5; $i++) {
        $p_id = isset($saved_links[$i]['id']) ? $saved_links[$i]['id'] : '';
        $p_url = isset($saved_links[$i]['url']) ? $saved_links[$i]['url'] : '';
        noir_platform_selector($i, $p_id, $p_url);
    }
}

/**
 * Audiobook Meta Box Callback
 */
function noir_editorial_audiobook_details_cb($post) {
    wp_nonce_field('noir_audio_meta_nonce', 'noir_audio_meta_nonce_field');
    
    $title = get_post_meta($post->ID, 'n_audio_custom_title', true);
    $desc = get_post_meta($post->ID, 'n_audio_description', true);
    $cover = get_post_meta($post->ID, 'n_audio_cover_url', true);
    $saved_links = get_post_meta($post->ID, 'n_purchase_links', true) ?: [];

    noir_field_row('Editorial Title', 'n_audio_custom_title', $title, 'text');
    noir_field_row('Audio Description', 'n_audio_description', $desc, 'textarea');
    noir_field_row('Custom Audio Cover URL', 'n_audio_cover_url', $cover, 'image');

    echo '<label style="display:block; font-weight:bold; margin-bottom:10px;">Listening Platforms & Links</label>';
    for($i=0; $i<5; $i++) {
        $p_id = isset($saved_links[$i]['id']) ? $saved_links[$i]['id'] : '';
        $p_url = isset($saved_links[$i]['url']) ? $saved_links[$i]['url'] : '';
        noir_platform_selector($i, $p_id, $p_url);
    }
}

/**
 * Save Meta Data
 */
function noir_editorial_save_editorial_meta($post_id) {
    // Check if saving book or audiobook
    $is_book = isset($_POST['noir_book_meta_nonce_field']) && wp_verify_nonce($_POST['noir_book_meta_nonce_field'], 'noir_book_meta_nonce');
    $is_audio = isset($_POST['noir_audio_meta_nonce_field']) && wp_verify_nonce($_POST['noir_audio_meta_nonce_field'], 'noir_audio_meta_nonce');

    if ($is_book || $is_audio) {
        $prefix = $is_book ? 'n_book_' : 'n_audio_';
        $fields = [$prefix.'custom_title', $prefix.'description', $prefix.'cover_url'];
        
        foreach ($fields as $field) {
            if (isset($_POST[$field])) {
                update_post_meta($post_id, $field, wp_kses_post($_POST[$field]));
            }
        }

        // Save dynamic links
        if (isset($_POST['purchase_platforms'])) {
            $links = [];
            foreach ($_POST['purchase_platforms'] as $link) {
                if (!empty($link['id']) && !empty($link['url'])) {
                    $links[] = [
                        'id' => intval($link['id']),
                        'url' => esc_url_raw($link['url'])
                    ];
                }
            }
            update_post_meta($post_id, 'n_purchase_links', $links);
        }
    }
}
add_action('save_post', 'noir_editorial_save_editorial_meta');

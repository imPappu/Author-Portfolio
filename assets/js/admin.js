jQuery(document).ready(function($){
    $('.noir-upload-btn').click(function(e) {
        e.preventDefault();
        var button = $(this);
        var input = button.prev('input');
        var custom_uploader = wp.media({
            title: 'Select Cover Image',
            button: { text: 'Use this image' },
            multiple: false
        }).on('select', function() {
            var attachment = custom_uploader.state().get('selection').first().toJSON();
            input.val(attachment.url);
        }).open();
    });
});

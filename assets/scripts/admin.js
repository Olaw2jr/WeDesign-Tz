/**
 * Created by Oscar on 3/27/2016.
 */
jQuery(function(jQuery) {

    jQuery('.testimonial_upload_image_button').click(function() {
        var formfield = jQuery(this).siblings('.testimonial_upload_image');
        var preview = jQuery(this).siblings('.testimonial_preview_image');
        tb_show('', 'media-upload.php?type=image&TB_iframe=true');
        /*window.send_to_editor = function(html) {
            imgurl = jQuery('img',html).attr('src');
            classes = jQuery('img', html).attr('class');
            id = classes.replace(/(.*?)wp-image-/, '');
            formfield.val(id);
            preview.attr('src', imgurl);
            tb_remove();
        };*/

        window.send_to_editor = function(stuff) {
            //console.log(stuff);
            var data = jQuery(stuff).filter('img');
            //console.log(data);
            imgurl = data.attr("src");
            //console.log(imgurl);
            classes = data.attr("class");
            //console.log(classes);
            id = classes.replace(/(.*?)wp-image-/, '');
            formfield.val(id);
            preview.attr('src', imgurl);
            tb_remove();
        };
        return false;
    });

    jQuery('.testimonial_clear_image_button').click(function() {
        var defaultImage = jQuery(this).parent().siblings('.testimonial_default_image').text();
        jQuery(this).parent().siblings('.testimonial_upload_image').val('');
        jQuery(this).parent().siblings('.testimonial_preview_image').attr('src', defaultImage);
        return false;
    });

});

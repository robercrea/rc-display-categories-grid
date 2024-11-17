//start jquery
jQuery(document).ready(function ($) {
    $(".select2").select2({ width: "100%" });
    $(".wp-color-picker").wpColorPicker();

    // Handle Range input changes
    $(".rc-range").on("input", function (event) {
        let labelClass = "#" + $(this).attr("name") + "_label";
        $(`${labelClass}`).text(event.target.value + "px");
    });

    // Handle image upload for category
    $("input#rc_term_image_media_manager").on("click", function (e) {
        e.preventDefault();
        let image_frame;
        if (image_frame) image_frame.open();

        image_frame = wp.media({
            title: "Select or Upload Image",
            multiple: false,
            library: { type: ["image"] },
        });

        image_frame.on("close", function () {
            let selection = image_frame.state().get("selection");
            let gallery_ids = new Array();
            let index = 0;
            selection.each(function (attachment) {
                gallery_ids[index] = attachment["id"];
                index++;
            });
            let ids = gallery_ids.join(",");
            if (ids.length === 0) return true;
            $("input#rc_term_image").val(ids);
            Refresh_Image(ids);
        });

        image_frame.on("open", function () {
            let selection = image_frame.state().get("selection");
            let ids = $("input#rc_term_image").val().split(",");
            ids.forEach(function (id) {
                var att = wp.media.attachment(id);
                att.fetch();
                selection.add(att ? [att] : []);
            });
        });
        image_frame.open();
    });

    function Refresh_Image(the_id) {
        let data = {
            action: "rc_term_image",
            nonce: rc_dcg_admin.nonce,
            id: the_id,
        };
        $.get(ajaxurl, data, function (res) {
            if (res.success === true)
                $("#rc_term_image_preview").replaceWith(res.data.image);
        });
    }
});

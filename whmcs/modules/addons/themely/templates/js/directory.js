/* Theme Search */
jQuery(document).ready(function() {
    function debounce(callback, wait) {
        let timeout;
        return (...args) => {
            clearTimeout(timeout);
            timeout = setTimeout(function () { callback.apply(this, args) }, wait);
        };
    }
    document.querySelector('#search_param').addEventListener('keyup', debounce( () => {
        var search_param = jQuery("#search_param").val();
        jQuery.ajax({
            url: 'modules/addons/themely/templates/search.php',
            type: "POST",
            data: {search_param: search_param},
            beforeSend: function () {
                jQuery("#spinner").show();
            },
            success: function (data) {
                jQuery("#results").html(data);
                jQuery("#spinner").hide();
            },
            error: function (error) {
                alert("Error!");
            }
        });
    }, 800))
});

/* Hide Inputs */
jQuery(document).ready(function() {
    $("label:contains('WordPress Theme Slug')").parent().addClass("invisible");
    $("label:contains('WordPress Theme URL')").parent().addClass("invisible");
});

/* Theme Selector */
jQuery(document).ready(function() {
  $("#results").on('click', 'button', function(e) {
    e.preventDefault();
    var $btn = $(this);
    if ($btn.hasClass('btn-success')) {
        $btn.prop("clicked", false);
        $btn.html('Select');
        $btn.removeClass('btn-success');
        $btn.addClass('btn-primary');
        $("label:contains('WordPress Theme Slug')").next().attr('value', "");
        $("label:contains('WordPress Theme URL')").next().attr('value', "");
    } else if ($btn.data('clicked', true)) {
        var group = "button[name='" + $btn.attr("name") + "']";
        $(group).prop("clicked", false);
        $(group).html('Select');
        $(group).removeClass('btn-success');
        $(group).addClass('btn-primary');
        $btn.prop("clicked", true);
        $btn.html('Selected');
        $btn.removeClass('btn-primary');
        $btn.addClass('btn-success');
        $("label:contains('WordPress Theme Slug')").next().attr('value', $(this).data("themeslug"));
        $("label:contains('WordPress Theme URL')").next().attr('value', $(this).data("themeurl"));
    } else {
        $btn.prop("clicked", false);
        $("label:contains('WordPress Theme Slug')").next().attr('value', "");
        $("label:contains('WordPress Theme URL')").next().attr('value', "");
    } 
  });
});
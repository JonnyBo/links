require('./bootstrap');
import jquery from 'jquery';
window.jQuery = jquery;

function setLinks(links) {
    if (links.hasOwnProperty('success') && links.success.length)
        jQuery('#lastLinks').html(links.success.join('<br>'));
    else if (links.hasOwnProperty('error') && links.error)
        showError(links.error);
    jQuery('#link').val('');
}

function showError(error) {
    jQuery('#formLink').append('<div class="alert alert-danger" role="alert">' + error + '</div>');
}

function hideError() {
    jQuery('.alert').remove();
}

jQuery(document).ready(function(){
    hideError();
    jQuery.ajax({
        url: "/links",
        method: 'get',
        success: (result) => {
            setLinks(result);
        },
        error: (error) => {
            showError(error);
        }
    });
    jQuery('#ajaxSubmit').click(function(e){
        e.preventDefault();
        hideError();
        jQuery('#ajaxSubmit').attr("disabled", true);
        jQuery.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="_token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: "/links/store",
            method: 'post',
            data: {
                link: jQuery('#link').val()
            },
            success: (result) => {
                setLinks(result);
                jQuery('#ajaxSubmit').removeAttr("disabled");
            },
            error: (error) => {
                showError(error);
                jQuery('#ajaxSubmit').removeAttr("disabled");
            }
        });
    });
});


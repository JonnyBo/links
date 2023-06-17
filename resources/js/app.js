require('./bootstrap');
import jquery from 'jquery';
window.jQuery = jquery;

jQuery(document).ready(function(){
    jQuery.ajax({
        url: "/links",
        method: 'get',
        success: (result) => {
            jQuery('#lastLinks').text(result.join("<br>"));
        },
        error: (error) => {
            console.log('error', error);
        }
    });
    jQuery('#ajaxSubmit').click(function(e){
        e.preventDefault();
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
                jQuery('#lastLinks').text(result.join("<br>"));
            },
            error: (error) => {
                console.log('error', error);
            }
        });
    });
});


require(['jquery'], function ($) {
    $(document).ready(function () {
        $(document).ajaxStop(function () {
            if ($('select[name=notification_type]').val() == 'popup') {
                $("[data-index='order_attribute']").css('display','none');
                $("[data-index='message']").css('display','none');
                $("[class*='wysiwig']").css('display','block');
            } else if ($('select[name=notification_type]').val() == 'notification') {
                $("[data-index='order_attribute']").css('display', 'block');
                $("[data-index='message']").css('display', 'block');
                $("[class*='wysiwig']").css('display', 'none');
            }
            $('select[name=notification_type]').change(()=> {
                if ($('select[name=notification_type]').val() == 'popup') {
                    $("[data-index='order_attribute']").css('display','none');
                    $("[data-index='message']").css('display','none');
                    $("[class*='wysiwig']").css('display','block');
                } else if ($('select[name=notification_type]').val() == 'notification') {
                    $("[data-index='order_attribute']").css('display','block');
                    $("[data-index='message']").css('display','block');
                    $("[class*='wysiwig']").css('display','none');
                }
            })
        });
    });
});
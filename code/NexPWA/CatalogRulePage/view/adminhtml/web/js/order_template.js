require(['jquery'], function ($) {
    $(document).ready(function () {

        $(document).ajaxStop(function () {
            $('select[name=order_attribute]').change(() => {
                if ($('select[name=order_attribute]').val() != 0) {
                    $('textarea[name=message]').val($('textarea[name=message]').val() + $('select[name=order_attribute]').val());
                    $('select[name=order_attribute]').val(0);
                }
            });
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
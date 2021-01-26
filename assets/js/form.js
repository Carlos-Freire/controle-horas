;
(function (window, document, $, undefined) {
    'use strict';

    var formApp = (function () {

        var $private = {};
        var $public = {};
        
        $public.validateForm = function() {
            var $form = $('.myFormValidate');

            $form.validate({
                submitHandler: function(form) {
                    var $this = $(form);
                    var $ajax = $this.data('ajax');

                    if ($ajax === true) {
                        console.log('ajax');
                        return false;
                    }

                    form.submit();
                },
                ignore: ""
            });
        };

        return $public;
    })();

    // Global
    window.formApp = formApp;
    formApp.validateForm();

})(window, document, jQuery);

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
                    var $callback = false;

                    if ($ajax === true) {
                        var $url = $this.attr('action');
                        var $serialize = $this.serialize();

                        if (typeof $this.data('callback') !== 'undefined') {
                            $callback = $this.data('callback');
                        }

                        $private.ajaxForm($url, $serialize,$callback);
                        return false;
                    }

                    form.submit();
                },
                ignore: ""
            });
        };

        $private.ajaxForm = function($url, $serialize,$callback)
        {
            $.ajax({
                method: "POST",
                url: $url,
                beforeSend: function( xhr ) {
                    $('.send-form').removeClass('hidden');
                },
                data: $serialize,
                dataType: "json",
                success: function (data) {
                    if (data.result == 'success') {
                        Swal.fire({
                            title: 'Sucesso!',
                            text: data.message,
                            icon: 'success',
                        }).then(()=> {
                            if (typeof $callback == "string") window[$callback]();
                            $('.send-form').addClass('hidden');
                        });

                    } else {
                        Swal.fire(
                            'Erro!',
                            data.message,
                            'error'
                        );
                    }
                },
                error: function (request, status, error) {
                    Swal.fire(
                        'Erro!',
                        'Ocorreu um erro durante o envio, por favor tente novamente!',
                        'error'
                    );
                }
            });
        };

        return $public;
    })();

    // Global
    window.formApp = formApp;
    formApp.validateForm();

})(window, document, jQuery);

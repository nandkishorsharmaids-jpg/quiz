define([
    'jquery',
    'mage/translate'
], function ($, $t) {
    'use strict';

    return function (config, element) {
        var $container = $(element);
        var $form = $container.find('#ids-quiz-form');
        var $result = $container.find('#ids-quiz-result');
        var $button = $container.find('.ids-quiz-submit');

        $form.on('submit', function (event) {
            event.preventDefault();

            $.ajax({
                url: config.submitUrl,
                type: 'POST',
                dataType: 'json',
                data: $form.serialize(),
                beforeSend: function () {
                    $button.prop('disabled', true).text($t('Submitting...'));
                    $result.removeClass('success error').text('');
                }
            }).done(function (response) {
                if (response.success) {
                    $result.addClass('success').text(
                        $t('Your score is %1/%2').replace('%1', response.score).replace('%2', response.total)
                    );
                } else {
                    $result.addClass('error').text(response.message || $t('Unable to submit quiz.'));
                }
            }).fail(function () {
                $result.addClass('error').text($t('Something went wrong while submitting your quiz.'));
            }).always(function () {
                $button.prop('disabled', false).text($t('Submit Quiz'));
            });
        });
    };
});

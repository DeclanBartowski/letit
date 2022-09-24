$(document).on('click', '.js-show-more', function () {
    let button = $(this);
    $.ajax({
        url: button.data('href'),
        type: "GET",
        success: function (data) {
            if(typeof button.closest('.container').prev().data('list') == "undefined")
            button.closest('.container').prev().find('[data-list]').append($(data).find('[data-list]').html());
            else{
                button.closest('.container').prev().append($(data).find('[data-list]').html());
            }
            button.closest('.pagination').html($(data).find('.pagination').html());
        }
    });
});

$(document).on('change', '[name=LOCATION]', function () {
    let id = +$(this).val();

    if (id > 0) {
        $('[data-container]').addClass('blur');
        BX.ajax.runAction('sp:tools.ComponentController.getLocationsHtml', {
            data: {id: id},
        }).then(function (response) {
            $('.shops__address').remove();
            $('[data-container]').append(response.data).removeClass('blur');
        }, function (response) {
            alert('error');
        });
    }
    return false;
});
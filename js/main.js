/*----------------------------
        Form Validation
-----------------------------*/

const elements = $('input, textarea');

$.each(elements, (index, element) => {
    $(element).on('keyup', () => {
        if ($(element).val().trim() !== '') {
            $(element).css('border-color', '#ced4da');
            $(element).next().html('');
        } else {
            $(element).css('border-color', '#dc3545');
            $(element).next().html(`${$(element).attr('data-name')} is required`);
        }
    });
});

function formValidation (e, ...elements) {
    [...elements].forEach(element => {
        if (element.val().trim() === '') {
            element.css('border-color', '#dc3545');
            element.next().html(`${element.attr('data-name')} is required`);
            e.preventDefault();
        } else {
            element.css('border-color', '#ced4da');
            element.next().html('');
        }
    });
}

$('.js--form-note').on('submit', function (e) {
    const inputElement = $(this).find('input');
    const areaElement = $(this).find('textarea');
    formValidation(e, inputElement, areaElement);
});


/*----------------------------
        Edit My Note
-----------------------------*/

$('.js--btn-edit').on('click', function () {
    const tr = $(this).parents('tr');
    const title = tr.children('td')[0].innerText;
    const description = tr.children('td')[1].innerText;
    $('input[name=titleEdit]').val(title);
    $('textarea[name=descriptionEdit]').text(description);
    $('#js--edit-id').val($(this).attr('data-id'));
});


/*----------------------------
        Delete My Note
-----------------------------*/

$('.js--btn-delete').on('click', function () {
    const id = $(this).attr('data-id');
    if (confirm('Are you sure want to delete this?')) {
        window.location = `${window.location.pathname}?delete=${id}`;
    }
});


/*----------------------------
    Initialize Data Table
-----------------------------*/

$(document).ready(() => {
    $('#data-table').DataTable();
});

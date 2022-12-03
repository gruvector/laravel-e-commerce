import 'nestable2';

window.admin.removeSubmitButtonOffsetOn('#image');

$('#type').on('change', (e) => {
    $('.link-field').addClass('hide');
    $(`.${e.currentTarget.value}-field`).removeClass('hide');
});

$('.dd').nestable({ maxDepth: 15 });

$('.dd').on('change', () => {
    $.ajax({
        type: 'PUT',
        url: route('admin.menus.items.order.update'),
        contentType: 'application/json; charset=utf-8',
        data: JSON.stringify($('.dd').nestable('serialize')[0]),
        success() {
            success(trans('menu::messages.menu_items_order_updated'));
        },
        error(xhr) {
            error(xhr.responseJSON.message);
        },
    });
});

let id;
let confirmationModal = $('#confirmation-modal');

$('.delete-menu-item').on('click', (e) => {
    id = $(e.currentTarget).closest('.dd-item').data('id');

    confirmationModal.modal('show');
});

confirmationModal.find('form').on('submit', (e) => {
    e.preventDefault();

    confirmationModal.modal('hide');

    $.ajax({
        type: 'DELETE',
        url: route('admin.menus.items.destroy', id),
        success() {
            success(trans('menu::messages.menu_item_deleted'));

            $(`.dd-item[data-id="${id}"]`).fadeOut();
        },
        error(xhr) {
            error(xhr.responseJSON.message);
        },
    });
});

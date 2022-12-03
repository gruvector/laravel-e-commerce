window.admin.removeSubmitButtonOffsetOn('#permissions');

$('.permission-parent-actions > .allow-all, .permission-parent-actions > .deny-all, .permission-parent-actions > .inherit-all').on('click', (e) => {
    let action = e.currentTarget.className.split(/\s+/)[2].split(/-/)[0];

    $(`.permission-${action}`).prop('checked', true);
});

$('.permission-group-actions > .allow-all, .permission-group-actions > .deny-all, .permission-group-actions > .inherit-all').on('click', (e) => {
    let action = e.currentTarget.className.split(/\s+/)[2].split(/-/)[0];

    $(e.currentTarget).closest('.permission-group')
        .find(`.permission-${action}`)
        .each((index, value) => {
            $(value).prop('checked', true);
        });
});

$('.delete-api-key').on('click', (e) => {
    $('#confirmation-form').attr('action', e.currentTarget.dataset.action);
});

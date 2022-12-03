$('#order-status').change((e) => {
    $.ajax({
        type: 'PUT',
        url: route('admin.orders.status.update', e.currentTarget.dataset.id),
        data: { status: e.currentTarget.value },
        success: (message) => {
            success(message);
        },
        error: (xhr) => {
            error(xhr.responseJSON.message);
        },
    });
});

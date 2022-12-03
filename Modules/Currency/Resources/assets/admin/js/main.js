$('#refresh-rates').on('click', (e) => {
    $.ajax({
        type: 'GET',
        url: route('admin.currency_rates.refresh'),
        success() {
            DataTable.reload('#currency-rates-table .table');

            window.admin.stopButtonLoading($(e.currentTarget));
        },
        error(xhr) {
            error(xhr.responseJSON.message);

            window.admin.stopButtonLoading($(e.currentTarget));
        },
    });
});

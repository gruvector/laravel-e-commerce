$('form').on('submit', (e) => {
    $(e.currentTarget).find(':input').filter((i, el) => {
        return ! el.value;
    }).attr('disabled', 'disabled');
});

$('#report-type').on('change', (e) => {
    window.location = route('admin.reports.index', { type: e.currentTarget.value });
});

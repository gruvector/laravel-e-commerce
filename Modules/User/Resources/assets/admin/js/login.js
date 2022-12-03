$('[data-loading]').on('click', (e) => {
    let button = $(e.currentTarget);

    if (button.is('i')) {
        button = button.parent();
    }

    button.data('loading-text', button.html())
        .addClass('btn-loading')
        .button('loading');
});

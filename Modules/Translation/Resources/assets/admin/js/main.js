import TranslationEditor from './TranslationEditor';

$('.translations-table').dataTable({
    pageLength: 20,
    lengthMenu: [10, 20, 50, 100, 200],
    drawCallback: () => {
        new TranslationEditor();
    },
});


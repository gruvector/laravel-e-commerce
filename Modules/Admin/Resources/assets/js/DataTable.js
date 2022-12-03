// Initialize state holders.
FleetCart.dataTable = { routes: {}, selected: {} };

export default class {
    constructor(selector, options, callback) {
        this.selector = selector;
        this.element = $(selector);

        if (FleetCart.dataTable.selected[selector] === undefined) {
            FleetCart.dataTable.selected[selector] = [];
        }

        this.initiateDataTable(options, callback);

        this.addErrorHandler();
        this.registerTableProcessingPlugin();
    }

    initiateDataTable(options, callback) {
        let sortColumn = this.element.find('th[data-sort]');

        this.element.dataTable(_.merge({
            serverSide: true,
            processing: true,
            ajax: this.route('index', { table: true }),
            stateSave: true,
            sort: true,
            info: true,
            filter: true,
            lengthChange: true,
            paginate: true,
            autoWidth: false,
            pageLength: 20,
            lengthMenu: [10, 20, 50, 100, 200],
            language: { processing: '<i class="fa fa-refresh fa-spin"></i>' },
            order: [
                sortColumn.index() !== -1 ? sortColumn.index() : 1,
                sortColumn.data('sort') || 'desc',
            ],
            initComplete: () => {
                if (this.hasRoute('destroy')) {
                    let deleteButton = this.addTableActions();

                    deleteButton.on('click', () => this.deleteRows());

                    this.selectAllRowsEventListener();
                }

                if (this.hasRoute('show') || this.hasRoute('edit')) {
                    this.onRowClick(this.redirectToRowPage);
                }

                if (callback !== undefined) {
                    callback.call(this);
                }
            },
            rowCallback: (row, data) => {
                if (this.hasRoute('show') || this.hasRoute('edit')) {
                    this.makeRowClickable(row, data.id);
                }
            },
            drawCallback: () => {
                this.element.find('.select-all').prop('checked', false);

                setTimeout(() => {
                    this.selectRowEventListener();
                    this.checkSelectedCheckboxes(this.constructor.getSelectedIds(this.selector));
                });
            },
            stateSaveParams(settings, data) {
                delete data.start;
                delete data.search;
            },
        }, options));
    }

    addTableActions() {
        let button = `
            <button type="button" class="btn btn-default btn-delete">
                ${trans('admin::admin.buttons.delete')}
            </button>
        `;

        return $(button).appendTo(
            this.element.closest('.dataTables_wrapper').find('.dataTables_length')
        );
    }

    deleteRows() {
        let checked = this.element.find('.select-row:checked');

        if (checked.length === 0) {
            return;
        }

        let confirmationModal = $('#confirmation-modal');
        let deleted = [];

        confirmationModal.modal('show').find('form').on('submit', (e) => {
            e.preventDefault();

            confirmationModal.modal('hide');

            let table = this.element.DataTable();

            table.processing(true);

            let ids = this.constructor.getRowIds(checked);

            // Don't make ajax request if an id was previously deleted.
            if (deleted.length !== 0 && _.difference(deleted, ids).length === 0) {
                return;
            }

            $.ajax({
                type: 'DELETE',
                url: this.route('destroy', { ids: ids.join() }),
                success: () => {
                    deleted = _.flatten(deleted.concat(ids));

                    this.constructor.setSelectedIds(this.selector, []);

                    this.constructor.reload(this.element);
                },
                error: (xhr) => {
                    error(xhr.responseJSON.message);

                    deleted = _.flatten(deleted.concat(ids));

                    this.constructor.setSelectedIds(this.selector, []);

                    this.constructor.reload(this.element);
                },
            });
        });
    }

    makeRowClickable(row, id) {
        let key = this.hasRoute('show') ? 'show' : 'edit';
        let url = this.route(key, { id });

        $(row).addClass('clickable-row').data('href', url);

        setTimeout(() => {
            $('.clickable-row td:not(:first-child)').css('cursor', 'pointer');
        });
    }

    onRowClick(handler) {
        let row = 'tbody tr.clickable-row td';

        if (this.element.find('.select-all').length !== 0) {
            row += ':not(:first-child)';
        }

        this.element.on('click', row, handler);
    }

    redirectToRowPage(e) {
        window.open(
            $(e.currentTarget).parent().data('href'),
            e.ctrlKey ? '_blank' : '_self'
        );
    }

    selectAllRowsEventListener() {
        this.element.find('.select-all').on('change', (e) => {
            this.element.find('.select-row').prop('checked', e.currentTarget.checked);
        });
    }

    selectRowEventListener() {
        this.element.find('.select-row').on('change', (e) => {
            if (e.currentTarget.checked) {
                this.appendToSelected(e.currentTarget.value);
            } else {
                this.removeFromSelected(e.currentTarget.value);
            }
        });
    }

    appendToSelected(id) {
        id = parseInt(id);

        if (! FleetCart.dataTable.selected[this.selector].includes(id)) {
            FleetCart.dataTable.selected[this.selector].push(id);
        }
    }

    removeFromSelected(id) {
        id = parseInt(id);

        FleetCart.dataTable.selected[this.selector].remove(id);
    }

    checkSelectedCheckboxes(selectedIds) {
        let rows = this.element.find('.select-row');

        let checkableRows = rows.toArray().filter((row) => {
            return selectedIds.includes(parseInt(row.value));
        });

        $(checkableRows).prop('checked', true);
    }

    route(name, params) {
        let router = FleetCart.dataTable.routes[this.selector][name];

        if (typeof router === 'string') {
            router = { name: router, params };
        }

        router.params = _.merge(params, router.params);

        return window.route(router.name, router.params).url();
    }

    hasRoute(name) {
        return FleetCart.dataTable.routes[this.selector][name] !== undefined;
    }

    static setRoutes(selector, routes) {
        FleetCart.dataTable.routes[selector] = routes;
    }

    static setSelectedIds(selector, selected) {
        FleetCart.dataTable.selected[selector] = selected;
    }

    static getSelectedIds(selector) {
        return FleetCart.dataTable.selected[selector];
    }

    static reload(selector, callback, resetPaging = false) {
        $(selector).DataTable().ajax.reload(callback, resetPaging);
    }

    static getRowIds(rows) {
        return rows.toArray().reduce((ids, row) => {
            return ids.concat(row.value);
        }, []);
    }

    static removeLengthFields() {
        $('.dataTables_length select').remove();
    }

    addErrorHandler() {
        $.fn.dataTable.ext.errMode = (settings, helpPage, message) => {
            this.element.html(message);
        };
    }

    // https://datatables.net/plug-ins/api/processing()
    registerTableProcessingPlugin() {
        $.fn.dataTable.Api.register('processing()', function (show) {
            return this.iterator('table', function (ctx) {
                ctx.oApi._fnProcessingDisplay(ctx, show);
            });
        });
    }
}

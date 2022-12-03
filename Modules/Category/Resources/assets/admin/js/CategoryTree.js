export default class {
    constructor(categoryForm, selector) {
        this.selector = selector;

        $.jstree.defaults.dnd.touch = true;
        $.jstree.defaults.dnd.copy = false;

        this.fetchCategoryTree();

        // On selecting a category.
        selector.on('select_node.jstree', (e, node) => categoryForm.fetchCategory(node.selected[0]));

        // Expand categories when jstree is loaded.
        selector.on('loaded.jstree', () => selector.jstree('open_all'));

        // On updating category tree.
        this.selector.on('move_node.jstree', (e, data) => {
            this.updateCategoryTree(data);
        });
    }

    fetchCategoryTree() {
        this.selector.jstree({
            core: {
                data: { url: route('admin.categories.tree') },
                check_callback: true,
            },
            plugins: ['dnd'],
        });
    }

    updateCategoryTree(data) {
        this.loading(data.node, true);

        $.ajax({
            type: 'PUT',
            url: route('admin.categories.tree.update'),
            data: { category_tree: this.getCategoryTree() },
            success: (message) => {
                success(message);

                this.loading(data.node, false);
            },
            error: (xhr) => {
                error(xhr.responseJSON.message);

                this.loading(data.node, false);
            },
        });
    }

    getCategoryTree() {
        let categories = this.selector.jstree(true).get_json('#', { flat: true });

        return categories.reduce((formatted, category) => {
            return formatted.concat({
                id: category.id,
                parent_id: (category.parent === '#') ? null : category.parent,
                position: category.data.position,
            });
        }, []);
    }

    loading(node, state) {
        let nodeElement = this.selector.jstree().get_node(node, true);

        if (state) {
            $(nodeElement).addClass('jstree-loading');
        } else {
            $(nodeElement).removeClass('jstree-loading');
        }
    }
}

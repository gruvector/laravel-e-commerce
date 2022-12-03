export default class {
    constructor(data) {
        this.productPanelHtml = this.getProductPanelHtml(data);
    }

    getProductPanelHtml(data) {
        data.product = this.normalizeAttributes(data.product);

        let template = _.template($('#flash-sale-product-template').html());

        return $(template(data));
    }

    normalizeAttributes(product) {
        if ($.isEmptyObject(product)) {
            return { id: null, pivot: { campaign_end: null, price: { amount: null }, qty: null } };
        }

        if (! $.isEmptyObject(FleetCart.errors['flash_sale.products'])) {
            return {
                id: product.id,
                name: product.name,
                pivot: { campaign_end: product.campaign_end, price: { amount: product.price }, qty: product.qty },
            };
        }

        return product;
    }

    render() {
        this.attachEventListeners();

        window.admin.dateTimePicker(this.productPanelHtml.find('.datetime-picker'));

        return this.productPanelHtml;
    }

    attachEventListeners() {
        this.productPanelHtml.find('.delete-product-panel').on('click', () => {
            this.productPanelHtml.remove();
        });
    }
}

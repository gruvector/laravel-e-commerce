import FlashSaleProduct from './FlashSaleProduct';

export default class {
    constructor() {
        this.productCount = 0;

        this.addFlashSaleProducts(FleetCart.data['flash_sale.products']);

        if (this.productCount === 0) {
            this.addProduct();
        }

        this.addFlashSaleProductsError(FleetCart.errors['flash_sale.products']);

        this.attachEventListeners();
        this.makeProductPanelsSortable();
    }

    addFlashSaleProducts(products) {
        for (let attributes of products) {
            this.addProduct(attributes);
        }
    }

    addProduct(attributes = {}) {
        let productTemplate = new FlashSaleProduct({ productPanelNumber: this.productCount++, product: attributes });

        $('#products-wrapper').append(productTemplate.render());

        window.admin.selectize();
    }

    addFlashSaleProductsError(errors) {
        for (let key in errors) {
            let parent = this.getInputFieldForKey(key).parent();

            parent.addClass('has-error');
            parent.append(`<span class="help-block">${errors[key][0]}</span>`);
        }
    }

    getInputFieldForKey(key) {
        let keyParts = key.split('.');

        // Replace all "_" to "-".
        keyParts = keyParts.map(k => {
            return k.split('_').join('-');
        });

        return $(`#${keyParts.join('-')}`);
    }

    attachEventListeners() {
        $('.add-product').on('click', () => {
            this.addProduct();
        });
    }

    makeProductPanelsSortable() {
        Sortable.create(document.getElementById('products-wrapper'), {
            handle: '.drag-icon',
            animation: 150,
        });
    }
}

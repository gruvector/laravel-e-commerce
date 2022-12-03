import Option from './Option';
import ProductOption from './ProductOption';

if ($('#option-create-form, #option-edit-form').length !== 0) {
    new Option();
}

if ($('#product-create-form, #product-edit-form').length !== 0) {
    new ProductOption();
}

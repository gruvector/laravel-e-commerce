import AttributeValues from './AttributeValues';
import ProductAttributes from './ProductAttributes';

if ($('#attribute-values-wrapper').length !== 0) {
    new AttributeValues();
}

if ($('#product-attributes-wrapper').length !== 0) {
    new ProductAttributes();
}

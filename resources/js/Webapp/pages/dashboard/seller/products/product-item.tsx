import * as React from 'react';
import { Product } from '@root/types/models';
import { t } from '@utils/helpers';
import { useUpdateProductMutation } from '@root/rest/seller/products.query';

type ProductItemType = {
    product: Product;
    shop_id: primary_id | null;
};

const ProductItem: React.FC<ProductItemType> = ({
    product,
    shop_id
}) => {

    const { mutate: updateProduct, isLoading: isUpdatingProduct } = useUpdateProductMutation();

    const [editingProduct, setEditingProduct] = React.useState<primary_id | null>(null);

    const [price, setPrice] = React.useState<string | number>('0.00');
    const [price_type, setPriceType] = React.useState<string>('bid');
    const [qty, setQty] = React.useState<string | number>('0');

    React.useEffect(() => {

        if (product.seller_product_id) {
            setPrice(product.price ?? '0.00');
            setPriceType(product.price_type ?? 'bid');
            setQty(product.qty ?? '0');
        }

    }, [product]);

    const onProductUpdate = () => {
        if (!shop_id) {
            return alert(t('Please select a shop first'));
        }

        if (!isUpdatingProduct &&
            (price_type == 'fixed' && price > 0 || price_type == 'bid') &&
            qty > 0) {
            updateProduct({
                product_id: product.id,
                price, price_type, qty,
                shop_id
            });

            setEditingProduct(null);
        }
    };

    const onCancel = () => {
        setEditingProduct(null);
    };

    const onRemove = () => {

    };

    return (
        <tr>
            <td>
                <div className="product m-0">
                    <figure>
                        <img
                            src={product.image}
                            alt="product-image"
                            className="img-fluid"
                        />
                    </figure>
                    <div className="content">
                        <div className="name">
                            <small>{product.id} - </small>
                            {product.title}
                        </div>
                    </div>
                </div>
            </td>
            <td>
                <div className="product m-0 mt-3">
                    {editingProduct == product.id ? (
                        <div className="row align-items-center">
                            <div className="col">
                                <small>{t('Type')}</small>
                                <select
                                    value={price_type}
                                    onChange={(e) => {
                                        setPriceType(e.target.value);
                                    }}
                                    placeholder={t('Select price type')}
                                    className="form-select ms-1"
                                >
                                    <option value="bid">
                                        {t('Bid')}
                                    </option>
                                    <option value="fixed">
                                        {t('Fixed')}
                                    </option>
                                </select>
                            </div>
                            {price_type === 'fixed' ? (
                                <div className="col">
                                    <small>{t('Amount')}</small>
                                    <input
                                        type="number"
                                        value={price}
                                        onChange={(e) => setPrice(e.target.value)}
                                        placeholder={t('Price')}
                                        className="form-control"
                                        min="1"
                                        step="any"
                                    />
                                </div>
                            ) : null}
                            <div className="col">
                                <small>{t('Qty')}</small>
                                <input
                                    type="text"
                                    value={qty}
                                    onChange={(e) => setQty(e.target.value)}
                                    placeholder={t('Qty')}
                                    className="form-control ms-1"
                                />
                            </div>
                            <div className="col">
                                <button
                                    onClick={onProductUpdate}
                                    type="button"
                                    className="btn btn-link text-success">
                                    {t('ok')}
                                </button>
                                <button
                                    type="button"
                                    onClick={onCancel}
                                    className="btn btn-link text-warning">
                                    {t('cancel')}
                                </button>
                            </div>
                        </div>
                    ) : (
                        <div
                            className="d-flex align-items-center justify-content-between"
                            onClick={() => setEditingProduct(product.id)}>
                            {product.seller_product_id ? (
                                <ul>
                                    <li>{t('Product Type')}: <span className="fw-bold">{product.price_type}</span></li>
                                    {product.price_type == 'fixed' ? (
                                        <li>{t('Price')}: <span className="fw-bold ms-1">{product.price ?? '0.00'}</span></li>
                                    ) : null}
                                    <li>{t('Qty')}: {product.qty ?? '0'}</li>
                                </ul>
                            ) : (
                                <span>{t('Click to edit product')}</span>
                            )}
                        </div>
                    )}
                </div>
            </td>
        </tr>
    );
};

export default ProductItem;
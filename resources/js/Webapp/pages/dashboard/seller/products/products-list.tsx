import * as React from 'react';
import { useProductListQuery } from '@root/rest/seller/products.query';
import { t } from '@utils/helpers';

import ProductItem from './product-item';
import { LoadingSpinner } from '@root/components/ui/loading-spinner';

type ProductListType = {
    shop_id: primary_id | null,
    sub_category_id: primary_id | null,
};

const ProductList: React.FC<ProductListType> = ({
    shop_id,
    sub_category_id
}) => {

    const [products, productsLoading] = useProductListQuery(
        shop_id,
        sub_category_id
    );

    return (
        <div className="row">
            <div className="col-md-12">

                {!shop_id ? (
                    <div className="alert alert-warning">
                        {t('Please select shop before editing products')}
                    </div>
                ) : null}

                <div className="table-responsive">
                    {productsLoading ? (
                        <LoadingSpinner />
                    ) : (
                        <table className="table">
                            <thead>
                                <tr>
                                    <th style={{ width: "40%" }}>{t('Products')}</th>
                                    <th style={{ width: "60%" }}>
                                        <small>{t('Click on any product to start editing')}</small>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                {products?.map(product => (
                                    <ProductItem
                                        key={product.id}
                                        product={product}
                                        shop_id={shop_id}
                                    />
                                ))}
                            </tbody>
                        </table>
                    )}
                </div>
            </div>
        </div>
    );
};

export default ProductList;
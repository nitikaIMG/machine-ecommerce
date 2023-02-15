import * as React from 'react';

import Header from './product-header';
import ProductList from './products-list';

const Products = () => {

    const [shop_id, setShopId] = React.useState<primary_id | null>(null);
    const [sub_category_id, setSubCategoryId] = React.useState<primary_id | null>(null);
    const [search_query, setSearchQuery] = React.useState<string>('');

    const actionSetShopId = React.useCallback((shop_id: primary_id) => {
        setShopId(shop_id);
    }, []);

    const actionSetSubCategoryId = React.useCallback((sub_category_id: primary_id) => {
        setSubCategoryId(sub_category_id);
    }, []);

    const actionSetSearchQuery = React.useCallback((search_query: string) => {
        setSearchQuery(search_query);
    }, []);

    return (
        <div className="row">
            <div className="col-md-12">
                <div className="card p30" id="myTab">
                    <Header
                        shop_id={shop_id}
                        sub_category_id={sub_category_id}
                        actionSetShopId={actionSetShopId}
                        actionSetSubCategoryId={actionSetSubCategoryId}
                    />
                    <ProductList
                        shop_id={shop_id}
                        sub_category_id={sub_category_id}
                    />
                </div>
            </div>
        </div>
    );
};

export default Products;
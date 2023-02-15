import * as React from 'react';
import { useParams } from 'react-router-dom';
import { useShopQuery } from '@root/rest/user/seller-shop.query';
import { LoadingSpinner } from '@root/components/ui/loading-spinner';
import ShopListItem from '@root/components/seller/shop/shop-list-item';
import ProductList from '@root/components/seller/product/product-list';
import ShopCategories from './shop-categories';

type ParamType = {
    id?: string
};

const ShopDetail = () => {

    const { id } = useParams<ParamType>();
    const [shop, isShopLoading] = useShopQuery(id!);


    if( ! id ) {
        return <h4 className="fw-bold">Error :/</h4>
    }

    if( isShopLoading || !shop ) {
        return <LoadingSpinner />
    }

    return (
        <>
            <ShopListItem shop={shop} />
            <ShopCategories shop_id={shop.id} />
            {/* <ProductList /> */}
        </>
    );
};

export default ShopDetail;
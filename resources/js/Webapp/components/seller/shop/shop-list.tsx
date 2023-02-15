import * as React from 'react';
import { useShopListQuery } from '@root/rest/user/seller-shop.query';
import { LoadingSpinner } from '@root/components/ui/loading-spinner';

import ShopListItem from './shop-list-item';

const ShopList = () => {

    const [ shops, areShopsLoading ] = useShopListQuery();

    if( areShopsLoading ) {
        return <LoadingSpinner />;
    }

    
    return (
        <div className="row">
            <div className="col-md-12">
                {shops?.map(shop => (
                    <ShopListItem key={shop.id} shop={shop} />
                ))}
            </div>
        </div>
    );
};

export default ShopList;
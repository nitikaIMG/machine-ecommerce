import * as React from 'react';
import { t } from '@utils/helpers';

import { useShopListQuery } from '@root/rest/seller/shop.query';
import {
    type ProductCategory,
    type BasicProductCategory
} from '@root/types/models';

type HeaderType = {
    shop_id: primary_id | null,
    sub_category_id: primary_id | null,

    actionSetShopId: (shop_id: primary_id) => void,
    actionSetSubCategoryId: (sub_category_id: primary_id) => void
};

const Header: React.FC<HeaderType> = ({
    shop_id,
    sub_category_id,

    actionSetShopId,
    actionSetSubCategoryId
}) => {

    const [shops, shopsLoading] = useShopListQuery();

    const [categories, setCategories] = React.useState<Array<ProductCategory>>([]);
    const [category_id, setSelectedCategory] = React.useState<primary_id | null>(null);
    
    const [sub_categories, setSubCategories] = React.useState<Array<BasicProductCategory>>([]);

    const reset = () => {
        setCategories([]);
        setSubCategories([]);
        setSelectedCategory(null);
    };

    const onShopUpdate = (e: React.ChangeEvent<HTMLSelectElement>) => {
        const shop_id = e.target.value;
        
        reset();
        actionSetShopId(shop_id);

        const shop = shops?.find(shop => shop.id == shop_id);
        if( shop && shop.categories && shop.categories.length ) {
            setCategories(shop.categories);
            return;
        }
    };
    
    const onCategoryUpdate = (e: React.ChangeEvent<HTMLSelectElement>) => {
        const parent_category_id = e.target.value;
        const parent = categories?.find(category => category.id == parent_category_id);

        if( parent ) {
            setSubCategories(parent.children ?? []);
        } else {
            setSubCategories([]);
        }

        setSelectedCategory(parent_category_id);
    };

    const onSubCategoryUpdate = (e: React.ChangeEvent<HTMLSelectElement>) => {
        actionSetSubCategoryId(e.target.value);
    };

    return (
        <div className="header seller-product-listing">
            <h3>{t('Products')}</h3>
            <div className="row align-items-center">
                <div className="col-12">
                    <div className="d-flex justify-content-between">
                        {shopsLoading ? (
                            <span>{t('Loading shops')}</span>
                        ): shops?.length ? (
                            <select
                                className="form-select"
                                value={shop_id ?? undefined}
                                onChange={onShopUpdate}
                                name="shop_id"
                                id="shop_id">
                                <option value="">{t('Select shop')}</option>
                                {shops.map(shop => (
                                    <option key={shop.id} value={shop.id}>{shop.shop_name}</option>
                                ))}
                            </select>
                        ) : (
                            <span>{t('No shops found')}</span>
                        )}

                        {categories.length ? (
                            <select
                                value={category_id ?? undefined}
                                className="form-select ms-1"
                                onChange={onCategoryUpdate}
                                name="shop_id"
                                id="shop_id">
                                <option value="">{t('Select category')}</option>
                                {categories.map(category => (
                                    <option key={category.id} value={category.id}>{category.title}</option>
                                ))}
                            </select>
                        ): null}

                        {sub_categories.length ? (
                            <select
                                value={sub_category_id ?? undefined}
                                className="form-select ms-1"
                                onChange={onSubCategoryUpdate}
                                name="shop_id"
                                id="shop_id">
                                <option value="">{t('Select category')}</option>
                                {sub_categories.map(category => (
                                    <option key={category.id} value={category.id}>{category.title}</option>
                                ))}
                            </select>
                        ): null}
                    </div>
                </div>
            </div>
        </div>
    );
};

export default Header;
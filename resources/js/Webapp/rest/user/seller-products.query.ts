import { useQuery, useMutation, useQueryClient } from 'react-query';
import { ResponseType } from '@root/types/common';
import axios from '@utils/axios';
import { AxiosError } from 'axios';

import { API_ENDPOINTS } from '@root/utils/endpoints';
import { Product, ProductCategory } from '@root/types/models';
import { PRODUCT_CATEGORY_LIST_QKEY } from '../product/categoy.query';

import { type State as SellerProductState } from '@pages/dashboard/seller/products/index';

export const SELLER_PRODUCTS_QKEY = 'seller.product.list';
export const SELLER_CATEGORIES_QKEY = 'seller.categories.list';

export type ProductListType = Pick<
    Product,
    'id' | 'title' | 'short_description' | 'image' | 'qty' | 'price' | 'price_type'
>;

type _ProductUpdateInput = {
    product_id: primary_id;
    qty: number | string;
    price_type: 'bid' | 'fixed';
    price: number | string;
    shop_id: primary_id;
};

// TODO: need to be updated
type ShopUpdateInput = {
    categories: Array<primary_id>;
    shop_id: primary_id;
};

const fetchProductList = async (shop_id: primary_id | null, sub_category_id: primary_id | null): Promise<Array<ProductListType>> => {
    const response = await axios.post(API_ENDPOINTS.SELLER_ALL_PRODUCTS, {
        shop_id, sub_category_id
    });

    return response.data?.data ?? [];
};

// fetch product listing
export const useProductListQuery = (
    shop_id: primary_id | null = null,
    sub_category_id: primary_id | null = null
) => {
    const {
        isLoading,
        error,
        data
    } = useQuery<Array<ProductListType>, Error>(
        [SELLER_PRODUCTS_QKEY, shop_id, sub_category_id], () => fetchProductList(shop_id, sub_category_id), {
            refetchOnReconnect: false,
            refetchOnWindowFocus: false
        });

    return { product_list: data, isLoading, error };
};


// fetch both categories / sub-categories for this seller
export const useCategoryListQuery = (shop_id?: primary_id | null): [
    Array<ProductCategory> | undefined,
    boolean,
    Error | null
] => {
    const {
        isLoading,
        error,
        data
    } = useQuery<Array<ProductCategory>, Error>(
        [SELLER_CATEGORIES_QKEY, shop_id], async () => {
            const response = await axios.post(API_ENDPOINTS.SELLER_CATEGORIES, { shop_id });
            return response.data?.data ?? null;
        }, {
            refetchOnReconnect: false,
            refetchOnWindowFocus: false
        });

    if( data && shop_id && shop_id !== 0 ) {
        return [
            // filter categories this shop_id is serving
            data?.filter(p => p.shops?.filter(s => s.id == shop_id).length),
            isLoading,
            error
        ];
    }

    return [data, isLoading, error];
};


export const useUpdateCategoryMutation = () => {
    const queryClient = useQueryClient();

    return useMutation<
            ResponseType,
            AxiosError<ResponseType>,
            ShopUpdateInput
        >(async (input: ShopUpdateInput) => {

        const res = await axios.post('/seller/shop/update', input);
        return res.data;
    }, {
        onSuccess: () => {
            queryClient.invalidateQueries(PRODUCT_CATEGORY_LIST_QKEY);
            queryClient.invalidateQueries('seller.shop.detail');
        }
    });
};


export const useUpdateProductMutation = () => {
    const queryClient = useQueryClient();

    return useMutation<
            ResponseType,
            AxiosError<ResponseType>,
            SellerProductState
        >(async (input: SellerProductState) => {

        const res = await axios.post(API_ENDPOINTS.SELLER_UPDATE_PRODUCT, input);
        return res.data;
    }, {
        onSuccess: () => {
            queryClient.invalidateQueries(SELLER_PRODUCTS_QKEY);
        }
    });
};
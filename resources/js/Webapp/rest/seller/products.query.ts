import { useQuery, useMutation, useQueryClient } from 'react-query';
import { ResponseType } from '@root/types/common';
import axios from '@utils/axios';
import { AxiosError } from 'axios';
import { type MutationFunction } from 'react-query';

import { API_ENDPOINTS } from '@root/utils/endpoints';
import { Product, ProductCategory } from '@root/types/models';

export const SELLER_PRODUCTS_QKEY = 'seller.product.list';
export const SELLER_CATEGORIES_QKEY = 'seller.categories.list';

export type SellerProductType = Pick<
    Product,
    'id' | 'title' | 'short_description' | 'image' | 'qty' | 'seller_product_id' | 'price' | 'price_type'
>;

type SellerProductUpdateType = {
    product_id: primary_id;
    qty: string | number;
    price_type: string;
    price: string | number;
    shop_id: primary_id;
};

const fetchProductList = async (shop_id: primary_id | null, sub_category_id: primary_id | null): Promise<Array<SellerProductType>> => {
    const response = await axios.post(API_ENDPOINTS.SELLER_ALL_PRODUCTS, {
        shop_id, sub_category_id
    });

    return response.data?.data ?? [];
};

// fetch product listing
export const useProductListQuery = (
    shop_id: primary_id | null = null,
    sub_category_id: primary_id | null = null
): [
    Array<SellerProductType> | undefined,
    Boolean,
    Error | null
] => {
    const {
        isLoading,
        error,
        data
    } = useQuery<Array<SellerProductType>, Error>(
        [SELLER_PRODUCTS_QKEY, shop_id, sub_category_id], () => fetchProductList(shop_id, sub_category_id), {
            refetchOnReconnect: false,
            refetchOnWindowFocus: false
        });

    return [data, isLoading, error];
};

export const useUpdateProductMutation = () => {
    const queryClient = useQueryClient();

    return useMutation<
            ResponseType<SellerProductType>,
            AxiosError<ResponseType>,
            SellerProductUpdateType
        >(async (input: SellerProductUpdateType) => {

        const res = await axios.post(API_ENDPOINTS.SELLER_UPDATE_PRODUCT, input);
        return res.data;
    }, {
        onSuccess: () => {
            queryClient.invalidateQueries(SELLER_PRODUCTS_QKEY);
        }
    });
};
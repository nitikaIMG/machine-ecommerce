import { useQuery, useMutation } from 'react-query';
import axios from '@utils/axios';

import { API_ENDPOINTS } from '@root/utils/endpoints';
import { ProductCategory } from '@root/types/models';

export const SELLER_CATEGORIES_QKEY = 'seller.categories.list';

const fetchShopList = async () => {
    const response = await axios.get(API_ENDPOINTS.SELLER_ALL_SHOPS);
    return response.data?.data ?? [];
};

const fetchCategoryList = async () => {
    const response = await axios.get(API_ENDPOINTS.SELLER_CATEGORIES);
    return response.data?.data ?? [];
};

export const useCategoriesQuery = (): [
    Array<ProductCategory> | undefined,
    boolean,
    Error | null
] => {
    const {
        isLoading,
        error,
        data
    } = useQuery<Array<ProductCategory>, Error>(
        SELLER_CATEGORIES_QKEY, fetchCategoryList, {
            refetchOnReconnect: false,
            refetchOnWindowFocus: false
        });

    return [data, isLoading, error];
};
import { useQuery, useMutation } from 'react-query';
import { ResponseType } from '@root/types/common';
import axios from '@utils/axios';
import { AxiosError } from 'axios';

import { API_ENDPOINTS } from '@root/utils/endpoints';
import { ProductCategory } from '@root/types/models';

export const PRODUCT_CATEGORY_LIST_QKEY = 'product.category.list';

const fetchCategories = async (shop_id?: primary_id | null, only_parent: boolean | number = false) => {
    const response = await axios.post(API_ENDPOINTS.PRODUCT_CATEGORY_LISTING, {
        shop_id, only_parent: '1'
    });
    return response.data?.data ?? [];
};


// fetch both categories / sub-categories
export const useCategoryListQuery = ({
    shop_id,
}: {
    shop_id?: primary_id
}): [
    Array<ProductCategory> | undefined,
    boolean,
    Error | null
] => {
    const {
        isLoading,
        error,
        data
    } = useQuery<Array<ProductCategory>, Error>(
        [PRODUCT_CATEGORY_LIST_QKEY, shop_id], () => {
            return fetchCategories(shop_id);
        }, {
            refetchOnReconnect: false,
            refetchOnWindowFocus: false
        });

    return [data, isLoading, error];
};
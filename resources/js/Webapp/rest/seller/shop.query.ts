import { useQuery, useMutation } from 'react-query';
import { ResponseType } from '@root/types/common';
import axios from '@utils/axios';

import { API_ENDPOINTS } from '@root/utils/endpoints';
import { Shop } from '@root/types/models';

export const SELLER_SHOP_QKEY = 'seller.shop.list';
export const SELLER_SHOP_DETAIL_QKEY = 'seller.shop.detail';

const fetchShopList = async () => {
    const response = await axios.get(API_ENDPOINTS.SELLER_ALL_SHOPS);
    return response.data?.data ?? [];
};

const fetchShop = async (shop_id: primary_id) => {
    const route = API_ENDPOINTS.SELLER_SHOP_DETAIL;
    const response = await axios.post(route, { shop_id });
    
    return response.data?.data ?? null;
};

interface ShopType extends Shop {}

// get all shops this seller owns
export const useShopListQuery = (): [
    Array<ShopType> | undefined,
    boolean,
    Error | null
] => {
    const {
        isLoading,
        error,
        data
    } = useQuery<Array<ShopType>, Error>(
        SELLER_SHOP_QKEY, fetchShopList, {
            refetchOnReconnect: false,
            refetchOnWindowFocus: false
        });

    return [data, isLoading, error];
};

export const useShopQuery = (shop_id: primary_id): [
    ShopType | undefined,
    boolean,
    Error | null
] => {

    const {
        isLoading,
        error,
        data
    } = useQuery<ShopType, Error>(
        SELLER_SHOP_DETAIL_QKEY, () => {
            return fetchShop(shop_id);
        }, {
            refetchOnReconnect: false,
            refetchOnWindowFocus: false
        });

    return [data, isLoading, error];
};
import { useMutation, useQuery, useQueryClient } from 'react-query';
import { ResponseType } from '@root/types/common';
import axios from '@utils/axios';
import { AxiosError } from 'axios';
import { AddressType } from '@root/types/models';

import { API_ENDPOINTS } from '@root/utils/endpoints';

export const ADDRESS_QKEY = 'address.list';

export type SubmitAddressType = {
    address_id: number | string,
    name: string,
    email: string,
    phone: string,
    address_1: string,
    address_2: string,
    city: string,
    zip: string,
    state: string,
    country: string,
    is_primary: number,
    latitude: string,
    longitude: string
};

const fetchAddressList = async (): Promise<Array<AddressType>> => {
    const response = await axios.get(API_ENDPOINTS.ADDRESS_LIST);
    return response.data?.data ?? [];
};

export const useAddressListQuery = () => {
    const {
        isLoading,
        error,
        data
    } = useQuery<Array<AddressType>, Error>(ADDRESS_QKEY, fetchAddressList, {
        refetchOnReconnect: false,
        refetchOnWindowFocus: false
    });

    return { address_list: data, isLoading, error };
};

export const useAddressByIdQuery = (address_id: number|string) => {
    const {
        isLoading,
        error,
        data
    } = useQuery<AddressType, Error>([ADDRESS_QKEY, address_id], async () => {
        const res = await axios.post(API_ENDPOINTS.VIEW_ADDRESS, {address_id});
        return res.data?.data;
    }, {
        refetchOnReconnect: false,
        refetchOnWindowFocus: false
    });

    return { address: data, isLoading, error };
};

export const useAddAddressMutation = () => {

    const queryClient = useQueryClient();

    return useMutation<
            ResponseType<AddressType>,
            AxiosError<ResponseType>,
            Partial<SubmitAddressType>
        >(async (input: Partial<SubmitAddressType>) => {

        const res = await axios.post(API_ENDPOINTS.ADD_ADDRESS, input);
        return res.data;
    }, {
        onSuccess: (response) => {
            if( response && response.data ) {
                const data = response.data;

                queryClient.setQueryData<Array<AddressType> | undefined>(ADDRESS_QKEY, (oldAList) => {
                    if( oldAList && data ) {
                        return [...oldAList, data];
                    }

                    return oldAList;
                });
            }
        }
    });
};

export const useUpdateAddressMutation = () => {
    
    const queryClient = useQueryClient();

    return useMutation<
            ResponseType<AddressType>,
            AxiosError<ResponseType>,
            Partial<SubmitAddressType>
        >(async (input: Partial<SubmitAddressType>) => {

        const res = await axios.post(API_ENDPOINTS.UPDATE_ADDRESS, input);
        return res.data;
    }, {
        onSuccess: (response) => {
            if( response && response.data ) {
                const data = response.data;

                // if checkbox is checked; we'll be better off invalidatign the whole query
                if( data.is_primary ) {
                    queryClient.invalidateQueries(ADDRESS_QKEY);
                    return;
                }

                queryClient.setQueryData([ADDRESS_QKEY, data.id], data);
                queryClient.setQueryData<Array<AddressType> | undefined>(ADDRESS_QKEY, (oldAList) => {
                    if( oldAList && data ) {
                        return oldAList.map(item => {
                            return (item.id == data.id) ? data : item;
                        });
                    }

                    return oldAList;
                });
            }
        }
    });
};

export const useDeleteAddressMutation = () => {
    return useMutation<
            ResponseType,
            AxiosError<ResponseType>,
            Partial<SubmitAddressType>
        >(async (input: Partial<SubmitAddressType>) => {

        const res = await axios.post(API_ENDPOINTS.DELETE_ADDRESS, input);
        return res.data;
    });
};
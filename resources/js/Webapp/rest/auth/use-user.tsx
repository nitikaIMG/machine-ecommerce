import * as React from 'react';
import axios from '@utils/axios';
import { API_ENDPOINTS } from '@root/utils/endpoints';
import { UserType } from '@root/types/models';
import { useQuery } from 'react-query';
import { ResponseType } from '@root/types/common';

const fetchUser = async (): Promise<ResponseType<UserType>> => {
    const user = await axios.get(API_ENDPOINTS.ME);
    return user.data;
};

export const useUser = () => {
    const {
        isLoading,
        error,
        data
    } = useQuery<ResponseType<UserType>, Error>('account.me', fetchUser, {
        refetchOnMount: false,
        refetchOnReconnect: false,
        refetchOnWindowFocus: false,
        retry: 0
    });

    return { user: data?.data, isLoading, error };
};
import { useMutation } from 'react-query';
import { ResponseType } from '@root/types/common';
import axios from '@utils/axios';
import { AxiosError } from 'axios';

import { API_ENDPOINTS } from '@root/utils/endpoints';

type UserAccount = {
    name: string,
    email: string,
    phone_code: string,
    phone: string,
    old_password: string,
    password: string,
    password_confirmation: string,
    latitude: string,
    longitude: string,
};

export type UpdateBasicAccountType =
    Omit<UserAccount, 'old_password' | 'latitude' | 'longitude'>;

export type UpdateAccountType =
    Pick<UserAccount, 'name'>;

export type UpdatePasswordType =
    Pick<UserAccount, 'old_password' | 'password' | 'password_confirmation'>;

export const useUpdateBasicAccountMutation = () => {
    return useMutation<
            ResponseType,
            AxiosError<ResponseType>,
            UpdateBasicAccountType
        >(async (input: UpdateBasicAccountType) => {

        const res = await axios.post(API_ENDPOINTS.UPDATE_ACCOUNT, input);
        return res.data;
    });
};

export const useUpdateAccountMutation = () => {
    return useMutation<
            ResponseType,
            AxiosError<ResponseType>,
            UpdateAccountType
        >(async (input: UpdateAccountType) => {

        const res = await axios.post(API_ENDPOINTS.UPDATE_ACCOUNT, input);
        return res.data;
    });
};

export const useUpdatePasswordMutation = () => {
    return useMutation<
            ResponseType,
            AxiosError<ResponseType>,
            UpdatePasswordType
        >(async (input: UpdatePasswordType) => {

        const res = await axios.post(API_ENDPOINTS.UPDATE_ACCOUNT, input);
        return res.data;
    });
};
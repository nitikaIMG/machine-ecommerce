import { useMutation } from 'react-query';
import { ResponseType } from '@root/types/common';
import axios from '@utils/axios';
import { AxiosError } from 'axios';

import { API_ENDPOINTS } from '@root/utils/endpoints';
import { UserType } from '@root/types/models';

type LoginInputType = {
    email_or_phone: string;
    password: string;
}

type LoginViaOtpInputType = {
    email_or_phone: string;
    otp: number | string;
};

type SendOtpType = {
    email_or_phone: string;
};

type LoginResponseType = {
    access_token: string;
    user: UserType;
}

// login with email / password
export const useLoginMutation = () => {
    return useMutation<
            ResponseType<LoginResponseType>,
            AxiosError<ResponseType>,
            LoginInputType
        >(async (input: LoginInputType) => {

        const res = await axios.post(API_ENDPOINTS.LOGIN, input);
        return res.data;
    });
};
// login via email /phone number
export const useSendLoginOtpMutation = () => {
    return useMutation<
            ResponseType<null>,
            AxiosError<ResponseType>,
            SendOtpType
        >(async (input: SendOtpType) => {
        const res = await axios.post(API_ENDPOINTS.LOGIN_VIA_OTP, input);
        return res.data;
    });
};

export const useLoginViaOtpMutation = () => {
    return useMutation<
            ResponseType<LoginResponseType>,
            AxiosError<ResponseType>,
            LoginViaOtpInputType
        >(async (input: LoginViaOtpInputType) => {

        const res = await axios.post(API_ENDPOINTS.LOGIN_VIA_OTP_VERIFY, input);
        return res.data;
    });
};
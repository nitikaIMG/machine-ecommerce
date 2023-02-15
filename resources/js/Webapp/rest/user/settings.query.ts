import { useMutation } from 'react-query';
import { ResponseType } from '@root/types/common';
import axios from '@utils/axios';
import { AxiosError } from 'axios';

import { API_ENDPOINTS } from '@root/utils/endpoints';

type SettingsInput = {
    allow_notification: 0 | 1 | '0' | '1';
};

export const useUpdateSettingsMutation = () => {
    return useMutation<
            ResponseType,
            AxiosError<ResponseType>,
            SettingsInput
        >(async (input: SettingsInput) => {

        const res = await axios.post(API_ENDPOINTS.SETTINGS, input);
        return res.data;
    });
};
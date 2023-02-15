import { useMutation } from 'react-query';
import { ResponseType } from '@root/types/common';
import axios from '@utils/axios';
import { AxiosError } from 'axios';

import { API_ENDPOINTS } from '@root/utils/endpoints';

type HelpSupportInput = {
    name: string;
    email: string;
    message: string;
};

export const useAddHelpSupportMutation = () => {
    return useMutation<
            ResponseType,
            AxiosError<ResponseType>,
            HelpSupportInput
        >(async (input: HelpSupportInput) => {

        const res = await axios.post(API_ENDPOINTS.HELP_SUPPORT, input);
        return res.data;
    });
};
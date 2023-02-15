import * as React from 'react';
import axios from '@utils/axios';
import { AxiosError, AxiosResponse } from 'axios';
import { ResponseType } from '@root/types/common';
import { useAppNotifications } from '@components/ui/toast';

// hook to know if there are network requests currently running
//   and how many are running
export const useAxiosLoader = () => {
    const [counter, setCounter] = React.useState(0);
    const { addToast } = useAppNotifications();

    React.useEffect(() => {
        const reqInterceptor = axios.interceptors.request.use(
            (config) => {
                setCounter(counter => counter + 1);
                return config;
            }
        );

        const resInterceptor = axios.interceptors.response.use(
            (response: AxiosResponse<ResponseType>) => {
                setCounter(counter => counter - 1);

                if( response.data ) {
                    const { message } = response.data;
                    if( message ) {
                        addToast(message, 'success');
                    }
                }

                return response;
            },
            (error: AxiosError<ResponseType>) => {
                setCounter(counter => counter - 1);

                if( error.response && error.response.data ) {
                    const { message } = error.response.data;
                    if( message ) {
                        // TODO: don't issue toast in some cases
                        addToast(message, 'error');
                    }
                }

                return Promise.reject(error);
            }
        );

        
        return () => {
            axios.interceptors.request.eject(reqInterceptor);
            axios.interceptors.response.eject(resInterceptor);
        };

    }, []);

    // counter greater than 0 means there's at least one network call still pending
    return [counter > 0, counter];
}
import {
    Error as ErrorType
} from '@root/types/common';

import {
    UserType
} from '@root/types/models';

export interface State {
    user: UserType | null;
    token: string | null;
    isLoggedIn: boolean;
    isLoading: boolean;
    errors?: Array<ErrorType | []>;
}

export const initialState: State = {
    user: null,
    token: null,
    isLoggedIn: false,
    isLoading: true,
    errors: []
}

export type Action =
    | { type: 'LOGIN_REQUEST'; username: string; password: string }
    | { type: 'LOGIN_SUCCESS'; user: UserType; token: string }
    | { type: 'SET_USER'; user: UserType }
    | { type: 'LOGIN_FAIL'; error: string }
    | { type: 'LOGOUT'; }

export default (state: State, action: Action): State => {
    switch(action.type) {
        case 'LOGIN_REQUEST':
            return {
                ...state,
                isLoading: true
            };

        case 'LOGIN_SUCCESS':
            return {
                ...state,
                isLoggedIn: true,
                isLoading: false,
                user: action.user,
                token: action.token
            };

        case 'SET_USER':
            return {
                ...state,
                isLoggedIn: true,
                isLoading: false,
                user: action.user
            };

        case 'LOGIN_FAIL':
        case 'LOGOUT':
            return {
                ...initialState,
                isLoading: false
            };
        default:
            return state;
    }
};
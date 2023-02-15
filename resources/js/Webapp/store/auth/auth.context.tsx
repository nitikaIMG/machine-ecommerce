import * as React from 'react';

import reducer, { State, initialState, Action } from './auth.reducer';
import { UserType } from '@root/types/models';

import { setAuthToken, unsetAuthToken, getAuthToken } from '@utils/cookie';
import { useUser } from '@root/rest/auth/use-user';

type LoginAction = {
    user: UserType;
    token: string;
};

interface AuthProviderState extends State {
    loginAction: (props: LoginAction) => void;
    logoutAction: () => void;
}

export const AuthContext = React.createContext<AuthProviderState | undefined>(undefined);

// performs side-effects
const dispatchWrapper = (dispatch: React.Dispatch<Action>): React.Dispatch<Action> => {

    return (action: Action) => {

        dispatch(action);

        switch( action.type ) {
            case 'LOGIN_SUCCESS':
                setAuthToken(action.token);
                break;

            case 'LOGOUT':
                unsetAuthToken();
                break;
        }
    };
};

export const AuthProvider: React.FC = (props) => {
    const { user, isLoading } = useUser();
    
    const [state, _dispatch] = React.useReducer(
        reducer,
        initialState,
        function() {
            if( ! getAuthToken() ) {
                initialState.isLoading = false;
            }

            return initialState;
        }
    );
    
    const dispatch = dispatchWrapper(_dispatch);

    React.useEffect(() => {
        if( !isLoading && user ) {
            dispatch({ type: 'SET_USER', user });
        }
    }, [isLoading, user]);

    const loginAction = (props: { user: UserType, token: string }) => {
        dispatch({ type: 'LOGIN_SUCCESS', ...props });
    };

    const logoutAction = () => {
        dispatch({ type: 'LOGOUT' });
    };

    const value = {
        ...state,
        loginAction,
        logoutAction
    };

    return (
        <AuthContext.Provider value={value} {...props} />
    );
};

export const useAuthUser = () => {
    const { user, isLoggedIn, isLoading } = React.useContext(AuthContext)!;
    return { user, isLoggedIn, isLoading };
}

export const useAuthActions = () => {
    const { loginAction, logoutAction } = React.useContext(AuthContext)!;
    return { loginAction, logoutAction };
};
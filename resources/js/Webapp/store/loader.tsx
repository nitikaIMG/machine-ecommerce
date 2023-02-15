import * as React from 'react';

type State = {
    isLoading: boolean;
    hasMessage: boolean;
    messageType: 'success' | 'error' | undefined;
    message: string | undefined;
};

type Action =
    | { type: 'START' }
    | { type: 'OVER', messageType?: State['messageType']; message?: State['message'] }
    | { type: 'RESET' };

const initialState: State = {
    isLoading: false,
    hasMessage: false,
    messageType: undefined,
    message: undefined
};

interface LoadingProviderType extends State {
    startLoading: () => void;
    stopLoading: (messageType?: State['messageType'], message?: State['message']) => void;
    resetLoading: () => void;
}

export const LoaderContext = React.createContext<LoadingProviderType | undefined>(undefined);

const reducer = (state: State, action: Action) => {
    switch(action.type) {
        case 'START':
            return {
                ...state,
                isLoading: true
            };

        case 'OVER':
            return {
                ...state,
                hasMessage: true,
                messageType: action?.messageType,
                message: action?.message
            };

        case 'RESET':
            return initialState;
    } 
};

export const LoadingProvider: React.FC = (props) => {

    const [state, dispatch] = React.useReducer(
        reducer,
        initialState
    );

    const startLoading = () => dispatch({ type: 'START' });

    const stopLoading = (messageType?: State['messageType'], message?: State['message']) => {
        dispatch({ type: 'OVER', messageType, message })
    };

    const resetLoading = () => dispatch({ type: 'RESET' });

    const value = {
        ...state,
        startLoading,
        stopLoading,
        resetLoading
    };

    return <LoaderContext.Provider value={value} {...props} />
};

export const useLoadingMessage = () => {
    const {hasMessage, messageType, message} = React.useContext(LoaderContext)!;
    return {hasMessage, messageType, message};
};

export const useLoadingActions  = () => {
    const {startLoading, stopLoading, resetLoading} = React.useContext(LoaderContext)!;
    return {startLoading, stopLoading, resetLoading};
};
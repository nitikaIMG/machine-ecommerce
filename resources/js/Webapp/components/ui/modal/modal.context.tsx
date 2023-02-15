import * as React from 'react';

type MODAL_VIEWS =
    | 'LOGIN'
    | 'PERSONAL_DETAIL'
    | 'SELLER_ACCOUNT_DETAIL'
    | 'OTP'
    | 'ADD_ADDRESS'
    | 'UPDATE_ADDRESS'
    | 'PASSWORD_UPDATE';

type State = {
    view?: MODAL_VIEWS;
    data?: any; // used to pass data to a modal
    isOpen: boolean;
};

type Action =
  | { type: 'open'; view?: MODAL_VIEWS; payload?: any }
  | { type: 'close' };

const initialState: State = {
    view: undefined,
    data: undefined,
    isOpen: false
};

interface ModalProviderState extends State {
    openModal: (view: MODAL_VIEWS, payload?: any) => void;
    closeModal: () => void;
}

const ModalContext = React.createContext<ModalProviderState | undefined>(undefined);

const reducer = (state: State, action: Action): State => {
    switch(action.type) {
        case 'open':
            return {
                ...state,
                isOpen: true,
                view: action.view,
                data: action.payload
            };

        case 'close':
            return initialState;

        default:
            throw new Error('invalid modal state');
    }
};

export const ModalProvider: React.FC = (props) => {
    const [state, dispatch] = React.useReducer(reducer, initialState);

    const openModal = (view: MODAL_VIEWS, payload?: any) => {
        dispatch({ type: 'open', view, payload })
    };

    const closeModal = () => dispatch({ type: 'close' });

    const value = {
        ...state,
        openModal,
        closeModal
    };

    return <ModalContext.Provider value={value} {...props} />;
};

export const useModalActions = () => {
    const { openModal, closeModal } = React.useContext(ModalContext)!;

    return { openModal, closeModal };
};

export const useModalState = () => {
    const { isOpen, view, data } = React.useContext(ModalContext)!;

    return { isOpen, view, data };
};
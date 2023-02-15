import * as React from 'react';
import { Toast, ToastContainer } from 'react-bootstrap';
import { uniqueId } from '@root/utils/helpers';

type MessageType = {
    messageId: string,
    messageType: 'success' | 'error',
    message: string
};

type ToastProviderState = {
    messages: Array<MessageType>,
    addToast: (message: string, messageType?: MessageType['messageType']) => void
}

const ToastContext = React.createContext<ToastProviderState | undefined>(undefined);

export const ToastProider: React.FC = ({ children }) => {

    const [messages, setMessage] = React.useState<Array<MessageType>>([]);

    const addToast = (message: string, messageType: MessageType['messageType'] = 'success') => {
        setMessage([
            ...messages,
            { messageId: uniqueId(), message, messageType }
        ]);
    };

    const removeToast = (messageId: string) => {
        setMessage(
            messages.filter(messageItem => messageItem.messageId !== messageId)
        );
    };

    return (
        <ToastContext.Provider value={{ addToast, messages }}>
            {children}

            <ToastContainer position="top-end" className="p-3">
                {messages.map(messageItem => (
                    <Toast
                        key={messageItem.messageId}
                        animation={true}
                        onClose={() => removeToast(messageItem.messageId)} delay={2800}
                        autohide>
                        <Toast.Header className="d-flex justify-content-between">
                            <div>
                                {messageItem.messageType === 'success' ? (
                                    <i className='fa fa-check-circle text-success'></i>
                                ) : (
                                    <i className='fa fa-times-circle text-danger'></i>
                                )}
                                <small className="ms-2">{messageItem.message}</small>
                            </div>
                        </Toast.Header>
                    </Toast>
                ))}
            </ToastContainer>
        </ToastContext.Provider>
    );
};

export const useAppNotifications = () => {
    const { messages, addToast } = React.useContext(ToastContext)!;
    return { messages, addToast };
};
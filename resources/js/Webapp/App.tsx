declare global {
    type primary_id = number | string
}

import * as React from 'react';
import * as ReactDOM from 'react-dom';

import { QueryClient, QueryClientProvider } from 'react-query';
import { BrowserRouter } from 'react-router-dom';

import { AuthProvider } from '@store/auth/auth.context';
import { ModalProvider } from '@components/ui/modal/modal.context';
import { ToastProider } from '@components/ui/toast';
import { AppLoadingBar } from '@root/components/ui/loading-bar';
import { ManagedModal } from '@components/ui/modal/modal';

import { LoadingSpinner } from './components/ui/loading-spinner';

import { Routes } from './routes';

const queryClient = new QueryClient();

const App = () => {

    return (
        // need to fix this Hadouken code
        <QueryClientProvider client={queryClient}>
            <BrowserRouter>
                <React.Suspense fallback={<LoadingSpinner />}>
                    <ModalProvider>
                        <ToastProider>
                            <AuthProvider>
                                <Routes />
                                <ManagedModal />
                                <AppLoadingBar />
                            </AuthProvider>
                        </ToastProider>
                    </ModalProvider>
                </React.Suspense>
            </BrowserRouter>
        </QueryClientProvider>
    );
}

export default App;

if (document.getElementById('machine-app')) {
    ReactDOM.render(<App />, document.getElementById('machine-app'));
}

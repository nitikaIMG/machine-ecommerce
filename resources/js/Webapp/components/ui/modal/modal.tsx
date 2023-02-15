import * as React from 'react';
import { useModalActions, useModalState } from './modal.context';
import { Modal, ModalBody } from 'react-bootstrap';
import { LazyLoad } from '@root/utils/hoc';
import { t } from '@utils/helpers';

const LoginModel = React.lazy(() => import('@components/auth/login-modal'));
const OtpModal = React.lazy(() => import('@components/auth/otp-modal'));
const PasswordUpdateModal = React.lazy(() => import('@components/auth/password-update'));

// after signup, if customer or seller is not onboarded
const PersonalDetailsModal = React.lazy(() => import('@components/user/basic-account-update-modal'));
const SellerAddressModal = React.lazy(() => import('@components/user/seller-account-update-modal'));

const AddAddressModal = React.lazy(() => import('@root/components/address/add-address-modal'));
const UpdateAddressModal = React.lazy(() => import('@root/components/address/update-address-modal'));

export const ManagedModal = () => {
    const { isOpen, view, data } = useModalState();
    const { closeModal } = useModalActions();

    return (
        <Modal show={isOpen} backdrop={'static'} dialogClassName='custom-modal'>
            <ModalBody>
                <button
                    onClick={() => {
                        if( confirm(t('Are you sure? All your changes will be lost')) ) {
                            closeModal();
                        }
                    }}
                    type="button"
                    className="btn-close"
                    aria-label="Close"
                />

                {view === 'LOGIN' && <LazyLoad component={LoginModel} />}
                {view === 'OTP' && <LazyLoad component={OtpModal} data={data} />}
                {view === 'PASSWORD_UPDATE' && <LazyLoad component={PasswordUpdateModal} />}
                {view === 'PERSONAL_DETAIL' && <LazyLoad component={PersonalDetailsModal} data={data} />}
                {view === 'SELLER_ACCOUNT_DETAIL' && <LazyLoad component={SellerAddressModal} data={data} />}
                {view === 'ADD_ADDRESS' && <LazyLoad component={AddAddressModal} data={data} />}
                {view === 'UPDATE_ADDRESS' && <LazyLoad component={UpdateAddressModal} data={data} />}
            </ModalBody>
        </Modal>
    );
};
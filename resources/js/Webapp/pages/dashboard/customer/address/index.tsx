import * as React from 'react';
import { useModalActions } from '@root/components/ui/modal/modal.context';
import { useAddressListQuery, useDeleteAddressMutation, useUpdateAddressMutation } from '@root/rest/user/address.query';
import { Spinner } from 'react-bootstrap';
import { useQueryClient } from 'react-query';

export default function Address() {

    const queryClient = useQueryClient();

    const { openModal, closeModal } = useModalActions();
    const { address_list, isLoading } = useAddressListQuery();

    const { mutate: updateAddress, isLoading: isAddressUpdating } = useUpdateAddressMutation();
    const { mutate: deleteAddress, isLoading: isAddressDeleting } = useDeleteAddressMutation();

    const markAddressAsPrimary = (address_id: number|string, is_primary: number = 1) => {

        updateAddress({ address_id, is_primary }, {
            onSuccess: (response) => {
                // queryClient.invalidateQueries('address.list');
            }
        });
    };

    const removeAddress = (address_id: number|string) => {
        
        deleteAddress({ address_id }, {
            onSuccess: (response) => {
                console.log("response: ", response);
                queryClient.invalidateQueries('address.list');
            }
        });
    };

    return (
        <div className="row">
            <div className="col-md-12">
                <div className="card p30" id="myTab">
                    <div className="header">
                        <div className="row">
                            <div className="col-md-12">
                                <div className="title">Manage Address</div>
                            </div>
                        </div>
                    </div>
                    <div className="row address-flex">
                        <div className="col-md-4 pb-1 pb-md-3">
                            <div className="address-wrap">
                                <a
                                    href=""
                                    onClick={(e) => {
                                        e.preventDefault();
                                        openModal('ADD_ADDRESS');
                                    }}
                                    className="add-address"
                                >
                                    <i className="fa fa-plus" />
                                    <span className="text">Add Address</span>
                                </a>
                            </div>
                        </div>
                        {isLoading ? (
                            <div className="col-md-4 pb-1 pb-md-3">
                                <div className="address-wrap">
                                    <Spinner
                                        as="span"
                                        animation="border"
                                        size="sm"
                                        role="status"
                                        aria-hidden="true"
                                    />
                                </div>
                            </div>
                        ) : address_list?.map((address, idx) => (
                                <div key={address?.id ?? idx} className="col-md-4 pb-1 pb-md-3">
                                    <div className="address-wrap justify-content-start">
                                        <div className="action">
                                            <a
                                                href=""
                                                onClick={(e) => {
                                                    e.preventDefault();

                                                    if( address.id ) {
                                                        openModal('UPDATE_ADDRESS', address.id);
                                                    }
                                                }}
                                                className="edit"
                                            >
                                                <i className="fa fa-pencil" />
                                            </a>
                                            <a
                                                href=""
                                                onClick={e => {
                                                    e.preventDefault();

                                                    if( address.id && confirm('Are you sure? This action cannot be undone.') ) {
                                                        removeAddress(address.id);
                                                    }
                                                }}
                                                className="delete ms-1"
                                            >
                                                <i className="fa fa-close" />
                                            </a>
                                        </div>
                                        <div className="content">
                                            <div className="name">{address?.name}</div>
                                            <div className="address">
                                                {address?.address}
                                            </div>
                                            <div className="ship d-flex align-items-center">
                                                <input
                                                    type="checkbox"
                                                    name="mark_address_as_primary"
                                                    id={`${idx}_primary_address`}
                                                    checked={address?.is_primary}
                                                    onChange={(e) => {
                                                        e.preventDefault();

                                                        if( address.id ) {
                                                            markAddressAsPrimary(
                                                                address.id,
                                                                address?.is_primary ? 0 : 1
                                                            );
                                                        }
                                                    }}
                                                />
                                                <label htmlFor={`${idx}_primary_address`}>
                                                    <span className="text ms-1">Mark this primary</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            ))
                        }
                    </div>
                </div>
            </div>
        </div>

    )
}
import * as React from 'react';
import * as yup from 'yup';
import { Form } from '@components/ui/form/form';
import { useAddAddressMutation } from '@root/rest/user/address.query';
import { useQueryClient } from 'react-query';
import { useModalActions } from '@components/ui/modal/modal.context';
import { Spinner } from 'react-bootstrap';

type Nullable<T> = {
    [key in keyof T]: T[key] | null;
};

type FormValues = {
    name: string,
    email: string,
    phone: string,
    address_1: string,
    address_2: string,
    city: string,
    zip: string,
    state: string,
    country: string,
    latitude: string,
    longitude: string
};

const initialValues = {
    name: undefined,
    email: undefined,
    phone: undefined,
    address_1: undefined,
    address_2: undefined,
    city: undefined,
    zip: undefined,
    state: undefined,
    country: undefined,
    latitude: undefined,
    longitude: undefined
};

const validationSchema = yup.object().shape({
    name: yup.string().required().min(2, 'Must be at least 2 chars').max(191, 'Must not exceed 191 chars'),
    email: yup.string().email().required(),
    phone: yup.string().matches(/^[0-9]+$/, 'Invalid phone number').min(8, 'Invalid phone number').max(12, 'Invalid phone number'),
    address_1: yup.string().required().max(191, 'Must not exceed 191 chars'),
    address_2: yup.string().max(191, 'Must not exceed 191 chars'),
    city: yup.string().max(191, 'Must not exceed 191 chars'),
    zip: yup.string().required().max(191, 'Must not exceed 191 chars'),
    state: yup.string().max(191, 'Must not exceed 191 chars'),
    country: yup.string().required().max(191, 'Must not exceed 191 chars'),
    latitude: yup.number(),
    longitude: yup.number()
});

const AddAddressModal = () => {

    const queryClient = useQueryClient();
    const { closeModal } = useModalActions();

    const { mutate: addAddress, isLoading } = useAddAddressMutation();

    const onSubmit = (props: Partial<FormValues>) => {
        addAddress(props, {
            onSuccess: () => {
                closeModal();
                // queryClient.invalidateQueries('address.list');

            }
        });
    };

    return (
        <>
            <Form<Partial<FormValues>>
                onSubmit={onSubmit}
                initialValues={initialValues}
                validationSchema={validationSchema}
            >
                {({ formik }) => (
                    <>
                        <div className="m-head">Add Address</div>
                        <div className="form-group">
                            <label className="label">Your Name</label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                className="form-control"
                                onChange={formik.handleChange}
                                onBlur={formik.handleBlur}
                                value={formik.values.name}
                                autoComplete="email"
                                autoCapitalize="off"
                                autoCorrect="off"
                            />
                            {(formik.errors.name && formik.touched.name)
                                ? <div className="invalid-feedback d-block"> {formik.errors.name} </div>
                                : null
                            }
                        </div>
                        <div className="form-group">
                            <label className="label">Email</label>
                            <input
                                type="text"
                                id="email"
                                name="email"
                                className="form-control"
                                onChange={formik.handleChange}
                                onBlur={formik.handleBlur}
                                value={formik.values.email}
                                autoComplete="email"
                                autoCapitalize="off"
                                autoCorrect="off"
                            />
                            {(formik.errors.email && formik.touched.email)
                                ? <div className="invalid-feedback d-block"> {formik.errors.email} </div>
                                : null
                            }
                        </div>
                        <div className="form-group">
                            <label className="label">Phone</label>
                            <input
                                type="text"
                                id="phone"
                                name="phone"
                                className="form-control"
                                onChange={formik.handleChange}
                                onBlur={formik.handleBlur}
                                value={formik.values.phone}
                                autoComplete="phone"
                                autoCapitalize="off"
                                autoCorrect="off"
                            />
                            {(formik.errors.phone && formik.touched.phone)
                                ? <div className="invalid-feedback d-block"> {formik.errors.phone} </div>
                                : null
                            }
                        </div>
                        <div className="form-group">
                            <label className="label">Address line 1</label>
                            <input
                                type="text"
                                id="address_1"
                                name="address_1"
                                className="form-control"
                                onChange={formik.handleChange}
                                onBlur={formik.handleBlur}
                                value={formik.values.address_1}
                                autoComplete="address_1"
                                autoCapitalize="off"
                                autoCorrect="off"
                            />
                            {(formik.errors.address_1 && formik.touched.address_1)
                                ? <div className="invalid-feedback d-block"> {formik.errors.address_1} </div>
                                : null
                            }
                        </div>
                        <div className="form-group">
                            <label className="label">Address line 2</label>
                            <input
                                type="text"
                                id="address_2"
                                name="address_2"
                                className="form-control"
                                onChange={formik.handleChange}
                                onBlur={formik.handleBlur}
                                value={formik.values.address_2}
                                autoComplete="address_2"
                                autoCapitalize="off"
                                autoCorrect="off"
                            />
                            {(formik.errors.address_2 && formik.touched.address_2)
                                ? <div className="invalid-feedback d-block"> {formik.errors.address_2} </div>
                                : null
                            }
                        </div>
                        <div className="form-group">
                            <label className="label">City</label>
                            <input
                                type="text"
                                id="city"
                                name="city"
                                className="form-control"
                                onChange={formik.handleChange}
                                onBlur={formik.handleBlur}
                                value={formik.values.city}
                                autoComplete="city"
                                autoCapitalize="off"
                                autoCorrect="off"
                            />
                            {(formik.errors.city && formik.touched.city)
                                ? <div className="invalid-feedback d-block"> {formik.errors.city} </div>
                                : null
                            }
                        </div>
                        <div className="form-group">
                            <label className="label">State</label>
                            <input
                                type="text"
                                id="state"
                                name="state"
                                className="form-control"
                                onChange={formik.handleChange}
                                onBlur={formik.handleBlur}
                                value={formik.values.state}
                                autoComplete="state"
                                autoCapitalize="off"
                                autoCorrect="off"
                            />
                            {(formik.errors.state && formik.touched.state)
                                ? <div className="invalid-feedback d-block"> {formik.errors.state} </div>
                                : null
                            }
                        </div>
                        <div className="form-group">
                            <label className="label">Zip</label>
                            <input
                                type="text"
                                id="zip"
                                name="zip"
                                className="form-control"
                                onChange={formik.handleChange}
                                onBlur={formik.handleBlur}
                                value={formik.values.zip}
                                autoComplete="zip"
                                autoCapitalize="off"
                                autoCorrect="off"
                            />
                            {(formik.errors.zip && formik.touched.zip)
                                ? <div className="invalid-feedback d-block"> {formik.errors.zip} </div>
                                : null
                            }
                        </div>
                        <div className="form-group">
                            <label className="label">Country</label>
                            <input
                                type="text"
                                id="country"
                                name="country"
                                className="form-control"
                                onChange={formik.handleChange}
                                onBlur={formik.handleBlur}
                                value={formik.values.country}
                                autoComplete="country"
                                autoCapitalize="off"
                                autoCorrect="off"
                            />
                            {(formik.errors.country && formik.touched.country)
                                ? <div className="invalid-feedback d-block"> {formik.errors.country} </div>
                                : null
                            }
                        </div>
                        <div className="form-group">
                            <button
                                type="submit"
                                className="login"
                            >
                                {isLoading ? (
                                    <Spinner
                                        as="span"
                                        animation="border"
                                        size="sm"
                                        role="status"
                                        aria-hidden="true"
                                    />
                                ) : 'Submit'}
                            </button>
                        </div>
                    </>
                )}
            </Form>
        </>

    );
};

export default AddAddressModal;
import * as React from 'react';
import * as yup from 'yup';
import cn from 'classnames';
import { useAuthUser } from '@root/store/auth/auth.context';
import { Form } from '@components/ui/form/form';
import { useUpdateBasicAccountMutation } from '@root/rest/user/account.query';
import { useModalActions } from '../ui/modal/modal.context';
import { Alert, Spinner } from 'react-bootstrap';
import { useQueryClient } from 'react-query';

type FormValues = {
    name: string,
    email: string,
    phone_code: string,
    phone: string,
    password: string,
    password_confirmation: string,
    shop_name: string,
    shop_email: string,
    shop_number: string,
    product_categories: number | string | undefined;
};

const validationSchema = yup.object().shape({
    name: yup.string().required().min(2, 'Must be at least 2 digits').max(191, 'Must not exceed 191 chars'),
    email: yup.string().email().required(),
    phone_code: yup.string().required(),
    phone: yup.string().matches(/^[0-9]+$/, 'Invalid phone number').max(12, 'Invalid phone number'),
    password: yup.string().required('Password is required'),
    password_confirmation: yup.string().required()
        .oneOf([yup.ref('password'), null], 'Passwords must match'),
    shop_name: yup.string().required(),
    shop_email: yup.string().email().required(),
    shop_phone: yup.string().matches(/^[0-9]+$/, 'Invalid phone number').max(12, 'Invalid phone number'),
});

// after registration acctoun details popup
const SellerAccountUpdateModal = () => {

    const { closeModal } = useModalActions();
    const queryClient = useQueryClient();

    const [errorMessage, setErrorMessage] = React.useState('');
    const [showPassword, setShowPassword] = React.useState(false);

    const { mutate: updateAccount, isLoading } = useUpdateBasicAccountMutation();

    const { user } = useAuthUser();

    const onSubmit = (props: FormValues) => {
        updateAccount(props, {
            onSuccess: ({ message }) => {
                queryClient.invalidateQueries('account.me');
                closeModal();
            },
            onError: (error) => {
                const message = error.response?.data?.message;
                if (message) {
                    setErrorMessage(message);
                }
            }
        });
    };

    return (
        <>
            <div className="m-head">Update basic and shop info</div>

            <Form<FormValues>
                onSubmit={onSubmit}
                initialValues={{
                    name: user?.name ?? '',
                    email: user?.email ?? '',
                    phone_code: '+966',
                    phone: user?.phone ?? '',
                    password: '',
                    password_confirmation: '',
                    shop_name: '',
                    shop_email: '',
                    shop_number: '',
                    product_categories: undefined
                }}
                validationSchema={validationSchema}
            >
                {({ formik }) => (
                    <>
                        <div className="form-group">
                            <label className="label">Name</label>
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
                            <label className="label">Phone Code</label>
                            <div className="input-group mb-3">
                                <select
                                    name="phone_code"
                                    id="phone_code"
                                    className="form-control"
                                    onChange={formik.handleChange}
                                    onBlur={formik.handleBlur}
                                    value={formik.values.phone_code}
                                >
                                    <option value="customer">+966</option>
                                </select>
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
                        </div>
                        <div className="form-group">
                            <label className="label">Password</label>
                            <div className="password-wrap">
                                <input
                                    type={showPassword ? 'text' : 'password'}
                                    className="form-control"
                                    id="password"
                                    name="password"
                                    onChange={formik.handleChange}
                                    onBlur={formik.handleBlur}
                                    value={formik.values.password}
                                    autoComplete="off"
                                    autoCapitalize="off"
                                    autoCorrect="off"
                                />
                                <button type="button" onClick={() => setShowPassword(!showPassword)} className="show-pass btn w-auto m-0 pt-0">
                                    <i className="fa fa-eye hide" />
                                    <i className={cn("fa", {
                                        "fa-eye-slash": !showPassword,
                                        "fa-eye": showPassword
                                    })} />
                                </button>
                            </div>
                            {(formik.errors.password && formik.touched.password)
                                ? <div className="invalid-feedback d-block"> {formik.errors.password} </div>
                                : null
                            }
                        </div>
                        <div className="form-group">
                            <label className="label">Re-Enter Password</label>
                            <div className="password-wrap">
                                <input
                                    type={showPassword ? 'text' : 'password'}
                                    className="form-control"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    onChange={formik.handleChange}
                                    onBlur={formik.handleBlur}
                                    value={formik.values.password_confirmation}
                                    autoComplete="off"
                                    autoCapitalize="off"
                                    autoCorrect="off"
                                />
                                <button type="button" onClick={() => setShowPassword(!showPassword)} className="show-pass btn w-auto m-0 pt-0">
                                    <i className="fa fa-eye hide" />
                                    <i className={cn("fa", {
                                        "fa-eye-slash": !showPassword,
                                        "fa-eye": showPassword
                                    })} />
                                </button>
                            </div>
                            {(formik.errors.password_confirmation && formik.touched.password_confirmation)
                                ? <div className="invalid-feedback d-block"> {formik.errors.password_confirmation} </div>
                                : null
                            }
                        </div>
                        <div className="form-group">
                            <label className="label">Shop Name</label>
                            <input
                                type="text"
                                id="shop_name"
                                name="shop_name"
                                className="form-control"
                                onChange={formik.handleChange}
                                onBlur={formik.handleBlur}
                                value={formik.values.shop_name}
                                autoComplete="shop_name"
                                autoCapitalize="off"
                                autoCorrect="off"
                            />
                            {(formik.errors.shop_name && formik.touched.shop_name)
                                ? <div className="invalid-feedback d-block"> {formik.errors.shop_name} </div>
                                : null
                            }
                        </div>
                        <div className="form-group">
                            <label className="label">Shop Email</label>
                            <input
                                type="text"
                                id="shop_email"
                                name="shop_email"
                                className="form-control"
                                onChange={formik.handleChange}
                                onBlur={formik.handleBlur}
                                value={formik.values.shop_email}
                                autoComplete="shop_email"
                                autoCapitalize="off"
                                autoCorrect="off"
                            />
                            {(formik.errors.shop_email && formik.touched.shop_email)
                                ? <div className="invalid-feedback d-block"> {formik.errors.shop_email} </div>
                                : null
                            }
                        </div>
                        <div className="form-group">
                            <label className="label">Shop Number</label>
                            <input
                                type="text"
                                id="shop_number"
                                name="shop_number"
                                className="form-control"
                                onChange={formik.handleChange}
                                onBlur={formik.handleBlur}
                                value={formik.values.shop_number}
                                autoComplete="shop_number"
                                autoCapitalize="off"
                                autoCorrect="off"
                            />
                            {(formik.errors.shop_number && formik.touched.shop_number)
                                ? <div className="invalid-feedback d-block"> {formik.errors.shop_number} </div>
                                : null
                            }
                        </div>
                        <div className="form-group">
                            <label className="label">Shop Category</label>
                            <select
                                name="product_categories"
                                id="product_categories"
                                className="form-control"
                                onChange={formik.handleChange}
                                onBlur={formik.handleBlur}
                                value={formik.values.product_categories}
                            >
                                <option value={11}>Electrical</option>
                                <option value={14}>Automobiles</option>
                            </select>
                            {(formik.errors.product_categories && formik.touched.product_categories)
                                ? <div className="invalid-feedback d-block"> {formik.errors.product_categories} </div>
                                : null
                            }
                        </div>
                        <div className="form-group">
                            {errorMessage ? (
                                <Alert variant="danger" onClose={() => setErrorMessage('')} dismissible>
                                    {errorMessage}
                                </Alert>
                            ) : null}

                            <button type="submit" className="login" disabled={isLoading}>
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

export default SellerAccountUpdateModal;
import * as React from 'react';
import * as yup from 'yup';
import cn from 'classnames';
import { useAuthUser } from '@root/store/auth/auth.context';
import { Form } from '@components/ui/form/form';
import { useUpdateBasicAccountMutation } from '@root/rest/user/account.query';
import { useModalActions } from '../ui/modal/modal.context';
import { Alert, Spinner } from 'react-bootstrap';

type FormValues = {
    name: string,
    email: string,
    phone_code: string,
    phone: string,
    password: string,
    password_confirmation: string
};

const validationSchema = yup.object().shape({
    name: yup.string().required().min(2, 'Must be at least 2 digits').max(191, 'Must not exceed 191 chars'),
    email: yup.string().email().required(),
    phone_code: yup.string().required(),
    phone: yup.string().matches(/^[0-9]+$/, 'Invalid phone number').max(12, 'Invalid phone number'),
    password: yup.string().required('Password is required'),
    password_confirmation: yup.string().required()
        .oneOf([yup.ref('password'), null], 'Passwords must match')
});

// after registration account details popup
const PersonalDetailsModal = () => {

    const { closeModal } = useModalActions();

    const [errorMessage, setErrorMessage] = React.useState('');
    const [showPassword, setShowPassword] = React.useState(false);

    const { mutate: updateAccount, isLoading } = useUpdateBasicAccountMutation();

    const { user } = useAuthUser();

    const onSubmit = (props: FormValues) => {
        updateAccount(props, {
            onSuccess: ({ message }) => {
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
            <div className="m-head">Update basic info</div>
            <div className="hd">Personal Details</div>

            <Form<FormValues>
                onSubmit={onSubmit}
                initialValues={{
                    name: user?.name ?? '',
                    email: user?.email ?? '',
                    phone_code: '+966',
                    phone: user?.phone ?? '',
                    password: '',
                    password_confirmation: ''
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

export default PersonalDetailsModal;
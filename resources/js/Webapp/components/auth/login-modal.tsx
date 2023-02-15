import * as React from 'react';
import * as yup from 'yup';
import cn from 'classnames';
import { Alert, Spinner } from 'react-bootstrap';
import { useModalActions } from '@components/ui/modal/modal.context';
import { useLoginMutation, useSendLoginOtpMutation } from '@root/rest/auth/auth.query';
import { Form } from '@components/ui/form/form';
import { useAuthActions } from '@store/auth/auth.context';

type FormValues = {
    email_or_phone: string,
    password: string,
    type: string,
};

const validateEmail = (email: string | undefined) => {
    return yup.string().email().isValidSync(email)
};

const validatePhone = (phone: number | undefined) => {
    return yup.number().integer().positive().test(
        (phone) => {
            return (phone && phone.toString().length >= 8 && phone.toString().length <= 14) ? true : false;
        }
    ).isValidSync(phone);
};

const LoginSchema = yup.object().shape({
    email_or_phone: yup.string()
        .required('Please enter a valid phone number or email address')
        .test('email_or_phone', 'Please enter a valid phone number or email address', (value) => {
            return validateEmail(value) || validatePhone(parseInt(value ?? '0'));
        }),
    password: yup.string().required()
});

const LoginViaOptSchema = yup.object().shape({
    email_or_phone: yup.string()
        .required('Please enter a valid phone number or email address')
        .test('email_or_phone', 'Please enter a valid phone number or email address', (value) => {
            return validateEmail(value) || validatePhone(parseInt(value ?? '0'));
        })
});

const RegistrationSchema = yup.object().shape({
    email_or_phone: yup.string()
        .required('Please enter a valid phone number or email address')
        .test('email_or_phone', 'Please enter a valid phone number or email address', (value) => {
            return validateEmail(value) || validatePhone(parseInt(value ?? '0'));
        }),
    type: yup.string().test('type', 'Invalid type', (value) => {
        return value === 'customer' || value === 'seller';
    })
});

const Login = () => {

    const { openModal, closeModal } = useModalActions();
    const { mutate: login, isLoading } = useLoginMutation();
    const { mutate: loginViaOtp, isLoading: isLoadingViaOtp } = useSendLoginOtpMutation();

    const [errorMessage, setErrorMessage] = React.useState('');
    const [showPassword, setShowPassword] = React.useState(false);

    const [successMessage, setSuccessMessage] = React.useState<string | null>(null);

    const [viaOtp, setViaOtp] = React.useState(true);

    const [isRegister, setIsRegister] = React.useState(false);

    const { loginAction } = useAuthActions();

    const toggleRegistration = () => {
        setIsRegister(!isRegister);
        setViaOtp(!isRegister);
    };

    const onSubmitViaOtp = (creds: FormValues) => {
        loginViaOtp(creds, {
            onSuccess: ({ message }) => {

                openModal('OTP', {
                    message: message ?? '',
                    email_or_phone: creds.email_or_phone
                });
            },
            onError: (error) => {
                const message = error.response?.data?.message;
                if (message) {
                    setErrorMessage(message);
                }
            }
        });
    };

    const onSubmit = (creds: FormValues) => {

        if (viaOtp) {
            onSubmitViaOtp(creds);
            return;
        }

        login(creds, {
            onSuccess: ({ message, data }) => {
                setSuccessMessage(message);

                if (data) {
                    const { user } = data;

                    loginAction({
                        user: user,
                        token: data.access_token
                    });

                    if( ! user.onboarded ) {
                        if( user.type === 'seller' ) {
                            openModal('SELLER_ACCOUNT_DETAIL');   
                        } else {
                            openModal('PERSONAL_DETAIL');
                        }
                    } else {
                        closeModal();
                    }
                } else {
                    setErrorMessage('Something went wrong');
                }
            },
            onError: (error) => {
                const message = error.response?.data?.message;
                if (message) {
                    setErrorMessage(message);
                }
            }
        });
    };

    const validationSchema = viaOtp
        ? LoginViaOptSchema
        : isRegister ? RegistrationSchema : LoginSchema;

    return (
        <>
            <Form<FormValues>
                onSubmit={onSubmit}
                initialValues={{
                    email_or_phone: '',
                    password: '',
                    type: 'customer'
                }}
                validationSchema={validationSchema}
            >
                {({ formik }) => (
                    <>
                        <div className="m-head">Welcome to Up-Shops </div>
                        {isRegister ? (
                            <div className="form-group">
                                <label className="label">You are</label>
                                <select
                                    name="type"
                                    id="type"
                                    className="form-control"
                                    onChange={formik.handleChange}
                                    onBlur={formik.handleBlur}
                                    value={formik.values.type}
                                >
                                    <option value="customer">Customer</option>
                                    <option value="seller">Seller</option>
                                </select>
                            </div>
                        ): null}
                        <div className="form-group">
                            <label className="label">Email / Phone Number</label>
                            <input
                                type="text"
                                id="email_or_phone"
                                name="email_or_phone"
                                className="form-control"
                                placeholder="john.doe@email.com"
                                onChange={formik.handleChange}
                                onBlur={formik.handleBlur}
                                value={formik.values.email_or_phone}
                                autoComplete="email"
                                autoCapitalize="off"
                                autoCorrect="off"
                            />
                            {(formik.errors.email_or_phone && formik.touched.email_or_phone)
                                ? <div className="invalid-feedback d-block"> {formik.errors.email_or_phone} </div>
                                : null
                            }
                        </div>
                        {!viaOtp ? (
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
                        ) : null}
                        <div className="form-group">
                            {errorMessage ? (
                                <Alert variant="danger" onClose={() => setErrorMessage('')} dismissible>
                                    {errorMessage}
                                </Alert>
                            ) : null}

                            <button type="submit" className="login" disabled={isLoading || isLoadingViaOtp || (successMessage !== null)}>
                                {isLoading ? (
                                    <Spinner
                                        as="span"
                                        animation="border"
                                        size="sm"
                                        role="status"
                                        aria-hidden="true"
                                    />
                                ) : successMessage !== null ? (
                                    <>
                                        <i className="fa fa-check me-1" aria-hidden="true"></i>
                                        {successMessage}
                                    </>
                                ) : isRegister ? 'Register' : 'Login'}
                            </button>
                        </div>
                    </>
                )}
            </Form>

            <div className="form-group">
                {!isRegister ? (
                    <div className="d-flex justify-content-between">
                        <span></span>
                        {/* <a
                            href=""
                            className="forgot"
                        >
                            Forgot password?
                        </a> */}
                        <a
                            href=""
                            className="forgot"
                            onClick={(e) => { e.preventDefault(); setViaOtp((s) => !s); }}
                        >
                            {viaOtp ? 'Login via email/password' : 'Login via OTP'}
                        </a>
                    </div>
                ) : null}
            </div>
            <div className="form-group">
                <button type="button" className="register" onClick={() => toggleRegistration()}>
                    {isRegister ? 'Login' : 'Register Now'}
                </button>
            </div>
        </>

    )
}

export default Login;
import * as React from 'react';
import * as yup from 'yup';
import cn from 'classnames';
import { Alert, Spinner } from 'react-bootstrap';
import { useModalActions } from '@components/ui/modal/modal.context';
import { useLoginMutation, useSendLoginOtpMutation } from '@root/rest/auth/auth.query';
import { Form } from '@components/ui/form/form';
import { useAuthActions } from '@store/auth/auth.context';
import { useUpdatePasswordMutation } from '@root/rest/user/account.query';

type FormValues = {
    old_password: string,
    password: string,
    password_confirmation: string,
};

const validationSchema = yup.object().shape({
    old_password: yup.string().required(),
    password: yup.string().required(),
    password_confirmation: yup.string().required()
        .oneOf([yup.ref('password'), null], 'Passwords must match')
});

const PasswordUpdateModal = () => {

    const { closeModal } = useModalActions();

    const [errorMessage, setErrorMessage] = React.useState('');
    const [showPassword, setShowPassword] = React.useState(false);

    const { mutate: updatePassword, isLoading: isUpdatingPassword } = useUpdatePasswordMutation();

    const onSubmit = (creds: FormValues) => {
        updatePassword(creds, {
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
            <Form<FormValues>
                onSubmit={onSubmit}
                initialValues={{
                    old_password: '',
                    password: '',
                    password_confirmation: '',
                }}
                validationSchema={validationSchema}
            >
                {({ formik }) => (
                    <>
                        <div className="form-group">
                            <label className="label">Old Password</label>
                            <div className="password-wrap">
                                <input
                                    type={showPassword ? 'text' : 'password'}
                                    className="form-control"
                                    id="old_password"
                                    name="old_password"
                                    onChange={formik.handleChange}
                                    onBlur={formik.handleBlur}
                                    value={formik.values.old_password}
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
                            {(formik.errors.old_password && formik.touched.old_password)
                                ? <div className="invalid-feedback d-block"> {formik.errors.old_password} </div>
                                : null
                            }
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
                            <label className="label">Re-enter Password</label>
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

                            <button type="submit" className="login" disabled={isUpdatingPassword}>
                                {isUpdatingPassword ? (
                                    <Spinner
                                        as="span"
                                        animation="border"
                                        size="sm"
                                        role="status"
                                        aria-hidden="true"
                                    />
                                ) : 'Update'}
                            </button>
                        </div>
                    </>
                )}
            </Form>
        </>

    )
}

export default PasswordUpdateModal;
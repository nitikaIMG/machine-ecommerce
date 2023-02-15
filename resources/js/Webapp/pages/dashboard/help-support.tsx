import * as React from 'react';
import * as yup from 'yup';
import { Form } from '@root/components/ui/form/form';
import { Spinner } from 'react-bootstrap';
import { useAddHelpSupportMutation } from '@root/rest/user/help-support.query';
import { useAuthUser } from '@root/store/auth/auth.context';

const validationSchema = yup.object().shape({
    name: yup.string().required().min(2, 'Must be at least 2 digits').max(191, 'Must not exceed 191 chars'),
    email: yup.string().email().required(),
    message: yup.string().required()
});

const HelpNSupport = () => {

    const { user } = useAuthUser();

    const { mutate: addMessage, isLoading: isUpdating } = useAddHelpSupportMutation();

    const onSubmit = (props: any) => {
        addMessage(props, {
            onSuccess: () => {

            }
        });
    };

    return (
        <div className="row">
            <div className="col-md-12">
                <div className="card p30" id="myTab">
                    <div className="header">
                        <div className="row">
                            <div className="col-md-6">
                                <div className="title">Update Account</div>
                            </div>
                        </div>
                    </div>
                    <Form
                        onSubmit={onSubmit}
                        initialValues={{
                            name: '',
                            email: user?.email ?? '',
                            message: ''
                        }}
                        validationSchema={validationSchema}
                    >
                        {({ formik }) => (
                            <>
                                <div className="form-group">
                                    <div className="row">
                                        <div className="col-md-6 col-lg-3">
                                            <label className="label">Name</label>
                                        </div>
                                        <div className="col">
                                            <input
                                                type="text"
                                                id="name"
                                                name="name"
                                                className="form-control"
                                                onChange={formik.handleChange}
                                                onBlur={formik.handleBlur}
                                                value={formik.values.name}
                                                autoComplete="name"
                                                autoCapitalize="off"
                                                autoCorrect="off"
                                                autoFocus
                                            />
                                            {(formik.errors.name && formik.touched.name)
                                                ? <div className="invalid-feedback d-block"> {formik.errors.name} </div>
                                                : null
                                            }
                                        </div>
                                    </div>
                                </div>

                                <div className="form-group">
                                    <div className="row">
                                        <div className="col-md-6 col-lg-3">
                                            <label className="label">Email</label>
                                        </div>
                                        <div className="col">
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
                                    </div>
                                </div>

                                <div className="form-group">
                                    <div className="row">
                                        <div className="col-md-6 col-lg-3">
                                            <label className="label">Message</label>
                                        </div>
                                        <div className="col">
                                            <textarea
                                                id="message"
                                                name="message"
                                                className="form-control"
                                                onChange={formik.handleChange}
                                                onBlur={formik.handleBlur}
                                                value={formik.values.message}
                                            >{formik.values.message}</textarea>
                                            {(formik.errors.message && formik.touched.message)
                                                ? <div className="invalid-feedback d-block"> {formik.errors.message} </div>
                                                : null
                                            }
                                        </div>
                                    </div>
                                </div>

                                <div className="form-group">
                                    <div className="row">
                                        <div className="col-md-6 col-lg-3"></div>
                                        <div className="col-md-6 col-lg-3">
                                            <button type="submit" className="save-btn border-0" disabled={isUpdating}>
                                                {isUpdating ? (
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
                                    </div>
                                </div>
                            </>
                        )}
                    </Form>
                </div>
            </div>
        </div>

    );
};

export default HelpNSupport;
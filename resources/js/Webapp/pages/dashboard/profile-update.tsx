import * as React from 'react';
import * as yup from 'yup';
import { Form } from '@root/components/ui/form/form';
import { LoadingSpinner } from '@root/components/ui/loading-spinner';
import { useUpdateAccountMutation, UpdateAccountType } from '@root/rest/user/account.query';
import { useAuthUser } from '@root/store/auth/auth.context';
import { useQueryClient } from 'react-query';
import { Spinner } from 'react-bootstrap';
import { useModalActions } from '@root/components/ui/modal/modal.context';

const validationSchema = yup.object().shape({
    name: yup.string().required().min(2, 'Must be at least 2 digits').max(191, 'Must not exceed 191 chars')
});

const ProfileUpdate = () => {

    const { openModal } = useModalActions();

    const { user, isLoading } = useAuthUser();

    const queryClient = useQueryClient();

    const { mutate: updateAccount, isLoading: isUpdating } = useUpdateAccountMutation();

    const onSubmit = (props: UpdateAccountType) => {
        updateAccount(props, {
            onSuccess: () => {
                queryClient.invalidateQueries('account.me');
            }
        });
    };

    if (isLoading) {
        return <LoadingSpinner />
    }

    return (
        <div className="row">
            <div className="col-md-12">
                <div className="card p30" id="myTab">
                    <div className="header">
                        <div className="row">
                            <div className="col-md-6">
                                <div className="title">Update Account</div>
                            </div>
                            <div className="col-md-6 text-md-end">
                                <button
                                    className="btn text-warning btn-link"
                                    onClick={() => openModal('PASSWORD_UPDATE')}
                                    type="button">
                                    Update Password
                                </button>
                            </div>
                        </div>
                    </div>
                    <Form<UpdateAccountType>
                        onSubmit={onSubmit}
                        initialValues={{
                            name: user?.name ?? ''
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

export default ProfileUpdate;
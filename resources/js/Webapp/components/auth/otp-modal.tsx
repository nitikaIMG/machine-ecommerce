import * as React from 'react';
import { useModalActions } from '../ui/modal/modal.context';
import { leftPad } from '@root/utils/helpers';
import { useCountdown } from '@root/hooks/useCountDown';
import { useLoginViaOtpMutation } from '@root/rest/auth/auth.query';
import { OtpInput } from '@components/ui/otp-input/otp-input';
import { useAuthActions } from '@root/store/auth/auth.context';
import { Alert } from 'react-bootstrap';

const OtpInputMemozd = React.memo(OtpInput);

const OTP_TIME = 8000; // 1 minute, 20 seconds

const TOTAL_OTP_INPUTS = 6;

const OtpModal = ({
    data: { email_or_phone }
}: {
    data: { email_or_phone: string }
}) => {

    const { openModal, closeModal } = useModalActions();

    const [timer, setTimer] = React.useState({
        processing: false,
        timeOver: false,
        time: new Date().getTime()
    });

    const { processing, timeOver, time } = timer;

    const {
        coundDown: [,,minutes,seconds],
        pauseCountDown
    } = useCountdown(time + OTP_TIME, timeOver);

    const [otp, setOtp] = React.useState('');

    const [errorMessage, setErrorMessage] = React.useState('');

    const { mutate: loginViaOtp, isLoading: isLoadingViaOtp } = useLoginViaOtpMutation();

    const { loginAction } = useAuthActions();

    const isOtpComplete = (otp: string | number) => {
        return String(otp).length === TOTAL_OTP_INPUTS;
    };

    const resetForm = () => {
        setOtp('');
        setTimer({ ...timer, processing: false, time: new Date().getTime(), timeOver: false });
    };

    const resendOtp = () => {
        resetForm();
    };

    const submitOtp = (otp: string | number) => {

        loginViaOtp({ email_or_phone, otp }, {
            onSuccess: ({ message, data }) => {

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
                    resetForm();
                }
            },
            onError: (error) => {
                const message = error.response?.data?.message;
                if (message) {
                    setErrorMessage(message);
                }
                resetForm();
            }
        });
    };

    // use memoized version of this fn so as to prevent re-render of otp-input component
    // due to timer
    const handleOnChange = React.useCallback((otp: number | string) => {
        otp = String(otp);

        setOtp(otp);

        // auto-submit the otp to the server once complete
        if (isOtpComplete(otp)) {

            setTimer({
                ...timer,
                processing: true
            });

            submitOtp(otp);
        }
    }, [otp]);

    // time is up
    if (!timeOver && (minutes + seconds) <= 0) {
        setTimer({ ...timer, time: new Date().getTime(), timeOver: true });
        pauseCountDown();
    }

    return (
        <>
            <div className="m-head">OTP Validation</div>
            <div className="form-group text-center">
                <label className="label text-success">
                    Please enter the OTP sent on registered email/phone
                </label>

                <OtpInputMemozd
                    totalInputs={TOTAL_OTP_INPUTS}
                    onChange={handleOnChange}
                    defaultOtp={otp}
                    isDisabled={timeOver || processing}
                />

                <a href="#" onClick={e => {
                    e.preventDefault();

                    if (timeOver && !processing) {
                        resendOtp();
                    }
                }} className="have-account underline mt-3">
                    Resend New Code
                </a>
                <div className="timer">
                    {timeOver && !processing ? (
                        <span>Please resend OTP</span>
                    ) : processing ? (
                        <span>
                            Processing...
                        </span>
                    ) : (
                        <span>
                            {leftPad(minutes)}:{leftPad(seconds)} sec
                        </span>
                    )
                    }
                </div>
            </div>
            <div className="form-group">
                {errorMessage ? (
                    <Alert variant="danger" onClose={() => setErrorMessage('')} dismissible>
                        {errorMessage}
                    </Alert>
                ) : null}

                <button type="button" className="login">Verify</button>
            </div>
        </>

    );
};

export default OtpModal;
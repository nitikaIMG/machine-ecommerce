import * as React from 'react';
import { SingleOtpInput } from './single-otp-input';

type OtpInputParams = {
    totalInputs: number;
    onChange: (otp: number | string) => void;
    onComplete: (otp: number | string) => void;
    isDisabled: boolean;
    defaultOtp: number | string;
};

// you should memoize this component in parent if, for some reason the parent keeps on repeating
export const OtpInput = ({
    totalInputs = 6,
    onChange,
    isDisabled,
    defaultOtp = ''
}: Partial<OtpInputParams>) => {

    const defualtVal = React.useMemo(() => {
        return String(defaultOtp).split('').map(el => parseInt(el));
    }, [defaultOtp]);

    const [otp, setOtp] = React.useState<Array<number | null>>(defualtVal);
    const [activeInput, setActiveInput] = React.useState(0);

    React.useEffect(() => {
        setOtp(defualtVal);
        setActiveInput(defualtVal.length);
    }, [defualtVal]);

    // React.useEffect(() => {
    //     const otpStr = _getOtp();
    //     onChange && onChange(otpStr);
    // }, [otp]);

    const _getOtp = (_otp: Array<number | null> | null = null): string => {
        return _otp ? _otp.join('') : otp.join('');
    };

    const _focusInput = (idx: number) => {
        if (activeInput !== idx) {
            setActiveInput(idx);
        }
    };

    const _focusNextInput = () => {
        if (activeInput < totalInputs -1) {
            _focusInput(activeInput + 1);
        }
    };

    const _focusPrevInput = () => {
        if (activeInput > 0) {
            _focusInput(activeInput - 1);
        }
    };

    const _isValueValid = (digit: string | number) => {
        return /^\d$/.test(String(digit));
    };

    const _setValueAtActiveInput = (value: number | null) => {
        const newOtp = [...otp];
        newOtp[activeInput] = value;

        setOtp(newOtp);

        return newOtp;
    };

    const handleOnChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        const { value } = e.target;

        if (_isValueValid(value)) {
            const newOtp = _setValueAtActiveInput(parseInt(value));
            onChange && onChange(_getOtp(newOtp));
        }
    };

    const handleOnInput = (e: React.ChangeEvent<HTMLInputElement>) => {
        const { value } = e.target;

        if (_isValueValid(value)) {
            _focusNextInput();
        }
    };

    const handleOnKeyDown = (e: React.KeyboardEvent<HTMLInputElement>) => {
        switch( e.key ) {
            case 'Backspace':
                e.preventDefault();
                _focusPrevInput();
                _setValueAtActiveInput(null);
                break;

            case 'Delete':
                e.preventDefault();
                _setValueAtActiveInput(null);
                break;

            case 'ArrowLeft':
                e.preventDefault();
                _focusPrevInput();
                break;
            
            case 'ArrowRight':
                e.preventDefault();
                _focusNextInput();
                break;

            case ' ':
            case 'Spacebar':
            case 'Space':
                e.preventDefault();
                break;
        }
    };

    const handleOnPaste = (e: React.ClipboardEvent) => {
        e.preventDefault();

        const pastedData = e.clipboardData
            .getData('text/plain')
            .slice(0, totalInputs - activeInput)
            .split('')
            .filter(otpVal => _isValueValid(otpVal));

        const newOtp = [...otp];

        let newActiveInput = activeInput;

        for( let i = 0, len = pastedData.length; i < len; i++ ) {
            newOtp[newActiveInput] = parseInt(pastedData[i]);
            newActiveInput++;
        }

        if( newActiveInput >= totalInputs ) {
            newActiveInput--;
        }

        if( newActiveInput > activeInput ) {
            setActiveInput(newActiveInput);
            setOtp(newOtp);
        }
    };

    const otpFields = () => {
        const a = [];
        for (let i = 0; i < totalInputs; i++) {
            a.push(
                <SingleOtpInput
                    key={i}
                    focus={activeInput === i}
                    value={otp[i] ?? ''}
                    disabled={isDisabled}
                    onChange={handleOnChange}
                    onInput={handleOnInput}
                    onKeyDown={handleOnKeyDown}
                    onPaste={handleOnPaste}
                    onFocus={(e: React.FocusEvent<HTMLInputElement>) => {
                        _focusInput(i);
                        e.target.select();
                    }}
                />
            );
        }
        return a;
    };

    return (
        <div className="row">
            {otpFields()}
        </div>
    );
};
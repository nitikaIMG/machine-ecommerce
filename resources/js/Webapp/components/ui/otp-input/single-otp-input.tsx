import * as React from 'react';

type SingleOtpInputType = {
    focus: boolean;
    [key: string]: any;
};

export const SingleOtpInput = ({
    focus,
    ...rest
}: SingleOtpInputType) => {

    const inputRef = React.useRef<HTMLInputElement>(null);

    React.useEffect(() => {

        if( focus && inputRef.current ) {
            inputRef.current.focus();
        }

    }, [focus]);

    return (
        <input
            type="text"
            className="form-control text-center col mr-2"
            maxLength={1}
            pattern="\d*"
            autoCapitalize="off"
            autoCorrect="off"
            autoComplete="off"
            ref={inputRef}
            {...rest}
        />
    );
};
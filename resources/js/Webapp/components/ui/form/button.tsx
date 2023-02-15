import * as React from 'react';
import { Spinner } from 'react-bootstrap';

type ButtonType = {
    isLoading?: boolean,
    text?: string,
    classNames?: string
};

// @ -- currently not in use
export const Button: React.FC<ButtonType> = ({
    isLoading = false,
    text = 'Submit',
    classNames = ''
}) => {
    return (
        <button
            type="submit"
            className={`login ${classNames}`}
        >
            {isLoading ? (
                <Spinner
                    as="span"
                    animation="border"
                    size="sm"
                    role="status"
                    aria-hidden="true"
                />
            ) : text}
        </button>
    );
};
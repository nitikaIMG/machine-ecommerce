import * as React from 'react';
import cn from 'classnames';
import { Spinner } from 'react-bootstrap';

const styles = {
    minHeight: '180px'
};

export const LoadingSpinner = (outerClass: string|object|[] = '') => {
    return (
        <div style={styles}
            className={cn('d-flex align-items-center justify-content-center', outerClass)}>
            <Spinner
                as="span"
                animation="border"
                role="status"
                aria-hidden="true"
            />
        </div>
    );
};
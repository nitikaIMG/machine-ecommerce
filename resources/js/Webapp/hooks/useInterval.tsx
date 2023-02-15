import * as React from 'react';

export default function useInterval(callback: () => void, delay: number) {
    const savedCallback = React.useRef<typeof callback>();
    const intervalRef = React.useRef<NodeJS.Timer | null>();

    // Remember the latest callback.
    React.useEffect(() => {
        savedCallback.current = callback;
    }, [callback]);

    // Set up the interval.
    React.useEffect(() => {
        function tick() {
            if (savedCallback.current) {
                savedCallback.current();
            }
        }
        if (delay !== null) {
            const id = intervalRef.current = setInterval(tick, delay);
            return () => clearInterval(id);
        }
    }, [delay]);

    const resetInterval = React.useCallback(() => {
        if( intervalRef.current && savedCallback.current ) {
            clearInterval(intervalRef.current);
            intervalRef.current = setInterval(savedCallback.current, delay);
        }
    }, [delay]);

    const startInterval = React.useCallback(() => {
        if( !intervalRef.current && savedCallback.current ) {
            intervalRef.current = setInterval(savedCallback.current, delay);
        }
    }, [delay]);

    const stopInterval = React.useCallback(() => {
        if( intervalRef.current ) {
            clearInterval(intervalRef.current);
            intervalRef.current = null;
        }
    }, [delay]);

    return { resetInterval, startInterval, stopInterval };
}

import * as React from 'react';
import useInterval from './useInterval';

// futureMS - future date in milliseconds - Date.now() + 8000 for 8 seconds countdown

export const useCountdown = (futureMS: number, isStateStale: boolean = false) => {

    const [time, setTime] = React.useState<number | null>(null);
    const [stateState, setStateStale] = React.useState(false);
    const [delay, setDelay] = React.useState(1000);

    const { stopInterval, startInterval } = useInterval(() => {
        setTime(futureMS - Date.now());
    }, delay);

    React.useEffect(() => {
        startInterval();
        setTime(futureMS - Date.now());
    }, [futureMS]);

    React.useEffect(() => {
        setStateStale(isStateStale);
    }, [isStateStale]);

    const pauseCountDown = React.useCallback(() => {
        stopInterval();
    }, []);

    const resumeCountDown = React.useCallback(() => {
        startInterval();
    }, []);

    const coundDown = time && !stateState
        ? getReturnValues(time)
        : getReturnValues(futureMS - Date.now());

    return {
        coundDown,
        pauseCountDown,
        resumeCountDown
    };
};

const getReturnValues = (countDown: number) => {
    const days = Math.floor(countDown / (1000 * 60 * 60 * 24));
    const hours = Math.floor(
        (countDown % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
    );
    const minutes = Math.floor((countDown % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((countDown % (1000 * 60)) / 1000);

    return [days, hours, minutes, seconds];
};
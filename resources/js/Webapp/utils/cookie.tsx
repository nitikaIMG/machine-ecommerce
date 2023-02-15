import Cookies from "js-cookie";
import { COOKIE_AUTH_TOKEN } from "./constants";

export const getAuthToken = () => {
    if (typeof window === undefined) {
        return null;
    }
    
    return Cookies.get( COOKIE_AUTH_TOKEN );
};

export const setAuthToken = (token: string) => {
    if (typeof window === undefined) {
        return null;
    }

    return Cookies.set( COOKIE_AUTH_TOKEN, token );
};

export const unsetAuthToken = () => {
    if (typeof window === undefined) {
        return;
    }
    
    Cookies.remove( COOKIE_AUTH_TOKEN );
};
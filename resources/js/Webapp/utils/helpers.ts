export const asset = (path = ''): string => {
    return `/web/static/${path}`.replace(/\/+$/, '');
};

export const uniqueId = (): string => {
    return Date.now().toString(36) + Math.random().toString(36).substring(2);
};

export const leftPad = (number: number, pad: number = 2): string => {
    let output = number + '';
    while (output.length < pad) {
        output = '0' + output;
    }
    return output;
};

// TODO: need to implement translation logic
export const t = (translation_str: string, namespace: string = ''): string => {
    return translation_str;
};

export interface Error {
    message?: string;
}

export interface ResponseType<TData = null> {
    status: 1 | 0;
    message: string | null;
    data: TData | null;
}
import * as React from 'react';
import { FormikContextType, useFormik } from 'formik';

type FormReturnParams<T> = {
    formik: FormikContextType<T>
};

type FormProps<TFormValues extends Record<string, any>> = {
    onSubmit: (values: TFormValues) => void,
    initialValues: TFormValues,
    children: (params: FormReturnParams<TFormValues>) => React.ReactNode,
    // validationSchema?: yup.ObjectSchema<TFormValues>
    validationSchema?: any
};

export const Form = <
    TFormValues extends Record<string, any> = Record<string, any>
>({
    onSubmit,
    initialValues,
    children,
    validationSchema
}: FormProps<TFormValues>) => {

    const formik = useFormik<TFormValues>({
        initialValues, validationSchema, onSubmit
    });

    const formSubmit = (e: React.FormEvent<HTMLFormElement>) => {
        e.preventDefault(); formik.submitForm();
    };

    return (
        <form onSubmit={(e) => formSubmit(e)}>
            {children({formik})}
        </form>
    )
}

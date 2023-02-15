import * as React from "react";

type LazyLoadHOC = {
    component: React.LazyExoticComponent<any>,
    fallback?: React.ComponentType | null,
    [x:string]: any
};

const _fallback = () => (
    <div style={{minHeight:'120px',minWidth:'120px'}} className="d-flex align-items-center justify-content-center">
        <div className="spinner-border" role="status">
            <span className="visually-hidden">Loading...</span>
        </div>
    </div>
);

export const LazyLoad: React.FC<LazyLoadHOC> = ({
    component: Component, fallback = null, ...props
}) => {
    return (
        <React.Suspense fallback={_fallback}>
            <Component {...props} />
        </React.Suspense>
    );
};
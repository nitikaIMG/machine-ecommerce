import * as React from 'react';
import { Redirect } from 'react-router-dom';
import { renderRoutes, RouteConfig } from 'react-router-config';
import { ROUTES } from './routes.const';
import { RouteComponentProps } from 'react-router';

import Homepage from '@pages/home';

import { HomepageLayout } from './layouts';
import { DashboardLayout } from './layouts';
import { useAuthUser } from './store/auth/auth.context';

type FilterRouteType = {
    component: React.FC<RouteComponentProps> | React.LazyExoticComponent<any>,
    isProtected?: boolean,
    isLoggedIn?: boolean,
    userRole?: 'customer' | 'seller', // auth user type
    routeRole?: 'customer' | 'seller' | null, // role auth required for this route
    unAuthCallback?: (() => void) | null,
    redirectTo?: string
};

export const Routes: React.FC = () => {
    const { user, isLoading } = useAuthUser();

    // if all checks passed it returns passed component
    // otherwise it returns component that renders Redirect
    const FilterRoute = React.useCallback(({
        component,
        isProtected = false,
        routeRole = null, // role auth required for this route
        unAuthCallback = null,
        redirectTo = '/'
    }: FilterRouteType) => {

        // if the route is protected and the user is not logged in
        if (isProtected && !isLoggedIn) {
            return () => {
                if (unAuthCallback) unAuthCallback();
                return <Redirect to={redirectTo} />;
            };
        }

        // if the route role doesn't match user's
        if (routeRole && userRole !== routeRole) {
            return () => {
                if (unAuthCallback) unAuthCallback();
                return <Redirect to={redirectTo} />;
            };
        }

        return component;
    }, [user]);

    if (isLoading) {
        return <h3>Loading...</h3>;
    }

    const isLoggedIn = user?.id ? true : false;

    const userRole = user?.type ?? 'customer';

    const routes = [
        // customer dashboard routes
        {
            // all the inner-routes must start with /ROUTES.DASHBOARD
            path: ROUTES.DASHBOARD,
            component: FilterRoute({
                component: DashboardLayout,
                isProtected: true
            }),
            routes: [
                {
                    path: ROUTES.DASHBOARD,
                    exact: true,
                    component: FilterRoute({
                        component: React.lazy(() => import('@root/pages/dashboard/customer/dashboard')),
                        routeRole: 'customer'
                    }),
                },
                {
                    path: ROUTES.DASHBOARD_MANAGE_ADDRESS,
                    component: FilterRoute({
                        component: React.lazy(() => import('@root/pages/dashboard/customer/address')),
                        routeRole: 'customer'
                    })
                },
                {
                    path: ROUTES.PROFILE,
                    component: FilterRoute({
                        component: React.lazy(() => import('@root/pages/dashboard/profile-update'))
                    })
                },
                {
                    path: ROUTES.HELP_N_SUPPORT,
                    component: FilterRoute({
                        component: React.lazy(() => import('@root/pages/dashboard/help-support'))
                    })
                },
            ]
        },
        // seller dashboard routes
        {
            path: ROUTES.SELLER_DASHBOARD,
            component: FilterRoute({
                component: DashboardLayout,
                routeRole: 'seller',
                isProtected: true
            }),
            routes: [
                {
                    path: ROUTES.SELLER_DASHBOARD,
                    exact: true,
                    component: FilterRoute({
                        component: React.lazy(() => import('@root/pages/dashboard/seller/dashboard'))
                    }),
                },
                {
                    path: ROUTES.SELLER_MANAGE_SHOPS,
                    exact: true,
                    component: FilterRoute({
                        component: React.lazy(() => import('@root/pages/dashboard/seller/manage-shops'))
                    }),
                },
                {
                    path: ROUTES.SELLER_SHOP_DETAIL,
                    exact: true,
                    component: FilterRoute({
                        component: React.lazy(() => import('@root/pages/dashboard/seller/manage-shops/shop-detail'))
                    }),
                },
                {
                    path: ROUTES.SELLER_RFQ,
                    exact: true,
                    component: FilterRoute({
                        component: React.lazy(() => import('@root/pages/dashboard/seller/rfq'))
                    }),
                },
                {
                    path: ROUTES.SELLER_ORDERS,
                    exact: true,
                    component: FilterRoute({
                        component: React.lazy(() => import('@root/pages/dashboard/seller/orders'))
                    }),
                },
                {
                    path: ROUTES.SELLER_PRODUCTS,
                    exact: true,
                    component: FilterRoute({
                        component: React.lazy(() => import('@root/pages/dashboard/seller/products'))
                    }),
                },
            ]
        },
        {
            path: ROUTES.HOME,
            component: HomepageLayout,
            routes: [
                {
                    path: ROUTES.HOME,
                    exact: true,
                    component: Homepage
                }
            ]
        }
    ];

    return renderRoutes(routes);
};
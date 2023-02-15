// routes should never start with /seller or /admin
// because they're reserved route in laravel

export const ROUTES: Record<string, string> = {
    HOME: '/',

    // customer routes
    DASHBOARD: '/dashboard',
    DASHBOARD_MANAGE_ADDRESS: '/dashboard/manage-address',
    PROFILE: '/dashboard/profile',
    HELP_N_SUPPORT: '/dashboard/help-support',

    // seller routes
    SELLER_DASHBOARD: '/s/dashboard',
    SELLER_MANAGE_SHOPS: '/s/dashboard/manage-shops',
    SELLER_SHOP_DETAIL: '/s/dashboard/manage-shops/:id',
    SELLER_RFQ: '/s/dashboard/rfq',
    SELLER_ORDERS: '/s/dashboard/orders',
    SELLER_PRODUCTS: '/s/dashboard/products'
};

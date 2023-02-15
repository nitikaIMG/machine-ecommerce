import * as React from 'react';
import { useLocation, NavLink } from 'react-router-dom';
import { asset } from '@root/utils/helpers';
import { ROUTES } from '@root/routes.const';

export const DashboardLayoutSellerAside = () => {

    return (
        <aside className="card">
            <ul className="side-nav">
                <li>
                    <NavLink to={ROUTES.SELLER_DASHBOARD} exact activeClassName="active">
                        <i className="icon">
                            <img src={asset("images/menu-icon/home.png")} alt="" className="icon-img" />
                            <img src={asset("images/menu-icon/home-hover.png")} alt="" className="icon-hover" />
                        </i>
                        Home
                    </NavLink>
                </li>
                <li>
                    <NavLink to={ROUTES.PROFILE} exact activeClassName="active">
                        <i className="icon">
                            <img src={asset("images/menu-icon/order.png")} alt="" className="icon-img" />
                            <img src={asset("images/menu-icon/order-hover.png")} alt="" className="icon-hover" />
                        </i>
                        Edit Profile
                    </NavLink>
                </li>
                <li>
                    <NavLink to={ROUTES.SELLER_MANAGE_SHOPS} exact activeClassName="active">
                        <i className="icon">
                            <img src={asset("images/menu-icon/shop.png")} alt="" className="icon-img" />
                            <img src={asset("images/menu-icon/shop-hover.png")} alt="" className="icon-hover" />
                        </i>
                        Manage Shops
                    </NavLink>
                </li>
                <li>
                    <NavLink to={ROUTES.SELLER_ORDERS} exact activeClassName="active">
                        <i className="icon">
                            <img src={asset("images/menu-icon/order.png")} alt="" className="icon-img" />
                            <img src={asset("images/menu-icon/order-hover.png")} alt="" className="icon-hover" />
                        </i>
                        Orders
                    </NavLink>
                </li>
                <li>
                    <NavLink to={ROUTES.SELLER_RFQ} exact activeClassName="active">
                        <i className="icon">
                            <img src={asset("images/menu-icon/rfq.png")} alt="" className="icon-img" />
                            <img src={asset("images/menu-icon/rfq-hover.png")} alt="" className="icon-hover" />
                        </i>
                        RFQs
                    </NavLink>
                </li>
                <li>
                    <NavLink to={ROUTES.SELLER_PRODUCTS} exact activeClassName="active">
                        <i className="icon">
                            <img src={asset("images/menu-icon/shop.png")} alt="" className="icon-img" />
                            <img src={asset("images/menu-icon/shop-hover.png")} alt="" className="icon-hover" />
                        </i>
                        Products
                    </NavLink>
                </li>
                <li>
                    <NavLink to={ROUTES.HELP_N_SUPPORT} exact activeClassName="active">
                        <i className="icon">
                            <img src={asset("images/menu-icon/shop.png")} alt="" className="icon-img" />
                            <img src={asset("images/menu-icon/shop-hover.png")} alt="" className="icon-hover" />
                        </i>
                        Help and Support
                    </NavLink>
                </li>
            </ul>
        </aside>

    );
};
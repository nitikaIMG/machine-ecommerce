import * as React from 'react';
import { useLocation, NavLink } from 'react-router-dom';
import { asset } from '@root/utils/helpers';
import { ROUTES } from '@root/routes.const';

export const DashboardLayoutCustomerAside = () => {

    return (
        <aside className="card">
            <ul className="side-nav">
                <li>
                    <NavLink to={ROUTES.DASHBOARD} exact activeClassName="active">
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
                            <img src={asset("images/menu-icon/shop.png")} alt="" className="icon-img" />
                            <img src={asset("images/menu-icon/shop-hover.png")} alt="" className="icon-hover" />
                        </i>
                        Edit Profile
                    </NavLink>
                </li>
                <li>
                    <NavLink to={ROUTES.DASHBOARD_MANAGE_ADDRESS} activeClassName="active">
                        <i className="icon">
                            <img src={asset("images/menu-icon/home.png")} alt="" className="icon-img" />
                            <img src={asset("images/menu-icon/home-hover.png")} alt="" className="icon-hover" />
                        </i>
                        Manage Addresses
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
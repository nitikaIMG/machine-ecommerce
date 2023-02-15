import * as React from 'react';
import { ROUTES } from '@root/routes.const';
import { useAuthActions, useAuthUser } from '@root/store/auth/auth.context';
import { NavDropdown, Spinner } from 'react-bootstrap';
import { Link } from 'react-router-dom';
import { useModalActions } from '@root/components/ui/modal/modal.context';
import { asset } from '@root/utils/helpers';
import { useHistory } from 'react-router-dom';
import { useUpdateSettingsMutation } from '@root/rest/user/settings.query';

export const UserDropDown = () => {

    const { user, isLoading } = useAuthUser();
    const { logoutAction, loginAction } = useAuthActions();
    const { openModal } = useModalActions();

    const { mutate: updateSettings, isLoading: isUpdatingSettings } =
        useUpdateSettingsMutation();

    const history = useHistory();

    const [notifActive, setNotifActive] = React.useState(false);

    const isSeller = user?.type === 'seller';
    const notifAllowed = (!isLoading && user?.settings)
        ? user.settings.allow_notification
        : false;

    React.useEffect(() => {
        setNotifActive(notifAllowed);
    }, [notifAllowed]);

    const notifUpdate = () => {
        setNotifActive(n => !n);
        updateSettings({
            allow_notification: notifAllowed ? 1 : 0
        });
    };

    return (
        <>
            {user ? (
                <NavDropdown title={user.name ?? 'Menu'}>
                    <div style={{ marginTop: '-12px', marginBottom: '-12px' }} className="profile-dropdown">
                        <NavDropdown.Item href="">
                            <div className="profile-blk border-0 pb-0">
                                <div className="left">
                                    <p className="name">{user.name ?? '(no name)'}</p>
                                    <p className="email">{user.email}</p>
                                    <p className="phone">{user.phone}</p>
                                </div>
                                <div className="right">
                                    <button
                                        onClick={() => history.push(ROUTES.PROFILE)}
                                        type="button"
                                        className="edit"
                                    >
                                        Edit
                                    </button>
                                </div>
                                {isSeller ? (
                                    <button
                                        onClick={() => history.push(ROUTES.SELLER_MANAGE_SHOPS)}
                                        type="button"
                                        className="manage-shop btn btn-sm btn-primary">
                                        <i className="icon">
                                            <img src={asset("images/manageshop-icon.png")} alt="" />
                                        </i>
                                        <span>Manage Shop</span>
                                    </button>
                                ) : null}
                            </div>
                        </NavDropdown.Item>
                        <NavDropdown.Item href="">
                            <span>
                                <i className="icon">
                                    <img src={asset("images/dropdown-icon/notification.png")} alt="" />
                                </i>
                                Notification
                            </span>
                            <div className="switch-btn">
                                <label className="switch" onClick={(e) => {
                                    e.stopPropagation();
                                }}>
                                    <input
                                        onChange={(e) => notifUpdate()}
                                        value="1"
                                        type="checkbox"
                                        checked={notifActive} />
                                    <span className="slider round" />
                                </label>
                            </div>
                        </NavDropdown.Item>
                        {!isSeller ? (
                            <NavDropdown.Item
                                onClick={() => history.push(ROUTES.DASHBOARD_MANAGE_ADDRESS)}
                            >
                                <i className="icon">
                                    <img src={asset("images/dropdown-icon/address.png")} alt="" />
                                </i>
                                Manage Address
                            </NavDropdown.Item>
                        ) : (
                            <NavDropdown.Item
                                onClick={() => history.push(ROUTES.SELLER_MANAGE_SHOPS)}
                            >
                                <i className="icon">
                                    <img src={asset("images/dropdown-icon/address.png")} alt="" />
                                </i>
                                Manage Shops
                            </NavDropdown.Item>
                        )}
                        {/* <NavDropdown.Item href="">
                            <span>
                                <i className="icon">
                                    <img src={asset("images/dropdown-icon/permission.png")} alt="" />
                                </i>
                                Access Permission
                            </span>
                            <div className="switch-btn">
                                <label className="switch">
                                    <input type="checkbox" />
                                    <span className="slider round" />
                                </label>
                            </div>
                        </NavDropdown.Item> */}
                        <NavDropdown.Item href="">
                            <i className="icon">
                                <img src={asset("images/dropdown-icon/about.png")} alt="" />
                            </i>
                            About us
                        </NavDropdown.Item>
                        <NavDropdown.Item href="">
                            <i className="icon">
                                <img src={asset("images/dropdown-icon/language.png")} alt="" />
                            </i>
                            Language
                        </NavDropdown.Item>
                        <NavDropdown.Item href="">
                            <i className="icon">
                                <img src={asset("images/dropdown-icon/country.png")} alt="" />
                            </i>
                            Country
                        </NavDropdown.Item>
                        <NavDropdown.Item href="">
                            <i className="icon">
                                <img src={asset("images/dropdown-icon/help.png")} alt="" />
                            </i>
                            Help &amp; Support
                        </NavDropdown.Item>
                        <NavDropdown.Item
                            href=""
                            onClick={(e) => {
                                e.preventDefault();
                                logoutAction();
                            }}
                        >
                            <i className="icon">
                                <img src={asset("images/dropdown-icon/log-out.png")} alt="" />
                            </i>
                            Logout
                        </NavDropdown.Item>
                    </div>
                </NavDropdown>
            ) : isLoading ? (
                <Spinner
                    as="span"
                    animation="border"
                    size="sm"
                    role="status"
                    aria-hidden="true"
                />
            ) : (
                <button
                    className="nav-link btn-to-link"
                    onClick={(e) => {
                        e.preventDefault();
                        !isLoading && openModal('LOGIN');
                    }}
                >
                    <i className="icon">
                        <img src={asset("images/dropdown-icon/user.png")} alt="" />
                    </i>
                    Login / Signup
                </button>
            )}
        </>
    );
};
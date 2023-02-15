import * as React from 'react';
import { asset } from '@root/utils/helpers';
import { UserDropDown } from './ui/user-dropdown';
import { NotificationDropDown } from './ui/notification-dropdown';
import { MessagesDropDown } from './ui/messages-dropdown';

const Header = () => {

    return (
        <div className="container-fluid menu-bar">
            <div className="container">
                <div className="row">
                    <div className="col-md-12">
                        <nav className="navbar navbar-expand-lg">
                            <div className="container-fluid">
                                <a className="navbar-brand" href="#">
                                    <img src={asset("images/machine-logo.png")} alt="Machine Enquiry" />
                                </a>
                                <button
                                    className="navbar-toggler"
                                    type="button"
                                    aria-label="Toggle navigation"
                                >
                                    <span className="navbar-toggler-icon" />
                                </button>
                                <div
                                    className="collapse navbar-collapse"
                                    id="navbarSupportedContent"
                                >
                                    <div className="d-flex ms-auto select-wrap">
                                        <select name="" id="" className="select">
                                            <option value="">Abu Dhabi</option>
                                        </select>
                                    </div>
                                    <form className="d-flex ms-auto serach-wrap">
                                        <input
                                            className="form-control me-2"
                                            type="search"
                                            placeholder="Search"
                                            aria-label="Search"
                                        />
                                        <button className="btn btn-outline-success" type="submit">
                                            Search
                                        </button>
                                    </form>
                                    <ul className="navbar-nav ms-auto mb-2 mb-lg-0 profile-nav">
                                        <li className="nav-item dropdown store-nav">
                                            <a
                                                className="nav-link"
                                                href="#"
                                                id="navbarDropdown"
                                                role="button"
                                                data-bs-toggle="dropdown"
                                                aria-expanded="false"
                                            >
                                                <img
                                                    src="images/house-icon.png"
                                                    alt=""
                                                    className="img-fluid"
                                                />
                                            </a>
                                            <ul
                                                className="dropdown-menu"
                                                aria-labelledby="navbarDropdown"
                                            >
                                                <li>
                                                    <a className="dropdown-item" href="#">
                                                        Action
                                                    </a>
                                                </li>
                                                <li>
                                                    <a className="dropdown-item" href="#">
                                                        Another action
                                                    </a>
                                                </li>
                                                <li>
                                                    <hr className="dropdown-divider" />
                                                </li>
                                                <li>
                                                    <a className="dropdown-item" href="#">
                                                        Something else here
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li className="nav-item dropdown message-nav">
                                            <MessagesDropDown />
                                        </li>
                                        <li className="nav-item dropdown notification-nav">
                                           <NotificationDropDown />
                                        </li>
                                        <li className="nav-item dropdown profile-nav">
                                            <a
                                                className="nav-link"
                                                href="#"
                                                id="navbarDropdown"
                                                role="button"
                                                data-bs-toggle="dropdown"
                                                aria-expanded="false"
                                            >
                                                <img
                                                    src="images/profie-icon.png"
                                                    alt=""
                                                    className="img-fluid"
                                                />
                                            </a>
                                        </li>
                                        <li className="nav-item dropdown quick-nav">
                                            <UserDropDown />
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

    );
}

export default Header;
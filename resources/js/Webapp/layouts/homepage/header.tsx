import * as React from 'react';
import { asset } from '@root/utils/helpers';
import { useModalActions } from '@root/components/ui/modal/modal.context';
import { useAuthActions, useAuthUser } from '@root/store/auth/auth.context';
import { UserDropDown } from '@root/layouts/ui/user-dropdown';

const HomepageHeader = () => {

    const { openModal } = useModalActions();
    const { user, isLoading } = useAuthUser();
    const { logoutAction } = useAuthActions();
    
    return (
        <div className="menu-bar home-page">
            <div className="border-bottom">
                <div className="container max-1170">
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
                                        data-bs-toggle="collapse"
                                        data-bs-target="#navbarSupportedContent"
                                        aria-controls="navbarSupportedContent"
                                        aria-expanded="false"
                                        aria-label="Toggle navigation"
                                    >
                                        <span className="navbar-toggler-icon" />
                                    </button>
                                    <div
                                        className="collapse navbar-collapse"
                                        id="navbarSupportedContent"
                                    >
                                        <ul className="navbar-nav ms-auto mb-2 mb-lg-0 profile-nav">
                                            
                                            { user && user.type === 'seller' ? (
                                                <li className="nav-item">
                                                    <a
                                                        className="nav-link"
                                                        href="#"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#shop-location"
                                                    >
                                                        Add Shop
                                                    </a>
                                                </li>
                                            ) : null }

                                            { !user ? (
                                                <>
                                                    {/* <li className="nav-item">
                                                        <a
                                                            className="nav-link"
                                                            href="#"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#reset-password"
                                                        >
                                                            Reset Password
                                                        </a>
                                                    </li>
                                                    <li className="nav-item">
                                                        <a
                                                            className="nav-link"
                                                            href=""
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#create-new-account"
                                                        >
                                                            Create New Account
                                                        </a>
                                                    </li> */}
                                                </>
                                            ) : null }

                                            <li className="nav-item">
                                                <UserDropDown />
                                            </li>
                                            
                                            <li className="nav-item">
                                                <a className="nav-link get-app" href="#">
                                                    Get the App
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div className="search-section">
                <div className="container max-1170">
                    <div className="row">
                        <div className="col-md-12">
                            <div className="up-logo">
                                <img src="images/machine-logo.png" alt="" />
                            </div>
                            <h1 className="title">
                                Buying online on the local market has never been easier.{" "}
                            </h1>
                        </div>
                        <div className="col-md-12">
                            <div className="header-search">
                                <select name="" id="" className="select">
                                    <option value="">Mina Al Arab, AI Riffa</option>
                                </select>
                                <div className="search-wrapper">
                                    <input
                                        type="text"
                                        className="form-control"
                                        placeholder="Search here"
                                    />
                                    <button className="serach-btn">Search</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default HomepageHeader;

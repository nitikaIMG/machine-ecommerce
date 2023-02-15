import * as React from 'react';
import { NavDropdown, Spinner } from 'react-bootstrap';
import { asset } from '@root/utils/helpers';

const icon = (
    <>
        <img
            src={asset("images/notification-icon.png")}
            alt="notification-icon"
            className="img-fluid"
        />
        <span className="badge">2</span>
    </>
);


export const NotificationDropDown = () => {
    return (
        <>
            <NavDropdown title={icon} role="button">
                <NavDropdown.Header>
                    <div className="d-flex align-items-center justify-content-between">
                        <span className="fw-bold">Notification</span>
                        <button type="button" className="bg-dark">
                            <img src={asset("images/notification-dots.png")} alt="notification-dots" />
                        </button>
                    </div>
                </NavDropdown.Header>
                <NavDropdown.Item>
                    <span className="text">
                        Excepteur sint occaecat cupidatat
                    </span>
                    <span className="minutes">2mins</span>
                </NavDropdown.Item>
                <NavDropdown.Item>
                    <span className="text">
                        Excepteur sint occaecat cupidatat
                    </span>
                    <span className="minutes">2mins</span>
                </NavDropdown.Item>
            </NavDropdown>
        </>
    );
};
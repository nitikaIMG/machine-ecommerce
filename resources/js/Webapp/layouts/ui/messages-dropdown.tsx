import * as React from 'react';
import { NavDropdown, Spinner } from 'react-bootstrap';
import { asset } from '@root/utils/helpers';

const chatIcon = (
    <img
        src={asset("images/chat-icon.png")}
        alt="chat-icon"
        className="img-fluid"
    />
);

export const MessagesDropDown = () => {
    return (
        <>
            <NavDropdown title={chatIcon} role="button" className="message-nav">
                <NavDropdown.Item>
                    Ibrahim: so when can you ship the product?
                </NavDropdown.Item>
                <NavDropdown.Item>
                    Irshad: there's one problem with this product.
                </NavDropdown.Item>
                <NavDropdown.Item>
                    Kumar: Hello
                </NavDropdown.Item>
            </NavDropdown>
        </>
    );
};
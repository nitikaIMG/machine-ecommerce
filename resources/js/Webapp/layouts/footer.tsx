import * as React from 'react';

const Footer = () => {
    return (
        <>
            <footer className="container-fluid">
                <div className="container max-1170">
                    <div className="row">
                        <div className="col-sm-12 col-md-6 col-lg-3">
                            <div className="ftr-hd">About Upshop</div>
                            <p className="text">
                                Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut
                                fugit, sed quia consequuntur magni dolores eos qui ratione
                                voluptatem sequi nesciunt.
                            </p>
                        </div>
                        <div className="col-sm-12 col-md-6 col-lg-3">
                            <div className="ftr-hd">Quick Links</div>
                            <ul className="ftr-links">
                                <li>
                                    <a href="">About Us</a>
                                </li>
                                <li>
                                    <a href="">Contact</a>
                                </li>
                                <li>
                                    <a href="">Add Shop</a>
                                </li>
                                <li>
                                    <a href="">Download the App</a>
                                </li>
                                <li>
                                    <a href="">Term and Conditions</a>
                                </li>
                            </ul>
                        </div>
                        <div className="col-sm-12 col-md-6 col-lg-3">
                            <div className="ftr-hd">Contact Us</div>
                            <ul className="address">
                                <li>
                                    <i className="fa fa-map-marker" />{" "}
                                    <span>
                                        3 Newbridge Court Chino Hills, CA91709, United Arab Emirates
                                    </span>
                                </li>
                                <li>
                                    <i className="fa fa-phone" /> <span>987 654 3210</span>
                                </li>
                                <li>
                                    <i className="fa fa-envelope" /> <span>info@upshop.com</span>
                                </li>
                            </ul>
                        </div>
                        <div className="col-sm-12 col-md-6 col-lg-3">
                            <div className="ftr-hd">Subscribe</div>
                            <form action="" className="news-letter">
                                <input type="text" />
                                <button className="send-btn" />
                            </form>
                            <ul className="social-media">
                                <li>
                                    <a href="">
                                        <i className="fa fa-facebook" />
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <i className="fa fa-twitter" />
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <i className="fa fa-linkedin" />
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <i className="fa fa-youtube" />
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
            <div className="footer-rights">
                <p>Copyright © 2022 UpShop. All rights reserved.</p>
            </div>
        </>
    );
}

export default Footer;

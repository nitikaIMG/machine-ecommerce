import * as React from 'react';

export default () => {
    return (
        <section className="categorie">
            <div className="container max-1170">
                <div className="row">
                    <div className="col-md-6">
                        <div className="title">Categories</div>
                    </div>
                    <div className="col-md-6 text-end">
                        <a href="" className="view-all">
                            View all
                        </a>
                    </div>
                </div>
                <div className="row">
                    <div className="col-md-4 col-sm-6 col-xs-12">
                        <div className="fav-bock">
                            <figure>
                                <img
                                    src="images/categories/automobiles.jpg"
                                    alt=""
                                    className="img-fluid"
                                />
                            </figure>
                            <div className="content">
                                <p className="name">Automobiles</p>
                                <p className="description">Excepteur sint occaecat cupidatat</p>
                            </div>
                        </div>
                    </div>
                    <div className="col-md-4 col-sm-6 col-xs-12">
                        <div className="fav-bock">
                            <figure>
                                <img
                                    src="images/categories/electricals.jpg"
                                    alt=""
                                    className="img-fluid"
                                />
                            </figure>
                            <div className="content">
                                <p className="name">Electricals</p>
                                <p className="description">Excepteur sint occaecat cupidatat</p>
                            </div>
                        </div>
                    </div>
                    <div className="col-md-4 col-sm-6 col-xs-12">
                        <div className="fav-bock">
                            <figure>
                                <img
                                    src="images/categories/hydraulics.jpg"
                                    alt=""
                                    className="img-fluid"
                                />
                            </figure>
                            <div className="content">
                                <p className="name">Hydraulics</p>
                                <p className="description">Excepteur sint occaecat cupidatat</p>
                            </div>
                        </div>
                    </div>
                    <div className="col-md-4 col-sm-6 col-xs-12">
                        <div className="fav-bock">
                            <figure>
                                <img
                                    src="images/categories/safety-tools.jpg"
                                    alt=""
                                    className="img-fluid"
                                />
                            </figure>
                            <div className="content">
                                <p className="name">Safety &amp; Tools</p>
                                <p className="description">Excepteur sint occaecat cupidatat</p>
                            </div>
                        </div>
                    </div>
                    <div className="col-md-4 col-sm-6 col-xs-12">
                        <div className="fav-bock">
                            <figure>
                                <img
                                    src="images/categories/plumbing.jpg"
                                    alt=""
                                    className="img-fluid"
                                />
                            </figure>
                            <div className="content">
                                <p className="name">Plumbing</p>
                                <p className="description">Excepteur sint occaecat cupidatat</p>
                            </div>
                        </div>
                    </div>
                    <div className="col-md-4 col-sm-6 col-xs-12">
                        <div className="fav-bock">
                            <figure>
                                <img
                                    src="images/categories/hardware-tools.jpg"
                                    alt=""
                                    className="img-fluid"
                                />
                            </figure>
                            <div className="content">
                                <p className="name">Hardware Tools</p>
                                <p className="description">Excepteur sint occaecat cupidatat</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
};
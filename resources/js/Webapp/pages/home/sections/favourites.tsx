import * as React from "react";
import { useAuthUser } from "@root/store/auth/auth.context";

export default () => {
    const { user } = useAuthUser();

    if( !user ) {
        return null;
    }

    return (
        <section className="favourites">
            <div className="container max-1170">
                <div className="row">
                    <div className="col-md-6">
                        <div className="title">Store Favourites</div>
                    </div>
                    <div className="col-md-6 text-end">
                        <a href="" className="view-all">
                            View all
                        </a>
                    </div>
                </div>
                <div className="row">
                    <div className="col-6 col-md-2">
                        <div className="fav-bock">
                            <figure>
                                <img
                                    src="images/favourites/edison.png"
                                    alt=""
                                    className="img-fluid"
                                />
                            </figure>
                            <p className="name">Edison Electricals</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
};
import * as React from 'react';
import ProductListItem from './product-list-item';

const ProductList = () => {
    
    return (
        <div className="row">
            <div className="col-md-12">
                <div className="card p30" id="myTab">
                    <div className="header">
                        <div className="row">
                            <div className="col-md-6">
                                <div className="title">Products</div>
                            </div>
                            <div className="col-md-6">
                                <div className="select-all">
                                    <input type="checkbox" />
                                    <label>Select all</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className="row">
                        <div className="col-md-12">
                            <div className="table-repsponsive th-auto">
                                <table className="table">
                                    <thead>
                                        <tr>
                                            <th />
                                            <th>Product Name</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody className="max-height600">
                                        <ProductListItem />
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default ProductList;
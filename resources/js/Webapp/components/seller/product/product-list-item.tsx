import * as React from 'react';

const ProductListItem = () => {
    return (
        <tr>
            <td>
                <input type="checkbox" />
            </td>
            <td>
                <div className="product-name-image">
                    <img src="images/product-image.png" alt="" />{" "}
                    <span className="name">Philips 125W HPI</span>
                </div>
            </td>
            <td>
                <div className="price-blk">
                    <label>AED</label>
                    <input type="text" defaultValue="25.56" />
                </div>
            </td>
        </tr>
    );
};

export default ProductListItem;
import * as React from 'react';
import { t } from '@root/utils/helpers';
import { Shop } from '@root/types/models';
import { Link } from 'react-router-dom';
import { ROUTES } from '@root/routes.const'

type ShopListItemType = {
    shop: Shop
};

const ShopListItem: React.FC<ShopListItemType> = ({ shop }) => {

    return (
        <div className="card p30" id="myTab">
            <div className="header">
                <div className="row">
                    <div className="col-md-6">
                        <Link to={`/s/dashboard/manage-shops/${shop.id}`}>
                            <div className="title"> {t('Shop')} #{shop.id}</div>
                            <div className="shop-name">{shop.shop_name}</div>
                        </Link>
                    </div>
                    <div className="col-md-6">
                        <div className="float-md-end">
                            <div className="shop-categories">
                                Category: {' '}
                                {shop?.categories?.map(c => c.title)?.join(', ')}
                            </div>
                            <div className="shop-date">
                                Date from: 15 Feb 2022 to 15 Feb 2022
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div className="row">
                <div className="col-md-6 col-lg-3">
                    <div className="shop-block">
                        <div className="ttl">Quote</div>
                        <table>
                            <tbody>
                                <tr className="border-wht">
                                    <td>New</td>
                                    <td>In Progress</td>
                                    <td>Closed</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>5</td>
                                    <td>18</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div className="col-md-6 col-lg-3">
                    <div className="shop-block">
                        <div className="ttl">Orders</div>
                        <table>
                            <tbody>
                                <tr className="border-wht">
                                    <td>New</td>
                                    <td>In Progress</td>
                                    <td>Closed</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>5</td>
                                    <td>18</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div className="col-md-6 col-lg-3">
                    <div className="shop-block">
                        <div className="ttl">Closed Orders</div>
                        <table>
                            <tbody>
                                <tr className="border-wht">
                                    <td>Pickup</td>
                                    <td>Delivery</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>6</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div className="col-md-6 col-lg-3">
                    <div className="shop-block">
                        <div className="ttl">Products</div>
                        <table cellSpacing={2}>
                            <tbody>
                                <tr className="border-wht">
                                    <td>Active</td>
                                    <td>On Sale</td>
                                </tr>
                                <tr>
                                    <td>150</td>
                                    <td>20</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default ShopListItem;
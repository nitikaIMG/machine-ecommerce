import * as React from 'react';

const RFQ = () => {

    return (
        <div className="row">
            <div className="col-md-12">
                <div className="card p30" id="myTab">
                    <div className="header">
                        <div className="row">
                            <div className="col-md-4 col-lg-5">
                                <div className="title">Request For Quote</div>
                            </div>
                            <div className="col-md-8 col-lg-7">
                                <ul className="nav nav-tabs accordion" role="tablist">
                                    <li className="nav-item" role="presentation">
                                        <button
                                            className="nav-link active"
                                            id="News-tab"
                                            data-bs-toggle="tab"
                                            data-bs-target="#News"
                                            type="button"
                                            role="tab"
                                            aria-controls="News"
                                            aria-selected="true"
                                        >
                                            New
                                        </button>
                                    </li>
                                    <li className="nav-item" role="presentation">
                                        <button
                                            className="nav-link"
                                            id="completed-tab"
                                            data-bs-toggle="tab"
                                            data-bs-target="#completed"
                                            type="button"
                                            role="tab"
                                            aria-controls="completed"
                                            aria-selected="false"
                                        >
                                            In progress
                                        </button>
                                    </li>
                                    <li className="nav-item" role="presentation">
                                        <button
                                            className="nav-link"
                                            id="Cancelled-tab"
                                            data-bs-toggle="tab"
                                            data-bs-target="#Cancelled"
                                            type="button"
                                            role="tab"
                                            aria-controls="Cancelled"
                                            aria-selected="false"
                                        >
                                            Closed
                                        </button>
                                    </li>
                                    <li className="nav-item" role="presentation">
                                        <select name="" id="" className="sort">
                                            <option value="">Sort by Date</option>
                                        </select>
                                    </li>
                                    <li className="nav-item" role="presentation">
                                        <select name="" id="" className="sort">
                                            <option value="">Sort by Price</option>
                                        </select>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div className="tab-content" id="myTabContent">
                        <div
                            className="tab-pane fade show active"
                            id="News"
                            role="tabpanel"
                            aria-labelledby="News-tab"
                        >
                            <div className="table-responsive">
                                <table className="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Request ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Price</th>
                                            <th scope="col" className="text-center">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1194586</td>
                                            <td>Adnan Khan</td>
                                            <td>15-02-2022</td>
                                            <td>AED 25.56</td>
                                            <td>
                                                <a href="" className="accept">
                                                    Accept
                                                </a>
                                                <a href="" className="deny">
                                                    Deny
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>194586</td>
                                            <td>Adnan Khan</td>
                                            <td>15-02-2022</td>
                                            <td>AED 25.56</td>
                                            <td>
                                                <a href="" className="accept">
                                                    Accept
                                                </a>
                                                <a href="" className="deny">
                                                    Deny
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>194586</td>
                                            <td>Adnan Khan</td>
                                            <td>15-02-2022</td>
                                            <td>AED 25.56</td>
                                            <td>
                                                <a href="" className="accept">
                                                    Accept
                                                </a>
                                                <a href="" className="deny">
                                                    Deny
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>194586</td>
                                            <td>Adnan Khan</td>
                                            <td>15-02-2022</td>
                                            <td>AED 25.56</td>
                                            <td>
                                                <a href="" className="accept">
                                                    Accept
                                                </a>
                                                <a href="" className="deny">
                                                    Deny
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>194586</td>
                                            <td>Adnan Khan</td>
                                            <td>15-02-2022</td>
                                            <td>AED 25.56</td>
                                            <td>
                                                <a href="" className="accept">
                                                    Accept
                                                </a>
                                                <a href="" className="deny">
                                                    Deny
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>194586</td>
                                            <td>Adnan Khan</td>
                                            <td>15-02-2022</td>
                                            <td>AED 25.56</td>
                                            <td>
                                                <a href="" className="accept">
                                                    Accept
                                                </a>
                                                <a href="" className="deny">
                                                    Deny
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>194586</td>
                                            <td>Adnan Khan</td>
                                            <td>15-02-2022</td>
                                            <td>AED 25.56</td>
                                            <td>
                                                <a href="" className="accept">
                                                    Accept
                                                </a>
                                                <a href="" className="deny">
                                                    Deny
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>194586</td>
                                            <td>Adnan Khan</td>
                                            <td>15-02-2022</td>
                                            <td>AED 25.56</td>
                                            <td>
                                                <a href="" className="accept">
                                                    Accept
                                                </a>
                                                <a href="" className="deny">
                                                    Deny
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>194586</td>
                                            <td>Adnan Khan</td>
                                            <td>15-02-2022</td>
                                            <td>AED 25.56</td>
                                            <td>
                                                <a href="" className="accept">
                                                    Accept
                                                </a>
                                                <a href="" className="deny">
                                                    Deny
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>194586</td>
                                            <td>Adnan Khan</td>
                                            <td>15-02-2022</td>
                                            <td>AED 25.56</td>
                                            <td>
                                                <a href="" className="accept">
                                                    Accept
                                                </a>
                                                <a href="" className="deny">
                                                    Deny
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div
                            className="tab-pane fade"
                            id="completed"
                            role="tabpanel"
                            aria-labelledby="completed-tab"
                        >
                            <div className="table-responsive">
                                <table className="table in-progress">
                                    <thead>
                                        <tr>
                                            <th scope="col">Request ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Quote Price</th>
                                            <th scope="col" className="text-center">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1194586</td>
                                            <td>Adnan Khan</td>
                                            <td>15-02-2022</td>
                                            <td>AED 25.56</td>
                                            <td>AED 25.56</td>
                                            <td>
                                                <a href="" className="deny">
                                                    <img src="images/chat-icon-btn.png" alt="" />
                                                    Chat
                                                </a>
                                                <a href="" className="deny">
                                                    Details
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>194586</td>
                                            <td>Adnan Khan</td>
                                            <td>15-02-2022</td>
                                            <td>AED 25.56</td>
                                            <td>AED 25.56</td>
                                            <td>
                                                <a href="" className="deny">
                                                    <img src="images/chat-icon-btn.png" alt="" />
                                                    Chat
                                                </a>
                                                <a href="" className="deny">
                                                    Details
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>194586</td>
                                            <td>Adnan Khan</td>
                                            <td>15-02-2022</td>
                                            <td>AED 25.56</td>
                                            <td>AED 25.56</td>
                                            <td>
                                                <a href="" className="deny">
                                                    <img src="images/chat-icon-btn.png" alt="" />
                                                    Chat
                                                </a>
                                                <a href="" className="deny">
                                                    Details
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>194586</td>
                                            <td>Adnan Khan</td>
                                            <td>15-02-2022</td>
                                            <td>AED 25.56</td>
                                            <td>AED 25.56</td>
                                            <td>
                                                <a href="" className="deny">
                                                    <img src="images/chat-icon-btn.png" alt="" />
                                                    Chat
                                                </a>
                                                <a href="" className="deny">
                                                    Details
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>194586</td>
                                            <td>Adnan Khan</td>
                                            <td>15-02-2022</td>
                                            <td>AED 25.56</td>
                                            <td>AED 25.56</td>
                                            <td>
                                                <a href="" className="deny">
                                                    <img src="images/chat-icon-btn.png" alt="" />
                                                    Chat
                                                </a>
                                                <a href="" className="deny">
                                                    Details
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>194586</td>
                                            <td>Adnan Khan</td>
                                            <td>15-02-2022</td>
                                            <td>AED 25.56</td>
                                            <td>AED 25.56</td>
                                            <td>
                                                <a href="" className="deny">
                                                    <img src="images/chat-icon-btn.png" alt="" />
                                                    Chat
                                                </a>
                                                <a href="" className="deny">
                                                    Details
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>194586</td>
                                            <td>Adnan Khan</td>
                                            <td>15-02-2022</td>
                                            <td>AED 25.56</td>
                                            <td>AED 25.56</td>
                                            <td>
                                                <a href="" className="deny">
                                                    <img src="images/chat-icon-btn.png" alt="" />
                                                    Chat
                                                </a>
                                                <a href="" className="deny">
                                                    Details
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>194586</td>
                                            <td>Adnan Khan</td>
                                            <td>15-02-2022</td>
                                            <td>AED 25.56</td>
                                            <td>AED 25.56</td>
                                            <td>
                                                <a href="" className="deny">
                                                    <img src="images/chat-icon-btn.png" alt="" />
                                                    Chat
                                                </a>
                                                <a href="" className="deny">
                                                    Details
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>194586</td>
                                            <td>Adnan Khan</td>
                                            <td>15-02-2022</td>
                                            <td>AED 25.56</td>
                                            <td>AED 25.56</td>
                                            <td>
                                                <a href="" className="deny">
                                                    <img src="images/chat-icon-btn.png" alt="" />
                                                    Chat
                                                </a>
                                                <a href="" className="deny">
                                                    Details
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>194586</td>
                                            <td>Adnan Khan</td>
                                            <td>15-02-2022</td>
                                            <td>AED 25.56</td>
                                            <td>AED 25.56</td>
                                            <td>
                                                <a href="" className="deny">
                                                    <img src="images/chat-icon-btn.png" alt="" />
                                                    Chat
                                                </a>
                                                <a href="" className="deny">
                                                    Details
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div
                            className="tab-pane fade"
                            id="Cancelled"
                            role="tabpanel"
                            aria-labelledby="Cancelled-tab"
                        >
                            <div className="table-responsive">
                                <table className="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Request ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Price</th>
                                            <th scope="col" className="text-center">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1194586</td>
                                            <td>Adnan Khan</td>
                                            <td>15-02-2022</td>
                                            <td>AED 25.56</td>
                                            <td className="text-center">
                                                <a href="" className="deny">
                                                    Details
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>194586</td>
                                            <td>Adnan Khan</td>
                                            <td>15-02-2022</td>
                                            <td>AED 25.56</td>
                                            <td className="text-center">
                                                <a href="" className="deny">
                                                    Details
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>194586</td>
                                            <td>Adnan Khan</td>
                                            <td>15-02-2022</td>
                                            <td>AED 25.56</td>
                                            <td className="text-center">
                                                <a href="" className="deny">
                                                    Details
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>194586</td>
                                            <td>Adnan Khan</td>
                                            <td>15-02-2022</td>
                                            <td>AED 25.56</td>
                                            <td className="text-center">
                                                <a href="" className="deny">
                                                    Details
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>194586</td>
                                            <td>Adnan Khan</td>
                                            <td>15-02-2022</td>
                                            <td>AED 25.56</td>
                                            <td className="text-center">
                                                <a href="" className="deny">
                                                    Details
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>194586</td>
                                            <td>Adnan Khan</td>
                                            <td>15-02-2022</td>
                                            <td>AED 25.56</td>
                                            <td className="text-center">
                                                <a href="" className="deny">
                                                    Details
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>194586</td>
                                            <td>Adnan Khan</td>
                                            <td>15-02-2022</td>
                                            <td>AED 25.56</td>
                                            <td className="text-center">
                                                <a href="" className="deny">
                                                    Details
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>194586</td>
                                            <td>Adnan Khan</td>
                                            <td>15-02-2022</td>
                                            <td>AED 25.56</td>
                                            <td className="text-center">
                                                <a href="" className="deny">
                                                    Details
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>194586</td>
                                            <td>Adnan Khan</td>
                                            <td>15-02-2022</td>
                                            <td>AED 25.56</td>
                                            <td className="text-center">
                                                <a href="" className="deny">
                                                    Details
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>194586</td>
                                            <td>Adnan Khan</td>
                                            <td>15-02-2022</td>
                                            <td>AED 25.56</td>
                                            <td className="text-center">
                                                <a href="" className="deny">
                                                    Details
                                                </a>
                                            </td>
                                        </tr>
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

export default RFQ;
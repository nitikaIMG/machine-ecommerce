import * as React from 'react';

export default function CustomerDashboard() {
  return (
    <>
      <div className="row">
        <div className="col-12">
          <div className="card">
            <div className="title">My Favourites</div>
            <div className="row mt-2 gap-2">
              <div className="col">
                <b>Edison Electrical</b>
              </div>
              <div className="col">
                <b>Voltsafe Engineering</b>
              </div>
              <div className="col">
                <b>North Hardware</b>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div className="row">
        <div className="col-md-12">
          <div className="card p30" id="myTab">
            <div className="header">
              <div className="row">
                <div className="col-md-4 col-lg-5">
                  <div className="title">New RFQ's</div>
                </div>
                <div className="col-md-8 col-lg-7">
                  <ul className="nav nav-tabs accordion" role="tablist">
                    <li className="nav-item" role="presentation">
                      <button
                        className="nav-link active"
                        id="New-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#New"
                        type="button"
                        role="tab"
                        aria-controls="New"
                        aria-selected="true"
                      >
                        New
                      </button>
                    </li>
                    <li className="nav-item" role="presentation">
                      <button
                        className="nav-link"
                        id="In-progres-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#In-progres"
                        type="button"
                        role="tab"
                        aria-controls="In-progres"
                        aria-selected="false"
                      >
                        In progres
                      </button>
                    </li>
                    <li className="nav-item" role="presentation">
                      <button
                        className="nav-link"
                        id="Closed-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#Closed"
                        type="button"
                        role="tab"
                        aria-controls="Closed"
                        aria-selected="false"
                      >
                        Closed
                      </button>
                    </li>
                    <li className="nav-item" role="presentation">
                      <button
                        className="nav-link view-all"
                        id="View-All-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#View-All"
                        type="button"
                        role="tab"
                        aria-controls="View-All"
                        aria-selected="false"
                      >
                        View All
                      </button>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div className="tab-content" id="myTabContent">
              <div
                className="tab-pane fade show active"
                id="New"
                role="tabpanel"
                aria-labelledby="New-tab"
              >
                <div className="table-responsive">
                  <table className="table">
                    <thead>
                      <tr>
                        <th scope="col">Request ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">Price</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>Adnan Khan</td>
                        <td>15-02-2022</td>
                        <td>AED 25.56</td>
                        <td>
                          <a href="" className="accept">
                            Accept
                          </a>
                          <a href="" className="deny ms-1">
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
                id="In-progres"
                role="tabpanel"
                aria-labelledby="In-progres-tab"
              >
                <div className="table-responsive">
                  <table className="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                      </tr>
                      <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                      </tr>
                      <tr>
                        <th scope="row">3</th>
                        <td colSpan={2}>Larry the Bird</td>
                        <td>@twitter</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div
                className="tab-pane fade"
                id="Closed"
                role="tabpanel"
                aria-labelledby="Closed-tab"
              >
                <div className="table-responsive">
                  <table className="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                      </tr>
                      <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                      </tr>
                      <tr>
                        <th scope="row">3</th>
                        <td colSpan={2}>Larry the Bird</td>
                        <td>@twitter</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div
                className="tab-pane fade"
                id="View-All"
                role="tabpanel"
                aria-labelledby="View-All-tab"
              >
                <div className="table-responsive">
                  <table className="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                      </tr>
                      <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                      </tr>
                      <tr>
                        <th scope="row">3</th>
                        <td colSpan={2}>Larry the Bird</td>
                        <td>@twitter</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div className="row">
        <div className="col-md-12">
          <div className="card p30" id="myTab">
            <div className="header">
              <div className="row">
                <div className="col-md-4 col-lg-5">
                  <div className="title">New RFQ’s</div>
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
                        Completed
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
                        Cancelled
                      </button>
                    </li>
                    <li className="nav-item" role="presentation">
                      <button
                        className="nav-link view-all"
                        id="View-Alls-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#View-Alls"
                        type="button"
                        role="tab"
                        aria-controls="View-Alls"
                        aria-selected="false"
                      >
                        View All
                      </button>
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
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>194586</td>
                        <td>Adnan Khan</td>
                        <td>AED 25.56</td>
                        <td>
                          <a href="" className="accept">
                            Details
                          </a>
                        </td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>194586</td>
                        <td>Adnan Khan</td>
                        <td>AED 25.56</td>
                        <td>
                          <a href="" className="deny">
                            Details
                          </a>
                        </td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td>194586</td>
                        <td>Adnan Khan</td>
                        <td>AED 25.56</td>
                        <td>
                          <a href="" className="accept">
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
                id="completed"
                role="tabpanel"
                aria-labelledby="completed-tab"
              >
                <div className="table-responsive">
                  <table className="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                      </tr>
                      <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                      </tr>
                      <tr>
                        <th scope="row">3</th>
                        <td colSpan={2}>Larry the Bird</td>
                        <td>@twitter</td>
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
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                      </tr>
                      <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                      </tr>
                      <tr>
                        <th scope="row">3</th>
                        <td colSpan={2}>Larry the Bird</td>
                        <td>@twitter</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div
                className="tab-pane fade"
                id="View-Alls"
                role="tabpanel"
                aria-labelledby="View-Alls-tab"
              >
                <div className="table-responsive">
                  <table className="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                      </tr>
                      <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                      </tr>
                      <tr>
                        <th scope="row">3</th>
                        <td colSpan={2}>Larry the Bird</td>
                        <td>@twitter</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </>

  )
}
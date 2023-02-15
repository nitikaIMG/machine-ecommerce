import { useAuthUser } from '@root/store/auth/auth.context';
import * as React from 'react';
import { renderRoutes, RouteConfigComponentProps } from 'react-router-config';
import { LoadingSpinner } from '@components/ui/loading-spinner';

import Header from '../common-header';
import Footer from '../footer';

import { DashboardLayoutSellerAside } from './aside-seller';
import { DashboardLayoutCustomerAside } from './aside-customer';

const LayoutDashboard: React.FC<RouteConfigComponentProps> = ({ route }) => {

  const { user, isLoading } = useAuthUser();

  const isTypeSeller = user?.type === 'seller';

  return (
    <>
      <Header />
      <section className="main-wraper">
        <div className="container">
          <div className="row">
            <div className="col-md-3">
              {isLoading ? (
                <LoadingSpinner />
              ) : isTypeSeller
                ? <DashboardLayoutSellerAside />
                : <DashboardLayoutCustomerAside />}
            </div>
            <div className="col-md-12 col-lg-9">
              <section className="center-wraper">
                {renderRoutes(route?.routes)}
              </section>
            </div>
          </div>
        </div>
      </section>
      <Footer />
    </>
  )
};

export default LayoutDashboard;

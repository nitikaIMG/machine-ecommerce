import * as React from 'react';
import { renderRoutes, RouteConfigComponentProps } from 'react-router-config';

import Header from './header';
import Footer from '../footer';

const LayoutHomepage: React.FC<RouteConfigComponentProps> = ({route}) => {
  return (
    <>
      <Header />
      <main>
        {renderRoutes(route?.routes)}
      </main>
      <Footer />
    </>
  )
};

export default LayoutHomepage;

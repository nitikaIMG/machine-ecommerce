import * as React from 'react';
import {
  SectionFavourite,
  SectionCategories,
  SectionHowItWorks,
  SectionNewPartners,
  SectionPopularLocations
} from './sections';

export default function Home() {
  return (
    <>
      <SectionFavourite />

      <SectionCategories />

      <SectionNewPartners />

      <SectionHowItWorks />

      <SectionPopularLocations />

      {/* Become Partner */}
      <section className="partner">
        <div className="container max-1170">
          <div className="row">
            <div className="col-md-12">
              <div className="partner-flex">
                <div className="title">
                  Become a Partner
                  <span className="sb-title">
                    Let's grow your business together
                  </span>
                </div>
                <a href="" className="join-now">
                  join Now
                </a>
              </div>
            </div>
          </div>
        </div>
      </section>
      {/* Download App */}
      <section className="app-download">
        <div className="container max-1170">
          <figure className="app-img">
            <img src="images/app-img.png" alt="" />
          </figure>
          <div className="content">
            <div className="title">Download the App</div>
            <p className="text">
              Sed ut perspiciatis unde omnis iste natus error sit voluptatem
              accusantium doloremque.
            </p>
            <a href="" className="store-btn">
              <img src="images/playstore-img.png" alt="" />
            </a>
            <a href="" className="store-btn">
              <img src="images/ios-btn.png" alt="" />
            </a>
          </div>
        </div>
      </section>
    </>

  )
}

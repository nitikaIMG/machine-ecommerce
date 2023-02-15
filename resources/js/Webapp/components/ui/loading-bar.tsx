import * as React from 'react';
import { useAxiosLoader } from '@root/hooks/useAxiosLoader';
import LoadingBar, { LoadingBarRef } from 'react-top-loading-bar';

export const AppLoadingBar = () => {
  const [ isLoading, ] = useAxiosLoader();
  const loadingRef = React.useRef<LoadingBarRef>(null);

  React.useEffect(() => {

    if( isLoading ) {
      loadingRef.current?.continuousStart(10, 14);
    } else {
      loadingRef.current?.complete();
    }

  }, [isLoading]);

  return (
    <div>
      <LoadingBar height={5} color='#fd7e14' ref={loadingRef} />
    </div>
  )
};

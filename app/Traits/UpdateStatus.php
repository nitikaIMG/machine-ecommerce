<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait UpdateStatus {
    
    public function update_status(Request $request)
    {
        [$rKey, $rClass] = $this->dt_resourceClass;

        if( $resource_id = intval($request->query('update_status')) ) {

            if( $resource = $rClass::withoutGlobalScopes()->find($resource_id) ) {
                $resource->status = $resource->status ? 0 : 1;
                $resource->update();

                if( $request->ajax() ) {
                    return response('OK');
                }

                return back()->withSuccess(__('Success updated'));
            }
        }

        return response('N', 422);
    }
}
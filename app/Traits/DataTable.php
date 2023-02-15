<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait DataTable {

    protected function get_datatable_data(Request $request)
    {
        [$rKey, $rClass] = $this->dt_resourceClass;

        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = $rClass::select('count(*) as allcount')->count();
        $totalRecordswithFilter = $rClass::select('count(*) as allcount')
            // ->where('name', 'like', '%' .$searchValue . '%')
            ->count();

        // Fetch records
        $records = $rClass::orderBy($columnName,$columnSortOrder);

        if( ! empty($this->dt_eagerLoadings) ) {
            $records->with($this->dt_eagerLoadings);
        }

        // if( !empty($searchValue) && isset($this->dt_searchFields) ) {
        //     foreach( (array)$this->dt_searchFields as $dt_searchFields ) {
        //         $records->orWhere($dt_searchFields, $searchValue);
        //     }
        // }

        $records = $records
            ->select("{$rKey}.*")
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $records
        );

        return $response;
    }

    public function update_status(Request $request)
    {
        [$rKey, $rClass] = $this->dt_resourceClass;

        if( $resource_id = intval($request->query('update_status')) ) {

            if( $resource = $rClass::find($resource_id) ) {
                $resource->status = $resource->status ? 0 : 1;
                $resource->update();

                return back()->withSuccess(__('Success updated'));
            }
        }

        return response('N', 422);
    }
}
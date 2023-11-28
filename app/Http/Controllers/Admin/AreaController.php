<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AreaDataTable;
use App\Http\Requests\Admin\StoreArea;
use App\Http\Requests\Admin\UpdateArea;
use App\Models\Area;
use App\Models\City;
use Illuminate\Http\Request;

class AreaController extends BaseAdminController
{
    public function __construct()
    {
        $this->permissionsAdmin('areas', $read = true, $create = true, $update = true, $delete = true);
    }

    public function index(AreaDataTable $areas)
    {
        $cities = City::get();
        return $areas->render('admin.areas.index', compact('cities'));
    }

    public function store(StoreArea $request)
    {
        $area = Area::create($request->validated());
        return response()->json(['status' => 'success', 'data' => $area]);
    }

    public function update(UpdateArea $request, Area $area)
    {
        $area->update($request->validated());

        return response()->json(['status' => 'success', 'data' => $area]);
    }

    public function destroy(Area $area)
    {
        $area->delete();
        return response()->json(['status' => 'success']);
    }


    public function getAreasByCity(Request $request)
    {
        $cityId = $request->get('city_id');
        $areas = Area::whereCityId($cityId)->get();

        return response()->json(['areas' => $areas]);
    }

}

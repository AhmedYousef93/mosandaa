<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AreaDataTable;
use App\DataTables\StateDataTable;
use App\Http\Requests\Admin\StoreArea;
use App\Http\Requests\Admin\StoreState;
use App\Http\Requests\Admin\UpdateArea;
use App\Http\Requests\Admin\UpdateState;
use App\Models\Area;
use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;

class StateController extends BaseAdminController
{
    public function __construct()
    {
        $this->permissionsAdmin('states', $read = true, $create = true, $update = true, $delete = true);
    }

    public function index(StateDataTable $states)
    {
        $cities = City::get();
        return $states->render('admin.states.index', compact('cities'));
    }

    public function store(StoreState $request)
    {
        $state = State::create($request->validated());
        return response()->json(['status' => 'success', 'data' => $state]);
    }

    public function update(UpdateState $request, State $state)
    {
        $state->update($request->validated());

        return response()->json(['status' => 'success', 'data' => $state]);
    }

    public function destroy(State $state)
    {
        $state->delete();
        return response()->json(['status' => 'success']);
    }
 

}

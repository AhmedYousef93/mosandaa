<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests\Admin\TimeStoreRequest;
use App\Models\Time;

class TimeController extends BaseAdminController
{
    public function __construct()
    {
        $this->permissionsAdmin('times', $read = true, $create = false, $update = false, $delete = true);
    }



    public function store(TimeStoreRequest $request)
    {
        $dayId = $request->input('dayId');
        $times = $request->input('time');

        foreach ($times as $time) {
            Time::create([
                'day_id' => $dayId,
                'time' => $time,
            ]);
        }
        return redirect()->back()->with('success', 'Times saved successfully');
    }


    public function destroy($id)
    {

    }


}

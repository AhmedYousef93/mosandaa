<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ContactUsDataTable;
use App\DataTables\DaysDataTable;
use App\DataTables\TimeTable;
use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class DayController extends BaseAdminController
{
    public function __construct()
    {
        $this->permissionsAdmin('days',$read = true, $create = false, $update = false, $delete = true);
    }

    public function index(DaysDataTable $contact)
    {
        return $contact->render('admin.days.index');
    }
    public function getTime(TimeTable $time, $dayId)
    {
        return $time->setDayId($dayId)->render('admin.times.index');
    }

    public function contactusDetails(Request $request)
    {
       $contact = ContactUs::where('id',$request->contact_id)->get();
       return json_decode($contact);
    }

    public function destroy($id)
    {
       
    }


}

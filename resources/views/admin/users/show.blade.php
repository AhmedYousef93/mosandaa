@extends('admin.layout.master')


@section('content')
<div class="container mt-4">
    <h1>User Details</h1>

    <div class="row">
        <!-- Vertical Tabs on the Right -->
        <div class="col-md-2">
            <ul class="nav flex-column" id="userTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="userTab" data-toggle="tab" href="#user" role="tab"
                        aria-controls="user" aria-selected="true">@lang('admin.profile')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="form1Tab" data-toggle="tab" href="#form1" role="tab" aria-controls="form1"
                        aria-selected="false">@lang('admin.Employment_contract_offer')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="form2Tab" data-toggle="tab" href="#form2" role="tab" aria-controls="form2"
                        aria-selected="false">@lang('admin.Identity_Show')</a>
                </li>
                <!-- Add more tabs as needed -->
            </ul>
        </div>

        <!-- Forms on the Left -->
        <div class="col-md-9">
            <div class="tab-content" id="userTabsContent">
                <!-- User Info Tab -->
                <div class="tab-pane fade show active" id="user" role="tabpanel" aria-labelledby="userTab">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h2>@lang('admin.profile')</h2>
                        </div>
                        <div class="card-body">
                            <form>
                                <!-- Additional input fields side by side -->

                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label for="field1" class="col-form-label">@lang('admin.name'):</label>
                                        <input type="text" id="field1" name="field1" class="form-control" value="{{$user->name}}" readonly>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="field2" class="col-form-label">@lang('admin.email'):</label>
                                        <input type="text" id="field2" name="field2" class="form-control" value="{{$user->email}}" readonly>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="field3" class="col-form-label">@lang('admin.phone'):</label>
                                        <input type="text" id="field3" name="field3" class="form-control" value="{{$user->phone}}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label for="field1" class="col-form-label">@lang('admin.date_of_birth'):</label>
                                        <input type="text" id="field1" name="field1" class="form-control" value="{{$user->userDetails?->date_of_birth}}" readonly>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="field2" class="col-form-label">@lang('admin.sponsor_name'):</label>
                                        <input type="text" id="field2" name="field2" class="form-control" value="{{$user->userDetails?->sponsor_name}}" readonly>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="field3" class="col-form-label">@lang('admin.passport_number'):</label>
                                        <input type="text" id="field3" name="field3" class="form-control" value="{{$user->userDetails?->passport_number}}" readonly>
                                    </div>
                                </div>

                                <div class="card-header">
                                  <h2>@lang('admin.address')</h2>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label for="field1" class="col-form-label">@lang('admin.city'):</label>
                                        <input type="text" id="field1" name="field1" class="form-control" value="{{$user->ActiveAddress?->city?->title}}" readonly>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="field2" class="col-form-label">@lang('admin.area'):</label>
                                        <input type="text" id="field2" name="field2" class="form-control" value="{{$user->ActiveAddress?->area?->title}}" readonly>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="field3" class="col-form-label">@lang('admin.state'):</label>
                                        <input type="text" id="field3" name="field3" class="form-control" value="{{$user->ActiveAddress?->state?->title}}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label for="field1" class="col-form-label">@lang('admin.street'):</label>
                                        <input type="text" id="field1" name="field1" class="form-control" value="{{$user->ActiveAddress?->street}}" readonly>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="field2" class="col-form-label">@lang('admin.building_number'):</label>
                                        <input type="text" id="field2" name="field2" class="form-control" value="{{$user->ActiveAddress?->building_number}}" readonly>
                                    </div>                                   
                                </div>
                                <div class="card-header">
                                  <h2>@lang('admin.Accommodation_Information')</h2>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label for="field1" class="col-form-label">@lang('admin.Residence_of_the_sponsor'):</label>
                                        <input type="text" id="field1" name="field1" class="form-control" value="{{$user->userDetails?->sponsor_residence}}" readonly>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="field2" class="col-form-label">@lang('admin.Labor_City'):</label>
                                        <input type="text" id="field2" name="field2" class="form-control" value="{{$user->userDetails?->labor_city}}" readonly>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="field3" class="col-form-label">@lang('admin.salary'):</label>
                                        <input type="text" id="field3" name="field3" class="form-control" value="{{$user->userDetails?->salary}}" readonly>
                                    </div>
                                </div>
                                <!-- Add more fields as needed -->
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Form 1 Tab -->
                <div class="tab-pane fade" id="form1" role="tabpanel" aria-labelledby="form1Tab">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h2>Form 1</h2>
                        </div>
                        <div class="card-body">
                            <form>
                                <!-- Add fields for the first form here -->
                                <!-- Use the same structure as previous examples -->
                            </form>
                        </div>
                    </div>
                </div>  

                <!-- Form 2 Tab -->
                <div class="tab-pane fade" id="form2" role="tabpanel" aria-labelledby="form2Tab">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h2>Form 2</h2>
                        </div>
                        <div class="card-body">
                            <form>
                                <!-- Add fields for the second form here -->
                                <!-- Use the same structure as previous examples -->
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Add more tabs as needed -->
            </div>
        </div>
    </div>

    <!-- Add a back button to return to the DataTable -->
    <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>

<!-- Include Bootstrap JS for tabs functionality -->
<script>
      document).ready(function () { '#userTabs').tab();
    ;
</script>
@endsection
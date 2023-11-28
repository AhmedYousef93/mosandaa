@extends('admin.layout.master')
@section('content')

<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-left mb-0">@lang('admin.dashboard')</h2>
            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">@lang('admin.home')</a>
                    </li>

                    <li class="breadcrumb-item"><a href="">@lang('admin.states')</a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>

{{-- main section crud in one page --}}
<section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title"> @lang('admin.states')</h4>
                    @if(Auth::guard('admin')->user()->hasPermission('states-create'))
                    <button class="dt-button create-new btn btn-gradient-success d-inline-flex" type="button"
                        data-toggle="modal" data-target="#modal-add-state">
                        <span style="font-size: 15px;">+ @lang('admin.addstates')</span>
                    </button>
                    @else
                    <button class="dt-button create-new btn btn-gradient-success d-inline-flex disabled" type="button">
                        <span style="font-size: 15px;">+ @lang('admin.addstates')</span>
                    </button>
                    @endif

                </div>
                <div class="card-datatable">
                    {{ $dataTable->table([
                    'class'=> 'datatables-ajax table table-bordered state-table'
                    ],true) }}

                </div>
            </div>
        </div>
    </div>

    <!-- Modal to add new record -->
    @if(Auth::guard('admin')->user()->hasPermission('states-create'))
    <div class="modal modal-slide-in fade" id="modal-add-state">
        <div class="modal-dialog sidebar-sm">
            <form id="addstate" method="POST" class="add-new-record modal-content pt-0" enctype="multipart/form-data"
                data-parsley-validate>
                @csrf
                @method('post')

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('admin.addstates')</h5>
                </div>
                <div class="modal-body flex-grow-1">

                    <div class="form-group">
                        <label class="form-label">@lang('admin.ar.title')</label>
                        <input type="text" name="title_ar" value="{{old('title_ar')}}" parsley-trigger="change"
                            placeholder="@lang('admin.ar.title')" class="form-control" required />
                    </div>

                    <div class="form-group">
                        <label class="form-label">@lang('admin.en.title')</label>
                        <input type="text" name="title_en" value="{{old('title_en')}}" parsley-trigger="change"
                            placeholder="@lang('admin.en.title')" class="form-control" required />
                    </div>

                    <div class="form-group">
                        <label class="form-label">@lang('admin.city')</label>
                        <select name="city_id" class="form-control" required>
                        <option value="">@lang('admin.choose')</option>
                            @foreach($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">@lang('admin.area')</label>
                        <select name="area_id" class="form-control" required>
                            <!-- Areas will be dynamically populated based on the selected city -->
                        </select>
                    </div>


                    <div class="row" style="margin-top: 15px;">
                        <div class="col-12">
                            <button type="submit" name="submit"
                                class="btn btn-dark data-submit mr-1">@lang('admin.save')</button>
                            <button type="reset" class="btn btn-outline-secondary"
                                data-dismiss="modal">@lang('admin.cancel')</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endif

    <!-- Modal to edit record -->
    @if(Auth::guard('admin')->user()->hasPermission('states-update'))
    <div class="modal modal-slide-in fade" id="modal-edit-state">
        <div class="modal-dialog sidebar-sm">
            <form id="editstate" method="post" class="add-new-record modal-content pt-0" enctype="multipart/form-data"
                data-parsley-validate>
                @csrf
                @method('put')

                <input type="hidden" name="stateId" id="state_id" class="form-control">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('admin.editstates')</h5>
                </div>
                <div class="modal-body flex-grow-1">

                    <div class="form-group">
                        <label class="form-label">@lang('admin.ar.title')</label>
                        <input type="text" name="title_ar" id="title_ar" parsley-trigger="change"
                            placeholder="@lang('admin.ar.title')" class="form-control" required />
                    </div>

                    <div class="form-group">
                        <label class="form-label">@lang('admin.en.title')</label>
                        <input type="text" name="title_en" id="title_en" parsley-trigger="change"
                            placeholder="@lang('admin.en.title')" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label class="form-label">@lang('admin.city')</label>
                        <select name="city_id" class="form-control" required>
                        <option value="">@lang('admin.choose')</option>
                            @foreach($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">@lang('admin.area')</label>
                        <select name="area_id" class="form-control" required>
                            <!-- Areas will be dynamically populated based on the selected city -->
                        </select>
                    </div>

                    <div class="row" style="margin-top: 15px;">
                        <div class="col-12">
                            <button type="submit" name="submit"
                                class="btn btn-dark data-submit mr-1">@lang('admin.save')</button>
                            <button type="reset" class="btn btn-outline-secondary"
                                data-dismiss="modal">@lang('admin.cancel')</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endif

</section>

@endsection

@push('js')
<script type="text/javascript">
    $.extend(true, $.fn.dataTable.defaults, {
        language: {
            url: '{{asset('AdminS/ assets_ar / app - assets / js / scripts / tables / '. app()->getLocale() . '.json') }}'
        }
    });
</script>
{{ $dataTable->scripts() }}

<script>

    $('body').on('submit', '#addstate', function (e) {
        e.preventDefault();
        $.ajax({
            url: '{{ route('states.store') }}',
            method: "post",
            data: new FormData(this),
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == 'success') {
                    toastr.options =
                    {
                        "closeButton": true,
                        "progressBar": true,
                        "showDuration": 500,
                    }
                    toastr['success']("@lang('admin.added')");
                }
                $('.state-table').DataTable().ajax.reload();
                $modal = $('#modal-add-state');
                $modal.find('form')[0].reset();
                $('#modal-add-state').modal('hide');
            },
            error: function (response) {
                var errors = response.responseJSON.errors;
                $.each(errors, function (index, value) {
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "showDuration": 500,
                    }
                    toastr['error'](value);
                });
            }


        });
    });

    $('body').on('click', '.edit', function (e) {
        e.preventDefault();
        var id = $(this).data('stateid');
        var title_ar = $(this).data('title_ar');
        var title_en = $(this).data('title_en');

        $('#state_id').val(id);
        $('#title_ar').val(title_ar);
        $('#title_en').val(title_en);
    })

    $('body').on('submit', '#editstate', function (e) {
        e.preventDefault();
        let id = $('#state_id').val();
        var url = '{{ route('states.update', ':id') }}';
        url = url.replace(':id', id);

        $.ajax({
            url: url,
            method: "post",
            data: new FormData(this),
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == 'success') {
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "showDuration": 500,
                    }
                    toastr['success']("@lang('admin.updated')");
                }
                $('.state-table').DataTable().ajax.reload();
                $modal = $('#modal-edit-state');
                $modal.find('form')[0].reset();
                $('#modal-edit-state').modal('hide');
            },
            error: function (response) {
                var errors = response.responseJSON.errors;
                $.each(errors, function (index, value) {
                    toastr.options =
                    {
                        "closeButton": true,
                        "progressBar": true,
                        "showDuration": 500,
                    }
                    toastr['error'](value);
                });
            }

        });
    });

    $('body').on('submit', '#delform', function (e) {
        e.preventDefault();
        var url = $(this).attr('action');
        $.ajax({
            url: url,
            method: "delete",
            data: {
                _token: '{{ csrf_token() }}',
            },
            success: function (response) {
                $('.state-table').DataTable().ajax.reload();
            }
        });
    })


    $('body').on('change', 'select[name="city_id"]', function () {
    var cityId = $(this).val();

    // Assuming you have a route named 'areas.get.by.city' to fetch areas by city
    $.ajax({
        url: '{{ route('areas.get.by.city') }}', // Adjust the route name
        method: 'GET',
        data: { city_id: cityId },
        success: function (response) {
            var areasSelect = $('select[name="area_id"]');
            areasSelect.empty(); // Clear existing options
            var currentLanguage = '{{ app()->getLocale() }}';

            $.each(response.areas, function (index, area) {
                var areaTitle = (currentLanguage === 'ar') ? area.title_ar : area.title_en;
                areasSelect.append('<option value="' + area.id + '">' + areaTitle + '</option>');
            });
        },
        error: function (error) {
            console.log(error);
        }
    });
});


</script>
@endpush
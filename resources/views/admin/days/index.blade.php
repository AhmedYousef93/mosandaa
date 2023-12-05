@extends('admin.layout.master')
@section('content')
<style>
        .inputGroup {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .inputGroup label {
            margin-right: 10px;
        }

        .btnContainer {
            display: flex;
        }

        .duplicateBtn,
        .deleteBtn {
            margin-right: 10px;
        }
    </style>
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-left mb-0">@lang('admin.dashboard')</h2>
            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">@lang('admin.home')</a>
                    </li>

                    <li class="breadcrumb-item"><a href="">@lang('admin.days')</a>
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
                    <h4 class="card-title"> @lang('admin.days')</h4>
                </div>
                <div class="card-datatable">
                    {{ $dataTable->table([
                    'class'=> 'datatables-ajax table table-bordered days-table'
                    ],true) }}

                </div>
            </div>
        </div>
    </div>
    @if(Auth::guard('admin')->user()->hasPermission('days-read'))
    <!-- Modal -->
    <div class="modal fade" id="modal-edit-time" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <form id="editcity" method="post" action="{{route('times.store')}}" class="add-new-record " enctype="multipart/form-data"
            data-parsley-validate>
            @csrf
            <input type="hidden" name="dayId" id="day_id" class="form-control">

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal Title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <!-- Input Fields -->
                        <div class="input-group mb-3">
                            <input type="time" name="time[]" id="time" parsley-trigger="change"
                                placeholder="@lang('admin.ar.title')" class="form-control" required />
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary duplicateBtn" type="button">Duplicate</button>
                            </div>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary deleteBtn" type="button">Delete</button>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">save</button>
                    </div>
                </div>
            </div>
    </div>
    </form>
    @endif


</section>

@endsection

@push('js')
<script type="text/javascript">
    $.extend(true, $.fn.dataTable.defaults, {
        language: {
            url: '{{asset('AdminS/assets_ar/app-assets/js/scripts/tables/'. app()->getLocale() . '.json') }}'
        }
    });
</script>
{{ $dataTable->scripts() }}
<script>
    $('body').on('click','.edit',function (e) {
            e.preventDefault();
            var id = $(this).data('dayid');
            var title_ar = $(this).data('title_ar');
            var title_en = $(this).data('title_en');

            $('#day_id').val(id);
            $('#title_ar').val(title_ar);
            $('#title_en').val(title_en);
        })
</script>

<script>
    $(document).ready(function() {
        // Add event listener for the duplicate button
        $('.modal-body').on('click', '.duplicateBtn', function() {
            duplicateInput($(this).closest('.input-group'));
        });

        // Add event listener for the delete button
        $('.modal-body').on('click', '.deleteBtn', function() {
            deleteInput($(this).closest('.input-group'));
        });

        function duplicateInput(originalInputGroup) {
            // Clone the original input group
            const clonedInputGroup = originalInputGroup.clone();

            // Clear the value of the cloned input
            clonedInputGroup.find('input').val('');

            // Append the cloned input group to the modal body
            $('.modal-body').append(clonedInputGroup);
        }

        function deleteInput(inputGroup) {
            // Remove the input group
            inputGroup.remove();
        }
    });
</script>


@endpush
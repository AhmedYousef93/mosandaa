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
<div class="modal fade" id="modal-edit-days" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<form id="editcity" method="post" class="add-new-record modal-content pt-0" enctype="multipart/form-data" data-parsley-validate>

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
                <input type="text" name="time" id="time" parsley-trigger="change" 
                        placeholder="@lang('admin.ar.title')" class="form-control" required/>                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary duplicateBtn" type="button">Duplicate</button>
                    </div>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary deleteBtn" type="button">Delete</button>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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

    $('body').on('click', '.day', function () {
        var contact_id = $(this).data('id');
        $.ajax({
            url: '{{ route('contactusdetails') }}',
            type: 'GET',
            data: {
                'contact_id': contact_id
            },
            success: function (response) {
                var docRow = '';
                $('#subject').html('');
                $.each(response, function (index, value) {
                    docRow = '<div class="modal-header">' + value.phone + '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body">' + value.description + '</div>';

                    $('#subject').append(docRow);

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
                $('.days-table').DataTable().ajax.reload();
            }
        });
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
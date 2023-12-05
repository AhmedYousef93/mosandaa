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

@endpush
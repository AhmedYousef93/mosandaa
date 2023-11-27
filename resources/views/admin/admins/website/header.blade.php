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

                        <li class="breadcrumb-item"><a href="">@lang('admin.settings')</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section id="basic-input">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('admin.header')</h4>
                    </div>
                    <form method="POST" id="header" enctype="multipart/form-data" data-parsley-validate>
                        @method('put')
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                @foreach(config('translatable.locales') as $lang)
                                    <div class="col-xl-6 col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="basicInput">@lang('admin.'.$lang.'.header_title')</label>
                                            <input type="text" class="form-control" name="{{$lang}}[title]"
                                                   value="{{$header->translate($lang)->title}}" required
                                                   parsley-trigger="change" placeholder="@lang('admin.title')"/>
                                        </div>

                                        <div class="form-group">
                                            <label>@lang('admin.'.$lang.'.header_description')</label>
                                            <textarea name="{{$lang}}[description]" rows="5"
                                                      class="form-control">{{ $header->translate($lang)->description }}</textarea>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="customFile">@lang('admin.photo')</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input image" name="url" id="image"/>
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        @if($header->websiteImages()->first())
                                            <img alt="" src="{{$header->websiteImages()->first()->image_path}}"
                                                 width="200"
                                                 height="100" class="image-show img-thumbnail img-rounded"
                                                 style="margin-right: 130px;"/>
                                        @else
                                            <img alt="" src="{{asset('/website/img/mob.png')}}" width="200" height="100"
                                                 class="image-show img-thumbnail img-rounded"
                                                 style="margin-right: 130px;"/>
                                        @endif
                                    </div>
                                </div>
                                <button type="submit" name="submit"
                                        class="btn btn-primary data-submit mr-1">@lang('admin.save')</button>
                                <button type="reset" class="btn btn-outline-secondary">@lang('admin.cancel')</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')

    <script>
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('body').on('submit', '#header', function (e) {
                e.preventDefault();
                var lang = ('{{app()->getLocale()}}' == 'ar' ? true : false);
                $.ajax({
                    url: '{{ route('header.update', $header->id)}}',
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
                                "showDuration": 300,
                                "rtl": lang

                            }
                            toastr['success']("@lang('admin.updatesuccessfully')");
                        }
                    },

                    error: function (response) {
                        var errors = response.responseJSON.errors;
                        $.each(errors, function (index, value) {
                            toastr.options =
                                {
                                    "closeButton": true,
                                    "progressBar": true,
                                    "showDuration": 500,
                                    "rtl": lang
                                }
                            toastr['error'](value);
                        });
                    }

                });
            });

        });
    </script>

@endpush

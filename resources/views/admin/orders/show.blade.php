@extends('admin.layout.master')


@section('content')


<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-left mb-0">@lang('admin.specified_time')</h2>
            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">{{$order->time->day->name}}</a>
                    </li>

                    <li class="breadcrumb-item"><a href="">{{$order->time->time}}</a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container mt-4">
    <div class="card">
        <!-- <img src="your-image-url.jpg" alt="Card Image"> -->
        <div class="card-content">
            <div class="card-title">@lang('admin.name') : {{$order->user->name}}</div>
            <div class="card-title">@lang('admin.phone') : {{$order->user->phone}}</div>
            <div class="card-title">@lang('admin.email') :{{$order->user->email}}</div>
        </div>
    </div>

    <div class="card">
        <img src="your-image-url.jpg" alt="Card Image">
        <div class="card-content">
            <div class="card-title"></div>
            <div class="card-description">Description for Card 2. This is another span for more details.</div>
        </div>
    </div>
</div>


@endsection
@extends('admin.layout.master')
@section('content')

  <style>
    .card {
      margin-top: 20px;
    }

    .tab-content {
      padding: 20px;
    }
    
  </style>
  <div class="container">
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                @foreach($services as $service)
                    <li class="nav-item">
                        <a class="nav-link @if($loop->first)active @endif" data-toggle="tab" href="#tab{{$service->id}}">{{$service->title}}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="tab-content">
            @foreach($services as $service)
                <div class="tab-pane fade show @if($loop->first)active @endif" id="tab{{$service->id}}">
                    <div class="row">
                        @foreach($service->subservices as $subservice)
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                    <h5 class="card-title">{{$subservice->title}}</h5>
                                    <p class="card-title">{{$subservice->description}}</p>
                                        <!-- Add button with icon to trigger common modal -->
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateModal" data-subservice-id="{{$subservice->id}}" onclick="clearModalFields()">
                                        <i data-feather="edit"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Common Update Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">@lang('admin.update')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Content will be dynamically updated using JavaScript -->
                <div id="modalContent"></div>
            </div>
        </div>
    </div>
</div>



@endsection

@push('js')

<script>
    $(document).ready(function () {
        // Listen for the tab change event
        $('.nav-tabs a').on('shown.bs.tab', function (e) {
            // Get the ID of the selected tab
            var selectedTabId = $(e.target).attr('href');

            // Hide all tab content
            $('.tab-content .tab-pane').removeClass('show active');

            // Show the content of the selected tab
            $(selectedTabId).addClass('show active');
        });
    });
</script>


<script>
$(document).ready(function () {
    $('#updateModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var subserviceId = button.data('subservice-id');

        $.ajax({
            url: '/admin/get-subservice-data/' + subserviceId,
            method: 'GET',
            success: function (data) {
                $('#modalContent').html(data);
            },
            error: function (error) {
                console.log('Error:', error);
            }
        });
    });
});



</script>
<script>
    function clearModalFields() {
        // Clear the values of the input fields in the modal
        $('#subserviceTitle').val('');
        $('#subserviceDescription').val('');
    }
</script>

<!-- resources/views/admin/layout/master.blade.php -->

<!-- ... your existing code ... -->

<script>
    function updateSubservice() {
        var subserviceId = $('#subserviceId').val();
        var titleAr = $('#subserviceTitleAr').val();
        var titleEn = $('#subserviceTitleEn').val();
        var descriptionAr = $('#subserviceDescriptionAr').val();
        var descriptionEn = $('#subserviceDescriptionEn').val();
        // Check if required fields are not empty
            if (titleAr.trim() === '' || descriptionAr.trim() === ''|| descriptionEn.trim() === ''|| titleEn.trim() === '') {
                    toastr['error']("@lang('admin.Please fill in all required fields')");
                return;
            }
        $.ajax({
            url: '/admin/subservice/' + subserviceId,
            method: 'PUT',
            data: {
                '_token': '{{ csrf_token() }}',
                'title_ar': titleAr,
                'title_en': titleEn,
                'description_ar': descriptionAr,
                'description_en': descriptionEn,
            },
            success: function (data) {
                $('#updateModal').modal('hide');
                toastr['success']("@lang('admin.updated')");

            },
            error: function (error) {
                console.log('Error:', error);
            }
        });
    }
</script>


@endpush

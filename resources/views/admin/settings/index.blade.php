@extends('layouts.adminlte.master')

@section('title')
{{-- master title here --}}
MG Dashbord
@endsection


@section('title_page')
Settings

@endsection


@section('content')
    @if (session()->has('success'))
        <script>
            window.onload = function() {
                notif({
                    msg: "{{session()->get('success')}}",
                    type: "success"
                });
            }
        </script>
    @endif

    @can('show_product')
        <div class="container-fluid">
            <div class="form-group">
            <label>Main Dashbord Photo</label>
            <form action="{{ route('store_app_image') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="file" class="form-control-file" name="photo">
                <button type="submit">submit</button>
              </form>
            </div>

<hr>
            <div class="form-group">
                <label>Current Admin Photo</label>
                <form action="{{ route('store_admin_image') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="file" class="form-control-file" name="photo">
                    <button type="submit">submit</button>
                  </form>
                </div>
        </div>
    @endcan



@endsection

@section('css')
<link href="{{ URL::asset('adminlte/assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />

@endsection


@section('scripts')
<script src="{{ URL::asset('adminlte/assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ URL::asset('adminlte/assets/plugins/notify/js/notifit-custom.js') }}"></script>

<script>
    $('#modaldemo8').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var user_id = button.data('user_id')
        var username = button.data('username')
        var modal = $(this)
        modal.find('.modal-body #user_id').val(user_id);
        modal.find('.modal-body #username').val(username);
    })
</script>
@endsection


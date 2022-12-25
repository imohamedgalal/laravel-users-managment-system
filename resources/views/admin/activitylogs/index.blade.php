@extends('layouts.adminlte.master')

@section('title')
{{-- master title here --}}
{{ trans('main_translate.Activity Logs') }}
@endsection


@section('title_page')
{{ trans('main_translate.Activity Logs') }}
{{-- <a class="btn btn-primary btn-sm" href="{{ route('create_user') }}">Add User</a> --}}

@endsection



@section('content')

@if (session()->has('success'))

{{-- <div id="successMessage" class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{session()->get('success')}}</strong>
</div> --}}

<script>
    window.onload = function() {
        notif({
            msg: "{{session()->get('success')}}",
            type: "success"
        });
    }
</script>

@endif
@can('show_logs')

    <div class="container-fluid">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>{{ trans('main_translate.Admin') }}</th>
                    <th>{{ trans('main_translate.Title') }}</th>
                    <th>{{ trans('main_translate.User') }}</th>
                    <th>{{ trans('main_translate.before') }}</th>
                    <th>{{ trans('main_translate.after') }}</th>
                    <th>{{ trans('main_translate.Date') }}</th>
                    <th>{{ trans('main_translate.Actions') }}</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($ActivityLog as $log )
            <tr>
                    <td>{{ $log->id }}</td>
                    <td><span class="badge badge-info">{{ $log->admin }}</span></td>
                    <td>

                        @if ($log->title == "Disable")
                        <span class="badge badge-danger">{{ trans('main_translate.Disable') }}</span>

                        @elseif ($log->title == "Update Product")
                        <span class="badge badge-warning">{{ trans('main_translate.Update Product') }}</span>

                        @elseif ($log->title == "Active")
                        <span class="badge badge-success">{{ trans('main_translate.Active') }}</span>

                        @elseif ($log->title == "Create Product")
                        <span class="badge badge-success">{{ trans('main_translate.Create Product') }}</span>

                        @elseif ($log->title == "Create New")
                        <span class="badge badge-success">{{ trans('main_translate.Create New') }}</span>

                        @else
                        {{ $log->title }}
                        @endif

                        </td>
                    <td>{{ $log->user }}</td>
                    <td>
                        @foreach ($products as $name => $code)

                            @if (str_contains(json_encode($log->before),$code ))
                            <span class="badge badge-success">{{$name}}</span>
                            @endif
                            @endforeach
                    </td>
                    <td>
                        @foreach ($products as $name => $code)

                            @if (str_contains(json_encode($log->after),$code ))
                            <span class="badge badge-success">{{$name}}</span>
                            @endif
                            @endforeach
                    </td>
                    <td>{{ $log->created_at }}</td>
                    <td>
                        @can('delete_logs')
                            <form action="{{ route('delete_log',$log->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this log?');">
                                @method('delete')
                                @csrf
                                {{-- <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{route('delete_log',$log->id)}}"><i class="fa fa-trash"></i></a> --}}

                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                            </form>
                        @endcan
                    </td>
            </tr>
            @endforeach

            </tbody>
        </table>
    </div>

@endcan


@endsection

@section('css')
<link href="{{ URL::asset('adminlte/assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ URL::asset('adminlte/assets/css/dataTables.bootstrap4.min.css') }}">


@endsection


@section('scripts')

<script src="{{ URL::asset('adminlte/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('adminlte/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('adminlte/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('adminlte/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('adminlte/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('adminlte/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('adminlte/assets/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ URL::asset('adminlte/assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('adminlte/assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ URL::asset('adminlte/assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('adminlte/assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('adminlte/assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>


<!--Internal  Notify js -->
<script src="{{ URL::asset('adminlte/assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ URL::asset('adminlte/assets/plugins/notify/js/notifit-custom.js') }}"></script>
<script>
  $(function () {
    $('#example1').DataTable({
      "paging": true,
      "lengthChange": true,
      'pageLength': 25,
      "lengthMenu": [10, 25, 50, 100, 200, 500],
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
      "buttons": ["csv", "excel", "pdf", "print"],
      "order": [[6, "desc" ]]
    }).buttons().container().appendTo('#example1_wrapper');
  });


//   setTimeout(function() {
//     $('#successMessage').fadeOut('fast');
// }, 2000); // <-- time in milliseconds
  </script>
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




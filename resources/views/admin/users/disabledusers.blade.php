@extends('layouts.adminlte.master')

@section('title')
{{-- master title here --}}
{{ trans('main_translate.Disabled Users') }}
@endsection


@section('title_page')
{{ trans('main_translate.Disabled Users') }}
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
    @can('show_users')

        <div class="container-fluid" style="overflow: scroll;">

            <table id="example1" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>{{ trans('main_translate.Name') }}</th>
                        <th>{{ trans('main_translate.Username') }}</th>
                        <th>{{ trans('main_translate.Email') }}</th>
                        <th>{{ trans('main_translate.Product') }}</th>
                        <th>{{ trans('main_translate.Status') }}</th>
                        <th>{{ trans('main_translate.Agent') }}</th>
                        <th>{{ trans('main_translate.Notes') }}</th>
                        <th>{{ trans('main_translate.Created') }}</th>
                        <th>{{ trans('main_translate.Updated') }}</th>
                        <th>{{ trans('main_translate.Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($users as $user )
                <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        {{-- <td>
                            @foreach ($products as $key => $value)
                            @if (str_contains(json_encode($user->product),$key ))
                            <span class="badge badge-success">{{$value}}</span>
                            @endif
                            @endforeach

                        </td> --}}


                        <td>
                            @foreach ($products as $name => $code)

                            @if (str_contains(json_encode($user->product),$code ))
                            <span class="badge badge-success">{{$name}}</span>
                            @endif
                            @endforeach

                        </td>
                        <td>
                            @if ($user->status == 'yes')
                            <span class="badge badge-success">{{ trans('main_translate.Active') }}</span>
                            @elseif ($user->status == 'no')
                            <span class="badge badge-danger">{{ trans('main_translate.Disabled') }}</span>
                            @else
                            <span class="badge badge-warning">{{ trans('main_translate.Not Confirmed') }}</span>
                            @endif

                        </td>
                        <td>
                            @if (is_array($user->agent))
                            @foreach ($user->agent as $id => $name)
                            <span class="badge badge-success">{{$name}}</span>
                            @endforeach
                            @else
                            <span class="badge badge-success"></span>
                            @endif


                        </td>
                        <td>{{ $user->notes }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->updated_at }}</td>
                        <td>
                            <div style="display: flex">
                                @can('active_disable_users')
                                <form action='{{ route('active_disable', $user->id) }}' method="post">
                                    @method('put')
                                    @csrf
                                    @if ($user->status == 'yes')
                                    <button type="submit" class="btn btn-danger mr-2"><i class="fa fa-ban"></i>
                                    </button>
                                    @else
                                    <button type="submit" class="btn btn-success mr-2"><i class="fa fa-check-square"></i>
                                    </button>
                                    @endif
                                </form>
                                @endcan
                                @can('edit_users')
                                <a href='{{ route('edit_user', $user->id) }}'><button class="btn btn-info mr-2"><i class="fa fa-edit"></i></button></a>
                                @endcan

                                @can('delete_users')
                                    @if (Auth::user()->id == $user->id || str_contains(json_encode($user->roles_name),"owner")   )
                                        <a class="btn btn-secondary mr-2" disabled><i class="fa fa-trash"></i></a>
                                    @else
                                        {{-- <a class="modal-effect btn btn btn-danger mr-2" data-effect="effect-scale" data-user_id="{{ $user->id }}" data-username="{{ $user->name }}" data-toggle="modal" href="#modaldemo8" ><i class="fa fa-trash"></i></a>
                                        <div class="modal" id="modaldemo8">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content modal-content-demo">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title">{{ trans('main_translate.Delete User!!') }}</h6><button aria-label="Close" class="close"
                                                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <form action="{{ route('delete_user',$user->id) }}" method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <div class="modal-body">
                                                            <p>{{ trans('main_translate.Are you sure want to delete this user') }}</p><br>
                                                            <input type="hidden" name="user_id" id="user_id" value="">
                                                            <input class="form-control" name="username" id="username" type="text" readonly>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('main_translate.Cancel') }}</button>
                                                            <button type="submit" class="btn btn-danger">{{ trans('main_translate.Delete') }}</button>
                                                        </div>
                                                        </div>
                                                    </form>
                                            </div>
                                        </div> --}}


                                        <form action="{{ route('delete_user',$user->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete user {{$user->name}}?');">
                                            @method('delete')
                                            @csrf
                                            {{-- <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{route('delete_log',$log->id)}}"><i class="fa fa-trash"></i></a> --}}

                                                <button type="submit" class="btn btn-danger mr-2"><i class="fa fa-trash"></i></button>
                                        </form>
                                    @endif
                                @endcan
                            </div>
                        </td>
                </tr>
                @endforeach
                </tbody>
            </table>

        </div>

    @endcan


@endsection

@section('css')
<link rel="stylesheet" href="{{ URL::asset('adminlte/assets/css/dataTables.bootstrap4.min.css') }}">

<link href="{{ URL::asset('adminlte/assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
<style>
    .dtr-control{
        cursor: pointer;
    }
</style>

@endsection


@section('scripts')

<script src="{{ URL::asset('adminlte/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('adminlte/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('adminlte/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('adminlte/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('adminlte/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('adminlte/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
{{-- <script src="{{ URL::asset('adminlte/assets/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ URL::asset('adminlte/assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('adminlte/assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ URL::asset('adminlte/assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('adminlte/assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('adminlte/assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script> --}}


<!--Internal  Notify js -->
<script src="{{ URL::asset('adminlte/assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ URL::asset('adminlte/assets/plugins/notify/js/notifit-custom.js') }}"></script>
<script>
 $(function () {
    // $("#example1").DataTable({
    //   "responsive": true, "lengthChange": false, "autoWidth": false,
    //   //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    //   "buttons": ["csv", "excel", "pdf", "print"]
    // }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
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
      "order": [[ 7, "desc" ]]
    }).buttons().container().appendTo('#example1_wrapper');
  });
//   $('#modaldemo8').on('show.bs.modal', function(event) {
//         var button = $(event.relatedTarget)
//         var user_id = button.data('user_id')
//         var username = button.data('username')
//         var modal = $(this)
//         modal.find('.modal-body #user_id').val(user_id);
//         modal.find('.modal-body #username').val(username);
//     })

</script>

@endsection




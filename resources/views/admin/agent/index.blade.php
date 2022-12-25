@extends('layouts.adminlte.master')

@section('title')
{{-- master title here --}}
{{ trans('main_translate.Agents List') }}
@endsection


@section('title_page')
{{ trans('main_translate.Agents List') }}
    @can('create_agent')
        <a class="btn btn-primary btn-sm" href="{{ route('create_agent') }}">{{ trans('main_translate.Add Agent') }}</a>
    @endcan

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

    @can('show_agent')
        <div class="container-fluid">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>{{ trans('main_translate.Name') }}</th>
                        <th>{{ trans('main_translate.Actions') }}</th>
                    </tr>
                </thead>
                <tbody>

                @foreach ($agents as $agent )
                <tr>
                        <td>{{ $agent->id }}</td>
                        <td>{{ $agent->name }}</td>
                        <td>
                            <div style="display: flex">
                                @can('edit_agent')
                                    <a href='{{ route('edit_agent', $agent->id) }}'><button class="btn btn-warning mr-2"><i class="fa fa-edit"></i></button></a>
                                @endcan

                                @can('delete_agent')
                                    <form action="{{ route('delete_agent',$agent->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this log?');">
                                        @method('delete')
                                        @csrf
                                        {{-- <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{route('delete_log',$log->id)}}"><i class="fa fa-trash"></i></a> --}}

                                            <button type="submit" class="btn btn-danger mr-2"><i class="fa fa-trash"></i></button>
                                    </form>
                                @endcan

                                {{-- @can('delete_agent')
                                    <a class="modal-effect btn btn btn-danger" data-effect="effect-scale" data-user_id="{{ $agent->id }}" data-username="{{ $agent->name }}" data-toggle="modal" href="#modaldemo8" >Delete</a>

                                    <div class="modal" id="modaldemo8">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">Delete User!!</h6><button aria-label="Close" class="close"
                                                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <form action="{{ route('delete_agent',$agent->id) }}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <div class="modal-body">
                                                        <p>Are you sure want to agent this user</p><br>
                                                        <input type="hidden" name="user_id" id="user_id" value="">
                                                        <input class="form-control" name="username" id="username" type="text" readonly>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                @endcan --}}

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


@extends('layouts.adminlte.master')

@section('title')
{{-- master title here --}}
Roles List
@endsection


@section('title_page')
Roles List
    @can('create_roles')
        <a class="btn btn-primary btn-sm" href="{{ route('roles.create') }}">Add</a>
    @endcan
@endsection



@section('content')

    @can('show_roles')

        @if (session()->has('Add'))
            <script>
                window.onload = function() {
                    notif({
                        msg: " تم اضافة الصلاحية بنجاح",
                        type: "success"
                    });
                }
            </script>
        @endif

        @if (session()->has('edit'))
            <script>
                window.onload = function() {
                    notif({
                        msg: " تم تحديث بيانات الصلاحية بنجاح",
                        type: "success"
                    });
                }
            </script>
        @endif

        @if (session()->has('delete'))
            <script>
                window.onload = function() {
                    notif({
                        msg: " تم حذف الصلاحية بنجاح",
                        type: "error"
                    });
                }
            </script>
        @endif

        <div class="row row-sm">
            <div class="col-xl-12">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table mg-b-0 text-md-nowrap table-hover ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Role Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $key => $role)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>
                                                    <a class="btn btn-success btn-sm" href="{{ route('roles.show', $role->id) }}">Show</a>

                                                @can('edit_roles')
                                                    <a class="btn btn-primary btn-sm"
                                                        href="{{ route('roles.edit', $role->id) }}">Edit</a>
                                                @endcan

                                                @if ($role->name !== 'owner')
                                                    @can('delete_roles')
                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy',
                                                        $role->id], 'style' => 'display:inline']) !!}
                                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                                        {!! Form::close() !!}
                                                    @endcan
                                                @endif


                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
        </div>

    @endcan

@endsection

@section('css')
<link href="{{ URL::asset('adminlte/assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection

@section('scripts')
<!--Internal  Notify js -->
<script src="{{ URL::asset('adminlte/assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ URL::asset('adminlte/assets/plugins/notify/js/notifit-custom.js') }}"></script>
@endsection


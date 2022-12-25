@extends('layouts.adminlte.master')


@section('title')
{{-- master title here --}}
show Role
@endsection


@section('title_page')
Show Role Permissions
    <a class="btn btn-primary btn-sm" href="{{ route('roles.index') }}">Back</a>
@endsection

@section('content')

    @can('show_roles')

        <div class="row">
            <div class="col-md-12">
                <div class="card mg-b-20">
                    <div class="card-body">

                        <div class="row">
                            <!-- col -->
                            <div class="col-lg-4">
                                <ul id="treeview1">
                                    <li><a href="#">{{ $role->name }}</a>
                                        <ul>
                                            @if(!empty($rolePermissions))
                                            @foreach($rolePermissions as $v)
                                            <li>{{ $v->name }}</li>
                                            @endforeach
                                            @endif
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <!-- /col -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endcan

@endsection

@section('css')
<!--Internal  Font Awesome -->
<link href="{{URL::asset('adminlte/assets/plugins/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
<!--Internal  treeview -->
<link href="{{URL::asset('adminlte/assets/plugins/treeview/treeview.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('js')
<script src="{{URL::asset('adminlte/assets/plugins/treeview/treeview.js')}}"></script>

@endsection

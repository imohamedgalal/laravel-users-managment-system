@extends('layouts.adminlte.master')

@section('title')
{{-- master title here --}}
Create Role
@endsection


@section('title_page')
Create Role
<a class="btn btn-primary btn-sm" href="{{ route('roles.index') }}">Back</a>

@endsection



@section('content')

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>خطا</strong>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    @can('create_roles')

        {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}

            <div class="row">
                <div class="col-md-12">
                    <div class="card mg-b-20">
                        <div class="card-body">
                            <div class="main-content-label mg-b-5">
                                <div class="col-xs-7 col-sm-7 col-md-7">
                                    <div class="form-group">
                                        <p>Role Name:</p>
                                        {!! Form::text('name', null, array('class' => 'form-control')) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <!-- col -->
                                <div class="col-lg-4">
                                    <ul id="treeview1">
                                        <li><a href="#">Permissions</a>
                                            <ul>
                                        </li>
                                        @foreach($permission as $value)
                                        <label
                                            style="font-size: 16px;">{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                                            {{ $value->name }}</label>

                                        @endforeach
                                        </li>

                                    </ul>
                                    </li>
                                    </ul>
                                </div>
                                <!-- /col -->
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

        {!! Form::close() !!}

    @endcan

@endsection

@section('css')

@endsection

@section('scripts')

@endsection



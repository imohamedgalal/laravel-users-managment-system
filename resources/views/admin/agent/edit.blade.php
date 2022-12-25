@extends('layouts.adminlte.master')

@section('title')
{{-- master title here --}}
{{ trans('main_translate.Edit Agent') . " " . $agent->name }}
@endsection


@section('title_page')
{{ trans('main_translate.Edit Agent') }}
<a class="btn btn-primary btn-sm" href="{{ route('index_agents') }}">{{ trans('main_translate.Back') }}</a>

@endsection


@section('content')
    @can('edit_agent')
        <div class="container-fluid">
            <form action="{{ route('update_agent', $agent->id) }}" method="post">
                @method('patch')

                @csrf

                <div class="form=group mb-3">
                    <label for="name">{{ trans('main_translate.Agent Name:') }}</label>
                    <div><input type="text" name="name" class="form-control" value="{{$agent->name}}" required></div>
                </div>


                <div class="form-group mb-3">
                    <button type="submit" class="btn btn-primary">{{ trans('main_translate.Save') }}</button>
                </div>

            </form>
        </div>
    @endcan
@endsection



@section('css')

@endsection


@section('scripts')

@endsection

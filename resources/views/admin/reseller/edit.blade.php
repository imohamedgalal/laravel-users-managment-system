@extends('layouts.adminlte.master')

@section('title')
{{-- master title here --}}
{{ trans('main_translate.Edit Reseller') . " " . $reseller->name }}
@endsection


@section('title_page')
{{ trans('main_translate.Edit Reseller') }}
<a class="btn btn-primary btn-sm" href="{{ route('index_resellers') }}">{{ trans('main_translate.Back') }}</a>

@endsection


@section('content')
    @can('edit_reseller')
        <div class="container-fluid">
            <form action="{{ route('update_reseller', $reseller->id) }}" method="post">
                @method('patch')

                @csrf

                <div class="form=group mb-3">
                    <label for="name">{{ trans('main_translate.Reseller Name:') }}</label>
                    <div><input type="text" name="name" class="form-control" value="{{$reseller->name}}" required></div>
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

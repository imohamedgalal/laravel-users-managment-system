
@extends('layouts.adminlte.master')

@section('title')
{{-- master title here --}}
{{ trans('main_translate.Add Reseller') }}
@endsection


@section('title_page')
{{ trans('main_translate.Add Reseller') }}
<a class="btn btn-primary btn-sm" href="{{ route('index_resellers') }}">{{ trans('main_translate.Back') }}</a>
@endsection



@section('content')

    @can('create_reseller')
        <div class="card-body">
            <form action="{{ route('store_reseller') }}" method="post">
                @csrf

                <div class="form=group mb-3">
                    <label for="name">{{ trans('main_translate.Reseller Name:') }}</label>
                    <div><input type="text" name="name" class="form-control"></div>
                </div>

                <div class="form=group mb-3">
                    <button type="submit" class="btn btn-primary">{{ trans('main_translate.Add Reseller') }}</button>
                </div>

            </form>
        </div>

    @endcan

@endsection

@section('css')

@endsection


@section('scripts')


@endsection


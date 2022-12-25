
@extends('layouts.adminlte.master')

@section('title')
{{ trans('main_translate.Add Product') }}
@endsection


@section('title_page')
{{ trans('main_translate.Add Product') }}
<a class="btn btn-primary btn-sm" href="{{ route('index_products') }}">{{ trans('main_translate.Back') }}
</a>
@endsection



@section('content')

    @can('create_product')
        <div class="card-body">
            <form action="{{ route('store_product') }}" method="post">
                @csrf

                <div class="form=group mb-3">
                    <label for="code">{{ trans('main_translate.Product Code:') }}</label>
                    <div><input type="text" name="code" class="form-control"></div>
                </div>

                <div class="form=group mb-3">
                    <label for="name">{{ trans('main_translate.Product Name:') }}</label>
                    <div><input type="text" name="name" class="form-control"></div>
                </div>

                <div class="form=group mb-3">
                    <label for="version">{{ trans('main_translate.Product Version:') }}</label>
                    <div><input type="text" name="version" class="form-control"></div>
                </div>

                <div class="form=group mb-3">
                    <button type="submit" class="btn btn-primary">{{ trans('main_translate.Add Product') }}</button>
                </div>

            </form>
        </div>

    @endcan

@endsection

@section('css')

@endsection


@section('scripts')


@endsection


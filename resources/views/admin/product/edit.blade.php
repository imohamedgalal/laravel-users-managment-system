@extends('layouts.adminlte.master')

@section('title')
{{ trans('main_translate.Edit Product') . " " . $product->name }}
@endsection


@section('title_page')
{{ trans('main_translate.Edit Product') }}
<a class="btn btn-primary btn-sm" href="{{ route('index_products') }}">{{ trans('main_translate.Back') }}</a>

@endsection


@section('content')
    @can('edit_product')
        <div class="container-fluid">
            <form action="{{ route('update_product', $product->code) }}" method="post">
                @method('patch')

                @csrf

                <div class="form=group mb-3">
                    <label for="code">{{ trans('main_translate.Product Code:') }}</label>
                    <div><input type="text" name="code" class="form-control" value="{{$product->code}}" required></div>
                </div>

                <div class="form=group mb-3">
                    <label for="name">{{ trans('main_translate.Product Name:') }}</label>
                    <div><input type="text" name="name" class="form-control" value="{{$product->name}}" required></div>
                </div>

                <div class="form=group mb-3">
                    <label for="version">{{ trans('main_translate.Product Version:') }}</label>
                    <div><input type="text" name="version" class="form-control" value="{{$product->version}}" required></div>
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

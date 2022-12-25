@extends('layouts.adminlte.master')

@section('title')
{{-- master title here --}}
{{ trans('main_translate.Edit Payment Method') }}
@endsection


@section('title_page')
{{ trans('main_translate.Edit Payment Method') }}
<a class="btn btn-primary btn-sm" href="{{ route('index_payments') }}">{{ trans('main_translate.Back') }}</a>

@endsection


@section('content')
    @can('edit_payment')
        <div class="container-fluid">
            <form action="{{ route('update_payment', $payments->id) }}" method="post">
                @method('patch')

                @csrf

                <div class="form=group mb-3">
                    <label for="name">{{ trans('main_translate.Payment Method:') }}</label>
                    <div><input type="text" name="pay_method" class="form-control" value="{{$payments->pay_method}}" required></div>
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

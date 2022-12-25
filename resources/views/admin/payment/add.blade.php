
@extends('layouts.adminlte.master')

@section('title')
{{-- master title here --}}
{{ trans('main_translate.Add Payment Method') }}
@endsection


@section('title_page')
{{ trans('main_translate.Add Payment Method') }}
<a class="btn btn-primary btn-sm" href="{{ route('index_payments') }}">{{ trans('main_translate.Back') }}</a>
@endsection



@section('content')

    @can('create_payment')
        <div class="card-body">
            <form action="{{ route('store_payment') }}" method="post">
                @csrf

                <div class="form=group mb-3">
                    <label for="name">{{ trans('main_translate.Payment Method') }}:</label>
                    <div><input type="text" name="pay_method" class="form-control"></div>
                </div>

                <div class="form=group mb-3">
                    <button type="submit" class="btn btn-primary">{{ trans('main_translate.Add Payment Method') }}</button>
                </div>

            </form>
        </div>

    @endcan

@endsection

@section('css')

@endsection


@section('scripts')


@endsection


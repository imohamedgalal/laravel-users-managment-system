@extends('layouts.adminlte.master')

@section('title')
{{-- master title here --}}
{{ trans('main_translate.Product List') }}
@endsection


@section('title_page')
{{ trans('main_translate.Product List') }}
    @can('create_product')
        <a class="btn btn-primary btn-sm" href="{{ route('create_product') }}">{{ trans('main_translate.Add Product') }}</a>
    @endcan

@endsection


@section('content')
    @if (session()->has('success'))
        <script>
            window.onload = function() {
                notif({
                    msg: "{{session()->get('success')}}",
                    type: "success"
                });
            }
        </script>
    @endif

    @can('show_product')
        <div class="container-fluid">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>{{ trans('main_translate.Code') }}</th>
                        <th>{{ trans('main_translate.Name') }}</th>
                        <th>{{ trans('main_translate.Version') }}</th>
                        <th>{{ trans('main_translate.Actions') }}</th>
                    </tr>
                </thead>
                <tbody>

                @foreach ($products as $product )
                <tr>
                        <td>{{ $product->code }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->version }}</td>
                        <td>
                            <div style="display: flex">
                                @can('edit_product')
                                    <a href='{{ route('edit_product', $product->code) }}'><button class="btn btn-warning mr-2"><i class="fa fa-edit"></i></button></a>
                                @endcan

                                @can('delete_product')
                                    <a class="modal-effect btn btn btn-danger mr-2" data-effect="effect-scale" data-user_id="{{ $product->code }}" data-username="{{ $product->name }}" data-toggle="modal" href="#modaldemo8" ><i class="fa fa-trash"></i></a>

                                    <div class="modal" id="modaldemo8">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">{{ trans('main_translate.Delete Product!!') }}</h6><button aria-label="Close" class="close"
                                                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <form action="{{ route('delete_product',$product->code) }}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <div class="modal-body">
                                                        <p>{{ trans('main_translate.Are you sure want to delete this product?') }}</p><br>
                                                        <input type="hidden" name="user_id" id="user_id" value="">
                                                        <input class="form-control" name="username" id="username" type="text" readonly>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('main_translate.Cancel') }}</button>
                                                        <button type="submit" class="btn btn-danger">{{ trans('main_translate.Delete') }}</button>
                                                    </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                @endcan

                            </div>

                        </td>
                </tr>
                @endforeach


                </tbody>
            </table>

        </div>
    @endcan



@endsection

@section('css')
<link rel="stylesheet" href="{{ URL::asset('adminlte/assets/css/dataTables.bootstrap4.min.css') }}">

<link href="{{ URL::asset('adminlte/assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />

@endsection


@section('scripts')
<script src="{{ URL::asset('adminlte/assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ URL::asset('adminlte/assets/plugins/notify/js/notifit-custom.js') }}"></script>

<script>
    $('#modaldemo8').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var user_id = button.data('user_id')
        var username = button.data('username')
        var modal = $(this)
        modal.find('.modal-body #user_id').val(user_id);
        modal.find('.modal-body #username').val(username);
    })
</script>
@endsection


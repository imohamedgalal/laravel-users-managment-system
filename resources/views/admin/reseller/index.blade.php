@extends('layouts.adminlte.master')

@section('title')
{{-- master title here --}}
{{ trans('main_translate.Resellers List') }}
@endsection


@section('title_page')
{{ trans('main_translate.Resellers List') }}
    @can('create_reseller')
        <a class="btn btn-primary btn-sm" href="{{ route('create_reseller') }}">{{ trans('main_translate.Add Reseller') }}</a>
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

    @can('show_reseller')
        <div class="container-fluid">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>{{ trans('main_translate.Name') }}</th>
                        <th>{{ trans('main_translate.Actions') }}</th>
                    </tr>
                </thead>
                <tbody>

                @foreach ($resellers as $reseller )
                <tr>
                        <td>{{ $reseller->id }}</td>
                        <td>{{ $reseller->name }}</td>
                        <td>
                            <div style="display: flex">
                                @can('edit_reseller')
                                    <a href='{{ route('edit_reseller', $reseller->id) }}'><button class="btn btn-warning mr-2"><i class="fa fa-edit"></i></button></a>
                                @endcan

                                @can('delete_reseller')
                                    <form action="{{ route('delete_reseller',$reseller->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this reseller?');">
                                        @method('delete')
                                        @csrf
                                        {{-- <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{route('delete_log',$log->id)}}"><i class="fa fa-trash"></i></a> --}}

                                            <button type="submit" class="btn btn-danger mr-2"><i class="fa fa-trash"></i></button>
                                    </form>
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


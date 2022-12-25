@extends('layouts.adminlte.master')

@section('title')
{{-- master title here --}}
MG Dashbord
@endsection


@section('title_page')
Edit Admin
@endsection


@section('content')
    @can('edit_admins')
        <div class="container-fluid">
            <form action="{{ route('update_user', $user->id) }}" method="post">
                @method('patch')

                @csrf
                <input type="hidden" name="id" value="{{ $user->id }}">

                <div class="form=group mb-3">
                    <label for="name">Name:</label>
                    <div><input type="text" name="name" class="form-control" value="{{$user->name}}" required></div>
                </div>

                <div class="form=group mb-3">
                    <label for="username">Usernme:</label>
                    <div><input type="text" name="username" class="form-control" value="{{$user->username}}" required></div>
                </div>

                <div class="form=group mb-3">
                    <label for="email">Email:</label>
                    <div><input type="email" name="email" class="form-control" value="{{$user->email}}" required></div>
                </div>

                <div class="form=group mb-3">
                    <label for="password">Password:</label>
                    <div><input type="password" name="password" class="form-control" value="{{$user->password}}" required></div>
                </div>

                <div class="form=group mb-3">
                    <label for="mobile">Mobile:</label>
                    <div><input type="text" name="mobile" class="form-control" value="{{$user->mobile}}"></div>
                </div>
                <div class="form-group">
                    <label>Product:</label>

                    <select id="product" name="product[]" class="select2" multiple="multiple" style="width: 100%;">
                        @foreach ($products as $name => $code)
                        <option value="{{ $code }}" {!! str_contains(json_encode($user->product),$code ) ? 'selected="selected"' : ''!!}>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="form=group mb-3">
                    <label for="agent">Agent:</label>
                    <div><input type="text" name="agent" class="form-control" value="{{$user->agent}}"></div>
                </div>

                <div class="form=group mb-3">
                    <label for="pay_method">pay_method:</label>
                    <div><input type="text" name="pay_method" class="form-control" value="{{$user->pay_method}}"></div>
                </div>

                <div class="form=group mb-3">
                    <label for="amount">amount:</label>
                    <div><input type="text" name="amount" class="form-control" value="{{$user->amount}}"></div>
                </div>

                <div class="form=group mb-3">
                    <label for="userSession">userSession:</label>
                    <div><input type="text" name="userSession" class="form-control" value="{{$user->userSession}}"></div>
                </div>

                <div class="form=group mb-3">
                    <label for="notes">Notes:</label>
                    <div><input type="text" name="notes" class="form-control" value="{{$user->notes}}"></div>
                </div>

                <div class="form=group mb-3">
                    <label for="active">Status:</label>
                    <div><input type="text" name="active" class="form-control" value="{{$user->active}}"></div>
                </div>

                @can('edit_roles')
                <div class="formgroup mb-3">
                    <strong>Roles Name</strong>

                    <select id="roles_name" name="roles_name[]" class="select2" multiple="multiple" style="width: 100%;">

                        @foreach ($roles as $key => $value)

                        <option value="{{ $key }}" {!! !empty($user->roles_name) && in_array($key,$user->roles_name ) ? 'selected="selected"' : ''!!}>{{ $value }}</option>

                        @endforeach
                    </select>
                </div>
                @endcan


                <div class="form-group mb-3">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>

            </form>
        </div>
    @endcan
@endsection



@section('css')

<link rel="stylesheet" href="{{ URL::asset('adminlte/assets/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('adminlte/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice{
        background-color: #007bff;
    border-color: #006fe6;
    color: #fff;
    padding: 0 10px;
    margin-top: .31rem;
    }
</style>
@endsection


@section('scripts')
<script src="{{ URL::asset('adminlte/assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script>

    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()
    });

</script>

@endsection

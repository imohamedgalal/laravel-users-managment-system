
@extends('layouts.adminlte.master')

@section('title')
{{-- master title here --}}
{{ trans('main_translate.Add User') }}
@endsection


@section('title_page')
{{ trans('main_translate.Add User') }}
<a class="btn btn-primary btn-sm" href="{{ route('index_users') }}">{{ trans('main_translate.Back') }}</a>

@endsection



@section('content')

    @can('create_users')
        <div class="card-body">
            <form action="{{ route('store_user') }}" method="post">
                @csrf
                <div class="fields">
                <div class="input-field">
                    <label for="name">{{ trans('main_translate.Name:') }}</label>
                    <div><input type="text" name="name" class="form-control"></div>
                </div>

                <div class="input-field">
                    <label for="username">{{ trans('main_translate.Usernme:') }}</label>
                    <div><input type="text" name="username" class="form-control"></div>
                </div>

                <div class="input-field">
                    <label for="email">{{ trans('main_translate.Email:') }}</label>
                    <div><input type="email" name="email" class="form-control"></div>
                </div>

                <div class="input-field">
                    <label for="password">{{ trans('main_translate.Password:') }}</label>
                    <div><input type="password" name="password" class="form-control"></div>
                </div>

                <div class="input-field">
                    <label for="mobile">{{ trans('main_translate.Mobile:') }}</label>
                    <div><input type="text" name="mobile" class="form-control"></div>
                </div>

                <div class="input-field">
                    <label for="product">{{ trans('main_translate.Product:') }}</label>
                    <select id="product" name="product[]" class="select2" multiple="multiple" style="width: 100%;">
                        @foreach ($products as $name => $code)
                        <option value="{{ $code }}" >{{ $name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="input-field">
                    <label>{{ trans('main_translate.Agent:') }}</label>

                    <select id="agent" name="agent[]" class="select2" multiple="multiple" style="width: 100%;">
                        <option value="">--- Select ---</option>

                        @foreach ($agents as $name => $id)

                        <option value="{{ $name }}">{{ $name }}</option>

                        @endforeach
                    </select>
                </div>

                <div class="input-field">
                    <label>{{ trans('main_translate.Reseller:') }}</label>

                    <select id="reseller" name="reseller[]" class="select2" multiple="multiple" style="width: 100%;">
                        <option value="">--- Select ---</option>

                        @foreach ($resellers as $name => $id)

                        <option value="{{ $name }}">{{ $name }}</option>

                        @endforeach
                    </select>
                </div>

                <div class="input-field" style="position:relative">
                    <label style="display: block">{{ trans('main_translate.Pay Method:') }}</label>

                    <select id="pay_method" name="pay_method[]" class="select2" multiple="multiple" style="display: inline-block;">
                        <option value="">None</option>

                        @foreach ($payments as $name => $id)

                        <option value="{{ $name }}">{{ $name }}</option>

                        @endforeach
                    </select>

                    @can('show_webapp_coins_info')


                            <!-- Trigger the modal with a button -->
                        <button type="button" id="eainfo" class="btn btn-info" data-toggle="modal" data-target="#myModal" style="width: 33%;float: right;top: 18%;position: absolute;right: 0px;padding: 0;height: auto;">Webapp Details:</button>

                        <!-- Modal -->
                        <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                <h4 class="modal-title">{{ trans('main_translate.Webapp Details:') }}</h4>
                                <button type="button" class="btn" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">

                                    <div style="align-items: center;display: flex;">
                                        <label for="eaemail">{{ trans('main_translate.Webapp Email:') }}</label>
                                        <input type="text" name="eaemail" class="form-control">
                                    </div>

                                    <div style="align-items: center;display: flex;">
                                        <label for="eapassword">{{ trans('main_translate.WepApp Password:') }}</label>
                                        <input type="text" name="eapassword" class="form-control">
                                    </div>

                                    <div style="align-items: center;display: flex;">
                                        <label for="eacode1">{{ trans('main_translate.Backup Code 1:') }}</label>
                                        <input type="text" name="eacode1" class="form-control">
                                    </div>

                                    <div style="align-items: center;display: flex;">
                                        <label for="eacode2">{{ trans('main_translate.Backup Code 2:') }}</label>
                                        <input type="text" name="eacode2" class="form-control">
                                    </div>

                                    <div style="align-items: center;display: flex;">
                                        <label for="eacode3">{{ trans('main_translate.Backup Code 3:') }}</label>
                                        <input type="text" name="eacode3" class="form-control">
                                    </div>

                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                            </div>
                        </div>
                    @endcan
                </div>

                <div class="input-field">
                    <label for="amount">{{ trans('main_translate.Amount:') }}</label>
                    <div><input type="text" name="amount" class="form-control"></div>
                </div>

                <div class="input-field">
                    <label for="userSession">{{ trans('main_translate.userSession:') }}</label>
                    <div><input type="text" name="userSession" class="form-control"></div>
                </div>


                <div class="input-field">
                    <label for="active_for">{{ trans('main_translate.Active for:') }}</label>
                    <div>
                        <input type="datetime-local" name="active_for" class="form-control">
                    </div>
                </div>

                <div class="input-field">
                    <label for="active">{{ trans('main_translate.Status:') }}</label>
                        {{-- <strong>Status:</strong> --}}
                          <select name="status" class="form-control">
                            <option value="no">{{ trans('main_translate.Disabled') }}</option>
                            <option value="yes">{{ trans('main_translate.Active') }}</option>
                         </select>
                </div>

                <div class="input-field">
                    <label for="notes">{{ trans('main_translate.Notes:') }}</label>
                    <div><input type="text" name="notes" class="form-control"></div>
                </div>

                @can('edit_roles')
                <div class="input-field">
                    <strong>{{ trans('main_translate.Roles Name:') }}</strong>

                    <select id="roles_name" name="roles_name[]" class="select2" multiple="multiple" style="width: 100%;">
                        <option value="">None</option>

                        @foreach ($roles as $key => $value)

                        <option value="{{ $key }}">{{ $value }}</option>

                        @endforeach
                    </select>
                </div>
                @endcan

                </div>

                <div class="" style="text-align: center;">
                    <button type="submit" class="btn btn-primary">{{ trans('main_translate.Save') }}<i class="fa fa-save" aria-hidden="true" style="margin:5px"></i>
                    </button>
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
    .fields{
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    }
    .fields .input-field{
    display: flex;
    width: calc(100% / 2 - 15px);
    flex-direction: column;
    margin: 4px 0;
    }
    form button {
            display: flex;
    align-items: center;
    justify-content: center;
    height: 45px;
    max-width: 200px;
    width: 100%;
    border: none;
    outline: none;
    color: #fff;
    border-radius: 5px;
    margin: 25px auto;
    background-color: #4070f4;
    transition: all 0.3s linear;
    cursor: pointer;
    }
    @media (max-width: 750px) {
    .container form{
        overflow-y: scroll;
    }
    .container form::-webkit-scrollbar{
       display: none;
    }
    form .fields .input-field{
        width: calc(100% / 2 - 15px);
    }
    }

    @media (max-width: 550px) {
        form .fields .input-field{
            width: 100%;
        }
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
        $('#eainfo').hide();

    $("#pay_method").change(function() {
    if (this.value == "coins") {
        $('#eainfo').show();
    } else {
        $('#eainfo').hide();
    }
    }).change();

</script>

@endsection


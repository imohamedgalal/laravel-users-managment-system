<!DOCTYPE html>
<!--=== Coding by CodingLab | www.codinglabweb.com === -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fut Heroes Registration</title>
    <link rel="icon" type="image/x-icon" href="{{ URL::asset('adminlte/assets/css/heroes.ico') }}">


    <!----======== CSS ======== -->
    <style>
        /* ===== Google Font Import - Poppins ===== */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap');
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}
body{
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #4070f4;
}
.container{
    position: relative;
    max-width: 900px;
    width: 100%;
    border-radius: 6px;
    padding: 30px;
    margin: 0 15px;
    background-color: #fff;
    box-shadow: 0 5px 10px rgba(0,0,0,0.1);
}
.container header{
    position: relative;
    font-size: 20px;
    font-weight: 600;
    color: #333;
}
.container header::before{
    content: "";
    position: absolute;
    left: 0;
    bottom: -2px;
    height: 3px;
    width: 27px;
    border-radius: 8px;
    background-color: #4070f4;
}
.container form{
    position: relative;
    margin-top: 16px;
    /* min-height: 490px; */
    background-color: #fff;
    overflow: hidden;
}
.container form .form{
    position: absolute;
    background-color: #fff;
    transition: 0.3s ease;
}
.container form .form.second{
    opacity: 0;
    pointer-events: none;
    transform: translateX(100%);
}
form.secActive .form.second{
    opacity: 1;
    pointer-events: auto;
    transform: translateX(0);
}
form.secActive .form.first{
    opacity: 0;
    pointer-events: none;
    transform: translateX(-100%);
}
.container form .title{
    display: block;
    margin-bottom: 8px;
    font-size: 16px;
    font-weight: 500;
    margin: 6px 0;
    color: #333;
}
.container form .fields{
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
}
form .fields .input-field{
    display: flex;
    width: calc(100% / 2 - 15px);
    flex-direction: column;
    margin: 4px 0;
}
.input-field label{
    font-size: 12px;
    font-weight: 500;
    color: #2e2e2e;
}
.input-field input, select{
    outline: none;
    font-size: 14px;
    font-weight: 400;
    color: #333;
    border-radius: 5px;
    border: 1px solid #aaa;
    padding: 0 15px;
    height: 42px;
    margin: 8px 0;
}
.input-field input :focus,
.input-field select:focus{
    box-shadow: 0 3px 6px rgba(0,0,0,0.13);
}
.input-field select,
.input-field input[type="date"]{
    color: #707070;
}
.input-field input[type="date"]:valid{
    color: #333;
}
.container form button, .backBtn{
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
.container form .btnText{
    font-size: 14px;
    font-weight: 400;
}
form button:hover{
    background-color: #265df2;
}
form button i,
form .backBtn i{
    margin: 0 6px;
}
form .backBtn i{
    transform: rotate(180deg);
}
form .buttons{
    display: flex;
    align-items: center;
}
form .buttons button , .backBtn{
    margin-right: 14px;
}


.select2-container .select2-selection--multiple {
    height: 42px;
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

    <!----===== Iconscout CSS ===== -->

    <link rel="stylesheet" href="{{ URL::asset('adminlte/assets/plugins/select2/css/select2.min.css') }}">


    <!--<title>Responsive Regisration Form </title>-->
</head>
<body>
    <div class="container">
        <header>Registration</header>

        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="fields">


                <div class="input-field">
                    <x-label for="name" :value="__('Name')" />

                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"  placeholder="Enter Full name" required autofocus />
                </div>


                <div class="input-field">
                    <x-label for="username" :value="__('Username')" />

                    <x-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" placeholder="Enter username" required autofocus />
                </div>


                <div class="input-field">
                    <x-label for="email" :value="__('Email')" />

                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" placeholder="Enter Email" required />
                </div>

                <div class="input-field">
                    <x-label for="mobile" :value="__('Mobile')" />
                    <x-input id="mobile" class="block mt-1 w-full" type="text" name="mobile" :value="old('mobile')"  placeholder="Enter Your Mobile" required autofocus />
                </div>
                            <!-- Password -->
                <div class="input-field">
                    <x-label for="password" :value="__('Password')" />

                    <x-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    placeholder="Enter Password"
                                    required autocomplete="new-password" />
                </div>

                <!-- Confirm Password -->
                <div class="input-field">
                    <x-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" placeholder="RE Enter Password" required />
                </div>



                <!--<div class="input-field">-->
                <!--    <label for="product">{{ trans('main_translate.Product:') }}</label>-->
                <!--    <select id="product" name="product[]" class="product" multiple="multiple" style="width: 100%;">-->
                <!--        @foreach ($products as $name => $code)-->
                <!--        <option value="{{ $code }}" >{{ $name }}</option>-->
                <!--        @endforeach-->
                <!--    </select>-->
                <!--</div>-->

                <div class="input-field">
                    <label for="product">{{ trans('main_translate.Product:') }}</label>
                        {{-- <strong>Status:</strong> --}}
                          <select name="product" class="form-control" required>
                              <option value="">Select Product</option>
                            @foreach ($products as $name => $code)
                        <option value="{{ $code }}" >{{ $name }}</option>
                        @endforeach
                         </select>
                </div>

                <!--<div class="input-field">-->
                <!--    <label>{{ trans('main_translate.Pay Method:') }}</label>-->

                <!--    <select id="pay_method" name="pay_method[]" class="pay_method" multiple="multiple" style="width: 100%;">-->

                <!--        @foreach ($payments as $name => $id)-->

                <!--        <option value="{{ $name }}">{{ $name }}</option>-->

                <!--        @endforeach-->
                <!--    </select>-->
                <!--</div>-->

                <div class="input-field">
                    <label for="pay_method">{{ trans('main_translate.Pay Method:') }}</label>
                        {{-- <strong>Status:</strong> --}}
                          <select  id="pay_method"  name="pay_method" class="form-control" required>
                            <option value="">Select Pay Method</option>
                            @foreach ($payments as $name => $id)

                                <option value="{{ $name }}">{{ $name }}</option>

                            @endforeach
                         </select>
                </div>



            </div>


            <!--<div class="fields" id="pay_coins">-->
            <!--    <div class="input-field">-->
            <!--        <x-label for="eaemail" :value="__('Ea WebApp Email')" />-->

            <!--        <x-input id="eaemail" class="block mt-1 w-full" type="email" name="eaemail" :value="old('eaemail')" placeholder="Enter webapp Email" />-->
            <!--    </div>-->


            <!--    <div class="input-field">-->
            <!--        <x-label for="eapassword" :value="__('Ea WebApp Password')" />-->

            <!--        <x-input id="eapassword" class="block mt-1 w-full" type="text" name="eapassword" :value="old('eapassword')"  placeholder="Enter Webapp Password" />-->
            <!--    </div>-->

            <!--    <div class="input-field">-->
            <!--        <x-label for="eacode1" :value="__('Ea Backup Code 1')" />-->

            <!--        <x-input id="eacode1" class="block mt-1 w-full" type="text" name="eacode1" :value="old('eacode1')"  placeholder="Enter Backup code 1" />-->
            <!--    </div>-->

            <!--    <div class="input-field">-->
            <!--        <x-label for="eacode2" :value="__('Ea Backup Code 2')" />-->

            <!--        <x-input id="eacode2" class="block mt-1 w-full" type="text" name="eacode2" :value="old('eacode2')"  placeholder="Enter Backup code 2" />-->
            <!--    </div>-->

            <!--    <div class="input-field">-->
            <!--        <x-label for="eacode3" :value="__('Ea Backup Code 3')" />-->

            <!--        <x-input id="eacode3" class="block mt-1 w-full" type="text" name="eacode3" :value="old('eacode3')"  placeholder="Enter Backup code 3" />-->
            <!--    </div>-->
            <!--</div>-->

            <!--<div class="fields">-->
            <!--    <div class="input-field" id="pay_paypal">-->
            <!--        <div class="input-field">-->
            <!--            <x-label for="paypal_email" :value="__('Paypal Email')" />-->
            <!--            <x-input id="paypal_email" class="block mt-1 w-full" type="email" name="paypal_email" :value="old('paypal_email')" placeholder="Enter paypal Email" />-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
            <!--<div class="fields">-->
            <!--    <div class="input-field" id="cash_number">-->
            <!--        <div class="input-field">-->
            <!--            <x-label for="cash_number" :value="__('Enter Cash Number')" />-->

            <!--            <x-input id="cash_number" class="block mt-1 w-full" type="text" name="cash_number" :value="old('cash_number')"  placeholder="Enter Cash Number" />-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->

            <div>

                <button type="submit">Register</button>

            </div>

        </form>
        <x-auth-validation-errors class="mt-4" style="color: red" :errors="$errors" />

    </div>
    <script src="{{ URL::asset('adminlte/assets/plugins/jquery/jquery.min.js') }}"></script>

    <script src="{{ URL::asset('adminlte/assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script>

    // $(function () {
      //Initialize Select2 Elements
    //   $('.product').select2({
    //     placeholder: "Select Product",

    //   });
    //   $('.pay_method').select2({
    //     placeholder: "Select Pay Method",

    //   })
    // });




    // $('#pay_coins').hide();
    // $('#pay_paypal').hide();
    // $('#cash_number').hide();

//   $("#pay_method").change(function() {
//     if (this.value == "") {
//         $('#pay_coins').hide();
//         $('#pay_paypal').hide();
//         $('#cash_number').hide();
//     }
//     if (this.value == "coins") {
//         $('#pay_coins').show();
//         $('#pay_paypal').hide();
//         $('#cash_number').hide();
//     }
//     if(this.value == "paypal") {
//         $('#pay_coins').hide();
//         $('#pay_paypal').show();
//         $('#cash_number').hide();
//     }
//     if(this.value == "cash") {
//         $('#pay_coins').hide();
//         $('#pay_paypal').hide();
//         $('#cash_number').show();
//     }
//     }).change();



</script>
</body>
</html>

@extends('layouts.app2')
@section('title', __('Register'))
@section('description', __('World\'s first fair trade tourism auctions'))
@section('keywords', 'Tourism Services, Attractions, Transportation, Tours, Save 60%, Fair Trade Tourism, No Agency Fees, Save More, Spend Less, Global Auctions, Amazing Deals')
@section('og-image', asset('images/image-cover.png'))
@section('og-image-url', asset('images/image-cover.png'))

@section('content')

@section('page')
    {{$host = request()->getHost()}}
    {{$lang = Config::get('app.locale')}}
    {{$terms = App\Page::where('code', 'terms')->where('lang', $lang)->first()}}
    {{-- {{$contract = App\Page::where('code', 'contract')->where('lang', $lang)->first()}} --}}
    {{$overview = App\Page::where('code', 'overview')->where('lang', $lang)->first()}}
@endsection
<br>
<div class="container">
    <p></p>
    <div class="row">
        <div class="col-md-6">
                <h3>{{ __('Create your account')}} </h3>
                <hr>
                    <form class="needs-validation" method="POST" action="{{ route('register') }}" novalidate>
                        @csrf
                        {{-- <div class="row text-center">
                            <div class="col-md-12">
                                <h4>{{ __('What type of user are your?') }}</h4>
                            </div>
                            <div class="col-md-12">
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-light">
                                        <input type="radio" name="roles" id="option1" autocomplete="off" value="Auctioneer" required> {{ __('Auctioneer')}}
                                    </label>
                                    <label class="btn btn-light">
                                        <input type="radio" name="options" id="option2" autocomplete="off" value="Bidder"> {{ __('Bidder')}}
                                    </label>
                                    <div class="invalid-feedback">
                                        {{ __('Please select a type') }}
                                    </div>
                                    @if ($errors->has('type'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('type') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div> --}}
                        <p></p>

                        <div class="form-group">
                            <label for="inputName">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                            <div class="invalid-feedback">
                                {{ __('Please enter your Name') }}
                            </div>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif

                        </div>
                        <div class="form-group">
                                <label for="email">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        {{-- <strong>{{ $errors->first('email') }}</strong> --}}
                                        {{ __('This email already exists, please enter another email') }}
                                    </span>
                                @else
                                    <div class="invalid-feedback">
                                        {{ __('Please enter a valid E-Mail Address') }}
                                    </div>
                                @endif
                                <span id="error_email"></span>
                        </div>
                        <div class="form-group">
                            <label for="country_id">{{ __('Country') }}</label>
                            {!! Form::select('country_id', App\Country::where('active', 1)->pluck('en_name', 'id'), null, ['placeholder'=>__('Select your Country'), 'class'=>'form-control select2', 'id' => 'country', 'required']) !!}
                            {{-- <select class="form-control select2 {{ $errors->has('lang') ? 'has-error' : '' }}" id="lang" name="lang" value="{{ old('lang') }}">
                                <option value="en">{{ __('Dominican Republic') }}</option>
                                <option value="es">{{ __('Mexico') }}</option>
                            </select> --}}
                            <div class="invalid-feedback">
                                {{ __('Please select your Country') }}
                            </div>

                            @if ($errors->has('country_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('country_id') }}</strong>
                                </span>
                            @endif

                        </div>
                        {{-- <div class="form-group">
                            <label for="inputEmail4">{{ __('Location') }}</label>
                            {!! Form::select('location_id', array('' => 'Please first select your Country'), null, ['class'=>'form-control select2', 'id' => 'locations', 'required', 'disabled']) !!}
                            <div class="invalid-feedback">
                                {{ __('Please select your Location') }}
                            </div>
                    
                            @if ($errors->has('location_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('location_id') }}</strong>
                                </span>
                            @endif
                    
                        </div> --}}
                        <div class="form-group">
                            <label for="inputEmail4">{{ __('Regions') }}</label>
                            {!! Form::select('region_id', array('' => 'Please first select your Country'), null, ['class'=>'form-control select2', 'id' => 'regions', 'required', 'disabled']) !!}
                            <div class="invalid-feedback">
                                {{ __('Please select your Region') }}
                            </div>
                    
                            @if ($errors->has('region_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('region_id') }}</strong>
                                </span>
                            @endif
                    
                        </div>
                        <div class="form-group">
                            <label for="inputEmail4">{{ __('Language') }}</label>
                            <select class="form-control select2 { $errors->has('lang') ? 'has-error' : '' }}" id="lang" name="lang" value="{{ old('lang') }}">
                                <option value="en">English</option>
                                <option value="es">Español</option>
                            </select>

                            @if ($errors->has('lang'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('lang') }}</strong>
                                </span>
                            @endif

                        </div>

                        {{-- <div class="form-group">
                            <label for="phone" class=" col-form-label text-md-right">{{__('Phone')}}</label>
                            <input id="phone" type="text" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required>
                            <div class="invalid-feedback">
                                {{ __('Please enter a valid Phone number') }}
                            </div>
                            @if ($errors->has('phone'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                        </div> --}}

                        <div class="form-group">
                            <label for="phone" class=" col-form-label text-md-right">{{__('Phone')}}</label>
                            <div class="input-group">
                                {{-- <div class="input-group-prepend">
                                    <select class="form-control" id="country-select" name="country-select">
                                        <option value="us">US</option>
                                        <option value="do">DO</option>
                                        <option value="es">ES</option>
                                        <option value="mx">MX</option>
                                        <option value="at">AT</option>
                                    </select>
                                </div> --}}
                                <input id="phone" type="text" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required>
                                <div class="invalid-feedback">
                                    {{ __('Please enter a valid Phone number') }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="company_name" class=" col-form-label text-md-right">{{__('Company Name')}} <small>- {{__('If you do not have a company name, please enter your name')}} </small></label>
                            <input id="company_name" type="text" class="form-control {{ $errors->has('company_name') ? ' is-invalid' : '' }}" name="company_name" value="{{ old('company_name') }}" required>
                            <div class="invalid-feedback">
                                {{ __('Please enter a Company Name') }}
                            </div>
                            @if ($errors->has('company_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('company_name') }}</strong>
                                </span>
                            @endif
                        </div>

                        {{-- <div class="form-group">
                            <label for="inputEmail4">{{ __('User Type') }}</label>
                            {!! Form::select('user_type', App\UserType::pluck('name', 'id'), null, ['placeholder'=>__('Select an User Type'), 'class'=>'form-control select2', 'required']) !!}
                            <div class="invalid-feedback">
                                {{ __('Please select a User Type') }}
                            </div>

                            @if ($errors->has('user_type'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('user_type') }}</strong>
                                </span>
                            @endif

                        </div> --}}

                        <div class="form-group">
                            <label for="password" class=" col-form-label text-md-right">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="password" required>
                            <div class="invalid-feedback">
                                {{ __('Please enter a Password') }}
                            </div>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class=" col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" id="password-confirm" required>
                            <div class="invalid-feedback">
                                {{ __('Please re-enter your password') }}
                            </div>
                            <span id='message'></span>
                        </div>
                        <hr>
                        {{-- <div class="row">
                            <div class="col-md-12">
                                <h4>{{ __('Payment method') }}</h4>
                            </div>
                            <div class="col-md-12">
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-light">
                                        <input type="radio" name="options" id="option1" autocomplete="off" value="Credit Card" required> {{ __('Credit Card')}} <i class="fa fa-credit-card text-danger" aria-hidden="true"></i>
                                    </label>
                                    <label class="btn btn-light">
                                        <input type="radio" name="options" id="option2" autocomplete="off" value="Paypal"> {{ __('Paypal')}} <i class="fa fa-paypal text-blue" aria-hidden="true"></i>
                                    </label>
                                    <div class="invalid-feedback">
                                        {{ __('Payment method') }}
                                    </div>
                                    @if ($errors->has('payment_method'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('payment_method') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <hr> --}}
                        <div class="contract_alert text-center mb-3" >
                            {{-- <span class="text-danger" id="contract_alert">{{__('You must accept the contract.')}}</span> <br> --}}
                            <span><a href="#" data-toggle="modal" data-target="#exampleModal"><strong>{{ __('Click here to see contract') }} </strong></a></span>
                        </div>
                        
                        {{-- Contract modal --}}
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ $terms->title }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        {!! $terms->content !!}

                                        <div class="custom-control custom-checkbox">
                                            <!-- Modal -->
                                            <input type="checkbox" name="contract" value="1" class="custom-control-input" id="customCheck1" required>
                                            <label class="custom-control-label" for="customCheck1">{{ __('I agree with the contract') }}</label>
                                            <div class="invalid-feedback">
                                                {{ __('You must accept the Contract') }}
                                            </div>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                </div>
                            </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" id="register_btn">
                                    {{ __('Create Account') }} <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </form>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    {{ $overview->title }}
                </div>
                <div class="card-body">
                    {!! $overview->content !!}
                    {{-- <p class="lead">
                        {{__('Auction fee: is 5% of Bid charged to Agency, monthly invoice payable within 7 days. Luefty is not responsible for Agency/Provider operational or financial or liability issues. Luefty is an auction and information platform. The use of the Luefty platform is subject to')}} <a href="#" data-toggle="modal" data-target="#exampleModal">{{__('PorSubasta Terms and Conditions')}}</a>.
                    </p> --}}
                </div>
            </div>
            <p></p>
            <h6>{{ __('When you confirm your email you will have full access to Luefty as Agency (Auctioneer) and as Provider (Bidder).') }} </h6>
            <small>
                {{ __('To set up a tutorial session please email') }} <span class="text-primary">info@luefty.com</span>
            </small>
            {{-- <p></p>
            <h6>{{ __('Do not forget your password.') }}</h6>
            <small>
                {{ __('There is no recovery procedure for lost passwords. If you cannot remember it, you will no longer be able to access your stored data.') }}
            </small>
            <p></p>
            <h6>{{ __('Your account is only as secure as your computer.') }}</h6>
            <small>
                {{ __('Never enter your password on a device that you do not fully trust. Do not log into your account from a shared or public computer.') }}
            </small>
             --}}
        </div>
    </div>
    <br>
    <div class="row justify-content-center">
        <div class="col-md-8">

        </div>
    </div>

    
</div>
@endsection

@section('scripts')
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>

<script>
    var cleave = new Cleave('#phone' ,{
        phone:true,
        phoneRegionCode: 'US'
    });
    
    $('#country-select').change(function(){
        cleave.setPhoneRegionCode(this.value);
        cleave.setRawValue('');
    });
</script>

<script>
	// $(document).ready(function(){
	// 	$('#country').on('change', function(){
	// 		var country = $(this).val();
	// 		if(country){
	// 			// console.log(country);
	// 			$.ajax({
	// 				url: 'getlocations/' + country,
	// 				type: 'GET',
	// 				dataType: 'json',
	// 				success: function(data){
	// 					console.log(data);
	// 					$('#locations').empty();
	// 					$('#locations').append('<option value="" disable="true" selected="true">Select Location</option>');

	// 					$.each(data, function(index, locationObj){
	// 						$('#locations').append('<option value="'+ locationObj.id +'">' + locationObj.name + '</option>');
	// 					})
	// 				}
	// 			});
	// 		}
	// 	});
    // });

    // $(document).ready(function(){
    //     $('select[name="country_id"]').on('change', function(){
            
    //         // $( "#to" ).prop( "disabled", false );
    //         //To enable 
    //         $('#locations').removeAttr('disabled');

    //         var country_id = $(this).val();

    //         if(country_id){
    //             // console.log(country_id);
    //             $.ajax({
    //                 url: 'getlocations/' + country_id,
    //                 type: 'GET',
    //                 dataType: 'json',
    //                 success: function(data){
    //                     console.log(data);
    //                     $('#locations').empty();
    //                     $('#locations').append('<option value="" disable="true" selected="true">Select Location</option>');

    //                     $.each(data, function(index, toObj){
    //                         $('#locations').append('<option value="'+ toObj.id +'">' + toObj.name + '</option>');
    //                         // $('#tail-select-to').append('<option value="'+ toObj.id +'">' + toObj.name + '</option>');
    //                         // newAddItem.push({ key: toObj.id, value: toObj.name, description: "" })
    //                     })
    //                 }
    //             });
    //         }
    //     });
    // });
</script>

<script>
    $(document).ready(function(){
        $('select[name="country_id"]').on('change', function(){
            
            // $( "#to" ).prop( "disabled", false );
            //To enable 
            $('#regions').removeAttr('disabled');

            var country_id = $(this).val();

            if(country_id){
                // console.log(country_id);
                $.ajax({
                    url: 'getregions/' + country_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                        console.log(data);
                        $('#regions').empty();
                        $('#regions').append('<option value="" disable="true" selected="true">Select Region</option>');

                        $.each(data, function(index, toObj){
                            $('#regions').append('<option value="'+ toObj.id +'">' + toObj.name + '</option>');
                        })
                    }
                });
            }
        });
    });
</script>

<script>
    $(document).ready(function(){
        
        // Email validation
        $('#email').blur(function(){
            var error_email = '';
            var email = $('#email').val();
            var _token = $('input[name="_token"]').val();
            var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if(!filter.test(email))
            {    
            $('#error_email').html('<label class="text-danger">Please enter a valid email.</label>');
            $('#email').addClass('has-error');
            $('#register_btn').attr('disabled', 'disabled');
            }
            else
            {
            $.ajax({
                url:"{{ route('email_available.checkemail') }}",
                method:"POST",
                data:{email:email, _token:_token},
                success:function(result)
                {
                if(result == 'unique')
                {
                $('#error_email').html('<label class="text-success">Available!</label>');
                $('#email').removeClass('has-error');
                $('#register_btn').attr('disabled', false);
                }
                else
                {
                $('#error_email').html('<label class="text-danger">This email already exists, please enter another email.</label>');
                $('#email').addClass('has-error');
                $('#register_btn').attr('disabled', 'disabled');
                }
                }
            })
            }
        });
        
        // Password validation
        $('#password, #password-confirm').on('keyup', function () {
            $('#register_btn').attr('disabled', 'disabled');
        if ($('#password').val() == $('#password-confirm').val()) {
            $('#message').html('Match!').css('color', 'green');
            $('#register_btn').attr('disabled', false);
        } else 
            $('#message').html('Re-enter your password. Passwords do not match!').css('color', 'red');
        });
    });
</script>

<script>
    $(function() {
        // $('#contract_alert').hide(); 
        $("#customCheck1").change(function() {
            if(this.checked) {
                $('#contract_alert').hide(); 
            }else {
                $('#contract_alert').show(); 
            }
        });
    });
</script>

@endsection

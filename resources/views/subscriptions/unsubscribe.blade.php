@extends('layouts.app')
@section('page-title')
    Subscribe |
@endsection
@section('content')
    <style>
        .btn-submit-contact {
            background-color: #243A85;
            color: #ffffff;
            border-radius: .5rem;
            padding: 8px;
            width: 100%;
            text-align: center;
            border: none;
        }

        .btn-submit-contact:hover {
            opacity: .85;
            color: #ffffff;
        }

        .alert-msg {
            --bs-alert-color: #084298;
            --bs-alert-bg: #fff;
            --bs-alert-border-color: #b6d4fe;
        }
    </style>
    <header>
        @include('menus.menu_secundario')
    </header>
    <main style="margin-top: 0.5rem;">
    <section class="vh-100">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div>
            <div class="card-body p-5">
              <h1 class="text-uppercase text-center mb-5">UnSubscribe.</h1>
              @if (session()->has('success'))
                        <script>
                            $(document).ready(function() {
                                setTimeout(
                                    function() {
                                        const alert = bootstrap.Alert.getOrCreateInstance('#alert-msg')
                                        alert.close()
                                    }, 5000);
                            });
                        </script>
                        <div class="alert alert-warning  alert-dismissible fade show" role="alert" id="alert-msg">
                            {{ session()->get('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"
                                style="font-size: 8px;"></button>
                        </div>
                    
                @elseif(session()->has('error'))
                    <script>
                        $(document).ready(function() {
                            setTimeout(
                                function() {
                                    const alert = bootstrap.Alert.getOrCreateInstance('#alert-msg')
                                    alert.close()
                                }, 5000);
                        });
                    </script>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert-msg">
                        {{ session()->get('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"
                            style="font-size: 8px;"></button>
                    </div>          
                @endif
                
              <form method="POST" action="{{ route('save_unsubscribe') }}" autocomplete="off" name="form1">
                @csrf
                <div class="mb-3">
                    <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" type="text"
                        name="email" placeholder="Email" value="{{ old('email') }}">
                    {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="mb-3 form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                    <div class="col-md-6 pull-center">
                        {!! app('captcha')->display() !!}
                        @if ($errors->has('g-recaptcha-response'))
                            <div class="invalid-feedback">{{ $errors->first('g-recaptcha-response') }}</div>
                        @endif
                    </div>
                </div>
                <div class="mb-3">
                    <button class="btn-submit-contact" type="submit">SUBMIT</button>
                </div> 
              </form>
            </div>
        </div>
      </div>
    </div>
  </div>
</section>
@include('menus.menu_footer_categories')
</main>
    <script src="https://www.google.com/recaptcha/api.js?hl=en" async defer></script>
@endsection
@yield('jquery')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
$(function() {
    $('#select_all').change(function(){
        var checkboxes = $(this).closest('form').find(':checkbox');
        if($(this).prop('checked')) {
          checkboxes.prop('checked', true);
        } else {
          checkboxes.prop('checked', false);
        }
    });
});
</script>
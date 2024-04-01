@extends('dashboard.master')
@section('main')

<section class="min-vh-100 mb-8">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('../assets/img/curved-images/curved14.jpg');">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 text-center mx-auto">
                    <h1 class="text-white mb-2 mt-5">Welcome!</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mt-lg-n10 mt-md-n11 mt-n10">
            <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                <div class="card z-index-0">
                    <div class="card-header text-center pt-4">
                        <h5>Login</h5>
                    </div>
                    <div class="row px-xl-5 px-sm-4 px-3">
                        <div class="col-12">
                            <!-- Your login form content goes here -->
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="mb-3">
                                    <input type="text" name="name" class="form-control" placeholder="Name" aria-label="Name" aria-describedby="email-addon">
                                    @error('name')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon">
                                    @error('password')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Login</button>
                                    <p></p>
                                    <!-- <p class="text-secondary">Don't have an account? <a href="{{ route('register') }}" class="text-primary">Register here</a></p> -->
                                </div>
                            </form>
                            <!-- End of login form -->
                        </div>
                        <div class="mt-2 position-relative text-center">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
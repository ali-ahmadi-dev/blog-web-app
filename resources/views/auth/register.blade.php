
@extends('layouts.front.master')
@section('content')
    <!-- **************** MAIN CONTENT START **************** -->
    <main>
        <!-- =======================
        Inner intro START -->
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-8 col-xl-8 mx-auto ">
                        <div class="rounded custom-box-shadow p-4 p-sm-5">
                            <h2>ثبت نام در سایت </h2>
                            <!-- Form START -->
                            <form method="POST" action="{{ route('register') }}" id="registerForm" class="mt-4">
                               @csrf
                                <!-- Name -->
                                <div class="mb-3">
                                    <label class="form-label" for="exampleInputName1">نام و نام خانوادگی</label>
                                    <input type="text" name="name"
                                           class="form-control @error('name') border-danger  @enderror "
                                           id="exampleInputName1"
                                           placeholder="نام و نام خانوادگی"  value="{{old('name')}}">

                                </div>

                                   @error('name')
                                    <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                <!-- Email -->
                                <div class="mb-3">
                                    <label class="form-label" for="exampleInputEmail1">ایمیل</label>
                                    <input type="text" name="email"
                                           class="form-control @error('email') border-danger  @enderror"
                                           id="exampleInputEmail1" value="{{old('email')}}" placeholder="ایمیل">

                                </div>

                                     @error('email')
                                    <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                <!-- Password -->
                                <div class="mb-3">
                                    <label class="form-label" for="exampleInputPassword1">رمز عبور</label>
                                    <input type="text" name="password"
                                           class="form-control @error('password') border-danger  @enderror "
                                           value="{{old('password')}}" id="exampleInputPassword1"
                                           placeholder="*********">

                                </div>

                                    @error('password')
                                    <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
                                    @enderror

                                <!-- Password Confirmation -->
                                <div class="mb-3">
                                    <label class="form-label" for="exampleInputPassword2">تایید رمز عبور</label>
                                    <input type="password" name="password_confirmation" class="form-control"
                                           id="exampleInputPassword2" placeholder="*********">
                                </div>
                                    <!-- Checkbox --- News -->
                                    <div class="d-flex justify-content-between align-items-center">
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" name="subscribe" class="form-check-input" id="subscribe">
                                        <label class="form-check-label" for="subscribe">عضویت در خبرنامه</label>
                                    </div>
                                    <div class="text-sm-end">
                                        <span>آیا قبلا ثبت نام کرده اید؟ <a href="#"><u>ورود</u></a></span>
                                    </div>
                                    </div>
                                <!-- Button -->
                                <div class="row align-items-center">
                                    <div class="col-sm-4">
                                        <button type="submit" class="g-recaptcha btn btn-success"
                                                data-sitekey="{{config('services.googel_recaptcha_v3.siteKey')}}"
                                                data-callback='onSubmit'
                                                data-action='submitRegister'

                                        >ثبت نام
                                        </button>
                                    </div>

                                </div>
                            </form>
                            <!-- Form END -->
                            <hr>
                            <!-- Social-media btn -->
                            <div class="text-center">
                                <p class="mb-4 mt-3">برای دسترسی سریع با شبکه اجتماعی خود وارد شوید</p>
                                <ul class="list-unstyled d-flex mt-3 justify-content-center mb-0">
                                    <li class="mx-2">
                                        <a href="#" class="btn btn-light d-inline-block fs-6">github<i
                                                class="fab fa-github text-dark align-middle ms-2 fs-5"></i></a>
                                    </li>
                                    <li class="mx-2">
                                        <a href="#" class="btn btn-light d-inline-block fs-6">google<i
                                                class="fab fa-google text-danger align-middle ms-2 fs-5"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- =======================
        Inner intro END -->

    </main>
    <!-- **************** MAIN CONTENT END **************** -->
@endsection

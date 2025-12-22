<?php

namespace App\Http\Controllers;

use App\Events\UserRegistered;
use App\Events\UserSubscribed;
use App\Mail\WelcomeMail;
use App\Models\User;
use App\Rules\GoogleRecaptchaV3;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    // Register or New User


    public function register(Request $request)
    {


        $fields =$request->validate([
        'name' =>['required', 'max:255'  ],
        'email' =>['required', 'email', 'max:255' , 'unique:users'  ],
        'password' =>['required','confirmed', 'max:255'   , Password::min(8)->max(12)->mixedCase()->letters()->numbers()->symbols()],
//              'g-recaptcha-response' =>['required' , new  GoogleRecaptchaV3('submitRegister',)],


      ],

      [

                'name.required' => 'نام و نام خانوادگی خود را وارد نمایید!',
                'name.max' => 'نام و نام خانوادگی باید حدااکثر 225 کارکتر باشد!',
                'name.min' => 'نام و نام خانوادگی باید حدااقل 5 کارکتر باشد!',
                'email.required' => 'ایمیل معتبر خود را وارد نمایید!',
                'email.max' => 'ایمیل مورد نظر حداکثر باید ۲۵۵ کارکتر باشد!',
                'email.email' => 'ایمیل معتبر وارد نمایید!',
                'email.unique' => 'قبلا کاربری با این ایمیل ثبت نام کرده است!',
                'password.required' => 'کلمه عبور خود را وارد نمایید!',
                'password.min' => 'کلمه عبور باید حداقل 8 کارکتر باشد!',
                'password.max' => 'کلمه عبور باید حداکثر 12 کارکتر باشد!',
                'password.confirmed' => 'کلمه عبور با تکرار آن برابر نیست!',
                'password.mixed' => 'کلمه عبور باید شامل اعداد کارکتر کوچک و بزرگ و کارکترهای ويژه (!@#$%^&*) باشد!',
                'g-recaptcha-response.required' => 'اعتبار سنجی گوگل ریکپچا الزامی است!'



      ]);

        //Create User
        $user =  User::create($fields);

        // send email

        if ( $user) {

          Auth::login($user);
//            event(new Registered($user, $request->password));
            event(new UserRegistered($user, $request->password, true));
//          Mail::to($request->email)->send(new WelcomeMail(Auth::user(), $request->password));
          if ($request->subscribe){
               event(new UserSubscribed($user));
          }

        } else{

           return redirect()->back()->with('error','مشکلی پیش امده دوباره تلاش کنید');

        }

        return redirect()->route('home')->withErrors([
            'success' => auth()->user()->name . ' عزیز خوش آمدید.'
        ]);



    }




    public  function login(Request $request){

       $credentials = $request->validate([

            'email' =>['required', 'email' ],
            'password' =>['required'],

        ],


         [


             'email.required' => 'ایمیل معتبر خود را وارد نمایید!',
             'email.email' => 'ایمیل معتبر وارد نمایید!',
             'password.required' => 'کلمه عبور خود را وارد نمایید!',

         ]);

      if(Auth::attempt($credentials , $request->remember )) {
              $request->session()->regenerate();
          return redirect()->route('home')->withErrors([
               'success' => auth()->user()->name . ' عزیز خوش آمدید.'
          ]);


      }else{
          return redirect()->back()->with('error' , 'اطلاعات وارده شده اشتباه است' );

      }

    }




    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->withErrors(['success' , 'با موفقیت خارج شدید']);
    }



}

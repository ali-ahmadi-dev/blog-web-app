<?php

namespace App\Http\Controllers;

use App\Events\UserRegistered;
use App\Events\UserSubscribed;
//use App\Mail\WelcomeMail;
use App\Models\User;
//use App\Rules\GoogleRecaptchaV3;
//use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Password as FacadesPassword;

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




    public function logout(Request $request):RedirectResponse{
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->withErrors(['success' , 'با موفقیت خارج شدید']);
    }



    public function sendResetLinkEmail(Request $request) :RedirectResponse
    {
        $request->validate([
            'email' =>['required', 'email' ]
        ],[
            'email.required' => 'ایمیل معتبر خود را وارد نمایید!',
            'email.email' => 'ایمیل معتبر وارد نمایید!'

        ]);

        $status = FacadesPassword::sendResetLink(
            $request->only('email')
        );
        return $status === FacadesPassword::RESET_LINK_SENT
            ? back()->with(['success' =>'لینک بازیابی کلمه عبور به ایمیل شما ارسال شد.'])
            : back()->withErrors(['error' => 'برای دریافت مجدد لینک بازیابی کلمه عبور چند لحظه صبر کنید']);

    }

    public function resetPasswordToken(string $token)
    {
        return view('auth.reset-password',['token'=>$token]);
    }


    public function passwordUpdate(Request $request)
    {

        $request->validate([
            'token' => ['required'],
            'email' => ['required','email'],
            'password' => ['required', 'confirmed', Password::min(8)->max(12)->mixedCase()->letters()->numbers()->symbols()],
        ],
            [
                'token'=>'توکن معتبر نمی باشد!',
                'email.required' => 'ایمیل معتبر خود را وارد نمایید!',
                'email.max' => 'ایمیل مورد نظر حداکثر باید ۲۵۵ کارکتر باشد!',
                'email.email' => 'ایمیل معتبر وارد نمایید!',
                'password.required' => 'کلمه عبور خود را وارد نمایید!',
                'password.min' => 'کلمه عبور باید حداقل 8 کارکتر باشد!',
                'password.max' => 'کلمه عبور باید حداکثر 12 کارکتر باشد!',
                'password.confirmed' => 'کلمه عبور با تکرار آن برابر نیست!',
                'password.mixed' => 'کلمه عبور باید شامل اعداد کارکتر کوچک و بزرگ و کارکترهای ويژه (!@#$%^&*) باشد!',
            ]
        );
        $status = FacadesPassword::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

//                if ($request->subscribe){
//                    event(new UserSubscribed($user));
//                }
                $user->save();
                //event(new PasswordReset($user));
            }
        );
        return $status === FacadesPassword::PASSWORD_RESET
            ? redirect()->route('login')->with('success', 'کلمه عبور شما تغیر کرد اکنون می توانید با آن در سایت لاگین نمایید.')
            : back()->withErrors(['error' => 'توکن بازیابی کلمه عبور معتبر نمی باشد!']);
    }




}

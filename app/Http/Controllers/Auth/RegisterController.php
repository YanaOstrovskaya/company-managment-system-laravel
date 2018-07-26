<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\EmployeeProfile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Intervention\Image\Facades\Image as ImageInt;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/company';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255|min:2',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'birhdate' => 'required|before:today',
            'job_start_date' => 'required|before:tomorrow',
            'phone' => 'required',
            'job_title' => 'required|string|max:255|min:2',
            'photo' => 'required|image|file'

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     *
     *
     */

    protected function create(array $data)
    {
        //create and resize image
        $img = ImageInt::make($data['photo'])
            ->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();});

        //type img;
        $extension = $data['photo']->extension();
        //generate unique name for image
        $imgName = str_random(20).'.'.$extension;

        if (!file_exists(public_path("images/photo"))) {
            mkdir(public_path("images/photo"), 0777, true);
            $img->save(public_path("images/photo/$imgName"));
        }
        else{
            $img->save(public_path("images/photo/$imgName"));
        }
        $birhdate = Carbon::parse($data['birhdate'])->format('Y-m-d');
        $job_start_date = Carbon::parse($data['job_start_date'])->format('Y-m-d');

        $job_start_date = Carbon::parse($data['job_start_date']);
        $EmployeeProfile = EmployeeProfile::create([
            'birhdate' => $birhdate,
            'photo'=> $imgName,
            'job_start_date' => $job_start_date,
            'phone' => $data['phone'],
            'job_title' => $data['job_title']
        ]);
        $idEmployeeProfile = $EmployeeProfile->id;

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'employee_profile_id' => $idEmployeeProfile
        ]);

    }
}

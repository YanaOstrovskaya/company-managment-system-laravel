<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\EmployeeProfile;
use App\Http\Requests\EditUser;
use Carbon\Carbon;
use Auth;
use Intervention\Image\Facades\Image as ImageInt;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(10);
        return view('users.index')->with(['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)//users/id
    {
        $user = User::find($id);
        $birhdate = Carbon::parse($user->employeeProfile->birhdate);
        $job_start_date = Carbon::parse($user->employeeProfile->job_start_date);
       // dd($user->company);
        $companies = Company::where('owner_id', $id)->get();
   // dd($company);
        return view('users.show')
            ->with(['user' => $user,
                    'birhdate' => $birhdate,
                    'job_start_date' => $job_start_date,
                    'companies' => $companies
                ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->id == $id || Auth::user()->role==='admin'){
        $user = User::find($id);
        $companies = Company::where('owner_id', $id)->get();

        return view('users.edit')
            ->with(['user' => $user,
                    'companies' => $companies
            ]);
        }
        else{
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditUser $request, $id)
    {
        if($request->hasFile('photo')){
            $img = ImageInt::make($request->photo)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();});
            $extension = $request->photo->extension();
            $imgName = str_random(20).'.'.$extension;
            $img->save(public_path("images/photo/$imgName"));
        }
        $user = User::find($id);
        $photo = $request->hasFile('photo')?$imgName:$user->employeeProfile->photo;

        EmployeeProfile::where('id', $user->employee_profile_id)->update([
            'birhdate' => $request->birhdate,
            'photo' => $photo,
            'job_start_date' => $request->job_start_date,
            'phone' => $request->phone,
            'job_title' => $request->job_title
        ]);

        User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email
        ]);
        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->role === 'admin') {
            $user = User::find($id);

            //dd($company->id);
            $user->delete();
            return redirect('/users');
        }
        else{
            return back();
        }
    }

}

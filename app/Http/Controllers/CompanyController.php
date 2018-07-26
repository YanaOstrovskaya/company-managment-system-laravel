<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\EditCompany;
use App\Http\Requests\CreateCompany;
use Intervention\Image\Facades\Image as ImageInt;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $companies = Company::orderBy('id', 'desc')->paginate(10);
        $users = User::all();


        return view('company.index')->with(['companies'=>$companies, 'users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCompany $request)
    {
        if($request->hasFile('logo')){
            $img = ImageInt::make($request->logo)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();});
            $extension = $request->logo->extension();
            $imgName = str_random(20).'.'.$extension;
            $img->save(public_path("images/logo/$imgName"));
        }

     $requestJs = Company::create([
            'logo' => $imgName,
            'name' => $request->name,
            'adress_line1' => $request->adress_line1,
            'adress_line2' => $request->adress_line2,
            'zip' => $request->zip,
            'province' => $request->province,
            'city' => $request->city,
            'country' => $request->country,
            'owner_id' => $request->owner_id,

        ]);
        if(!empty($request->owner_id)){
            $user = User::find($request->owner_id);
            $user->company_id = $requestJs->id;
            $user->save();
        }

           $user = Auth::user()->role;

        return response()->json([$requestJs, $user]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        $company = Company::find($company->id);
        $user = User::find($company->owner_id);


        // dd($company);
        return view('company.show')->with(['company' => $company, 'user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        if(Auth::user()->role==='admin' || isset(Auth::user()->company->owner_id) && Auth::user()->company->owner_id==$company->owner_id){
        $users = User::all();
        $logo = $company->logo;
        return view('company.edit')->with(['company' => $company, 'users' => $users, 'logo' => $logo]);
        }
        else{
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(EditCompany $request, Company $company)
    {

        if($request->hasFile('logo')){
            $img = ImageInt::make($request->logo)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();});
            $extension = $request->logo->extension();
            $imgName = str_random(20).'.'.$extension;
            $img->save(public_path("images/logo/$imgName"));
        }
        //dd($imgName);

        $logo = $request->hasFile('logo')?$imgName:$company->logo;

        Company::where('id', $company->id)->update([
            'logo' => $logo,
            'name' => $request->name,
            'adress_line1' => $request->adress_line1,
            'adress_line2' => $request->adress_line2,
            'zip' => $request->zip,
            'province' => $request->province,
            'city' => $request->city,
            'country' => $request->country,
            'owner_id' => $request->owner_id
        ]);

        if(!empty($request->owner_id)){
            $user = User::find($request->owner_id);
            $user->company_id = $company->id;
            $user->save();
        }else{
            User::where('company_id', $company->id)->update(['company_id' => null]);
        }

        return redirect('/company');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        if (Auth::user()->role === 'admin') {
            $company = Company::find($company->id);

            //dd($company->id);
            $company->delete();
            if ($company) {
                alert()->success('Deleted!',"Company has been deleted");
                return redirect('/company');
            }
            return redirect('/company');
        }
        else{
            return back();
        }
    }
}

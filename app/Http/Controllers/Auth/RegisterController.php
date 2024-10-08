<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Student;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/home';

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'Initial' => ['required','string'],
            'FullName' => ['required','string'],
            'Gender' => ['required','string'],
            'birthday' => ['required','date'],
            'school' => ['required','string'],
            'City' => ['required','string'],
            'Grade' => ['required'],
            'ContactNumber' => ['required','string','min:10','max:10'],
            'HouseNumber' => ['required','string'],
            'StreetAdress' => ['required','string'],
            'District' => ['required','string'],
            'province' => ['required','string'],
            'ParentFullName' => ['required','string'],
            'ParentGender' => ['required','string'],
            'ParentBirthday' => ['required','date'],
            'NIC' => ['required','string','max:10','min:10'],
            'PNumber' => ['required','string','max:10','min:10'],
            'Pemail' => ['required','string','email'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $userId = $user->id;

        
        $student = Student::create([
            'initial' => $data['Initial'],
            'LastName' => $data['name'],
            'FullName' => $data['FullName'],
            'Gender' => $data['Gender'],
            'birthday' => $data['birthday'],
            'school' => $data['school'],
            'city' => $data['City'],
            'grade' => $data['Grade'],
            'contactNumber' => $data['ContactNumber'],
            'email' => $data['email'],
            'houseNumber' => $data['HouseNumber'],
            'street' => $data['StreetAdress'], 
            'district' => $data['District'],
            'province' => $data['province'],
            'PerentFullName' => $data['ParentFullName'],
            'PerentGender' => $data['ParentGender'],
            'PerentNic' => $data['NIC'],
            'PerentContact' => $data['PNumber'],
            'PerentEmail' => $data['Pemail'],
            'user_id' => $userId
        ]);
     
        return $user;
    }
}

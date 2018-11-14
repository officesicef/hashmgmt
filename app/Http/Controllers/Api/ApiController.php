<?php

namespace App\Http\Controllers\Api;

use App\Medicine;
use App\Pain;
use App\Patient;
use App\Relationship;
use App\Therapy;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);


        if ($validator->fails()) {
            return response()->json(["status" => "fail", "message" => $validator->messages()], 422);
        }

        if (User::where('email', strtolower($request->email))->first()){
            return response()->json(["status" => "fail", "message" => "User already exists."], 409);
        }

        $user = User::create([
            'name' => $request->name,
            'email' =>  strtolower($request->email),
            'password' => hash('sha256', $request->password),
        ]);

        return response()->json(["status" => "ok", "user" => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(["status" => "fail", "message" => $validator->messages()], 422);
        }

        $user = User::where('email', strtolower($request->email))->first();

        if (!$user) {
            return response()->json(["status" => "fail", "message" => "Email: ".strtolower($request->email)." does not exist"], 401);
        }

        $hash_pw = hash('sha256',$request->password);

        if (strcmp($user->password, $hash_pw) != 0) {
            return response()->json(["status" => "fail", "message" => "Wrong password"], 401);
        }

        return response()->json(["status" => "ok", "user" => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addPain(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|integer|exists:patients,id',
            'scale' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(["status" => "fail", "message" => $validator->messages()], 422);
        }
        $pain = Pain::create([
            'patient_id' => $request->patient_id,
            'scale' =>  $request->scale,
        ]);

        return response()->json(["status" => "ok", "pain" => $pain]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addTherapy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|integer|exists:patients,id',
            'medicine_id' => 'required|integer|exists:medicines,id',
        ]);

        if ($validator->fails()) {
            return response()->json(["status" => "fail", "message" => $validator->messages()], 422);
        }

        $therapy = Therapy::create([
            'patient_id' =>  $request->patient_id,
            'medicine_id' =>  $request->medicine_id,
        ]);

        $therapy = Therapy::where('id', $therapy->id)->with('medicine')->first();

        return response()->json(["status" => "ok", "therapy" => $therapy]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addPatient(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(["status" => "fail", "message" => $validator->messages()], 422);
        }

        $patient = Patient::create([
            'full_name' => $request->full_name,
        ]);

        return response()->json(["status" => "ok", "patient" => $patient]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function assignPatient(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|integer|exists:patients,id',
            'user_id' => 'required|integer|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(["status" => "fail", "message" => $validator->messages()], 422);
        }


        // If we already have this relationship, don't add it again.
        if (Relationship::where('user_id', $request->user_id)->where('patient_id', $request->patient_id)->first()){
            return response()->json(["status" => "ok"]);
        }

        Relationship::create([
            'user_id' => $request->user_id,
            'patient_id' => $request->patient_id,
        ]);

        return response()->json(["status" => "ok"]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function patients(Request $request)
    {

        if ($request->user_id){
            $patients = Relationship::getPatients($request->user_id);
        }else {
            $patients = Patient::all();
        }

        return response()->json(["status" => "ok", "patients" => $patients]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function medicines(Request $request)
    {

        if ($request->get('search')) {

            $search = strtolower($request->get('search'));


            $medicines = Medicine::where('registered_name', 'LIKE', "%$search%")->
                orWhere('slug', 'LIKE', "%$search%")->get();
        }else {
            $medicines = Medicine::take(20)->get();
        }

        return response()->json(["status" => "ok", "medicines" => $medicines]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function painHistory(Request $request)
    {
        $patient_id = $request->get('patient_id');

        $painHistory = Pain::where('patient_id', $patient_id)->take(15)->get();

        return response()->json(["status" => "ok", "pain-history" => $painHistory]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function therapyHistory(Request $request)
    {
        $patient_id = $request->get('patient_id');

        $therapyHistory = Therapy::where('patient_id', $patient_id)->with(['medicine', 'patient'])->take(15)->get();

        return response()->json(["status" => "ok", "therapy-history" => $therapyHistory]);
    }

}

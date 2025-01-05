<?php

namespace App\Http\Controllers\Field;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class AuthController extends Controller
{
    public function showLogin()
    {
        return view('field.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ],
        [
            'username.required' => 'Please enter username',
            'password.required' => 'Please enter password',
        ]);

        if ($validator->passes())
        {
            $username = $request->username;
            $password = $request->password;
            $remember_me = true;

            try
            {
                $user = User::where('username', $username)->first();

                if(!$user)
                    return response()->json(['error2'=> 'No user found with this username']);

                if( !$user->hasRole(['Field Accessor']) )
                    return response()->json(['error2'=> 'Only field accessor can login to this application']);

                if($user->active_status == '0' && !$user->roles)
                    return response()->json(['error2'=> 'You are not authorized to login, contact HOD']);

                if(!auth()->attempt(['username' => $username, 'password' => $password], $remember_me))
                    return response()->json(['error2'=> 'Your entered credentials are invalid']);

                $userType = '';
                if( $user->hasRole(['User']) )
                    $userType = 'user';

                return response()->json(['success'=> 'login successful', 'user_type'=> $userType ]);
            }
            catch(\Exception $e)
            {
                DB::rollBack();
                Log::info("login error:". $e);
                return response()->json(['error2'=> 'Something went wrong while validating your credentials!']);
            }
        }
        else
        {
            return response()->json(['error'=>$validator->errors()]);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required_unless:competition_mode,0',
            'competition_type_id' => 'required',
            'competition_mode' => 'required_if:competition_type_id,2',
            // 'society_name' => 'required|max:100',
            'society_telephone' => 'required|max:15',
            'nodal_person_name' => 'required|max:100',
            'nodal_person_contact' => 'required|max:20',
            'nodal_person_email' => 'required|max:100',
            'building_name' => 'required|max:255',
            // 'area_name' => 'required|max:255',
            'city' => 'required|max:50',
            // 'landmark' => 'nullable|sometimes|max:100',
            'pincode' => 'required|max:10',
            'ward_id' => 'required',
            'other_address' => 'required|max:200',
            'username' => 'required|max:100',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password'
        ]);

        if ($validator->fails())
            return response()->json(['error'=>$validator->errors()]);

        try
        {
            $input = $request->toArray();
            DB::beginTransaction();
            $input['password'] = Hash::make($input['password']);
            $input['tenant_id'] = '1';
            $input['category_id'] = $input['category_id'] ?? 1;
            $user = new User();
            $user = User::create( Arr::only( $input, $user->getFillable() ) );

            if( $user )
            {
                DB::table('model_has_roles')->updateOrInsert([ 'model_type'=> 'App\Models\User', 'model_id'=> $user->id ],
                                [ 'role_id'=> '1', 'tenant_id'=> '1' ]);
                auth()->attempt(['username' => $user->username, 'password' => $request->password], false);
            }
            DB::commit();
            return response()->json(['success'=> 'Registration successful' ]);
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            Log::info("login error:". $e);
            return response()->json(['error2'=> 'Something went wrong while registering your account!']);
        }

    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('field.login');
    }


    public function showChangePassword()
    {
        return view('admin.change-password');
    }


    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->passes())
        {
            $old_password = $request->old_password;
            $password = $request->password;

            try
            {
                $user = DB::table('app_users')->where('id', $request->user()->id)->first();

                if( Hash::check($old_password, $user->password) )
                {
                    DB::table('app_users')->where('id', $request->user()->id)->update(['password'=> Hash::make($password)]);

                    return response()->json(['success'=> 'Password changed successfully!']);
                }
                else
                {
                    return response()->json(['error2'=> 'Old password does not match']);
                }
            }
            catch(\Exception $e)
            {
                DB::rollBack();
                Log::info("password change error:". $e);
                return response()->json(['error2'=> 'Something went wrong while changing your password!']);
            }
        }
        else
        {
            return response()->json(['error'=>$validator->errors()]);
        }
    }
}

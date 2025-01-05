<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\AssignUserRoleRequest;
use App\Http\Requests\Admin\ChangeUserPasswordRequest;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\Category;
use App\Models\CompetitionType;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Ward;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::whereHas('roles', fn($q)=> $q->whereNotIn('id', ['1','2']) )->whereNot('id', Auth::user()->id)->latest()->get();
        $roles = Role::orderBy('id', 'DESC')->where('tenant_id', Auth::user()->tenant_id)->whereIn('id', [4,5])->get();
        $wards = Ward::get();
        $categories = Category::get();
        $competitionTypes = CompetitionType::get();

        return view('admin.users')->with(['users'=> $users, 'competitionTypes'=> $competitionTypes, 'roles'=> $roles, 'wards'=> $wards, 'categories'=> $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $input['password'] = Hash::make($input['password']);
            $input['nodal_person_name'] = $input['nodal_person_name'] ?? ' ';
            $input['nodal_person_contact'] = $input['nodal_person_contact'] ?? ' ';
            $input['nodal_person_email'] = $input['nodal_person_email'] ?? ' ';
            $input['building_name'] = $input['building_name'] ?? ' ';
            $input['area_name'] = $input['area_name'] ?? ' ';
            $input['city'] = $input['city'] ?? ' ';
            $input['landmark'] = $input['landmark'] ?? ' ';
            $input['pincode'] = $input['pincode'] ?? ' ';

            $user = User::create( Arr::only( $input, Auth::user()->getFillable() ) );
            DB::table('model_has_roles')->insert(['role_id'=> $input['role'], 'model_type'=> 'App\Models\User', 'model_id'=> $user->id, 'tenant_id'=> $user->tenant_id]);
            DB::commit();
            return response()->json(['success'=> 'Accessor created successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'creating', 'Accessor');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $wards = Ward::get();
        $categories = Category::get();
        $roles = Role::whereNot('id', '2')->get();
        $user->loadMissing('roles');

        if ($user)
        {
            $wardHtml = '<span>
                <option value="">--Select Ward--</option>';
                foreach($wards as $ward):
                    $is_select = $ward->id == $user->ward_id ? "selected" : "";
                    $wardHtml .= '<option value="'.$ward->id.'" '.$is_select.'>'.$ward->name.'</option>';
                endforeach;
            $wardHtml .= '</span>';

            $categoryHtml = '<span>
                <option value="">--Select Category--</option>';
                foreach($categories as $category):
                    $is_select = $category->id == $user->category_id ? "selected" : "";
                    $wardHtml .= '<option value="'.$category->id.'" '.$is_select.'>'.$category->name.'</option>';
                endforeach;
            $categoryHtml .= '</span>';

            $roleHtml = '<span>
                <option value="">--Select Role --</option>';
                foreach($roles as $role):
                    $is_select = $role->id == $user->roles[0]->id ? "selected" : "";
                    $roleHtml .= '<option value="'.$role->id.'" '.$is_select.'>'.$role->name.'</option>';
                endforeach;
            $roleHtml .= '</span>';

            $response = [
                'result' => 1,
                'user' => $user,
                'roleHtml' => $roleHtml,
                'wardHtml' => $wardHtml,
                'categoryHtml' => $categoryHtml,
            ];
        }
        else
        {
            $response = ['result' => 0];
        }
        return $response;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $user->update( Arr::only( $input, Auth::user()->getFillable() ) );
            $user->roles()->detach();
            DB::table('model_has_roles')->insert(['role_id'=> $input['role'], 'model_type'=> 'App\Models\User', 'model_id'=> $user->id, 'tenant_id'=> $user->tenant_id]);
            DB::commit();

            return response()->json(['success'=> 'Accessor updated successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'updating', 'Accessor');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function toggle(Request $request, User $user)
    {
        $current_status = DB::table('app_users')->where('id', $user->id)->value('active_status');
        try
        {
            DB::beginTransaction();
            if($current_status == '1')
            {
                User::where('id', $user->id)->update([ 'active_status' => '0' ]);
            }
            else
            {
                User::where('id', $user->id)->update([ 'active_status' => '1' ]);
            }
            DB::commit();
            return response()->json(['success'=> 'User status updated successfully']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'changing', 'User\'s status');
        }
    }

    public function changePassword(ChangeUserPasswordRequest $request, User $user)
    {
        $input = $request->validated();
        try
        {
            DB::beginTransaction();
            $user->update([ 'password' => Hash::make($input['new_password']) ]);
            DB::commit();
            return response()->json(['success'=> 'Password updated successfully']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'changing', 'User\'s password');
        }

    }


    public function getRole(User $user)
    {
        $user->load('roles');
        if ($user)
        {
            $roles = Role::orderBy('id', 'DESC')->whereIn('id', [4,5])->get();
            $roleHtml = '<span>
                <option value="">--Select Role--</option>';
                foreach($roles as $role):
                    $is_select = $role->id == $user->roles[0]->id ? "selected" : "";
                    $roleHtml .= '<option value="'.$role->id.'" '.$is_select.'>'.$role->name.'</option>';
                endforeach;
            $roleHtml .= '</span>';

            $response = [
                'result' => 1,
                'user' => $user,
                'roleHtml' => $roleHtml,
            ];
        }
        else
        {
            $response = ['result' => 0];
        }
        return $response;
    }


    public function assignRole(User $user, AssignUserRoleRequest $request)
    {
        try
        {
            DB::beginTransaction();
            $user->roles()->detach();
            DB::table('model_has_roles')->insert(['role_id'=> $request->edit_role, 'model_type'=> 'App\Models\User', 'model_id'=> $user->id, 'tenant_id'=> $user->tenant_id]);
            DB::commit();
            return response()->json(['success'=> 'Role updated successfully']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'changing', 'User\'s role');
        }
    }
}

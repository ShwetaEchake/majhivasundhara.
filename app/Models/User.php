<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    protected $appends = [ 'tenant_name' ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tenant_id',
        'competition_type_id',
        'competition_mode',
        'username',
        'password',
        'category_id',
        'household_no',
        'tmc_total_students',
        'total_stud_in_private_school',
        // 'society_name',
        'society_telephone',
        'nodal_person_name',
        'nodal_person_contact',
        'nodal_person_email',
        'building_name',
        // 'area_name',
        'city',
        // 'landmark',
        'pincode',
        'ward_id',
        'other_address',
        'verification_code',
        'excel_path',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    public function getRoleNameAttribute()
    {
        return $this->getRoleNames();
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
    public function getTenantNameAttribute()
    {
        return $this->tenant->name;
    }

    public function contests()
    {
        return $this->hasMany(UserContest::class);
    }

    public function contestTwo()
    {
        return $this->hasMany(UserContestTwo::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function competitionType()
    {
        return $this->belongsTo(CompetitionType::class);
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }

    public function ContestentPd()
    {
        return $this->hasMany(ContestentPd::class);
    }

    public function fieldEditedContestOne()
    {
        return $this->hasMany(FieldEditedFormOne::class, 'contestant_user_id', 'id');
    }

    public function fieldEditedContestTwo()
    {
        return $this->hasMany(FieldEditedFormTwo::class, 'contestant_user_id', 'id');
    }

}

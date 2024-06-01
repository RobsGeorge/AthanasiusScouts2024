<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\User;

class Roles extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'RoleID',
        'RoleName',
        'RoleDescription'
    ];

    protected $table = "Roles";
    protected $primaryKey = 'RoleID';

    public function users()
    {
        return $this->belongsToMany(User::class, 'PersonRole', 'RoleID', 'PersonID');
    }

}

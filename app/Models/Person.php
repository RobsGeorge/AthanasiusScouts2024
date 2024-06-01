<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use App\Models\Roles;
use App\Models\User;

class Person extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'PersonID',
        'FirstName',
        'SecondName',
        'ThirdName',
        'ShamandoraCode'
    ];

    protected $table = "PersonInformation";
    protected $primaryKey = 'PersonID';
    public $timestamps = false;


    public function roles()
    {
        return $this->hasOne(Roles::class, 'PersonRole', 'PersonID', 'RoleID');
    }

}

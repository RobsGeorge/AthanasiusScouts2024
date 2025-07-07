<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
    'participant_name',
    'main_team',
    'sub_team',
    'program_rating',
    'program_pros',
    'program_cons',
];
    protected $table = 'Feedback';

    public $timestamps = false; // Disable timestamps if not needed
}

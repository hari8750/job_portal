<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployerProfile extends Model
{
    use HasFactory;

    // Table ka naam specify karna zaroori hai
    protected $table = 'employer_profiles';

    // Mass assignment ke liye allowed fields
    protected $fillable = [
        'user_id',
        'company_name',
        'address',
        'description',
        'aadhar_card',
    ];

    /**
     * Relation: EmployerProfile belongs to a User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

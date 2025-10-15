<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $table = 'job_applications'; // correct table name

    protected $fillable = [
        'candidate_id',
        'name',
        'phone',
        'city',
        'job_id',
        'status',
    ];

    // Each application belongs to one Job
    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    // Candidate data is stored in the same table, so this relation can be removed or left for future User table
    // public function candidate()
    // {
    //     return $this->belongsTo(User::class, 'candidate_id');
    // }
}

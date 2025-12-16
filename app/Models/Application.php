<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $table = 'job_applications'; // table name should be lowercase & plural

    protected $fillable = [
        'candidate_id',
        'name',
        'phone',
        'city',
        'job_id',
        'status'
    ];

    // Each application belongs to one Job
    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    // Each application belongs to one Candidate (User)
    public function candidate()
    {
        return $this->belongsTo(User::class, 'candidate_id');
    }
}

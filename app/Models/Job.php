<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = 'job'; // explicitly specify table name
    protected $fillable = [
    'employer_id',
    'title',
    'company',
    'location',
    'salary',
    'description',
    'status', // add this
];

    public function applications()
{
    return $this->hasMany(JobApplication::class, 'job_id', 'id');
}

}

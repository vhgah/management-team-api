<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'url'
    ];

    public function members()
    {
        return $this->belongsToMany(User::class, 'team_users', 'team_id', 'user_id')
            ->withTimestamps('joined_at')
            ->withPivot('is_creator');
    }
}

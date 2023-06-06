<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->select(['name', 'email', 'username']);
    }
}

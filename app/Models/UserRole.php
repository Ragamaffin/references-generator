<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    public const ROLE_ADMINISTRATOR = 'Администратор';
    public const ROLE_USER = 'Пользователь';

    protected $fillable = [
        'role_id',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}

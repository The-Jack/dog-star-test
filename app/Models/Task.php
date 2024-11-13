<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'owner',
    ];

    protected function casts(): array
    {
        return [
            'title' => 'string',
            'description' => 'string',
            'complete' => 'bool',
        ];
    }

    public function owner(): HasOne
    {
        return $this->hasOne(User::class);
    }
}

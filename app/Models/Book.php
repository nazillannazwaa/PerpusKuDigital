<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'code',
        'category',
        'stock',
        'cover',
        'description',
    ];

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    /**
     * Get image URL
     */
    public function getCoverUrlAttribute(): string
    {
        if (empty($this->cover)) {
            return 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=300&auto=format&fit=crop&q=80';
        }

        if (str_starts_with($this->cover, 'http://') || str_starts_with($this->cover, 'https://')) {
            return $this->cover;
        }

        return asset($this->cover);
    }
}


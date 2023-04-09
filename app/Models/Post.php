<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, int $id)
 * @method static create(array|string[] $param)
 */
class Post extends Model
{
    use Sluggable, HasFactory;

    protected $fillable = [
        'title',
        'description',
        'posted_by',
        'slug',
        'image',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'posted_by');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

}

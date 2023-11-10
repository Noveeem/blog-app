<?php

namespace App\Models;

use App\Enum\PostStatus;
use Filament\Resources\Concerns\HasTabs;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Tags\HasTags;
use Spatie\Tags\Tag;

class Post extends Model
{
    use HasFactory, HasTags;

    protected $table = 'posts';

    protected $fillable = [
        'title',
        'slug',
        'content',
        'thumbnail',
        'user_id',
    ];

    protected $casts = [
        'published_at' => 'date',
        'status' => PostStatus::class,
    ];

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function tt(): HasMany {
        return $this->hasMany(Tag::class);
    }
}

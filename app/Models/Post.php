<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_id',
        'content_blocks',
        'footer_blocks',
        'is_featured',
        'main_image_upload',
        'main_image_url',
        'published_at',
        'slug',
        'title',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'published_at' => 'datetime',
            'updated_at' => 'datetime',
            'content_blocks' => 'array',
            'footer_blocks' => 'array',
        ];
    }

    public function scopePublished($query)
    {
        return $query
            ->whereNotNull('published_at')
            ->whereDate('published_at', '<=', Carbon::now());
    }

    public function scopeFeatured($query)
    {
        return $query
            ->published()
            ->where('is_featured', true);
    }

    /**
     * Get the category that owns the post.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getMainImage()
    {
        if ($this->main_image_upload) {
            return Storage::url($this->main_image_upload);
        }

        return $this->main_image_url;
    }
}

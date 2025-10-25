<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
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

    /**
     * Scope a query to only include published posts.
     */
    #[Scope]
    protected function published(Builder $query): void
    {
        $query
            ->whereNotNull('published_at')
            ->whereDate('published_at', '<=', Carbon::now());
    }

    /**
     * Scope a query to only include featured posts.
     */
    #[Scope]
    protected function featured(Builder $query): void
    {
        $query
            ->published()
            ->where('is_featured', true);
    }

    /**
     * Get the category that owns the post.
     */
    public function category()
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['type_id', 'cover_image', 'title', 'slug', 'body'];

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public static function createSlug($name)
    {
        $project_slug = Str::slug($name);
        return $project_slug;
    }
}

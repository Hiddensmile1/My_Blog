<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Blog extends Model
{
    use HasFactory;
    // protected $guarded = [];

    protected $fillable = ['title', 'body', 'img_url', 'category_id', 'admin_id', 'published'];

    protected $hidden = ['updated_at', 'created_at'];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
   
    public function tag(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}


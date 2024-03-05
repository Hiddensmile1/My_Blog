<?php

namespace App\Models;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    // protected $guarded = [];
    protected $fillable = ['name', 'description'];


    protected $hidden = ['updated_at', 'created_at'];
    
    public function blog(): HasMany{

        return $this->hasMany(Blog::class);
        
    }

}

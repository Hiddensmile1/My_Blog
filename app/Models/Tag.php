<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    //this below function is used to hide the below values in the array
    //(i.e created_at etc), so that it won't display in the code

    protected $hidden = ['updated_at', 'created_at', 'pivot'];

    public function blog(): BelongsToMany
    {
        return $this->belongsToMany(Blog::class);
    }
}

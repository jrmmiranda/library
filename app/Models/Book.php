<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function path()
    {
    	return '/show/' . $this->id;
    }

    public function updatePath()
    {
    	return '/update/' . $this->id;
    }

    public function destroyPath()
    {
    	return '/destroy/' . $this->id;
    }

    public function setAuthorAttribute($author)
    {
        $this->attributes['author_id'] = (Author::firstOrCreate([
            'name' => $author,
        ]))->id;
    }
}

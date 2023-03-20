<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    public $uploadDirectory = '/storage/auth/posts/';
    public const POST_IMAGE = 1;

    protected $fillable = ['image', 'type'];


    public function image() : Attribute              // mutators
    {
        return Attribute::make(
            get: fn ($image) => $this->uploadDirectory. $image
        );
    }

}

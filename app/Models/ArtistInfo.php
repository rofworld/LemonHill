<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtistInfo extends Model
{
    use HasFactory;
    public $fillable = ['name', 'description', 'image_url'];

}

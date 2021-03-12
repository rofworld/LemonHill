<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventArtists extends Model
{
    use HasFactory;
    public $fillable = ['artist_id', 'artist_name','event_id'];
}

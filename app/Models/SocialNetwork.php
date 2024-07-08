<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialNetwork extends Model
{
    use HasFactory;

    protected $fillable = ['facebook', 'tiktok', 'instagram', 'youtube', 'twitter'];

    public $timestamps = false;
}

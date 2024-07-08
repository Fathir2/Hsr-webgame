<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
    use HasFactory;

    protected $table = 'videos';
    protected $primaryKey = 'kd_videos';
    protected $fillable = ['judul_videos', 'image_videos', 'link_videos'];
}

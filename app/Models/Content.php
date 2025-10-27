<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'title',
        'type',        // text, video, link, image etc.
        'video_source_type', // YouTube, Vimeo, HTML5
        'video_url',
        'video_length',
    ];

    // Relation: Content belongs to Module
    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}

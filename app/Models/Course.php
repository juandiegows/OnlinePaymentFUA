<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'course_category_id',
        'url_poster',
        'price',
        'description',
        'user_id'
    ];

    public function category(){
        return $this->belongsTo(CourseCategory::class, 'course_category_id');
    }

    public function contents(){
        return $this->hasMany(Content::class);
    }
}

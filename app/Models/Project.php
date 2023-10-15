<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
  use HasFactory;

  protected $fillable = [
    "title",
    "type_id",
    "description",
    "thumb",
    "release",
    "language",
    "link",
    "slug"
  ];

  public function user(){
    return $this->belongsTo(User::class);
  }

  public function category(){
    return $this->belongsTo(Category::class);
  }

  public function type(){
    // Project appartiene 
    return $this->belongsTo(Type::class);
  }
}

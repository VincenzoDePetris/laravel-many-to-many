<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'link', 'slug', 'category_id',];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function getCategoryBadge()
    {  
        return ($this->category ? ("<span class='badge' style='background-color: {$this->category->color}'>{$this->category->label}</span>") : ("Non ci sono categorie selezionate"));  
    }
} 

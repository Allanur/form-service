<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['form_id', 'title'];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function properties()
    {
        return $this->belongsToMany(Property::class, 'group_properties');
    }
}

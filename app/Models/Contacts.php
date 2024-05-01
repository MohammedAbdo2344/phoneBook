<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image', 
    ];
    public function contractsMobile() {
        return $this->hasMany(ContactMobile::class, 'contact_id','id');
    }
    public function contractsMail() {
        return $this->hasMany(ContactMail::class, 'contact_id','id');
    }
}

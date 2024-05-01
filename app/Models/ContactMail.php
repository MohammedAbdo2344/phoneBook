<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMail extends Model
{
    use HasFactory;
    protected $fillable = [
        'contact_id',
        'mail'
    ];
    
    public function contracts() {
        return $this->belongsToMany(Contacts::class);
    }
}

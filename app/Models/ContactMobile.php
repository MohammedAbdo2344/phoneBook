<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMobile extends Model
{
    use HasFactory;
    protected $fillable = [
        'contact_id',
        'number'
    ];
    public function contracts() {
        return $this->belongsToMany(Contacts::class);
    }
}

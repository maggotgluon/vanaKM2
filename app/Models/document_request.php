<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class document_request extends Model
{
    // use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function document()
    {
        return $this->hasOne(document::class ,'Doc_Code');
    }
}

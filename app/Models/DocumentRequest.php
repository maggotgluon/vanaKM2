<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'doc_code',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function document()
    {
        return $this->hasOne(Document::class ,'req_id');
    }
}

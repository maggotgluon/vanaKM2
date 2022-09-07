<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class document extends Model
{
    use HasFactory;

    protected $fillable = [
        'Doc_Code',
        'Doc_Name',
        'Doc_Type',
        'Doc_Life',
        'Doc_ver',
        'Doc_DateApprove',
    ];
    public function document_request()
    {
        return $this->belongsTo(document_request::class, 'Doc_Code');
    }
}

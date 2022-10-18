<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'Doc_Code',
        'Doc_Name',
        'Doc_Type',
        'Doc_Life',
        'Doc_ver',
        'Doc_Location',
        'Doc_StartDate',
        'Doc_DateApprove',
    ];
    public function DocumentRequest()
    {
        return $this->belongsTo(DocumentRequest::class, 'Doc_Code');
    }
}

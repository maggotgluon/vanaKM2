<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
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
    public function TrainingRequest()
    {
        return $this->belongsTo(TrainingRequest::class, 'Doc_Code');
    }
}

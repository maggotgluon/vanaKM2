<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'req_code',
        'doc_code',
        'doc_name',
        'doc_type',
        'doc_startDate',
        'doc_life',
        'doc_ver',
        'pdf_location',
        'doc_dateApprove',
    ];

    public function DocumentRequest()
    {
        return $this->belongsTo(DocumentRequest::class, 'req_id');
    }
}

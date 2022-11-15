<?php

namespace App\Http\Livewire;

use App\Models\DocumentRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DocumentRequestTable extends Component
{
    public $search;
    public $req_status;
    public $requests;

    public function mount()
    {
        if ( Gate::allows('review_document', Auth::user() ) ||
             Gate::allows('publish_document', Auth::user() ) ) {
            $this->requests = DocumentRequest::all();
        }else{
            $this->requests = Auth::user()->DocumentRequest;
        }
        // $this->requests->paginate(15);
    }

    public function render()
    {
        return view('livewire.document-request-table',[
            'requests' => $this->requests->where('doc_name',$this->search)
        ]);
    }

    public function search(){
        dd($this->requests->where('doc_name',$this->search));
        return view('livewire.document-request-table',[
            'requests' => $this->requests->where('doc_name',$this->search)
        ]);
    }
}

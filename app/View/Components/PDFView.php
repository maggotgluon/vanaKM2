<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PDFView extends Component
{
    public $pdf;
    /**
     * Create a new component instance.
     *
     * @return void
     */


    public function __construct($pdf)
    {
        //
        // dd($this->pdf,$pdf);
        $this->pdf = $pdf;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.pdf-view');
    }
}

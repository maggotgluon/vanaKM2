<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{$documentRequest->doc_type}}-{{$documentRequest->doc_code}}-{{$documentRequest->doc_name}}-rev-{{$documentRequest->doc_ver}}
        </h2>
        {{__('Effective Date')}} : <x-badge label="{{$documentRequest->doc_startDate}}" />
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4 flex gap-2 mb-2">
                <x-button href="{{route('document.index')}}" label="{{__('Back')}}"/>
                <!-- <x-button href="{{route('document.download',['id'=>$documentRequest->id])}}" label="{{__('Download')}} PDF"/> -->

                <!-- <x-button>Download Raw file</x-button> -->
                <!-- <x-button class="ml-auto">Print</x-button> -->
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- {{$documentRequest}} -->
                <!-- {{asset($documentRequest->pdf_location)}} -->

                <x-pdf-view :pdf="asset($documentRequest->pdf_location)"/>

            </div>
        </div>
    </div>
</x-app-layout>

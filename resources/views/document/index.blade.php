<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Documents approved') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg min-h-screen">

                @if($documents->count()>0)
                <div class="grid md:grid-cols-3 grid-cols-1 gap-4 m-4">
                @foreach ($documents as $document)

                <x-card title="{{$document->doc_type}}-{{$document->doc_code}}-{{$document->doc_name}}-rev-{{$document->doc_ver}}">
                {{__('Effective Date')}} : <x-badge label="{{$document->doc_startDate}}" />
                    <x-slot name="footer">
                        <div class="flex justify-end items-center">
                            <x-button icon="eye" label="{{__('View')}}" href="{{route('document.show',['id'=>$document->id])}}" primary />
                        </div>
                    </x-slot>
                </x-card>

                @endforeach
                </div>

                @if ( $documents->lastPage()!==1 )

                <div class="m-4 bg-slate-200 rounded-md text-center p-4">
                    {{ $documents->links() }}
                </div>
                @endif

                @else
                <div class="m-4 bg-slate-200 rounded-md text-center p-4">
                    {{__('Nothing here')}}
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

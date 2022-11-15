<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Training') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg min-h-screen">


                @if($trainings->count()>0)
                <div class="grid md:grid-cols-3 grid-cols-1 gap-4 m-4">
                    @foreach ($trainings as $training)


                <x-card title="{{$training->training_008->subject}}">
                {{__('Instructor')}} : {{App\Models\User::find($training->instructor)->name}}<br>
                <x-badge outline label="{{__('Date Strat')}} {{$training->training_008->train_dateStart}} - {{$training->training_008->train_dateEnd}}" />
                <x-badge outline label="{{__('Time Strat')}} {{$training->training_008->train_timeStart}} - {{$training->training_008->train_timeEnd}}" />
                    <x-slot name="footer">
                        <div class="flex justify-end items-center">
                            <x-button label="{{__('View')}}" href="{{route('training.show',['id'=>$training->id])}}" primary />
                        </div>
                    </x-slot>
                </x-card>
                    @endforeach
                </div>

                @if ( $trainings->lastPage()!==1 )

                <div class="m-4 bg-slate-200 rounded-md text-center p-4">
                    {{ $trainings->links() }}
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

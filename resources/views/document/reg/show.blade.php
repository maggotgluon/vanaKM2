<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{$documents->Doc_Name}} 
        </h2>
        <span class="text-sm ">
            {{$documents->Doc_Code}}
        </span>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex flex-col">
                    <p>
                        {{$documents->Doc_Type}}
                    </p>
                    <p>
                        {{$documents->Doc_Obj}} {{__('reason')}} {{$documents->Doc_Description}}

                        </p>
                    <p>
                    upload by : {{$documents->user_id}}
                    </p>
                    <span class="text-sm ">created_at  {{$documents->created_at}}</span> 
                    <p>
                        Approved by : {{$documents->User_Approve}}
                    </p>
                    <span class="text-sm ">last update {{$documents->updated_at}}</span> 
                
                    <br>
                    
                    <!-- {{ $documents }} -->
                    <!-- {{ Auth::user()->id }} -->
                    <hr>
                    <iframe src="{{asset($documents->Doc_Location)}}" width="100%" height="500px">
                    
                    <hr>
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Request Document') }}
        </h2>
    </x-slot>
 

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <h2>{{ __('Request Document') }}</h2>

                    <hr>
                    <form action="{{route('regDoc.create')}}" method="post" enctype="multipart/form-data" class="grid grid-cols-2 gap-2">
                        @csrf
                        <div class="py-2 col-span-2">
                            
                            <x-input-label 
                                for="date" class="inline"> 
                                {{__('Date')}} : 
                            </x-input-label>
                            <x-text-input 
                                name="date" 
                                value="{{date('Y-m-d')}}"
                                disabled type="date" />
                            <!-- <input class="bg-backdrop rounded-md" type="date" disabled name="date" value="{{date('Y-m-d')}}" id=""> -->

                        </div>
                        <div class="py-2">

                            <x-input-label 
                                for="name" class="inline"> 
                                {{__('Name')}} : 
                            </x-input-label>
                            <x-text-input 
                                name="name" id="name"
                                class="w-full"
                                value="{{old('name', Auth::user()->name) }}"
                                type="text" readonly/>

                            <!-- <input id="name" value="{{ Auth::user()->name }}" class="bg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full{{$errors->has('name') ? ' border-accent' : ''}}" type="text" name="name" value="{{ old('name') }}" readonly />
                            <label for="name" class="block font-medium text-sm text-content{{$errors->has('name') ? ' text-accent' : ''}}">
                                {{ __('Name') }}
                            </label> -->
                        </div>
                        <div class="py-2">
                            <x-input-label 
                                for="email" class="inline"> 
                                {{__('Email')}} : 
                            </x-input-label>
                            <x-text-input 
                                name="email" id="email"
                                class="w-full"
                                value="{{old('email', Auth::user()->email) }}"
                                type="email" />

                            <!-- <input id="name" value="{{ Auth::user()->email }}" class="bg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full{{$errors->has('email') ? ' border-accent' : ''}}" type="email" name="email" value="{{ old('email') }}" readonly />
                            <label for="email" class="block font-medium text-sm text-content{{$errors->has('email') ? ' text-accent' : ''}}">
                                {{ __('Email') }}</label> -->
                        </div>
                        <div class="py-2">
                            <x-input-label 
                                for="email" class="inline"> 
                                {{__('Department')}} : 
                            </x-input-label>
                            <x-text-input 
                                name="department" id="department"
                                class="w-full"
                                value="{{old('department', Auth::user()->department) }}"
                                type="text" readonly/>

                            <!-- <input id="department" value="{{ Auth::user()->department }}" class="bg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full{{$errors->has('department') ? ' border-accent' : ''}}" type="text" name="department" value="{{ old('department') }}" />
                            <label for="department" class="block font-medium text-sm text-content{{$errors->has('department') ? ' text-accent' : ''}}">
                                {{ __('Department') }}</label> -->
                        </div>
                        <div class="py-2">
                            <x-input-label 
                                for="departmenthead" class="inline"> 
                                {{__('Department Head')}} : 
                            </x-input-label>
                            <x-text-input 
                                name="departmenthead" id="departmenthead"
                                class="w-full"
                                value="{{old('departmenthead', Auth::user()->department_head) }}"
                                type="text" />

                            <!-- <input id="departmenthead" value="{{ Auth::user()->department_head }}" class="bg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full{{$errors->has('departmenthead') ? ' border-accent' : ''}}" type="text" name="departmenthead" value="{{ old('departmenthead') }}" />
                            <label for="departmenthead" class="block font-medium text-sm text-content{{$errors->has('departmenthead') ? ' text-accent' : ''}}">
                                {{ __('Department Head') }}</label> -->
                        </div>
                        <hr class="col-span-2">
                        <div class="py-2">

                            <x-input-label 
                                for="DocCode" class="inline"> 
                                {{__('Dar Number')}} : 
                            </x-input-label>
                            <x-text-input 
                                name="DocCode" id="DocCode"
                                value="{{old('DocCode', 'DAR'.date('Y').str_pad( $count_doc_code+1 ,4,'0',STR_PAD_LEFT) ) }}"
                                type="text" readonly/>
                            <!-- Dar Number :
                            <input class="bg-backdrop rounded-md" name="DocCode" type="text" value="{{'DAR'.date('Y').str_pad( $count_doc_code+1 ,4,'0',STR_PAD_LEFT)}}"> -->
                        </div>


                        <span>
                            <label for="type">Type</label>
                            <select class="bg-backdrop rounded-md" name="type" id="type">
                                <optgroup label="Document">
                                    <option disabled value="Document-SM">SM: System Manual</option>
                                    <option disabled value="Document-PR">PR: Procedure</option>
                                    <option disabled value="Document-WI">WI: Work Instruction</option>
                                    <option disabled value="Document-SD">SD: Standard</option>
                                    <option disabled value="Document-SP">SP: Specification</option>
                                    <option value="Document-DS_KM">DS/KM: Document Support</option>
                                    <option disabled>MN: Manual</option>
                                </optgroup>
                                <optgroup label="Form">
                                    <option disabled value="Form-ADM">ADM</option>
                                    <option disabled value="Form-ENG">ENG</option>
                                    <option disabled value="Form-HRM">HRM</option>
                                    <option disabled value="Form-Other">Other Dept. ...</option>
                                </optgroup>

                                <optgroup label="External">
                                    <option disabled value="External-Report">Report from external</option>
                                </optgroup>

                                <optgroup label="Record">
                                    <option disabled value="Record-KPIs">KPIs</option>
                                    <option disabled value="Record-ISO9001">Risk ISO9001</option>
                                    <option disabled value="Record-ISO45001">Rish ISO45001</option>
                                    <option disabled value="Record-Chemical">Chemical List</option>
                                    <option disabled value="Record-Legal">Legal & Compliance</option>
                                    <option disabled value="Record-Plan">Communication Plan</option>
                                    <option disabled value="Record-Review">Review DCC&REC</option>
                                    <option disabled value="Record-Other">Other</option>
                                </optgroup>
                                <optgroup label="Training system">
                                    <option disabled value="Training-diamond">diamond</option>
                                    <option disabled value="Training-unprotected">unprotected</option>
                                    <option disabled value="Training-consider">consider</option>
                                </optgroup>
                            </select>
                        </span>
                        <div class="py-2 col-span-2">
                            <x-input-label 
                                for="Doc_Name" class="inline"> 
                                {{__('Document Name')}} : 
                            </x-input-label>
                            <x-text-input 
                                name="Doc_Name" id="Doc_Name"
                                class="" maxlength="10"
                                value="{{old('Doc_Name') }}"
                                type="text" />
                            @error('Doc_Name')
                            <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full ">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="py-2">
                            <x-input-label for="objective" class="inline" >
                                Objective :
                            </x-input-label>
                            <!-- <div class="flex flex-col md:flex-row justify-around flex-wrap"> -->
                            <div class="grid grid-cols-2 grid-flow-dense">
                                <span>
                                    <x-text-input class="px-1 mx-1" type="radio" 
                                    name="objective" id="objective-1" value="ขอเอกสารใหม่" />
                                    <x-input-label for="objective-1" class="inline" selected>
                                        ขอเอกสารใหม่ 
                                    </x-input-label>
                                </span>
                                <span>
                                    <x-text-input class="px-1 mx-1" type="radio" 
                                    name="objective" id="objective-2" value="เปลี่ยนแปลง" />
                                    <x-input-label for="objective-2" class="inline">
                                    เปลี่ยนแปลง 
                                    </x-input-label>
                                </span>
                                <span>
                                    <x-text-input class="px-1 mx-1" type="radio" 
                                    name="objective" id="objective-3" value="ขอนำเข้าเอกสารภายนอก" />
                                    <x-input-label for="objective-3" class="inline">
                                    ขอนำเข้าเอกสารภายนอก 
                                    </x-input-label>
                                </span>
                                <span>
                                    <x-text-input class="px-1 mx-1" type="radio" 
                                    name="objective" id="objective-4" value="ขอเพิ่ม / เปลี่ยนแปลง / ยกเลิกผู้ถือครอง" />
                                    <x-input-label for="objective-4" class="inline">
                                    ขอเพิ่ม / เปลี่ยนแปลง / ยกเลิกผู้ถือครอง 
                                    </x-input-label>
                                </span>
                                <span>
                                    <x-text-input class="px-1 mx-1" type="radio" 
                                    name="objective" id="objective-5" value="ขอสำเนาเอกสาร" />
                                    <x-input-label for="objective-5" class="inline">
                                    ขอสำเนาเอกสาร 
                                    </x-input-label>
                                </span>
                                <span>
                                    <x-text-input class="px-1 mx-1" type="radio" 
                                    name="objective" id="objective-6" value="ขอยกเลิก" />
                                    <x-input-label for="objective-6" class="inline">
                                    ขอยกเลิก 
                                    </x-input-label>
                                </span>
                                <span>
                                    <x-text-input class="px-1 mx-1" type="radio" 
                                    name="objective" id="objective-7" value="ขอทำลาย" />
                                    <x-input-label for="objective-7" class="inline">
                                    ขอทำลาย 
                                    </x-input-label>
                                </span>
                                <span>
                                    <x-text-input class="px-1 mx-1" type="radio" 
                                    name="objective" id="objective-8" value="อื่นๆ" />
                                    <x-input-label for="objective-8" class="inline">
                                    อื่นๆ 
                                    </x-input-label>
                                </span>
                                <!-- <span><input class="px-2 mx-2" type="radio" name="objective" id="objective-1" value="ขอเอกสารใหม่"><label for="objective-1" selected>ขอเอกสารใหม่ </label></span> -->
                                <!-- <span><input class="px-2 mx-2" type="radio" name="objective" id="objective-2" value="เปลี่ยนแปลง"><label for="objective-2">เปลี่ยนแปลง </label></span> -->
                                <!-- <span><input class="px-2 mx-2" type="radio" name="objective" id="objective-3" value="ขอนำเข้าเอกสารภายนอก"><label for="objective-3">ขอนำเข้าเอกสารภายนอก </label></span> -->
                                <!-- <span class="col-span-2"><input class="px-2 mx-2" type="radio" name="objective" id="objective-4" value="ขอเพิ่ม / เปลี่ยนแปลง / ยกเลิกผู้ถือครอง"><label for="objective-4">ขอเพิ่ม / เปลี่ยนแปลง / ยกเลิกผู้ถือครอง </label></span>
                                <span><input class="px-2 mx-2" type="radio" name="objective" id="objective-5" value="ขอสำเนาเอกสาร"><label for="objective-5">ขอสำเนาเอกสาร </label></span> -->
                                <!-- <span><input class="px-2 mx-2" type="radio" name="objective" id="objective-6" value="ขอยกเลิก"><label for="objective-6">ขอยกเลิก </label></span>
                                <span><input class="px-2 mx-2" type="radio" name="objective" id="objective-7" value="ขอทำลาย"><label for="objective-7">ขอทำลาย </label></span>
                                <span><input class="px-2 mx-2" type="radio" name="objective" id="objective-8" value="อื่นๆ"><label for="objective-8">อื่นๆ </label></span> -->
                            </div>
                            <br>
                            <div>
                                @error('objective')
                                <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full items-center ">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <span class="flex flex-col">
                            <label for="info">รายละเอียดการแก้ไข </label>
                            <textarea name="info" id="info" cols="30" rows="5" class="bg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full{{$errors->has('name') ? ' border-accent' : ''}}"></textarea>
                            @error('info')
                            <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full ">{{$message}}</span>
                            @enderror
                        </span>


                        <div class="flex flex-wrap justify-between gap-4">
                            <span class="px-4">
                                <x-input-label 
                                    for="usedate" class="inline"> 
                                    {{__('date-use ')}} : 
                                </x-input-label>
                                <x-text-input 
                                    name="usedate" id="usedate"
                                    class="" maxlength="10"
                                    value="{{old( 'usedate' ,Carbon\Carbon::now()->toDateString()) }}"
                                    min="{{Carbon\Carbon::now()->toDateString()}}"
                                    type="date" />
                            </span>

                                    <!-- <label for="dateUse">date-use : </label>
                                    <input type="date" name="usedate" id="dateUse" value="{{Carbon\Carbon::now()->toDateString()}}" min="{{Carbon\Carbon::now()->toDateString()}}" class="bg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50  my-2 {{$errors->has('name') ? ' border-accent' : ''}}"></span> -->
                                <!-- @error('usedate')
                        <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full " >{{$message}}</span>
                    @enderror -->

                        <span class="px-4">
                                <x-input-label 
                                    for="Year" class="inline"> 
                                    {{__('date-use ')}} : 
                                </x-input-label>
                                <x-text-input 
                                    name="Year" id="Year"
                                    class="" maxlength="10"
                                    value="{{old( 'Year' ,1) }}"
                                    min="1" max="10" step="1"
                                    type="number" /> Year(s)
                            </span>

                                <!-- <label for="dateKeep">Year Life : </label>
                                <input type="number" name="Year" id="Year" value="1" min="1" max="10" step="1" class="bg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50  my-2 {{$errors->has('name') ? ' border-accent' : ''}}">
                            </span>Year(s) -->
                            <!-- @error('Year')
                        <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full " >{{$message}}</span>
                    @enderror -->
                            <span class="px-4 block">
                                <x-input-label 
                                    for="file" class="inline"> 
                                    {{__('File')}} : 
                                </x-input-label>
                                <x-text-input 
                                    name="file" id="file"
                                    value="{{old( 'file') }}"
                                    type="file"  accept=".pdf" required/> 
                                <!-- <label>File</label>
                                <input type="file" name="file"> -->

                            </span>
                            @error('file')
                            <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full ">{{$message}}</span>
                            @enderror
                        </div>


                        <div class="flex justify-end mt-4 ">
                            <!-- <button  class='mr-5 inline-flex items-center px-4 py-2 bg-backdrop-inv border border-transparent rounded-md font-semibold text-xs text-content-inv uppercase tracking-widest hover:bg-backdrop-light active:bg-backdrop-light focus:outline-none focus:border-backdrop-light focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150'>
                {{ __('Add More') }}
            </button> -->

                            <x-primary-button>
                                {{ __('Request Document') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    </div>
    </div>
</x-app-layout>
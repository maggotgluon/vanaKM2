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
                    <form action="{{route('regDoc.create')}}" method="post" enctype="multipart/form-data"
                    class="grid grid-cols-4 gap-2">
                        @csrf
                        <div class="py-2 col-span-4">

                            <x-input-label
                                for="date" class="inline"> <span class="required text-brand_orange text-xs"> * </span>
                                {{__('Date')}} :
                            </x-input-label>
                            <x-text-input required
                                name="date"
                                value="{{Carbon\Carbon::now()->toDateString()}}"
                                readonly type="date" />

                        </div>
                        <div class="py-2 col-span-2">

                            <x-input-label
                                for="name" class="inline"><span class="required text-brand_orange text-xs"> * </span>
                                {{__('Name')}} :
                            </x-input-label>
                            <x-text-input required
                                name="name" id="name"
                                class="w-full"
                                value="{{old('name', Auth::user()->name) }}"
                                type="text" readonly/>

                        </div>
                        <div class="py-2">
                            <x-input-label
                                for="email" class="inline"> <span class="required text-brand_orange text-xs"> * </span>
                                {{__('Email')}} :
                            </x-input-label>
                            <x-text-input required
                                name="email" id="email"
                                class="w-full"
                                value="{{old('email', Auth::user()->email) }}"
                                type="email" />
                        </div>
                        <div class="py-2">
                            <x-input-label
                                for="email" class="inline"> <span class="required text-brand_orange text-xs"> * </span>
                                {{__('Department')}} :
                            </x-input-label>
                            <x-text-input required
                                name="department" id="department"
                                class="w-full"
                                value="{{old('department', Auth::user()->department) }}"
                                type="text" readonly/>

                        </div>
                        <div class="py-2 col-span-2">
                            <x-input-label
                                for="departmenthead" class="inline"> <span class="required text-brand_orange text-xs"> * </span>
                                {{__('Department Head')}} :
                            </x-input-label>
                            <x-text-input required
                                name="departmenthead" id="departmenthead"
                                class="w-full"
                                value="{{old('departmenthead', Auth::user()->department_head) }}"
                                type="text" />

                        </div>
                        <div class="py-2 ">
                            <x-input-label
                                for="Doc_Name" class="inline"> <span class="required text-brand_orange text-xs"> * </span>
                                {{__('Document Name')}} :
                            </x-input-label>
                            <x-text-input required
                                name="Doc_Name" id="Doc_Name"
                                class="w-full"
                                value="{{old('Doc_Name') }}"
                                type="text" />
                            @error('Doc_Name')
                            <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full ">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="py-2 ">
                            <x-input-label
                                for="Doc_FullName" class="inline"> <span class="required text-brand_orange text-xs"> * </span>
                                {{__('Document Full Name')}} :
                            </x-input-label>
                            <x-text-input required
                                name="Doc_FullName" id="Doc_FullName"
                                class="w-full"
                                value="{{old('Doc_FullName') }}"
                                type="text" />
                            @error('Doc_FullName')
                            <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full ">{{$message}}</span>
                            @enderror
                        </div>


                        <span class="col-span-1">
                            <x-input-label  for="type"><span class="required text-brand_orange text-xs"> * </span> {{__('Document Type')}} : </x-input-label >
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

                        <div class="py-2 col-span-3">
                            <x-input-label for="objective" class="inline" >
                                 {{__('Objective')}} :
                            </x-input-label>
                            <!-- <div class="flex flex-col md:flex-row justify-around flex-wrap"> -->
                            <div class="grid grid-cols-3 grid-flow-dense">
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
                                    <x-text-input class="px-1 mx-1 pointer-events-none opacity-50" type="radio"
                                    name="objective" id="objective-3" value="ขอนำเข้าเอกสารภายนอก" />
                                    <x-input-label for="objective-3" class="inline  pointer-events-none opacity-50">
                                    ขอนำเข้าเอกสารภายนอก
                                    </x-input-label>
                                </span>
                                <span>
                                    <x-text-input class="px-1 mx-1  pointer-events-none opacity-50" type="radio"
                                    name="objective" id="objective-4" value="ขอเพิ่ม / เปลี่ยนแปลง / ยกเลิกผู้ถือครอง" />
                                    <x-input-label for="objective-4" class="inline  pointer-events-none opacity-50">
                                    ขอเพิ่ม / เปลี่ยนแปลง / ยกเลิกผู้ถือครอง
                                    </x-input-label>
                                </span>
                                <span>
                                    <x-text-input class="px-1 mx-1  pointer-events-none opacity-50" type="radio"
                                    name="objective" id="objective-5" value="ขอสำเนาเอกสาร" />
                                    <x-input-label for="objective-5" class="inline  pointer-events-none opacity-50">
                                    ขอสำเนาเอกสาร
                                    </x-input-label>
                                </span>
                                <span>
                                    <x-text-input class="px-1 mx-1  pointer-events-none opacity-50" type="radio"
                                    name="objective" id="objective-6" value="ขอยกเลิก" />
                                    <x-input-label for="objective-6" class="inline  pointer-events-none opacity-50">
                                    ขอยกเลิก
                                    </x-input-label>
                                </span>
                                <span>
                                    <x-text-input class="px-1 mx-1  pointer-events-none opacity-50" type="radio"
                                    name="objective" id="objective-7" value="ขอทำลาย" />
                                    <x-input-label for="objective-7" class="inline  pointer-events-none opacity-50">
                                    ขอทำลาย
                                    </x-input-label>
                                </span>
                                <span>
                                    <x-text-input class="px-1 mx-1  pointer-events-none opacity-50" type="radio"
                                    name="objective" id="objective-8" value="อื่นๆ" />
                                    <x-input-label for="objective-8" class="inline  pointer-events-none opacity-50">
                                    อื่นๆ
                                    </x-input-label>
                                </span>
                            </div>
                            <br>
                            <div>
                                @error('objective')
                                <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full items-center ">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <span class="flex flex-col col-span-2">
                            <label for="info">  {{__('description')}} :  </label>
                            <x-textarea-input name="info" id="info" cols="30" rows="5"></x-textarea-input>
                            @error('info')
                            <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full ">{{$message}}</span>
                            @enderror
                        </span>


                        <div class="grid grid-cols-1 col-span-2">
                            <span class="px-4">
                                <x-input-label
                                    for="usedate" class="inline">
                                    {{__('Effctive_Date')}} :
                                </x-input-label>
                                <x-text-input
                                    name="usedate" id="usedate"
                                    class="" maxlength="10"
                                    value="{{old( 'usedate' ,Carbon\Carbon::now()->addDay(10)->toDateString()) }}"
                                    min="{{Carbon\Carbon::now()->addDay(10)->toDateString()}}"
                                    type="date" />
                            </span>
                            <span class="px-4">
                                <x-input-label
                                    for="Year" class="inline">
                                    {{__('DocumentAge')}} :
                                </x-input-label>
                                <x-text-input
                                    name="Year" id="Year"
                                    class="" maxlength="10"
                                    value="{{old( 'Year' ,1) }}"
                                    min="1" max="10" step="1"
                                    type="number" />   {{__('Year')}}
                            </span>

                            <span class="px-4 block">
                                <x-input-label
                                    for="file" class="inline"> <span class="required text-brand_orange text-xs"> * </span>
                                    {{__('File')}} :
                                </x-input-label>
                                <x-text-input
                                    name="file" id="file"
                                    value="{{old( 'file') }}"
                                    type="file"  accept=".pdf" required/>

                            </span>
                            @error('file')
                            <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full ">{{$message}}</span>
                            @enderror

                            <span class="px-4 block">
                                <x-input-label
                                    for="fileRAW" class="inline"> <span class="required text-brand_orange text-xs"> * </span>
                                    {{__('File Raw')}} :
                                </x-input-label>
                                <x-text-input
                                    name="fileRAW" id="fileRAW"
                                    value="{{old( 'file') }}"
                                    type="file"  accept=".doc,.docx,.xls,.xlsx" required/>

                            </span>
                            @error('fileRAW')
                            <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full ">{{$message}}</span>
                            @enderror
                        </div>


                        <div class="flex justify-end mt-4 col-span-4">
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


<script type="module">
    import { faker } from 'https://cdn.skypack.dev/@faker-js/faker';

    const e=document.querySelectorAll('input');
    e.forEach(ee => {
        // console.log(ee.name,ee.value)
        if(ee.type=='text' & ee.value ==''){
            ee.value=faker.hacker.noun()
        }

        if(ee.type=='number' & ee.value ==''){
            ee.value=faker.mersenne.rand()
        }
        if(ee.type=='date' & ee.value ==''){
            dd  = faker.date.future()
            ee.value= dd.toDateString()
        }

    });

    const e2=document.querySelectorAll('textarea');
    e2.forEach(ee=>{
        ee.value=faker.lorem.lines()
    })
</script>

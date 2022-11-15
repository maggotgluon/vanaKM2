<div>


<x-notifications />
    <!-- action="{{route('document.request.store')}}" method="post"  -->
    <form wire:submit.prevent="store"
        enctype="multipart/form-data">
        @csrf
        <div class="px-4 py-5 bg-white sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
            <div class="grid grid-cols-6 gap-6">

                <div class="col-span-6 sm:col-span-2 relative">
                    <x-input wire:model="doc_code" name="doc_code" label="{{ __('Doc Code') }}" placeholder="{{ __('Doc Code') }}" autofocus />

                    <x-info-tools-tip>
                        {{__('Ex:')}} ITD-001<br>
                        ไม่ต้องระบุประเภทเอกสาร
                    </x-info-tools-tip>
                </div>
                <div class="col-span-6 sm:col-span-4 relative">
                    <x-input wire:model="doc_name" name="doc_name" label="{{ __('Doc Name') }}" placeholder="{{ __('Doc Name') }}" />


                </div>

                <div class="col-span-6 sm:col-span-3">

                    <x-native-select label="{{__('Document Type')}}" wire:model="doc_type" >
                            <option value='nulled'>{{__('Please select')}} {{__('Document Type')}}</option>
                            <optgroup label="Document">
                            <option disabled value='SM'>Document-SM</option>
                            <option disabled value='PR'>Document-PR</option>
                            <option disabled value='WI'>Document-WI</option>
                            <option disabled value='SD'>Document-SD</option>
                            <option disabled value='SP'>Document-SP</option>
                            <option value='DS'>Document-DS/KM</option>
                            </optgroup>
                            <optgroup label="Form">
                            <option disabled value='ADM'>Form-ADM</option>
                            <option disabled value='ENG'>Form-ENG</option>
                            <option disabled value='HRM'>Form-HRM</option>
                            <option disabled value='Other'>Form-Other</option>
                            </optgroup>
                            <optgroup label="External">
                            <option disabled value='Report'>External-Report</option>
                            </optgroup>
                            <optgroup label="Record">
                            <option disabled value='KPIs'>Record-KPIs</option>
                            <option disabled value='Risk'>Record-ISO9001</option>
                            <option disabled value='Rish'>Record-ISO45001</option>
                            <option disabled value='Chemical'>Record-Chemical</option>
                            <option disabled value='Legal'>Record-Legal</option>
                            <option disabled value='Communication'>Record-Plan</option>
                            <option disabled value='Review'>Record-Review</option>
                            <option disabled value='Other'>Record-Other</option>
                            </optgroup>
                            <optgroup label="Training">
                            <option disabled value='diamond'>Training-diamond</option>
                            <option disabled value='unprotected'>Training-unprotected</option>
                            <option disabled value='consider'>Training-consider</option>
                            </optgroup>
                        </x-native-select>
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <x-native-select label="{{__('Objective')}}" wire:model="req_obj">
                        <option value='nulled'>{{__('Please select')}} {{__('Objective')}}</option>
                        <option value="create"> ขอเอกสารใหม่</option>
                        <option value="modify"> เปลี่ยนแปลง</option>
                        <option disabled value="import"> ขอนำเข้าเอกสารภายนอก</option>
                        <option disabled value="change"> ขอเพิ่ม / เปลี่ยนแปลง / ยกเลิกผู้ถือครอง</option>
                        <option disabled value="copy"> ขอสำเนาเอกสาร</option>
                        <option disabled value="cancle"> ขอยกเลิก</option>
                        <option disabled value="distroy"> ขอทำลาย</option>
                        <option disabled value="other"> อื่นๆ</option>
                    </x-native-select>


                </div>
                <div class="col-span-6 sm:col-span-6">

                    <x-textarea wire:model="req_description" name="req_description" label="{{__('Discription')}}" placeholder="{{__('Discription')}}" />

                </div>
                <div class="col-span-3 sm:col-span-2">

                    <x-input value="{{old('doc_startDate', Carbon\Carbon::now()->toDateString() )}}" wire:model="doc_startDate" type="date"
                    min="{{Carbon\Carbon::now()->addDays(10)->toDateString()}}" name="doc_startDate" label="{{ __('Effective Date') }}" />

                </div>
                <div class="col-span-3 sm:col-span-2">
                    @if ($doc_type == 'SM'||
                         $doc_type == 'PR'||
                         $doc_type == 'WI'||
                         $doc_type == 'SD'||
                         $doc_type == 'SP'||
                         $doc_type == 'DS')

                        <x-jet-label for="doc_life" value="{{ __('Doc_life') }}" />

                        <x-input readonly value="{{__('Until Change')}}"/>
                        <x-jet-input hidden wire:model="doc_life" value="-1"/>
                    @else
                    <x-input wire:model="doc_life" type="number" min="0"
                    name="doc_life" label="{{ __('Doc_life') }}"
                    />

                    @endif


                </div>
                <div class="col-span-6 sm:col-span-2">

                    <div class="pb-4" x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                                                                        x-on:livewire-upload-finish="isUploading = false"
                                                                        x-on:livewire-upload-error="isUploading = false"
                                                                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                        <!-- File Input -->
                        <x-input label="{{ __('Doc File') }} (PDF)" id="pdf_file" type="file" name="pdf_file"
                            class="file:mr-2 file:py-2 file:px-4
                                    file:rounded-full file:border-0
                                    file:text-xs file:font-semibold
                                    file:bg-brand_blue/50 file:text-white
                                    hover:file:bg-brand_blue/100"
                            accept=".pdf"
                                    wire:model.defer="pdf_file" />
                        <!-- Progress Bar -->
                        <div x-show="isUploading">
                            <progress max="100" x-bind:value="progress"></progress>
                        </div>
                    </div>


                    <div class="pb-4" x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                                                                        x-on:livewire-upload-finish="isUploading = false"
                                                                        x-on:livewire-upload-error="isUploading = false"
                                                                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                        <!-- File Input -->
                        <x-input label="{{ __('Doc File') }} (Doc/Xls)" id="doc_file" type="file" name="doc_file"
                            class="file:mr-2 file:py-2 file:px-4
                                    file:rounded-full file:border-0
                                    file:text-xs file:font-semibold
                                    file:bg-brand_blue/50 file:text-white
                                    hover:file:bg-brand_blue/100"
                            accept=".doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,
                                    .xls,.xlsx,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                                    wire:model.defer="doc_file" />
                        <!-- Progress Bar -->
                        <div x-show="isUploading">
                            <progress max="100" x-bind:value="progress"></progress>
                        </div>
                    </div>

                </div>
            </div>

            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md mt-4">

                <x-jet-button
                    class="bg-brand_green text-white hover:bg-brand_green/80 active:bg-brand_green focus:bg-brand_green/80 focus:ring focus:ring-brand_green/80 focus:border-white">
                    {{ __('Save') }}
                </x-jet-button>
            </div>
    </form>
</div>

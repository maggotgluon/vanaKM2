<div>

    <x-notifications />

    <form wire:submit.prevent="store"
            enctype="multipart/form-data">
        @csrf
        <div class="px-4 py-5 bg-white sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
            <div class="grid grid-cols-6 gap-6">
                <h2>FM-LDS-008</h2>

                <div class="col-span-6 sm:col-span-6">

                    <x-native-select label="{{__('Instructor')}}" wire:model="instructor" name="instructor">
                        <!-- <option value="{{Auth::User()->id}}" selected>{{Auth::User()->name}}</option> -->
                        @foreach (App\Models\User::where('department',Auth::User()->department)->get() as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </x-native-select>

                    <!-- <x-input value="{{old('teacher')}}" wire:model="teacher"
                                        name="teacher" label="{{ __('teacher') }}" placeholder="teacher" autofocus /> -->
                </div>

                <div class="col-span-6 sm:col-span-6">
                    <x-input value="{{old('subject')}}" wire:model="subject" name="subject" label="{{ __('Subject') }}" placeholder="{{ __('Subject') }}" />
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <x-input type="date" value="{{old('train_dateStart')}}" wire:model="train_dateStart" min="{{Carbon\Carbon::now()->addDays(3)->toDateString()}}" name="train_dateStart" label="{{ __('Date Strat') }}" placeholder="{{ __('Date Strat') }}" />
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <x-input type="date" value="{{old('train_dateEnd')}}" wire:model="train_dateEnd" min="{{Carbon\Carbon::now()->addDays(3)->toDateString()}}" name="train_dateEnd" label="{{ __('Date End') }}" placeholder="{{ __('Date End') }}" />
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <x-input type="time" value="{{old('train_timeStart')}}" wire:model="train_timeStart" name="train_timeStart" label="{{ __('Time Strat') }}" placeholder="{{ __('Time Strat') }}" />
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <x-input type="time" value="{{old('train_timeEnd')}}" wire:model="train_timeEnd" name="train_timeEnd" label="{{ __('Time End') }}" placeholder="Time End" />
                </div>

                <div class="col-span-6 sm:col-span-6">

                    <x-textarea wire:model="train_objective" name="train_objective" label="{{__('Objective')}}" placeholder="{{__('Objective')}}" />

                </div>

                <h3 class="col-span-6 sm:col-span-5">{{__('subject Details discription')}}</h3>

                <div class="col-span-6 sm:col-span-5">

                    <x-textarea wire:model="train_subjectDetails" name="train_subjectDetails" label="{{__('subject Details discription')}}" placeholder="{{__('subject Details discription')}}" />

                </div>

                <div class="col-span-6 sm:col-span-1">
                    <x-input type="number" value="{{old('train_subjectDuration')}}" wire:model="train_subjectDuration" name="train_subjectDuration" label="{{ __('Duration') }}" placeholder="{{ __('Duration') }}" />
                </div>


                <h3 class="col-span-6 sm:col-span-5">{{__('Activity')}}</h3>

                <div class="col-span-6 sm:col-span-5">

                    <x-textarea wire:model="train_activityDetails" name="train_activityDetails" label="{{__('Activity')}}" placeholder="{{__('Activity')}}" />

                </div>

                <div class="col-span-6 sm:col-span-1">
                    <x-input type="number" value="{{old('train_activityDuration')}}" wire:model="train_activityDuration" name="train_activityDuration" label="{{ __('Duration') }}" placeholder="{{ __('Duration') }}" />
                </div>


                <h3 class="col-span-6 sm:col-span-5">{{__('Assessment')}}</h3>

                <div class="col-span-6 sm:col-span-5">

                    <x-textarea wire:model="train_assessmentDetails" name="train_assessmentDetails" label="{{__('Assessment')}}" placeholder="{{__('Assessment')}}" />

                </div>

                <div class="col-span-6 sm:col-span-1">
                    <x-input type="number" value="{{old('train_assessmentDuration')}}" wire:model="train_assessmentDuration" name="train_assessmentDuration" label="{{ __('Duration') }}" placeholder="{{ __('Duration') }}" />
                </div>


                <h3>{{__('Remark')}}</h3>

                <div class="col-span-6 sm:col-span-6">

                    <x-textarea wire:model="train_remark" name="train_remark" label="{{__('Remark')}}" placeholder="{{__('Remark')}}" />

                </div>

                <h2>FM-LDS-009</h2>


                <div class="col-span-6 sm:col-span-6">
                    {{__('Assessment process')}}
                    <div class="flex justify-between">
                        <x-checkbox wire:model="assessment_process" name="assessment_process[]" value="ถาม-ตอบ" label="ถาม-ตอบ" />
                        <x-checkbox wire:model="assessment_process" name="assessment_process[]" value="แบบทดสอบ" label="แบบทดสอบ" />
                        <x-checkbox  wire:model="assessment_process" name="assessment_process[]" value="ทดลองปฏิบัติงานจริง" label="ทดลองปฏิบัติงานจริง" />
                    </div>
                    <x-jet-input-error for="assessment_process" class="mt-2"></x-jet-input-error>
                    <!-- {{var_export($assessment_process)}} -->

                </div>

                <div class="col-span-6 sm:col-span-6">
                    * {{__('Assessment Tools')}} :
                    <x-textarea wire:model="assessment_tools" name="assessment_tools" label="{{__('Assessment Tools')}}" placeholder="{{__('Assessment Tools')}}" />

                </div>
                <div class="col-span-6 sm:col-span-6">
                    <h3> {{__('Assessment Criteriament')}} :</h3>
                </div>
                <div class="col-span-6 sm:col-span-6">
                    {{__('Pass')}}
                    <x-textarea wire:model="assessment_pass" name="assessment_pass" label="{{__('Pass')}}" placeholder="{{__('Pass')}}" />

                </div>
                <div class="col-span-6 sm:col-span-6">
                    {{__('Nopass')}}
                    <x-textarea wire:model="assessment_fail" name="assessment_fail" label="{{__('Nopass')}}" placeholder="{{__('Nopass')}}" />

                </div>

                <div class="col-span-6 sm:col-span-6">
                    <x-jet-label for="pdf_file" value="{{ __('File') }} (PDF)" />
                    <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                        <!-- File Input -->
                        <x-jet-input id="pdf_location" type="file" class="mt-1 block w-full" name="pdf_location" value="{{old('pdf_location')}}" class="file:mr-2 file:py-2 file:px-4
                                                file:rounded-full file:border-0
                                                file:text-xs file:font-semibold
                                                file:bg-brand_blue/50 file:text-white
                                                hover:file:bg-brand_blue/100" accept=".pdf" wire:model.defer="pdf_location" />
                        <x-jet-input-error for="pdf_location" class="mt-2"></x-jet-input-error>
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

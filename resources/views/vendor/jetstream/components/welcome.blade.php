<x-card>
    <x-slot name="header">
        <div class="flex justify-start items-center p-6 gap-4 ">
            <x-jet-application-logo class="block h-24 w-auto -mt-9" />
            <h1 class="text-xl font-bold"> Welcome to KM Intranet!</h1>
        </div>
    </x-slot>
    <p class="py-4 max-w-lg m-auto">
        การนำองค์ความรู้ขององค์กร มาจัดการเข้าสู่โปรแกรมระบบ เพื่อให้ทุกคนในองค์กรสามารถนำไปศึกษา และใช้ได้อย่างง่ายดาย และรวดเร็วขึ้น
    </p>
    <x-slot name="footer">
        <div class="flex justify-center items-stretch gap-4">
            @auth
                <x-card>
                    <x-slot name="header">
                        <x-badge lg icon="document-text" label="{{__('Document')}}"/>
                    </x-slot>

                    @if (App\Models\Document::where('doc_startDate','<=',Carbon\Carbon::now()->toDateString())->get()->count()>=3)
                    <ul>
                        @foreach ( App\Models\Document::where('doc_startDate','<=',Carbon\Carbon::now()->toDateString())->get()->random(3) as $doc )
                        <li>
                            <a href="{{route('document.show',['id'=>$doc->id])}}">
                            {{$doc->doc_code}} : {{$doc->doc_name}}
                            </a>
                            <span class="text-xs">(update {{Carbon\Carbon::parse($doc->updated_at)->diffForHumans()}})</span>
                        </li>

                        @endforeach
                    </ul>
                    @endif

                    <x-slot name="footer">
                        <div class="flex justify-end">
                            <x-button href="{{route('document.index')}}" label="All Document" rightIcon="chevron-double-right" primary outline />
                        </div>
                    </x-slot>
                </x-card>

                <x-card>
                    <x-slot name="header">
                        <x-badge lg icon="presentation-chart-bar" label="{{__('Training')}}"/>
                    </x-slot>
                    @if (App\Models\TrainingRequest::all()->count()>=3)
                    <ul>
                        @foreach ( App\Models\TrainingRequest::all()->random(3) as $doc )
                        <li>
                            <a href="{{route('training.show',['id'=>$doc->id])}}">
                            {{json_decode($doc->training_008)->subject}}
                            </a>
                            <span class="text-xs">(update {{Carbon\Carbon::parse($doc->updated_at)->diffForHumans()}})</span>
                        </li>

                        @endforeach
                    </ul>
                    @endif
                    <x-slot name="footer">
                        <div class="flex justify-end">
                            <x-button href="{{route('training.index')}}" label="All Training" rightIcon="chevron-double-right" primary outline />
                        </div>
                    </x-slot>
                </x-card>
            @else
                <x-button href="{{ route('login') }}" label="{{__('Log in')}}" primary />
                @if (Route::has('register'))
                    <x-button href="{{ route('register') }}" label="{{__('Register')}}" primary outline />
                @endif
            @endauth
        </div>
    </x-slot>
</x-card>

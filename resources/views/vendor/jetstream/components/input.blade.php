@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }}  {!! $attributes->merge(['class' => 'border-gray-300
                                    focus:border-brand_green focus:ring focus:ring-brand_green focus:ring-opacity-50
                                    rounded-md shadow-sm']) !!}>


@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => ' rounded-md shadow-sm border-brand_blue focus:border-brand_orange focus:ring focus:ring-brand_yellow focus:ring-opacity-50 disabled:border-0']) !!}>

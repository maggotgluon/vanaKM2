<button {{ $attributes->merge(['type' => 'submit', 'class' => 'bg-brand_blue text-sm text-brand_yellow hover:text-brand_orange hover:scale-110 px-8 py-4 rounded-lg hover:bg-brand_green transition-all duration-500 shadow hover:shadow-xl uppercase font-bold shadow-brand_yellow']) }}>
    {{ $slot }}
</button>

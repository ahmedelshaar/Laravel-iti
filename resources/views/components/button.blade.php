<button {{ $attributes->class(['btn', 'btn' . $type])->merge(['type' => 'button']) }}>
    {{ $slot }}
</button>

@php
    $previewUrl = app(\App\Support\CmsData::class)->mediaUrl($value ?? null);
@endphp

<label class="{{ $class ?? '' }}">
    <span>{{ $label }}</span>
    @if(!empty($help ?? null))
        <small class="admin-field-help">{{ $help }}</small>
    @endif
    <input type="file" name="{{ $name }}" accept="image/*">
    @if($previewUrl)
        <div class="mt-3 overflow-hidden rounded-[10px] border border-slate-200 bg-white p-3">
            <img src="{{ $previewUrl }}" alt="{{ $label }}" class="block max-h-[220px] w-auto max-w-full rounded-[6px] object-contain">
            <p class="mt-2 break-all text-xs text-slate-500">{{ $value }}</p>
        </div>
    @elseif(!empty($fallbackLabel ?? null))
        <p class="admin-field-help">{{ $fallbackLabel }}</p>
    @endif
</label>

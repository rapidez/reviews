@props(['score', 'maxScore' => '100'])
<div
    {{ $attributes->class('bg-emphasis relative h-2.5 rounded-full ring-px ring-success overflow-hidden') }}>
    <div
        class="absolute inset-0 rounded-full bg-success"
        :style="'width: calc(' + {{ $score }} + ' / {{ $maxScore }} * 100%)'"
    ></div>
</div>
@props([
    'status',
    'dates' => [
        'on_review_date' => null,
        'lnd_date' => null,
        'akuntansi_date' => null,
        'treasury_date' => null,
        'cleared_date' => null,
    ]
])

@php
    $steps = [
        ['label' => 'On Review', 'field' => 'on_review_date'],
        ['label' => 'Diajukan ke LND', 'field' => 'lnd_date'],
        ['label' => 'Diajukan ke Akuntansi', 'field' => 'akuntansi_date'],
        ['label' => 'Diajukan ke Treasury', 'field' => 'treasury_date'],
        ['label' => 'Cleared', 'field' => 'cleared_date'],
    ];

    $statusIndex = array_search($status, array_column($steps, 'label'));
@endphp

<div class="bg-indigo-50 p-4 rounded-xl shadow-md">
    <h2 class="text-xl font-bold text-indigo-900 mb-4">Progress</h2>
    <div class="flex items-center justify-between">
        @foreach ($steps as $index => $step)
            <div class="flex flex-col items-center text-center w-1/5">
                <div class="
                    rounded-full w-10 h-10 flex items-center justify-center mb-1
                    @if ($index < $statusIndex) bg-green-400 text-white
                    @elseif ($index === $statusIndex) bg-yellow-400 text-black
                    @else bg-gray-400 text-white
                    @endif
                ">
                    @if ($index < $statusIndex)
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    @elseif ($index === $statusIndex)
                        <svg class="animate-spin h-5 w-5" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"/>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"/>
                        </svg>
                    @else
                        {{ $index + 1 }}
                    @endif
                </div>
                <div class="text-sm font-semibold text-gray-800">{{ $step['label'] }}</div>
                <div class="text-xs text-gray-600">
                    @php
                        $dateValue = $dates[$step['field']] ?? null;
                    @endphp
                    {{ $dateValue ? \Carbon\Carbon::parse($dateValue)->translatedFormat('d F Y') : '-' }}
                </div>
            </div>
        @endforeach
    </div>
</div>
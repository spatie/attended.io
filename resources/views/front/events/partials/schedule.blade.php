@foreach($slotsGroupedByDay as $day => $slots)
    <h2>{{ $slots->first()->starts_at->format('d F Y') }}</h2>
    <table>
        @foreach($slots as $slot)
            @php
                $startHourChanged = $slot->startHour() !== optional($previousSlot ?? null)->startHour();
                $trackChanged = $slot->track !== optional($previousSlot ?? null)->track;
                $previousSlot = $slot;
            @endphp
            <tr>
                <td>
                    @if ($startHourChanged)
                        {{ $slot->startHour() }}
                    @endif
                </td>
                <td>
                    @if ($trackChanged || $startHourChanged)
                        {{ $slot->track }}
                    @endif
                </td>
                <td>
                    <b><a href="{{ route('slots.show', $slot->idSlug()) }}">{{ $slot->name }}</a></b><br/>
                    @include('front.slots.partials.by-speaker')
                </td>
                <td>
                    @include('front.reviews.partials.summary', ['reviewable' => $slot])
                </td>
            </tr>
        @endforeach
    </table>
@endforeach


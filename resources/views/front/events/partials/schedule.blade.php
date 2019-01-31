@foreach($slotsGroupedByDay as $day => $slots)
    <h2>{{ $slots->first()->starts_at->format('d F Y') }}</h2>
    <table>
        @foreach($slots as $slot)
            @php
                $startHourChanged = $slot->startHour() !== optional($previousSlot ?? null)->startHour();
                $locationChanged = $slot->location !== optional($previousSlot ?? null)->location;
                $previousSlot = $slot;
            @endphp
            <tr>
                <td>
                    @if ($startHourChanged)
                        {{ $slot->startHour() }}
                    @endif
                </td>
                <td>
                    @if ($locationChanged || $startHourChanged)
                        {{ $slot->location }}
                    @endif
                </td>
                <td>
                    <b><a href="{{ route('slots.show', $slot->idSlug()) }}">{{ $slot->name }}</a></b><br/>
                    @include('front.slots.partials.by-speaker')
                </td>
                <td>
                    @include('front.reviews.partials.review-summary')
                </td>
            </tr>

        @endforeach
    </table>
@endforeach


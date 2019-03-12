<nav class="mb-8">
    <ul class="flex font-condensed tracking-wide uppercase text-grey-dark border-b-2 border-grey-lightest">
        <li class="{!! (! request()->has('past') && ! request()->has('query')) ? 'font-bold border-b-2 pb-1 border-grey-lightest' : '' !!}">
            <a href="?">Upcoming</a>
        </li>
        <li class="ml-4 {!! request()->has('past') ? 'font-bold border-b-2 pb-1 border-grey-lightest' : '' !!}">
            <a href="?past=1">Past</a>
        </li>
    </ul>
</nav>

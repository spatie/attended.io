<nav>
    <ul class="flex font-condensed font-bold tracking-wide text-grey-light uppercase border-b-2 border-grey-lightest">
        <li class="{!! (! request()->has('past') && ! request()->has('query')) ? 'text-grey-dark border-b-2 pb-1 border-red' : '' !!}" style="top:2px">
            <a href="?">Upcoming</a>
        </li>
        <li class="ml-4 {!! request()->has('past') ? 'text-grey-dark border-b-2 pb-1 border-red' : '' !!}"  style="top:2px">
            <a href="?past=1">Past</a>
        </li>
    </ul>
</nav>

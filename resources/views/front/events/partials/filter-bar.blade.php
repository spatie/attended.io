<nav class="flex">
    <ul class="flex">
        <li {!! (! request()->has('past') && ! request()->has('query')) ? 'class="font-bold"' : '' !!}>
            <a href="?">Upcoming</a>
        </li>
        <li {!! request()->has('past') ? 'class="font-bold"' : '' !!}>
            <a href="?past=1">Past</a>
        </li>
    </ul>
</nav>

<nav class="flex">
    <ul class="flex">
        <li {!! request()->has('past') ? '' : 'class="font-bold"' !!}>
            <a href="?">Upcoming</a>
        </li>
        <li {!! request()->has('past') ? 'class="font-bold"' : '' !!}>
            <a href="?past=1">Past</a>
        </li>
    </ul>
    <form
        data-controller="search"
        data-action="search#submit"
    >
        <input
            type="text"
            name="query"
            placeholder="Search..."
            value="{{ request()->query('query') }}"
            data-target="search.input"
        >
        <button type="submit">
            Search
        </button>
        <button data-action="search#reset">
            Reset
        </button>
    </form>
</nav>

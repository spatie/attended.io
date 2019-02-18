<nav class="flex">
    <ul class="flex">
        <li {!! (! request()->has('past') && ! request()->has('query')) ? 'class="font-bold"' : '' !!}>
            <a href="?">Upcoming</a>
        </li>
        <li {!! request()->has('past') ? 'class="font-bold"' : '' !!}>
            <a href="?past=1">Past</a>
        </li>
    </ul>
    <form
        id="search-form"
        data-controller="search"
        data-turbolinks-permanent
    >
        <input
            type="text"
            name="query"
            placeholder="Search..."
            value="{{ request()->query('query') }}"
            data-target="search.input"
            data-action="keyup->search#submit"
        >
        <button
            data-target="search.clear"
            data-action="search#reset"
            class="{{ request()->query('query') ? null : 'hidden' }}"
        >
            Clear
        </button>
    </form>
</nav>

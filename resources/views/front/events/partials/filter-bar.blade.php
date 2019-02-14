<ul>
    <a @php( print request()->has('past') ? '' : 'active') href="?upcoming=1">Upcoming</a>
    <a @php( print request()->has('past') ? 'active' : '') href="?past=1">Past</a>

    <form action="{{ route('search') }}">
        <input type="text" name="query" />

        <button>Search</button>
    </form>

</ul>
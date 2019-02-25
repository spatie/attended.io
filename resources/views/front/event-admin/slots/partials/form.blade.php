@csrf

<context :model="$slot">
    <input-field name="name" label="Name"/>
    <input-field name="description" label="Description"/>
    <select-field name="type" :options="['talk', 'workshop']" label="Type"/>
    <input-field name="starts_at" label="Starts at"/>
    <input-field name="ends_at" label="Ends at"/>
    <input-field name="speaker_name" label="Speaker name"/>
</context>

<button>Save</button>

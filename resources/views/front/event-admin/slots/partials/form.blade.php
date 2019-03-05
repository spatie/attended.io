@csrf

<context :model="$slot">
    <select-field name="track_id" :options="$tracks" label="Track"/>

    <input-field name="name" label="Name"/>
    <input-field name="description" label="Description"/>
    <select-field name="type" :options="$slotTypes" label="Type"/>
    <input-field name="starts_at" label="Starts at"/>
    <input-field name="ends_at" label="Ends at"/>

    {{ mount('SpeakersInput', [
        'initialSpeakers' => $speakers,
        'errors' => $errors->getMessages(),
]   ) }}

</context>

<button>Save</button>

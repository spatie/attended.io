@csrf

<context :model="$slot">
    <input-field name="name" label="Name"/>
    <input-field name="description" label="Description"/>
    <select-field name="type" :options="['talk', 'workshop']" label="Type"/>
    <input-field name="starts_at" label="Starts at"/>
    <input-field name="ends_at" label="Ends at"/>

    {{ refract('SpeakersInput', [
        'initialSpeakers' => $speakers,
        'errors' => $errors->getMessages(),
]   ) }}

</context>

<button>Save</button>

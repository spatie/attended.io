@csrf

<context :model="$event">
    <input-field name="name" label="Name"/>
    <input-field name="description" label="Description"/>
    <input-field name="location" label="Location"/>
    <input-field name="city" label="City"/>
    <country-select name="country_code" :model="$event" label="Country"/>
    <input-field name="website" label="Website"/>
    <input-field name="starts_at" label="Starts at"/>
    <input-field name="ends_at" label="Ends at"/>

    <h2>Call for papers</h2>

    <checkbox-field name="cfp" label="Call for papers"/>
    <input-field name="cfp_link" label="Link"/>
    <input-field name=cfp_deadline label="Deadline"/>
</context>

<button>Save</button>

import Repeater from '../lib/components/Repeater';

export default function SpeakersInput({ initialSpeakers, errors }) {
    return (
        <Repeater
            initial={initialSpeakers}
            blueprint={{ id: null, name: '', email: '', editable: true }}
            addNewLabel="Add new speaker"
        >
            {({ item, index, update, remove }) => (
                <>
                    <input type="hidden" name={`speakers[${index}][id]`} value={item.id || ''} />
                    <label>Name</label>
                    <input
                        type="text"
                        name={`speakers[${index}][name]`}
                        value={item.name}
                        readOnly={! item.editable}
                        onChange={event => update({ ...item, name: event.target.value })}
                    />
                    <label>Email</label>
                    <input
                        type="email"
                        name={`speakers[${index}][email]`}
                        value={item.email}
                        readOnly={! item.editable}
                        onChange={event => update({ ...item, email: event.target.value })}
                    />
                    {item.editable === false && (
                        <strong>Has account</strong>
                    )}
                    <button type="button" onClick={remove}>
                        Remove
                    </button>
                    {errors.length ? <p>{errors[0]}</p> : null}
                </>
            )}
        </Repeater>
    );
}

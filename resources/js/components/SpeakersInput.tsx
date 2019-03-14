import * as React from 'react';
import Repeater from '../lib/components/Repeater';

type Speaker = {
    id: number | null;
    name: string;
    email: string;
};

type Props = {
    initial: Speaker[];
    errors: string[];
};

export default function SpeakersInput({ initial, errors }: Props) {
    return (
        <Repeater
            initial={initial}
            blueprint={{ id: null, name: '', email: '' }}
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
                        onChange={event => update({ ...item, name: event.target.value })}
                    />
                    <label>Email</label>
                    <input
                        type="email"
                        name={`speakers[${index}][email]`}
                        value={item.email}
                        onChange={event => update({ ...item, email: event.target.value })}
                    />
                    <button type="button" onClick={remove}>
                        Remove
                    </button>
                    {errors.length ? <p>{errors[0]}</p> : null}
                </>
            )}
        </Repeater>
    );
}

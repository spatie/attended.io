import * as React from 'react';
import Repeater from '../lib/components/Repeater';

type Track = {
    id: number | null;
    name: string;
    slotCount: number;
};

type Props = {
    initial: Track[];
    errors: string[];
};

export default function TracksInput({ initial, errors }: Props) {
    return (
        <Repeater
            initial={initial}
            blueprint={{ id: null, name: '', slotCount: 0 }}
            addNewLabel="Add new track"
        >
            {({ item, index, update, remove }) => (
                <>
                    <input type="hidden" name={`tracks[${index}][id]`} value={item.id || ''} />
                    <input
                        type="text"
                        name={`tracks[${index}][name]`}
                        value={item.name}
                        onChange={event => update({ ...item, name: event.target.value })}
                    />
                    <em>{item.slotCount} slots</em>
                    {item.slotCount === 0 && (
                        <button type="button" onClick={remove}>
                            Remove
                        </button>
                    )}
                    {errors.length ? <p>{errors[0]}</p> : null}
                </>
            )}
        </Repeater>
    );
}

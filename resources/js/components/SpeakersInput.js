import React from 'react';
import Draggable from '../lib/components/Draggable';
import useCollection from '../lib/hooks/useCollection';

export default function SpeakersInput({ initialSpeakers, errors }) {
    const [speakers, { add, update, remove, moveBefore, moveAfter }] = useCollection(initialSpeakers);

    return (
        <Draggable>
            {({ dragging }) => (
                <>
                    <button type="button" onClick={() => add({ id: null, name: '', slotCount: 0 })}>
                        Add new speaker
                    </button>
                    <Draggable.DropTarget onDrop={draggingIndex => moveBefore(draggingIndex, 0)}>
                        {({ dropTargetProps }) => <div {...dropTargetProps}>Drop</div>}
                    </Draggable.DropTarget>
                    <ul>
                        {speakers.map((speaker, index) => (
                            <li key={index}>
                                <Draggable.Item data={index}>
                                    {({ draggableItemProps, draggableHandleProps }) => (
                                        <div {...draggableItemProps}>
                                            <span {...draggableHandleProps}>DRAG ME</span>
                                            <Speaker
                                                speaker={speaker}
                                                index={index}
                                                onUpdate={update}
                                                onRemove={remove}
                                                errors={errors[`speakers.${index}.name`] || []}
                                            />
                                        </div>
                                    )}
                                </Draggable.Item>
                                <Draggable.DropTarget
                                    onDrop={draggingIndex => moveAfter(draggingIndex, index)}
                                >
                                    {({ dropTargetProps }) => <div {...dropTargetProps}>Drop</div>}
                                </Draggable.DropTarget>
                            </li>
                        ))}
                    </ul>
                </>
            )}
        </Draggable>
    );
}

function Speaker({ speaker, index, errors, onUpdate, onRemove }) {
    const canBeRemoved = speaker.slotCount === 0;

    function updateSpeakerName(name, index) {
        onUpdate({ ...speaker, name }, index);
    }

    function updateSpeakerEmail(email, index) {
        onUpdate({ ...speaker, email }, index);
    }

    return (
        <>
            <input type="hidden" name={`speakers[${index}][id]`} value={speaker.id || ''} />
            <label>Name</label>
            <input
                type="text"
                name={`speakers[${index}][name]`}
                value={speaker.name}
                onChange={event => updateSpeakerName(event.target.value, index)}
            />
            <label>Email</label>
            <input
                type="email"
                name={`speakers[${index}][email]`}
                value={speaker.email}
                onChange={event => updateSpeakerEmail(event.target.value, index)}
            />
            {canBeRemoved && (
                <button type="button" onClick={() => onRemove(index)}>
                    Remove
                </button>
            )}
            {errors.length ? <p>{errors[0]}</p> : null}
        </>
    );
}

import React from 'react';
import Draggable from '../lib/components/Draggable';
import useCollection from '../lib/hooks/useCollection';

export default function TracksInput({ initialTracks, errors }) {
    const [tracks, { add, update, remove, moveBefore, moveAfter }] = useCollection(initialTracks);

    return (
        <Draggable>
            {({ dragging }) => (
                <>
                    <button type="button" onClick={() => add({ id: null, name: '', slotCount: 0 })}>
                        Add new track
                    </button>
                    <Draggable.DropTarget onDrop={draggingIndex => moveBefore(draggingIndex, 0)}>
                        {({ dropTargetProps }) => <div {...dropTargetProps}>Drop</div>}
                    </Draggable.DropTarget>
                    <ul>
                        {tracks.map((track, index) => (
                            <li key={index}>
                                <Draggable.Item data={index}>
                                    {({ draggableItemProps }) => (
                                        <div {...draggableItemProps}>
                                            <Draggable.Handle>DRAG ME</Draggable.Handle>
                                            <Track
                                                track={track}
                                                index={index}
                                                onUpdate={update}
                                                onRemove={remove}
                                                errors={errors[`tracks.${index}.name`] || []}
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

function Track({ track, index, errors, onUpdate, onRemove }) {
    const canBeRemoved = track.slotCount === 0;

    function updateTrackName(name, index) {
        onUpdate({ ...track, name }, index);
    }

    return (
        <>
            <input type="hidden" name={`tracks[${index}][id]`} value={track.id || ''} />
            <input
                type="text"
                name={`tracks[${index}][name]`}
                value={track.name}
                onChange={event => updateTrackName(event.target.value, index)}
            />
            <em>{track.slotCount} slots</em>
            {canBeRemoved && (
                <button type="button" onClick={() => onRemove(index)}>
                    Remove
                </button>
            )}
            {errors.length ? <p>{errors[0]}</p> : null}
        </>
    );
}

import React from 'react';

export default function Track({track, index, onUpdate, onRemove, validationError}) {

    function updateTrackName(name, index)
    {
        const updatedTrack = {...track, name};

        onUpdate(updatedTrack, index);
    }

    const canDelete = track.slotCount === 0;

    return (
        <div>
            <input type="hidden" name={`tracks[${index}][id]`} value={track.id | ''}/>
            <input type="text" name={`tracks[${index}][name]`} value={track.name}
                   onChange={(event) => updateTrackName(event.target.value, index)}/>

            { canDelete && <span onClick={() => onRemove(index)}>Remove</span> }

            {validationError.length ? (<div>{validationError[0]}</div>) : (<div></div>)}
        </div>
    );
}
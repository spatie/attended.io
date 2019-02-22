import React, { useState } from 'react';

export default function TracksForm({ initialTracks, validationErrors }) {
    const [tracks, setTracks] = useState(initialTracks);

    if (tracks.length === 0) {
        addTrack();
    }

    function addTrack() {
        setTracks(tracks => [...tracks, { id: null, name: '', slotCount: 0 }]);
    }

    function updateTrack(updatedTrack, updatedTrackIndex) {
        const newTracks = tracks.map((track, index) => {
            if (index !== updatedTrackIndex) {
                return track;
            }

            return updatedTrack;
        });

        setTracks(newTracks);
    }

    function removeTrack(trackIndex) {
        const newTracks = tracks.filter((track, index) => index !== trackIndex);

        setTracks(newTracks);

        if (tracks.length === 0) {
            this.addTrack();
        }
    }

    return (
        <div>
            <span onClick={addTrack}>Add new track</span>

            {tracks.map((track, index) => (
                <Track
                    key={index}
                    track={track}
                    index={index}
                    onUpdate={updateTrack}
                    onRemove={removeTrack}
                    validationError={validationErrors[`tracks.${index}.name`] || []}
                />
            ))}
        </div>
    );
}

function Track({ track, index, onUpdate, onRemove, validationError }) {
    function updateTrackName(name, index) {
        const updatedTrack = { ...track, name };

        onUpdate(updatedTrack, index);
    }

    const canDelete = track.slotCount === 0;

    return (
        <div>
            <input type="hidden" name={`tracks[${index}][id]`} value={track.id | ''} />
            <input
                type="text"
                name={`tracks[${index}][name]`}
                value={track.name}
                onChange={event => updateTrackName(event.target.value, index)}
            />

            {canDelete && <span onClick={() => onRemove(index)}>Remove</span>}

            {validationError.length ? <div>{validationError[0]}</div> : <div />}
        </div>
    );
}

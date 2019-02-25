import React, { createContext, useContext, useState } from 'react';

const DraggableContext = createContext({});

export default function Draggable({ children }) {
    const [dragging, setDragging] = useState(false);

    function startDragging() {
        setDragging(true);
    }

    function stopDragging() {
        setDragging(false);
    }

    return (
        <DraggableContext.Provider value={{ dragging, startDragging, stopDragging }}>
            {children}
        </DraggableContext.Provider>
    );
}

Draggable.Item = function DraggableItem({ data, children }) {
    const { dragging, stopDragging } = useContext(DraggableContext);

    function onDragStart(event) {
        event.dataTransfer.setData('data', JSON.stringify(data));
    }

    const draggableItemProps = dragging
        ? { draggable: true, onDragStart, onDragEnd: stopDragging }
        : null;

    return children({ dragging, draggableItemProps });
};

Draggable.Handle = function DraggableHandle({ children }) {
    const { startDragging } = useContext(DraggableContext);

    return <span onMouseDown={startDragging}>{children}</span>;
};

Draggable.DropTarget = function DraggableDropTarget({ onDrop, children }) {
    const { dragging } = useContext(DraggableContext);

    function handleDragOver(event) {
        event.preventDefault();
    }

    function handleDrop(event) {
        event.preventDefault();

        onDrop(JSON.parse(event.dataTransfer.getData('data')));
    }

    const dropTargetProps = dragging ? { onDrop: handleDrop, onDragOver: handleDragOver } : null;

    return children({ dragging, dropTargetProps });
};

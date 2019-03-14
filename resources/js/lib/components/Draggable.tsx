import * as React from 'react';
import { createContext, useContext, useState } from 'react';

const DraggableContext = createContext({
    dragging: false,
    startDragging: () => {},
    stopDragging: () => {},
});

type DraggableProps = {
    children: (props: { dragging: boolean }) => JSX.Element;
};

export default function Draggable({ children }: DraggableProps) {
    const [dragging, setDragging] = useState(false);

    function startDragging() {
        setDragging(true);
    }

    function stopDragging() {
        setDragging(false);
    }

    return (
        <DraggableContext.Provider value={{ dragging, startDragging, stopDragging }}>
            {children({ dragging })}
        </DraggableContext.Provider>
    );
}

Draggable.Item = function DraggableItem({ data, children }) {
    const { dragging, stopDragging } = useContext(DraggableContext);

    function handleDragStart(event) {
        event.dataTransfer.setData('data', JSON.stringify(data));
    }

    if (!dragging) {
        return <div>{children}</div>;
    }

    return (
        <div draggable onDragStart={handleDragStart} onDragEnd={stopDragging}>
            {children}
        </div>
    );
};

Draggable.Handle = function DraggableHandle({ children }) {
    const { startDragging } = useContext(DraggableContext);

    return <div onMouseDown={startDragging}>{children}</div>;
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

    if (!dragging) {
        return <div>{children}</div>;
    }

    return (
        <div onDrop={handleDrop} onDragOver={handleDragOver}>
            {children}
        </div>
    );
};

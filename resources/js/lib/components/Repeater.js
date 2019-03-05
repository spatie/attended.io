import Draggable from './Draggable';
import useCollection from '../hooks/useCollection';

export default function Repeater({ initial, blueprint, addNewLabel, children }) {
    const [items, { add, remove, update, moveBefore, moveAfter }] = useCollection(initial);

    return (
        <Draggable>
            {({ dragging }) => (
                <>
                    <button type="button" onClick={() => add({ ...blueprint })}>
                        {addNewLabel}
                    </button>
                    <Draggable.DropTarget onDrop={draggingIndex => moveBefore(draggingIndex, 0)}>
                        {({ dropTargetProps }) => <div {...dropTargetProps}>Drop</div>}
                    </Draggable.DropTarget>
                    <ul>
                        {items.map((item, index) => (
                            <li key={index}>
                                <Draggable.Item data={index}>
                                    {({ draggableItemProps, draggableHandleProps }) => (
                                        <div {...draggableItemProps}>
                                            <span {...draggableHandleProps}>DRAG ME</span>
                                            {children({
                                                item,
                                                update: newItem => update(newItem, index),
                                                remove: () => remove(index),
                                            })}
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

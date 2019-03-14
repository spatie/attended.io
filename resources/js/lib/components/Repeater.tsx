import * as React from 'react';
import Draggable from './Draggable';
import useList from '../hooks/useList';

type Props<T> = {
    initial: T[];
    blueprint: T;
    addNewLabel: string;
    children: (props: ChildFunctionProps<T>) => JSX.Element;
};

type ChildFunctionProps<T> = {
    item: T;
    index: number;
    update: (newItem: T) => void;
    remove: () => void;
};

export default function Repeater<T>({ initial, blueprint, addNewLabel, children }: Props<T>) {
    const [items, { add, remove, update, moveBefore, moveAfter }] = useList(initial);

    return (
        <Draggable>
            {() => (
                <>
                    <button type="button" onClick={() => add({ ...blueprint })}>
                        {addNewLabel}
                    </button>
                    <Draggable.DropTarget onDrop={draggingIndex => moveBefore(draggingIndex, 0)}>
                        Drop
                    </Draggable.DropTarget>
                    <ul>
                        {items.map((item, index) => (
                            <li key={index}>
                                <Draggable.Item data={index}>
                                    <Draggable.Handle>DRAG ME</Draggable.Handle>
                                    {children({
                                        item,
                                        index,
                                        update: newItem => update(newItem, index),
                                        remove: () => remove(index),
                                    })}
                                </Draggable.Item>
                                <Draggable.DropTarget
                                    onDrop={draggingIndex => moveAfter(draggingIndex, index)}
                                >
                                    Drop
                                </Draggable.DropTarget>
                            </li>
                        ))}
                    </ul>
                </>
            )}
        </Draggable>
    );
}

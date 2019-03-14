import { useState } from 'react';

type Actions<T> = {
    add: (item: T) => void;
    update: (newItem: T, index: number) => void;
    remove: (index: number) => void;
    moveBefore: (subjectIndex: number, targetIndex: number) => void;
    moveAfter: (subjectIndex: number, targetIndex: number) => void;
};

export default function useList<T>(initialItems: T[]): [T[], Actions<T>] {
    const [list, setList] = useState(initialItems);

    function add(item: T) {
        setList(list => [...list, item]);
    }

    function update(newItem: T, index: number) {
        setList(list => {
            return list.map((item, i) => {
                return index === i ? newItem : item;
            });
        });
    }

    function remove(index: number) {
        setList(list => {
            return list.filter((_, i) => {
                return index !== i;
            });
        });
    }

    function moveBefore(subjectIndex: number, targetIndex: number) {
        setList(list => {
            if (subjectIndex === targetIndex) {
                return list;
            }

            return list.reduce(
                (newCollection, item, index) => {
                    if (index === subjectIndex) {
                        return newCollection;
                    }

                    if (index === targetIndex) {
                        return [...newCollection, list[subjectIndex], list[targetIndex]];
                    }

                    return [...newCollection, item];
                },
                <T[]>[]
            );
        });
    }

    function moveAfter(subjectIndex: number, targetIndex: number) {
        setList(list => {
            if (subjectIndex === targetIndex) {
                return list;
            }

            return list.reduce(
                (newCollection, item, index) => {
                    if (index === subjectIndex) {
                        return newCollection;
                    }

                    if (index === targetIndex) {
                        return [...newCollection, list[targetIndex], list[subjectIndex]];
                    }

                    return [...newCollection, item];
                },
                <T[]>[]
            );
        });
    }

    return [list, { add, update, remove, moveBefore, moveAfter }];
}

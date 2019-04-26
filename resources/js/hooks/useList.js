import { useState } from 'react';

export default function useList(initialItems) {
    const [list, setList] = useState(initialItems);

    function add(item) {
        setList(list => [...list, item]);
    }

    function update(newItem, index) {
        setList(list => {
            return list.map((item, i) => {
                return index === i ? newItem : item;
            });
        });
    }

    function remove(index) {
        setList(list => {
            return list.filter((_, i) => {
                return index !== i;
            });
        });
    }

    function moveBefore(subjectIndex, targetIndex) {
        setList(list => {
            if (subjectIndex === targetIndex) {
                return list;
            }

            return list.reduce((newCollection, item, index) => {
                if (index === subjectIndex) {
                    return newCollection;
                }

                if (index === targetIndex) {
                    return [...newCollection, list[subjectIndex], list[targetIndex]];
                }

                return [...newCollection, item];
            }, []);
        });
    }

    function moveAfter(subjectIndex, targetIndex) {
        setList(list => {
            if (subjectIndex === targetIndex) {
                return list;
            }

            return list.reduce((newCollection, item, index) => {
                if (index === subjectIndex) {
                    return newCollection;
                }

                if (index === targetIndex) {
                    return [...newCollection, list[targetIndex], list[subjectIndex]];
                }

                return [...newCollection, item];
            }, []);
        });
    }

    return [list, { add, update, remove, moveBefore, moveAfter }];
}

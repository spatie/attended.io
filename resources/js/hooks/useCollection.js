import { useReducer } from 'react';

function collectionReducer(collection, action) {
    switch (action.type) {
        case 'ADD_ITEM': {
            return [...collection, action.item];
        }
        case 'UPDATE_ITEM': {
            return collection.map((item, index) => {
                return index === action.index ? action.item : item;
            });
        }
        case 'REMOVE_ITEM': {
            if (collection.length === 1) {
                return collectionReducer([], { type: 'ADD_ITEM' });
            }

            return collection.filter((item, index) => {
                return index !== action.index;
            });
        }
        case 'MOVE_BEFORE': {
            return collection.reduce((newCollection, item, index) => {
                if (index === action.subjectIndex) {
                    return newCollection;
                }

                if (index === action.targetIndex) {
                    return [
                        ...newCollection,
                        collection[action.subjectIndex],
                        collection[action.targetIndex],
                    ];
                }

                return [...newCollection, item];
            }, []);
        }
        case 'MOVE_AFTER': {
            return collection.reduce((newCollection, item, index) => {
                if (index === action.subjectIndex) {
                    return newCollection;
                }

                if (index === action.targetIndex) {
                    return [
                        ...newCollection,
                        collection[action.targetIndex],
                        collection[action.subjectIndex],
                    ];
                }

                return [...newCollection, item];
            }, []);
        }
    }
}

export default function useRepeater(initialCollection = []) {
    const [collection, dispatch] = useReducer(collectionReducer, initialCollection);

    function add(item) {
        dispatch({ type: 'ADD_ITEM', item });
    }

    function update(item, index) {
        dispatch({ type: 'UPDATE_ITEM', item, index });
    }

    function remove(index) {
        dispatch({ type: 'REMOVE_ITEM', index });
    }

    function moveBefore(subjectIndex, targetIndex) {
        dispatch({ type: 'MOVE_BEFORE', subjectIndex, targetIndex });
    }

    function moveAfter(subjectIndex, targetIndex) {
        dispatch({ type: 'MOVE_AFTER', subjectIndex, targetIndex });
    }

    return [collection, { add, update, remove, moveBefore, moveAfter }];
}

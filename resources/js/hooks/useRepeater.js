import { useReducer } from 'react';

function repeaterReducer(collection, action) {
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
                return repeaterReducer([], { type: 'ADD_ITEM' });
            }

            return collection.filter((item, index) => {
                return index !== action.index;
            });
        }
    }
}

export default function useRepeater(initialCollection = []) {
    const [collection, dispatch] = useReducer(repeaterReducer, initialCollection);

    function add(item) {
        dispatch({ type: 'ADD_ITEM', item });
    }

    function update(item, index) {
        dispatch({ type: 'UPDATE_ITEM', item, index });
    }

    function remove(index) {
        dispatch({ type: 'REMOVE_ITEM', index });
    }

    return [collection, { add, update, remove }];
}

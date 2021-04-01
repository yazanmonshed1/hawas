import { createStore } from 'redux';
import AppReducer from './reducers';

export const store = createStore(
    AppReducer, /* preloadedState, */
    window.__REDUX_DEVTOOLS_EXTENSION__ && window.__REDUX_DEVTOOLS_EXTENSION__()
);
import * as Views from 'laravel-javascript-views/react';
import SpeakersInput from './components/SpeakersInput';
import TracksInput from './components/TracksInput';

const views = new Views();

views.register('SpeakersInput', SpeakersInput);
views.register('TracksInput', TracksInput);

views.mount();

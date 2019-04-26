import { render } from 'react-dom';
import SpeakersInput from './components/SpeakersInput';
import TracksInput from './components/TracksInput';

function mount(componentName, Component) {
    [...document.querySelectorAll(`[data-component=${componentName}]`)].forEach(container => {
        render(<Component {...JSON.parse(container.dataset.props)} />, container);
    });
}

mount('SpeakersInput', SpeakersInput);
mount('TracksInput', TracksInput);

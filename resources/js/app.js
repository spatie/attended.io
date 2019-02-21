import React from 'react';
import ReactDOM from "react-dom";
import TracksForm from "./components/TracksForm";

const tracksFormContainer = document.getElementById('tracksForm');
if (tracksFormContainer) {
    ReactDOM.render(<TracksForm {...JSON.parse(tracksFormContainer.dataset.props)} />, tracksFormContainer);
}
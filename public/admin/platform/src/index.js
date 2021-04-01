import React from "react";
import ReactDOM from "react-dom";
import { Provider } from 'react-redux';

const app = document.getElementById("app");

import 'reactjs-popup/dist/index.css';
import "./assets/sass/base.scss";
import Main from "./Main";
import { store } from "./store";

ReactDOM.render(
    <Provider store={store}>
        <Main />
    </Provider>
    , app)
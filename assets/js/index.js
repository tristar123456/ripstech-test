import 'babel-polyfill';
import React from 'react';
import {render} from 'react-dom';
import App from './app';
import './chart';

render(<App />, document.getElementById('app'));

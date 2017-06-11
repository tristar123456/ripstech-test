import 'babel-polyfill';
import React from 'react';
import {render} from 'react-dom';
import App from './app';
import './chart';
import './carousel';

render(<App />, document.getElementById('app'));

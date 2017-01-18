import React, {PropTypes} from 'react';
import {Map, TileLayer} from 'react-leaflet';
import asyncPoll from 'react-async-poll';

function App(props = {points: []}) {
  const position = {lat: 45, lng: 0};
  const points = props.points || [];

  return (
    <Map center={position} zoom={3}>
      <TileLayer
        url='http://{s}.tile.osm.org/{z}/{x}/{y}.png'
        attribution='&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
      />
    </Map>
  );
}

App.propTypes = {
  points: PropTypes.arrayOf(PropTypes.shape({
    id: PropTypes.number,
    lat: PropTypes.number,
    long: PropTypes.number,
    icon: PropTypes.string,
  })),
};

async function onPoll(props) {
  const options = {method: 'GET'};
  const response = await fetch('/points', options);
  const data = await response.json();

  return new App({...props, ...{points: data}});
}

export default asyncPoll(2 * 1000, onPoll)(App);

import React, {PropTypes} from 'react';
import {render} from 'react-dom';
import {Map, TileLayer} from 'react-leaflet';
import Point from './point';

function App(props) {
  const position = {lat: 45, lng: 0};
  const {points} = props;

  return (
    <Map center={position} zoom={3}>
      <TileLayer
        url='https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png'
        attribution='&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
      />
      {points && points.length ? points.map(point => Point(point)) : null}
    </Map>
  );
}

App.propTypes = {
  points: PropTypes.arrayOf(PropTypes.shape({
    id: PropTypes.number,
    lat: PropTypes.number,
    long: PropTypes.number,
    icon: PropTypes.string,
    createdAt: PropTypes.string,
  })),
};

async function fetchPoints() {
  const options = {method: 'GET'};
  const response = await fetch('/points', options);
  const data = await response.json();

  render(<App points={data} />, document.getElementById('app'));
}

fetchPoints();

export default App;

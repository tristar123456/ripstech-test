import React, {Component, PropTypes} from 'react';
import {Map, TileLayer} from 'react-leaflet';

class App extends Component {
  static propTypes = {
    points: PropTypes.arrayOf(PropTypes.shape({
      id: PropTypes.number,
      lat: PropTypes.number,
      long: PropTypes.number,
      icon: PropTypes.string,
    })),
  };

  static defaultProps = {
    points: [],
  };

  render() {
    const position = {lat: 45, lng: 0};

    return (
      <Map center={position} zoom={3}>
        <TileLayer
          url='http://{s}.tile.osm.org/{z}/{x}/{y}.png'
          attribution='&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
        />
      </Map>
    );
  }
}

export default App;

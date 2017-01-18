import React, {PropTypes} from 'react';
import {Marker} from 'react-leaflet';
import {VectorMarkers} from 'Leaflet.vector-markers';

function Point(props = {}) {
  const icon = VectorMarkers.icon({
    icon: props.icon,
    markerColor: 'red',
  });

  return (
    <Marker
      key={props.id}
      position={{lat: props.lat, lng: props.long}}
      icon={icon}
    />
  );
}

Point.propTypes = {
  id: PropTypes.number.isRequired,
  lat: PropTypes.number.isRequired,
  long: PropTypes.number.isRequired,
  icon: PropTypes.string.isRequired,
  createdAt: PropTypes.string.isRequired,
};

export default Point;

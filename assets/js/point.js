import React, {PropTypes} from 'react';
import {Marker} from 'react-leaflet';

function Point(props = {}) {
  return (
    <Marker
      key={props.id}
      position={{lat: props.lat, lng: props.long}}
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

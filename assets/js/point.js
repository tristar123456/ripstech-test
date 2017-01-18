import React, {PropTypes} from 'react';
import {Marker} from 'react-leaflet';
import {VectorMarkers} from 'Leaflet.vector-markers';

function parseColor(createdAt) {
  const sixHoursAgo = new Date();
  const oneHourAgo = new Date();
  const created = new Date(createdAt);
  let color = '#d3d3d3';

  oneHourAgo.setHours(oneHourAgo.getHours() - 1);
  sixHoursAgo.setHours(sixHoursAgo.getHours() - 6);

  if (created.getTime() > oneHourAgo.getTime()) {
    color = '#ff0000';
  } else if (created.getTime() > sixHoursAgo.getTime()) {
    color = '#ff9999';
  }

  return color;
}

function Point(props = {}) {
  const dayAgo = new Date();
  const created = new Date(props.createdAt);
  const icon = VectorMarkers.icon({
    icon: props.icon,
    markerColor: parseColor(props.createdAt),
  });
  let output = null;

  dayAgo.setHours(dayAgo.getHours() - 24);

  if (created.getTime() > dayAgo.getTime()) {
    output = <Marker
      key={props.id}
      position={{lat: props.lat, lng: props.long}}
      icon={icon}
    />;
  }

  return output;
}

Point.propTypes = {
  id: PropTypes.number.isRequired,
  lat: PropTypes.number.isRequired,
  long: PropTypes.number.isRequired,
  icon: PropTypes.string.isRequired,
  createdAt: PropTypes.string.isRequired,
};

export default Point;

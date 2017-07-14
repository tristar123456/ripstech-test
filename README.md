RIPSTech Test
---

## Setup

Clone the repository:

`git clone git@github.com:hownowbrowncow/ripstech-test.git`

Install dependencies:

`composer install`
`yarn` OR `npm install`

Build frontend assets:

`NODE_ENV=production gulp`

To initalize the doctrine database type:

`php bin/console doctrine:migrations:migrate`

and confirm the following warning with an `y`.

Add geolocation data:

`bin/console maxmind:geoip:update-data http://geolite.maxmind.com/download/geoip/database/GeoLiteCity.dat.gz`


## Usage

There are 3 endpoints available

#### OPTIONS /points

description: Returns info on available endpoints and request parameters.

#### GET /points

description: Returns a collection of point data.

#### POST /points

description: Create a new point record.
parameters:

	lat:
		description: Latitude of new point
		type: float
		required: false
	long:
		description: Longitude of new point
		type: float
		required: false
	ip:
		description: IP address that will be used for lat/long geolocation
		type: string
		required: false
	icon:
		description: Font-Awesome icon used on display marker
		type: string
		required: false

examples (using curl):

with IP and icon:
`curl --data "ip=186.190.128.4&icon=bullseye" http://map.dev/points`

with lat/long:
`curl --data "lat=41.832284&long=-71.420443" http://map.dev/points`

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

Database config is set to use postgres. After creating a table and user run:

`bin/console doctrine:database:create`

Validate and update database schema:

`bin/console doctrine:schema:update --force`
`bin/console doctrine:schema:validate`

Add geolocation data:

`bin/console maxmind:geoip:update-data http://geolite.maxmind.com/download/geoip/database/GeoLiteCity.dat.gz`

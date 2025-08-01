let mix = require('laravel-mix');

const path = require('path');
let directory = path.basename(path.resolve(__dirname));

const source = 'platform/core/' + directory;
const dist = 'public/vendor/core/core/' + directory;

mix.js(source + '/resources/assets/js/dashboard.js', dist + '/js').vue({ version: 2 });


    .copy(dist + '/js/dashboard.js', source + '/public/js');

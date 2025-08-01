let mix = require('laravel-mix');
let glob = require('glob');
const fs = require('fs');

mix.options({
    processCssUrls: false,
    clearConsole: true,
    terser: {
        extractComments: false,
    }
});

mix.webpackConfig({
    stats: {
        children: true,
    },
});

// Run only for ripple theme
require('./platform/themes/ripple/webpack.mix.js');

// Original content for other modules (commented out)
// glob.sync('./platform/**/**/webpack.mix.js').forEach(item => {
//     let content = fs.readFileSync(item, 'utf8');
//     content = content.replace(/\.sass\([^)]+\)/g, '');
//     eval(content);
// });

// Run only for a package, replace [package] by the name of package you want to compile assets
// require('./platform/packages/[package]/webpack.mix.js');

// Run only for a plugin, replace [plugin] by the name of plugin you want to compile assets
// require('./platform/plugins/[plugin]/webpack.mix.js');

// Run only for themes, you shouldn't modify below config, just uncomment if you want to compile only theme's assets
// glob.sync('./platform/themes/**/webpack.mix.js').forEach(item => require(item));


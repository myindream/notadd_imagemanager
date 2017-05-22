require('./check-versions')();

process.env.NODE_ENV = 'production';

var ora = require('ora');
var rm = require('rimraf');
var path = require('path');
var chalk = require('chalk');
var merge = require('webpack-merge');
var webpack = require('webpack');
var config = require('../config');
var buildWebpackConfig = require('./webpack.prod.conf');
var webpackConfig = merge(buildWebpackConfig, {
    plugins: [
        new webpack.ProgressPlugin()
    ],
    watch: true
});

rm(path.join(config.build.assetsRoot, config.build.assetsSubDirectory), err => {
    if (err) throw err;
    webpack(webpackConfig, function (err, stats) {
        if (err) throw err;
        console.log('\n');
        process.stdout.write(stats.toString({
                colors: true,
                modules: true,
                children: false,
                chunks: false,
                chunkModules: false
            }) + '\n');

        console.log(chalk.cyan(`  Build completed at ${(new Date()).toLocaleString()}.`));
        console.log(chalk.cyan('  Watching ...\n'));
    });
});
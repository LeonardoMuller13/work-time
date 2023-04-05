const mix = require('laravel-mix');
const path = require('path');
const { VueLoaderPlugin } = require('vue-loader')

mix.options({
    hmrOptions: {
        host: 'localhost',
        port: '8081'
    },
});

mix.webpackConfig({
	node: {
		// fs:'empty',
		global: true,
		__filename: true,
		__dirname: true,
	},
	module: {
		rules: [{
			test: /\.(mp4|webm|ogg|mp3|wav|flac|aac|txt)(\?.*)?$/,
			loader: 'url-loader',
			options: {
				limit: 10000,
				name: 'media/[name]--[folder].[ext]'
			}
		}]
	},
	resolve: {
		alias: {
			'@': path.resolve(__dirname, 'packages/spa/http/src/resources/assets/js'),
			'images': path.resolve(__dirname, 'packages/spa/http/src/resources/assets/images'),
			'assets': path.resolve(__dirname, 'packages/spa/http/src/resources/assets'),
		},
		fallback: {
			fs: false,
			os: false,
			http: false,
			https: false,
			child_process: false
		}
	}
})
.js('packages/spa/http/src/resources/assets/js/app.js', 'public/js')
.vue()

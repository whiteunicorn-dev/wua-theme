import path from 'path'
import autoprefixer from 'autoprefixer'
import liveReload from 'vite-plugin-live-reload'
import createExternal from 'vite-plugin-external'
import StylelintPlugin from 'vite-plugin-stylelint'
import watchAndRun from 'vite-plugin-watch-and-run'
import filterReplace from 'vite-plugin-filter-replace'
import sassGlobImports from 'vite-plugin-sass-glob-import'
import externalGlobals from 'rollup-plugin-external-globals'

export default {
	root: './resources/',
	base: './',
	build: {
		outDir: '../dist/',
		assetsDir: '',
		emptyOutDir: false,
		manifest: true,
	},
	server: {
		cors: true,
		strictPort: true,
		port: 3636,
		open: __vite_get_base_url(),
	},
	plugins: [
		sassGlobImports(),
		liveReload(__dirname + '/**/**.php'),
		StylelintPlugin({
			include: ['./resources/scss/**/*.scss']
		}),
		filterReplace([
			{
				filter: /resources\/js\/.+\.js$/,
				replace: [
					{
						from: /\$\(/g,
						to: 'jQuery('
					},
					{
						from: /\$\./g,
						to: 'jQuery.'
					}
				],
			},
			{
				filter: /select2\/dist\/.+\.js$/,
				replace: {
					from: 'exports',
					to: 'undefined'
				}
			},
			{
				filter: /selectric\/public\/.+\.js$/,
				replace: {
					from: 'exports',
					to: 'undefined'
				}
			},
			{
				filter: /malihu-custom-scrollbar-plugin\/.+\.js$/,
				replace: {
					from: 'exports',
					to: 'undefined'
				}
			}
		]),
		externalGlobals({
			jquery: 'jQuery'
		},{
			include: ['*.js', '*.ts', '*.jsx', '*.tsx', '*.vue']
		}),
		createExternal({
			externals: {
				jquery: 'jQuery'
			}
		}),
		watchAndRun([
			{
				watch: '**/resources/scss/**/*.scss',
				watchKind: 'add',
				run: 'touch ./resources/scss/load.scss',
				quiet: true
			}
		])
	],
	css: {
		postcss: {
			plugins: [
				autoprefixer(),
			],
		},
		devSourcemap: true,
	},
}

// determines the base website URL for the dev command
function __vite_get_base_url() {
	const pathParts = __dirname.split(path.sep)
	const baseUrl = 'http://localhost/' // [UPDATE WITH CURRENT SITE URL]

	if (pathParts.includes('server')) {
		return `${baseUrl}${pathParts.slice(pathParts.indexOf('server') + 1, pathParts.indexOf('wp-content')).join('/')}/`
	} else if (pathParts.includes('Server')) {
		return `${baseUrl}${pathParts.slice(pathParts.indexOf('Server') + 1, pathParts.indexOf('wp-content')).join('/')}/`
	} else {
		return baseUrl
	}
}

import path from 'path'
import autoprefixer from 'autoprefixer'
import StylelintPlugin from 'vite-plugin-stylelint'
import watchAndRun from 'vite-plugin-watch-and-run'
import sassGlobImports from 'vite-plugin-sass-glob-import'

export default {
	root: './resources/',
	base: './',
	build: {
		rollupOptions: {
			input: {
				app: './resources/index-admin.html',
			},
		},
		outDir: '../dist/admin/',
		assetsDir: '',
		emptyOutDir: false,
		manifest: true,
	},
	server: {
		cors: true,
		strictPort: true,
		port: 3737,
		open: __vite_get_base_url(),
	},
	plugins: [
		sassGlobImports(),
		StylelintPlugin(),
		watchAndRun([
			{
				watch: '**/resources/scss/**/*.scss',
				watchKind: 'add',
				run: 'touch ./resources/scss/load-admin.scss',
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
	const adminPath = 'wp-admin';

	if (pathParts.includes('server')) {
		return `${baseUrl}${pathParts.slice(pathParts.indexOf('server') + 1, pathParts.indexOf('wp-content')).join('/')}/${adminPath}`
	} else if (pathParts.includes('Server')) {
		return `${baseUrl}${pathParts.slice(pathParts.indexOf('Server') + 1, pathParts.indexOf('wp-content')).join('/')}/${adminPath}`
	} else {
		return `${baseUrl}${adminPath}`
	}
}

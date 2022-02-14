/**
 * The module dependencies.
 */
const path = require('path');
const postcss = require('postcss');
const globby = require('globby');
const defaults = require('lodash.defaults');
const kebabCase = require('lodash.kebabcase');
const sortBy = require('lodash.sortby');
const groupBy = require('lodash.groupby');
const map = require('lodash.map');
const sizeOf = require('image-size');
const slash = require('slash');

/**
 * Get the image ratio.
 *
 * @param  {String} file
 * @return {Number}
 */
const getRatio = (file) => {
	const name = path.basename(file);
	const matches = /@(\d)x\.[a-z]{3,4}$/gi.exec(file);

	return matches ? parseInt(matches[1], 10) : 1;
};

/**
 * Convert filename to a valid CSS selector.
 *
 * @param  {String} file
 * @return {String}
 */
const getSelector = (file) => {
	let name = path.basename(file);
	let base, pseudo;

	name = name.replace(/(@\d+x)?\..+$/gi, '');

	if (/\_/.test(name)) {
		base = name.replace(`_${name.split('_').pop()}`, '');
		pseudo = name.split('_').pop();
	}

	if (base && pseudo) {
		return (
`.${base}-${pseudo},
a:${pseudo} .${base},
button:${pseudo} .${base},
a.${pseudo} .${base},
button.${pseudo} .${base},
.${base}.${pseudo}`
		);
	}

	return `.${kebabCase(name)}`;
};


/**
 * Convert each one of the paths to an Image object.
 *
 * @param  {String[]} images
 * @param  {String}   stylesheet
 * @return {Object[]}
 */
const prepareImages = (images, stylesheet) => {
	images = images.map((image) => {
		const url = slash(path.relative(path.dirname(stylesheet), image));
		const size = sizeOf(image);
		const ratio = getRatio(image);
		const selector = getSelector(image);

		return {
			url,
			size,
			ratio,
			selector,
		};
	});

	images = sortBy(images, 'ratio');
	images = groupBy(images, 'ratio');

	return images;
};

/**
 * Generate CSS rules for the given objects.
 *
 * @param  {Object}   root
 * @param  {Object[]} images
 * @param  {Number}   ratio
 * @return {String}
 */
const compileCSS = (root, images, ratio) => {
	images = images.map(({ selector, url, size }) => {
		const rule = postcss.rule({ selector });
		const decls = [
			['background', `url(${url}) no-repeat 0 0`],
			['background-size', '100% 100%'],
			['width', `${size.width / ratio}px`],
			['height', `${size.height / ratio}px`],
			['display', 'inline-block'],
			['vertical-align', 'middle'],
			['font-size', '0px']
		];

		rule.source = root.source;

		decls.forEach(([prop, value]) => {
			const decl = postcss.decl({ prop, value });

			decl.raws.before = ' ';
			decl.raws.after = '';
			decl.source = rule.source;

			rule.append(decl);
		});

		rule.raws.after = ' ';
		rule.raws.semicolon = true;

		return rule;
	});

	if (ratio > 1) {
		const mediaRule = postcss.atRule({
			name: 'media',
			params: `(-webkit-min-device-pixel-ratio: ${ratio}), (min-resolution: ${ratio * 96}dpi)`
		});

		images.forEach((rule) => {
			rule.raws.before = '\n\t';
		});

		mediaRule.raws.before = '\n';
		mediaRule.raws.after = '\n';
		mediaRule.source = root.source;

		mediaRule.append(images);
		root.append(mediaRule);
	} else {
		root.append(images);
	}
};

/**
 * Process the images and generate the CSS rules.
 *
 * @param  {Object}  root
 * @param  {Object}  opts
 * @return {Promise}
 */
const processImages = (root, { images, stylesheet }) => {
	return globby(images)
		.then((paths) => prepareImages(paths, stylesheet))
		.then((groups) => map(groups, (images, ratio) => compileCSS(root, images, ratio)));
};

/**
 * Define the plugin.
 */
module.exports = postcss.plugin('postcss-lazy-rules', function(opts) {
	opts = defaults({}, opts, {
		images: '',
		stylesheet: ''
	});

	if (!opts.images) {
		throw new Error(`postcss-lazy-rules: Please provide a glob pattern for "images" option.`);
	}

	if (!opts.stylesheet) {
		throw new Error(`postcss-lazy-rules: Please provide value for the "stylesheet" option.`);
	}

	return function(root, result) {
		// We don't care about other stylesheets.
		if (slash(root.source.input.file) !== slash(opts.stylesheet)) {
			return;
		}

		return processImages(root, opts);
	};
});

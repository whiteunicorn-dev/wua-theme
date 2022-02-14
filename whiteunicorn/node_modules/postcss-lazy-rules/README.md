# postcss-lazy-rules

### Usage

```js
var fs = require('fs');
var path = require('path');
var postcss = require('postcss');
var rules = require('postcss-lazy-rules');

var css = fs.readFileSync('./css/sprite.css', 'utf8');
var opts = {
	images: path.resolve(__dirname, './images/*.png'),
	stylesheet: path.resolve(__dirname, './css/sprite.css')
};

postcss([rules(opts)])
	.process(css, {
		from: './css/style.css',
		to: './dist/style.css'
	})
	.then(function(result) {
		fs.writeFileSync('./dist/style.css', result.css);
	});
```

**Result**

```css
/* Input */

/* ---------------- */

/* Output */
.circle { background: url(../images/circle.png) no-repeat 0 0; width: 25px; height: 25px; }
.square { background: url(../images/square.png) no-repeat 0 0; width: 25px; height: 25px; }

@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
	.circle { background: url(../images/circle@2x.png) no-repeat 0 0; width: 25px; height: 25px; background-size: 25px 25px; }
	.square { background: url(../images/square@2x.png) no-repeat 0 0; width: 25px; height: 25px; background-size: 25px 25px; }
}
```

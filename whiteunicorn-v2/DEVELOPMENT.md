## Dependencies
1. Latest version of [NodeJS](http://nodejs.org/) (min v6.0.0) [nvm use >= 16]
2. Latest version of one of the following package managers

- [NPM](https://www.npmjs.com/) (min v16.0.0)
- [Yarn](https://yarnpkg.com/) (min v0.20.4)

## Install
In the root directory of the project run:

```
npm install
```

or

```
yarn install
```

## Development
To start the project in development mode, run:

```
npm run dev
```

## Build
To build the project, run:

```
npm run build
```

This command will generate an images sprite and build all assets(html, css and javascript) in the `dist` folder. Assets live in the `resources` folder. 

## Configuration files
The build process configuration files live in `vite.config.js`


## Notes
Swiper, Magnific Popup, and GSAP (including some plugins) are included in this build. To remove, edit the package.json file "dependencies" object and delete the items there. Then re-run npm init. (May need to delete the pacakge.lock file first)


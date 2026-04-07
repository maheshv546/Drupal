{
  "name": "voya_drupal_theme_builder",
  "version": "1.0.0",
  "description": "Front-end build tools for custom Voya Drupal theme.",
  "repository": {
    "type": "git",
    "url": "https://github.voya.net/Voya/drupal-platform.git"
  },
  "type": "module",
  "private": "true",
  "devDependencies": {
    "@babel/core": "^7.18.2",
    "@babel/preset-env": "^7.18.2",
    "@fortawesome/fontawesome-free": "^6.7.2",
    "@stylistic/stylelint-plugin": "^3.1.3",
    "autoprefixer": "^10.4.21",
    "breakpoint-sass": "^3.0.0",
    "del": "^5.1.0",
    "eslint": "^8.9.0",
    "eslint-config-airbnb-base": "^15.0.0",
    "eslint-config-prettier": "^8.4.0",
    "eslint-plugin-import": "^2.26.0",
    "eslint-plugin-jsx-a11y": "^6.5.1",
    "eslint-plugin-prettier": "^2.6.2",
    "eslint-plugin-react": "^7.30.0",
    "eslint-plugin-yml": "^0.12.0",
    "gulp": "^4.0.2",
    "gulp-babel": "^8.0.0",
    "gulp-eslint-new": "^2.3.0",
    "gulp-if": "^3.0.0",
    "gulp-postcss": "^10.0.0",
    "gulp-rename": "^2.0.0",
    "gulp-sass": "^6.0.1",
    "gulp-sass-glob": "^1.1.0",
    "gulp-sourcemaps": "^2.6.5",
    "gulp-stylelint-esm": "^3.0.0",
    "gulp-terser": "^1.4.1",
    "gulp-uglify": "^3.0.2",
    "merge-stream": "^2.0.0",
    "postcss-scss": "^4.0.6",
    "prettier": "^1.14.0",
    "raw-loader": "^4.0.2",
    "sass": "^1.89.2",
    "sass-rem": "^2.0.1",
    "stylelint": "^16.0.0",
    "stylelint-config-standard-scss": "^14.0.0",
    "stylelint-declaration-strict-value": "^1.10.11",
    "stylelint-order": "^7.0.0",
    "terser-webpack-plugin": "^5.2.0",
    "webpack": "^5.51.1",
    "yarn": "^1.22.18"
  },
  "engines": {
    "node": ">= 18.0"
  },
  "scripts": {
    "setup": "npm install && npm outdated || true",
    "nuke": "rm -r node_modules;",
    "build": "UV_THREADPOOL_SIZE=16 gulp",
    "build:dev": "gulp build:dev"
  },
  "browserslist": [
    "defaults"
  ]
}

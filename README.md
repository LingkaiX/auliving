# auliving

auliving.com.au

### How to use Parcel

- Install and initialise
  - npm install -g parcel
  - cd ./src
  - npm init -y
  - npm install node-sass
  - yarn add sass
- When developing
  - parcel watch theme.js -d ../
- When submit the fanalised files
  - parcel build theme.js -d ../
- Add Babel
  - yarn add babel-preset-env
  - Add file '.babelrc':
    {
    "presets": ["env"]
    }
- Add PostCss, etc. : https://parceljs.org/transforms.html

  **DO NOT MODIFY theme.js AND theme.css DIRECTLY**

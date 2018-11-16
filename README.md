# Gutenberg-Blocks-Boilerplate

Very simple boilerplate for writing Gutenberg Blocks within a plugin.

## Usage

1. Clone this into a folder inside `mu-plugins` or `plugins`
   - If `mu-plugin` make sure you manually load it.
1. `cd` into the directory and run `npm install && gulp build`
   - Blocks are loaded from the `build` directory, so make sure you run gulp tasks before trying to make this work.
1. Check the `sample-block` folder inside `src`.
   - Every folder inside `src` is assumed to be a block.
   - `block.js` contains the main block code, this will be transpiled to ES5.
   - `style.scss` and `editor.scss` contain the styles for frontend and editor.
1. You can use `gulp` to build and then watch all blocks.

<?php 

defined('ABSPATH') || exit;

function registerJS($ns, $blockName, $path)
{
  $name = $ns . '--' . $blockName;
  wp_register_script(
    $name,
    plugins_url($path . '/block.js', __FILE__),
    array('wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor'),
    filemtime(plugin_dir_path(__FILE__) . $path . '/block.js')
  );
  return $name;
}

function registerStyle($ns, $blockName, $path, $isEditor = false)
{
  $name = $ns . '--' . $blockName;
  $name = $isEditor ? $name . '--editor' : $name;
  $fileName = $isEditor ? 'editor.css' : 'style.css';
  $arr = $isEditor ? array('wp-edit-blocks') : array();

  wp_register_style(
    $name,
    plugins_url($path . '/' . $fileName, __FILE__),
    $arr,
    filemtime(plugin_dir_path(__FILE__) . $path . '/' . $fileName)
  );
  return $name;
}

function registerBlock($ns, $blockName, $jsName, $styleName, $editorStyleName)
{
  $id = $ns . '/' . $blockName;
  register_block_type($id, array(
    'style' => $styleName,
    'editor_style' => $editorStyleName,
    'script' => $jsName,
  ));
}

function goodfolk_blocks_register()
{
  if (!function_exists('register_block_type')) {
		// Gutenberg is not active.
    return;
  }

  $ns = explode('/', dirname(__FILE__));
  $ns = $ns[count($ns) - 1];
  $blocksRelPath = 'build';
  $dir = new DirectoryIterator(dirname(__FILE__) . '/' . $blocksRelPath);

  foreach ($dir as $fileInfo) {
    if (!$fileInfo->isDot()) {
      // the folder name becomes the block name
      $blockName = $fileInfo->getFilename();
      $jsName = registerJS($ns, $blockName, $blocksRelPath . '/' . $blockName);
      $styleName = registerStyle($ns, $blockName, $blocksRelPath . '/' . $blockName, false);
      $editorStyleName = registerStyle($ns, $blockName, $blocksRelPath . '/' . $blockName, true);
      registerBlock($ns, $blockName, $jsName, $styleName, $editorStyleName);
    }
  }

}

add_action('init', 'goodfolk_blocks_register'); 
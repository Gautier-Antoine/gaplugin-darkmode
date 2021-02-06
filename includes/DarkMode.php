<?php
/**
 * @package GAP-DarkMode
 */
namespace GAPlugin;
/**
* Class Share
* manage the social media where we can share the article in your Share ShortcodeNav
*/
class DarkMode extends AdminPage {
    const
      /**
      * @var string name of the page
      */
      PAGE = 'darkmode',
      /**
      * @var string name for the language files
      */
      LANGUAGE = 'darkmode-text',
      /**
      * @var string name for the files
      */
      FILE = 'darkmode',
      /**
      * @var string name for the plugin folder
      */
      FOLDER = 'gaplugin-darkmode';

    public static function getfolder(){
      return plugin_dir_url( __DIR__ );
    }
    /**
    * @var array names of the share social medias and urls
    */
    public static $list = [
      ['label_for' => 'test']
    ];
    public static function registerPublicScripts () {
      wp_register_style(static::FILE, static::getFolder() . 'includes/' . static::FILE . '.css');
      wp_enqueue_style(static::FILE);
      wp_register_script(static::FILE . '-js', static::getFolder() . 'includes/' . static::FILE . '.js', [], false, true);
      wp_enqueue_script(static::FILE . '-js');
      if (get_option(static::PAGE . '-test')) {
        wp_register_style(static::FILE . '-test', static::getFolder() . 'includes/' . static::FILE . '-test.css');
        wp_enqueue_style(static::FILE . '-test');
      }
    }
    public static function registerSettingsText () {
      printf(__('DarkMode is active', static::LANGUAGE) . '<br><br>');

      printf(__('Use in your %1$s :', static::LANGUAGE) . '<br>', 'CSS (Cascade Style Sheet)');
      printf(__('- for the light theme %1$s', static::LANGUAGE) . '<br>', ':root');
      printf(__('- for the dark theme %1$s', static::LANGUAGE) . '<br><br>', '[data-theme="dark"]');

      printf(__('If you click on the test button,%1$sthe %2$s of the %3$s will be affected', static::LANGUAGE) . '<br><br>'
      ,'<br>', 'color & background-color', 'body');

      echo 'Shortcode = [GAP-' . static::PAGE . ']';
    }
    public static function addPageFunction($args) {
      ?>
        <input
          type="checkbox"
          class="checkbox"
          id="<?= $args['label_for'] ?>"
          name="<?= static::PAGE . '-' . $args['class'] ?>"
          title="<?php printf(__('Checkbox for %1$s', static::LANGUAGE), $args['class']) ?>"
          <?php if (get_option(static::PAGE . '-' . $args['class'])) {echo ' checked';} ?>
        >
      <?php
    }
    public static function ShortcodeNav() {
      return '
        <div class="theme-switch-wrapper">
            <label class="theme-switch" for="checkbox">
                <input type="checkbox" id="checkbox" />
                <div class="slider round"></div>
          </label>
        </div>
      ';
      }

      /**
       * Activate plugin
       */
      public static function Activate() {
        flush_rewrite_rules();
      }
      /**
       * Deactivate plugin
       */
      public static function Deactivate() {
        flush_rewrite_rules();
      }

}

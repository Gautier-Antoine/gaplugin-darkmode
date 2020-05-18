<?php
/*
Plugin Name: DarkMode-GA
Plugin URI: https://github.com/Pepite61/gaplugin-darkmode
Description: Dark Mode for the website
Version: 0.00.01

Requires at least: 5.2
Requires PHP: 7.2

Author: GAUTIER Antoine
Author URI: gautierantoine.com
Text Domain: darkmode-text
Domain Path: /languages
License:     GPL v3
License URI: https://www.gnu.org/licenses/gpl-3.0.en.html

DarkMode-GA is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or any later version.

DarkMode-GA is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with DarkMode-GA.
If not, see https://www.gnu.org/licenses/gpl-3.0.en.html.
*/

  defined('ABSPATH') or die('You cannot enter');
  add_filter(
    'rest_authentication_errors',
    function( $result ) {
      if ( true === $result || is_wp_error( $result ) ) {
          return $result;
      }
      if ( ! is_user_logged_in() ) {
          return new WP_Error(
              'rest_not_logged_in',
              __( 'You are not currently logged in', 'darkmode-text' ),
              array( 'status' => 401 )
          );
      }
      return $result;
    }
  );
  if (!class_exists('GAPlugin\AdminPage')){
    require_once 'includes/AdminPage.php';
  }
  require_once 'includes/DarkMode.php';


  register_uninstall_hook( __FILE__, ['GAPlugin\DarkMode', 'removeOptions']);

  add_action(
    'init',
    function () {
      GAPlugin\DarkMode::register();
    }
  );

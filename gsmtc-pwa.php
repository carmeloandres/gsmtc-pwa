<?php
/**
 * @package Gsmtc-Pwa
 */

/*
Plugin Name: Gesimatica pwa
Plugin URI: https://gesimatica.com/pwa
Description: Used to provide pwa functionality.
Version: 0.1
Author: Carmelo Andrés
Author URI: https://carmeloandres.com//
License: GPLv2 or later
Text Domain: gsmtc-pwa
Domain Path: /Languages
*/

if ( ! defined( 'ABSPATH' ) ) {die;} ; // to prevent direct access

/**
 * @version 0.1 used to check version and existence of plugin
 */
if( ! defined('GSMTC_PWA_VERSION')) define( 'GSMTC_PWA_VERSION', '0.1' ); // used to check version and existence of plugin




class Gsmtc_Pwa {
    
    function activate(){
        $this->copy_sw(); // copy service worker from plugin folder to root
    }
    
    function deactivate(){

        $this->delete_sw(); // delete
        flush_rewrite_rules();

    }

    // Función para encolar los scripts en wordpress
    // es mejor hacerlo en una función aparte y no hacerlo en el constructor de la clase
    function register() {
        // encola los estilos en la administracion de wordpress
        add_action('admin_enqueue_scripts',array($this,'enqueue'));

        // encola los estilos en el frontend de wordpress
        add_action('wp_enqueue_scripts',array($this,'enqueue'));
       
    }



    function uninstall(){

    }

    function custom_post_type(){
        register_post_type( 'book',['public' => true,
                                    'label' => 'Books']); 
    }

    function enqueue(){
        // enqueue all our scripts
//        wp_enqueue_style('mypluginstyle', plugins_url('/assets/mystyle.css',__FILE__));
        wp_enqueue_script('gsmtc-pwa', plugins_url('/assets/js/gsmtc-pwa.js',__FILE__));
        error_log('Se ha ejecutado la función enqueue');

    }
    function copy_sw(){

        $path_to_root = get_home_path().'sw.js';
        $path_to_sw = plugin_dir_path( __FILE__ ) .'assets/js/sw.js';
        error_log (" las rutas son las siguientes".PHP_EOL.var_export($path_to_root,true).PHP_EOL.var_export($path_to_sw,true)); 
        copy($path_to_sw,$path_to_root);
    }

    function delete_sw(){
        $path_to_sw = plugin_dir_path( __FILE__ ) .'assets/js/sw.js';
        unlink($path_to_sw);
    }

}

//if (! class_exists ('GsmtcPwa')){

    $GsmtcPwa = new Gsmtc_PWA();
    $GsmtcPwa->register();
//}
 
// activatión

register_activation_hook(__FILE__,array($GsmtcPwa,'activate'));

// deactivation

register_deactivation_hook(__FILE__,array($GsmtcPwa,'deactivate'));
/**
 * Función para el encolado de estilos generales en el lado del cliente
 */
function abc_nutricion_assets(){
    wp_register_style( 'nutricion_css',plugin_dir_url( __FILE__ ) .'assets/css/nutricion.css', false, '1' );
    wp_enqueue_style( 'nutricion_css' );

}


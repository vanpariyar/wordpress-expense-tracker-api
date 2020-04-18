<?php 
/**
 * @Package : Expense Manager API
 * @desc : Use to register Activation and Deactivaion Hooks.
 * 
 */

require_once( WPETA_PLUGIN_DIR . 'includes/customizer.php');

/**
 * Activation Hook.
 */
function WPETA_activation_hook(){
    add_action( 'init', 'WPETA_customizer');
    /**
     * Flush Rewrite Rules after register.
     */
    flush_rewrite_rules( );
}


/**
 * Deactivation Hook.
 */
function WPETA_deactivation_hook(){
    unregister_post_type( 'expenses' );
    /**
     * Flush Rewrite Rules after register.
     */
    flush_rewrite_rules( );
    
}

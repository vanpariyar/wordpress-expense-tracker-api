<?php
function WPETA_get_expense( $type = 'total' ){
    switch( $type ) {
        case 'total':

        break;
        case 'income':
            $expenses = get_posts(array(
                'post_type' => 'expenses',
                'post_status' => 'publish'
            ));
        break;
        case 'expense':

        break;
        default:
        break;
    }
}
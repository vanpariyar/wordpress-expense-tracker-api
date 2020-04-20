<?php
function WPETA_get_expense( $type = 'total' ){
    switch( $type ) {
        case 'total':

        break;
        case 'income':
            $expenses = get_posts(array(
                'post_type' => 'expenses',
                'post_status' => 'publish',
                'numberposts' => '-1',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'expense-category',
                        'field' => 'slug',
                        'terms' => 'credit',
                        'operator' => 'IN',
                    )
                 )
            ));
            $sum = 0;
            foreach( $expenses as $key => $post ){
                $sum += intval(get_post_meta( $post->ID ,'amount', true));
            }
            // return $sum;
            return count($expenses);
            
        break;
        case 'expense':

        break;
        default:
        break;
    }
}
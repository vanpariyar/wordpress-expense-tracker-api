<?php
/**
 *  @desc Controllers For the Transactions Route
 */

 /**
  *  @method GET
  *  @desc For Route expenses/api/v1/transactions'
  */

require_once( WPETA_PLUGIN_DIR . 'api/utils/transaction_helpers.php');
  
function WPETA_get_transactions( $req ) {
    
    /**
     *  Will return Data In Array.
     */
    $request_query = get_posts( 
        array(
            'post_type' => 'expenses',
        )
    );

    if(count($request_query)){

        $data = array();

        foreach ($request_query as $key => $post) {
            $request_query[$key]->amount   = get_post_meta( $post->ID, amount, true );
            $request_query[$key]->category = ( get_the_terms( $post->ID, 'expense-category' ) )[0];
        }

        $json = array(
            'success' => true,
            'data'    => array(
                'transaction'  => $request_query,
                'Total Income' => WPETA_get_expense('income'),
            ),

        );
        $response = new WP_REST_Response($json);
        $response->set_status(200);
        return $response;
    } else {
        $json = array(
            'success' => false,
            'data'    => 'No data Found',
        );
        $response = new WP_REST_Response($json);
        $response->set_status(404);
        return $response;
    }

    
}

 /**
  *  @method POST
  *  @desc For Route expenses/api/v1/transactions'
  */
  function WPETA_add_transactions( $req ) {
    /**
     * Required Parameter We can Use For validation And also passing for Error.
     */
    $request_param = array(
        'title'    => array(
            'required' => true,
            'type'     => 'string',
        ),
        'amount'   => array(
            'required' => true,
            'type'     => 'number',
        ),
        'category_slug' => array(
            'required' => true,
            'type'     => 'string',
        ),
    );

    $expense_category = 'expense-category';

    $data = array();
    $error['message'] = false;
    foreach( $request_param as $key => $value ) {
        if( $request_param[$key]['type'] == 'string' ){
            $data[$key] = wp_trim_words($req[$key]);
        } else {
            $data[$key] = intval($req[$key]);
        }

        if( empty($data[$key]) ){
            $error['message'] = __('Error In Argument Supplied', 'WPETA');
            $json = array(
                'success' => false,
                'data'    => $error['message'],
                'schema'  => $request_param,
            );
            $response = new WP_REST_Response($json);
            $response->set_status(404);
            return $response;
        }   
    }

    $args = array(
        'post_title'            => $data['title'],
        'post_excerpt'          => '',
        'post_status'           => 'publish',
        'post_type'             => 'expenses',
    );

    if($inserted_post = wp_insert_post( $args )){
        update_post_meta( $inserted_post, 'amount', $data['amount'] );
        wp_set_post_terms( $inserted_post, [$data['category_slug']], $expense_category, false );

    } else {
        $error['message'] = __('Transaction Not Added', 'WPETA');
    }


    if( ! $error['message'] ){

        $json = array(
            'success' => true,
            'data'    => __('Transaction Added', 'WPETA'),
        );
        $response = new WP_REST_Response($json);
        $response->set_status(200);
        return $response;
    } else {
        $json = array(
            'success' => false,
            'data'    => $error['message'],
        );
        $response = new WP_REST_Response($json);
        $response->set_status(404);
        return $response;
    }
}

/**
  *  @method GET
  *  @desc For Route expenses/api/v1/transaction/id'
  */

function WPETA_get_single_transaction( $req ){
    $post = get_post( $req['id'] );
    $post->amount   = get_post_meta( $post->ID, amount, true );
    $post->category = ( get_the_terms( $post->ID, 'expense-category' ) )[0];
    if( $post ){
        $json = array(
            'success' => true,
            'data'    => $post,
        );
        $response = new WP_REST_Response($json);
        $response->set_status(200);
        return $response;
    } else {
        $json = array(
            'success' => false,
            'data'    => __('Error Getting Transaction'),
            'schema'  => array(
                'id' => array(
                    'required' => true,
                    'type'     => 'Number',
                    'example'  => '/wp-json/expenses/api/v1/transaction/345345',
                    'METHOD'   => 'GET',
                ),
            )
        );
        $response = new WP_REST_Response($json);
        $response->set_status(404);
        return $response;
    }

}

/**
  *  @method DELETE
  *  @desc For Route expenses/api/v1/transaction/id'
  */

function WPETA_delete_single_transaction( $req ){
    $post = wp_trash_post( $req['id'] );
    if( $post ){
        $json = array(
            'success' => true,
            'data'    => $post,
        );
        $response = new WP_REST_Response($json);
        $response->set_status(200);
        return $response;
    } else {
        $json = array(
            'success' => false,
            'data'    => __('Error Getting Transaction'),
            'schema'  => array(
                'id' => array(
                    'required' => true,
                    'type'     => 'Number',
                    'example'  => '/wp-json/expenses/api/v1/transaction/345345',
                    'METHOD'   => 'DELETE',
                )
            )
        );
        $response = new WP_REST_Response($json);
        $response->set_status(404);
        return $response;
    }
}
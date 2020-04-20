<?php 
/**
 *  To Get Various Catgory oF transaction
 */

/**
  *  @method GET
  *  @desc For Route expenses/api/v1/category'
  */

function WPETA_get_transaction_categories( $req ) {
    $args = array( 
        'expense-category', 
        'hide_empty' => false 
    );
    return get_terms( $args );
}

/**
  *  @method POST
  *  @desc For Route expenses/api/v1/category'
  */

function WPETA_add_transaction_category( $req ) {
    $schema = array(
        'name' => array(
            'required' => true,
            'type'     => 'string', 
        ),
        'description' => array(
            'required' => false,
            'type'     => 'string', 
        ),
        'slug' => array(
            'required' => false,
            'type'     => 'string', 
        ),
        'parent' => array(
            'required' => false,
            'type'     => 'number', 
        ),
    );

    $error = $data = array();
    
    foreach( $schema as $key => $value ) {
        if( $schema[$key]['required'] && empty($req[$key]) ) {
            $error['message'] = __('Error In Argument Supplied', 'WPETA');
            $json = array(
                'success' => false,
                'data'    => $error['message'],
                'schema'  => $schema,
            );
            $response = new WP_REST_Response($json);
            $response->set_status(404);
            return $response;
        } elseif( !empty( $req[$key] ) ) {
            if( $schema[$key]['type'] == 'string' ){
                $data[$key] = wp_trim_words($req[$key]);
            } else {
                $data[$key] = intval($req[$key]);
            }  
        }
        
    }

    if( isset($data['parent']) ){
        $flag = false;
        $args = array( 
            'expense-category', 
            'hide_empty' => false 
        );
        $terms = get_terms( $args );
        foreach( $terms as $key => $term ) {
            if( $data['parent'] == $term->term_id ){
                $flag = true;
                break;
            }
        }
        if( $flag ){
            $error['message'] = __('Parent Category Not Exist', 'WPETA');
            $json = array(
                'success' => false,
                'data'    => $error['message'],
                'schema'  => $schema,
            );
            $response = new WP_REST_Response($json);
            $response->set_status(404);
            return $response;
        }
    }
    $category_name = $data['name'];
    unset($data['name']);
    $args = $data;
    
    $inserted_term = wp_insert_term( $category_name, 'expense-category', $args );
    if( is_wp_error($inserted_term) ){
        $error['message'] = __('Category Could not Be Added', 'WPETA');
            $json = array(
                'success' => false,
                'data'    => $error['message'],
                'schema'  => $schema,
                'wp_error' => $inserted_term,
            );
            $response = new WP_REST_Response($json);
            $response->set_status(404);
            return $response;
    }

    $error['message'] = __('Category Added successfully', 'WPETA');
    $json = array(
        'success' => true,
        'data'    => $inserted_term,
    );
    $response = new WP_REST_Response($json);
    $response->set_status(200);
    return $response;

    
}

/**
  *  @method GET
  *  @desc For Route expenses/api/v1/category/<int id >'
  */

function WPETA_get_transaction_category( $req ){
    $schema = array(
        'id' => array( 
           'type'  => 'number',
           'required' => true, 
           'route' => 'expenses/api/v1/category/<int id >',
        )
    );

    $data = $error = array();
    /**
     *  Default Function To check argument Insted of typing each
     */
    foreach( $schema as $key => $value ) {
        if( $schema[$key]['required'] && empty($req[$key]) ) {
            $error['message'] = __('Error In Argument Supplied', 'WPETA');
            $json = array(
                'success' => false,
                'data'    => $error['message'],
                'schema'  => $schema,
            );
            $response = new WP_REST_Response($json);
            $response->set_status(404);
            return $response;
        } elseif( !empty( $req[$key] ) ) {
            if( $schema[$key]['type'] == 'string' ){
                $data[$key] = wp_trim_words($req[$key]);
            } else {
                $data[$key] = intval($req[$key]);
            }  
        }


        
    }

    $term = get_term_by( 'id', $data['id'], 'expense-category' );

    if( ! $term ){
        $error['message'] = __('Category not Found', 'WPETA');
            $json = array(
                'success' => false,
                'data'    => $error['message'],
                'schema'  => $schema,
            );
            $response = new WP_REST_Response($json);
            $response->set_status(404);
            return $response;
    }

    $error['message'] = __('Category Added successfully', 'WPETA');
    $json = array(
        'success' => true,
        'data'    => $term,
    );
    $response = new WP_REST_Response($json);
    $response->set_status(200);
    return $response;
}

/**
  *  @method DELETE
  *  @desc For Route expenses/api/v1/category/<int id >'
  */

function WPETA_delete_transaction_category( $req ){

}


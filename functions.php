<?php

// Añadir un meta al crear el pedido durante el proceso de checkout
add_action( 'woocommerce_checkout_create_order', 'codigoverso_add_new_order_meta' );

function codigoverso_add_new_order_meta( $order ) {
    $meta_key = '_custom_meta'; 
    //Recogemos el valor del campo personalizado el cual nos viene del formulario de checkout
    $meta_value = $_POST['custom_meta']; 

    // Añadir el meta al pedido
    $order->update_meta_data( $meta_key, $meta_value );
}

// Añadir el campo personalizado al formulario de checkout
add_filter('woocommerce_checkout_fields', 'codigoverso_add_fild_in_checkout_form', 10, 1);

function codigoverso_add_fild_in_checkout_form($fields) {
    
    // Añadimos el campo personalizado, donde pone shipping ponemos billing si queremos que sea en la dirección de facturación
    $fields['shipping']['custom_meta'] = array(
        'type'        => 'text',
        'class'       => array('form-row-wide'),
        'label'       => __('Custom meta', XANA_B2B_THEME_TEXT_DOMAIN),
        'placeholder' => __('Add custom meta', XANA_B2B_THEME_TEXT_DOMAIN),
        'required'    => true, // Si queremos que sea obligatorio
        'priority'    => 40, // Prioridad del campo, nos sirve para ordenar los campos
        'default'     => '' // Valor por defecto
    );

    return $fields;

}

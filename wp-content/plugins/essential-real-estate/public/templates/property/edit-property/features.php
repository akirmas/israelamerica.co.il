<?php
/**
 * Created by G5Theme.
 * User: trungpq
 * Date: 18/11/16
 * Time: 5:46 PM
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
global $property_data, $property_meta_data;
?>
<div class="property-fields-wrap">
    <?php
    $features_terms_id = array();
    $features_terms = get_the_terms( $property_data->ID, 'property-feature' );
    if ( $features_terms && ! is_wp_error( $features_terms ) ) {
        foreach( $features_terms as $feature ) {
            $features_terms_id[] = intval( $feature->term_id );
        }
    }
    $property_features = get_categories(array(
        'taxonomy'  => 'property-feature',
        'hide_empty' => 0,
        'orderby' => 'term_id',
        'order' => 'ASC'
    ));
    $parents_items=$child_items=array();
    if ($property_features) {
        foreach ($property_features as $term) {
            if (0 == $term->parent) $parents_items[] = $term;
            if ($term->parent) $child_items[] = $term;
        };
        if (is_taxonomy_hierarchical('property-feature') && count($child_items)>0) {
            foreach ($parents_items as $parents_item) {
                echo '<div class="ere-heading-style2 property-fields-title">';
                echo '<h2>' . $parents_item->name . '</h2>';
                echo '</div>';
                echo '<div class="property-fields property-feature row">';
                foreach ($child_items as $child_item) {
                    if ($child_item->parent == $parents_item->term_id) {
                        echo '<div class="col-sm-3"><div class="checkbox"><label>';
                        if ( in_array( $child_item->term_id, $features_terms_id ) ) {
                            echo '<input type="checkbox" name="property_feature[]" value="' . esc_attr($child_item->term_id) . '" checked/>';
                        }
                        else
                        {
                            echo '<input type="checkbox" name="property_feature[]" value="' . esc_attr($child_item->term_id) . '" />';
                        }
                        echo esc_html($child_item->name);
                        echo '</label></div></div>';
                    };
                };
                echo '</div>';
            };
        } else {
            echo '<div class="ere-heading-style2 property-fields-title">';
            echo '<h2>' . esc_html__( 'Property Features', 'essential-real-estate' ). '</h2>';
            echo '</div>';
            echo '<div class="property-fields property-feature row">';
            foreach ($parents_items as $parents_item) {
                echo '<div class="col-sm-3"><div class="checkbox"><label>';
                if ( in_array( $parents_item->term_id, $features_terms_id ) ) {
                    echo '<input type="checkbox" name="property_feature[]" value="' . esc_attr($parents_item->term_id) . '" checked/>';
                }
                else
                {
                    echo '<input type="checkbox" name="property_feature[]" value="' . esc_attr($parents_item->term_id) . '" />';
                }
                echo esc_html($parents_item->name);
                echo '</label></div></div>';
            };
            echo '</div>';
        };
    };
    ?>
</div>
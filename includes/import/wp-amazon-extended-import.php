<?php
$wpas_wp_memory=wc_let_to_num(WP_MEMORY_LIMIT);
if ( $wpas_wp_memory < 127108864 ) {
    echo '<div style="padding:25px;font-size:18px;background-color:#ffec64;

color:#333333;" class="notice notice-warning is-dismissible">' . sprintf( __( 'WP Memory is %s - We recommend setting WP memory to at least 128MB or more to get better service. Editing config,see : <a href="%s"  target="_blank">WP Memory Limit</a>', 'wp-amazon-shop' ), size_format( $wpas_wp_memory ), 'https://wordpress.org/support/article/editing-wp-config-php/#increasing-memory-allocated-to-php' ) . '</div>';
}
?>
<div class="wrap" id="acl-wpas-products-import">
    <div class="acl-container">
        <div class="acl-import-filter-section">
            <div class="acl-row">
                <div class="acl-col-12 text-center mb-1">
                    <label for="wpas_no_pa_import_by">
                        <?php _e('Products Import By ', 'wp-amazon-shop'); ?>
                    </label>
                    <input type="radio" name="no_pa_import_by" class="wpas_no_pa_import_by" value="search"
                           checked><?php _e('Keyword Search', 'wp-amazon-shop'); ?>
                    <input type="radio"  name="no_pa_import_by" class="wpas_no_pa_import_by"
                           value="lookup"> <?php _e('ASIN Numbers', 'wp-amazon-shop'); ?><strong style="color:orange"> Pro</strong>
                </div>
                <div class="acl-col-md-2-ex">
                    <select name="wpas_no_pa_cat" id="wpas_no_pa_cat">
                        <?php ACL_WPAS_iKits::store_categories(); ?>
                    </select>
                </div>
                <div class="acl-col-md-4">
                    <input name="wpas_no_pa_keyword" id="wpas_no_pa_keyword"
                           placeholder="<?php _e('Type Search keyword', 'wp-amazon-shop'); ?>" type="text">
                </div>
                <div class="acl-col-md-2-ex">
                    <select name="wpas_no_pa_sort" id="wpas_no_pa_sort">
                        <option value="all"><?php _e('All', 'wp-amazon-shop'); ?></option>
                        <option value="relevanceblender"><?php _e('Featured', 'wp-amazon-shop'); ?></option>
                        <option value="price-asc-rank"><?php _e('Price: Low to High', 'wp-amazon-shop'); ?></option>
                        <option value="price-desc-rank"><?php _e('Price: High to Low', 'wp-amazon-shop'); ?></option>
                        <option value="review-rank"><?php _e('Avg. Customer Review', 'wp-amazon-shop'); ?></option>
                        <option value="date-desc-rank"><?php _e('Newest Arrivals', 'wp-amazon-shop'); ?></option>
                    </select>
                </div>
                <div class="acl-col-md-2-ex">
                    <input type="hidden" id="wpas-search-string">
                    <button id="wpas_no_pa_import_submit"
                            class="button button-primary"><?php _e('Search for product', 'wp-amazon-shop'); ?> </button>
                </div>
            </div>
            <!--acl-row-->
        </div>
        <!-- acl-add-all-products-section-->

        <div class="wpas-no-aws-import-products-section">
            <div class="acl-row wpas-no-pa-add-all-container pb-3 pt-3">
                <div>
                    <input name="wpas_add_all_to_queue" id="wpas_add_all_to_queue" type="checkbox">
                    <label for="wpas_add_all_to_queue"><?php _e('Add all Products to Import Queue', 'wp-amazon-shop'); ?></label>
                </div>
            </div>
            <div class="acl-row wpas-no-aws-import-products-row">
            </div>
            <!--acl-row-->
        </div>
        <div class="acl-pagination-section">
            <div class="acl-row">
                <div>
                    <ul class="acl-product-import-pagination">
                    </ul>
                </div>
            </div>
            <!--acl-row-->
        </div>
        <!-- acl-pagination-section-->

        <!--wpas-no-aws-import-products-section-->
        <div class="wpas-no-aws-import-products-queue-section">
            <div class="acl-row section-heading">
                <div class="acl-col-md-12">
                    <h3><?php _e('Selected Product List', 'wp-amazon-shop'); ?> : <strong id="import-selected-products">0</strong>
                    </h3>
                </div>
                <!--acl-col-md-12-->
            </div>
            <!--acl-row-->
            <div class="acl-row pb-3 pt-3">
                <div>
                    <input name="wpas_remove_all_from_queue" id="wpas_remove_all_from_queue" type="checkbox">
                    <label for="wpas_remove_all_from_queue"><?php _e('Clear all products from Import Queue', 'wp-amazon-shop'); ?></label>
                </div>
            </div>
            <!--acl-row-->
            <div class="acl-row" id="wpas-no-pa-queue-box-container">

            </div>
            <!--acl-row-->
            <div class="acl-row acl-row-bg-color">
                <div class="acl-col-md-8">
                    <input type="checkbox" id="wpas_import_link_woo_cat" name="wpas_import_link_woo_cat"
                           value="1"/>
                    <label for="wpas_import_link_woo_cat">
                        <?php _e('Enable to import product to existing category otherwise product will be inserted to amazon store given category', 'wp-amazon-shop'); ?>
                    </label>
                </div>
                <div class="acl-col-md-4">

                    <?php
                    $taxonomy = 'product_cat';
                    $orderby = 'name';
                    $show_count = 0;      // 1 for yes, 0 for no
                    $pad_counts = 0;      // 1 for yes, 0 for no
                    $hierarchical = 1;      // 1 for yes, 0 for no
                    $empty = 0;

                    $args = array(
                        'taxonomy' => $taxonomy,
                        'orderby' => $orderby,
                        'show_count' => $show_count,
                        'pad_counts' => $pad_counts,
                        'hierarchical' => $hierarchical,
                        'hide_empty' => $empty
                    );
                    $wpas_woo_categories = get_categories($args);
                    ?>
                    <select name="wpas_woo_category" id="wpas_woo_category" class="wpas_woo_category">
                        <?php
                        if (!empty($wpas_woo_categories)) {
                            foreach ($wpas_woo_categories as $category) {
                                echo '<option value="' . $category->name . '">' . $category->name . '</option>';
                            }
                        }
                        ?>
                    </select>
                    <label for="wpas_woo_category">
                        <?php _e('Shop Category', 'wp-amazon-shop'); ?>
                    </label>
                </div>
                <div class="acl-col-md-12">
                    <p class="acl-highlight-message">  <?php _e('For more configuration, go to ', 'wp-amazon-shop') ?><a
                                href="<?php echo get_admin_url(); ?>admin.php?page=wp-amazon-shop&tab=wpas_import"><?php _e('Products Impoort Settings.', 'wp-amazon-shop') ?></a>
                    </p>
                </div>
            </div>
            <!--acl-row-->
            <div class="acl-row">
                <div class="acl-col-md-12">
                    <button id="wpas-no-pa-import-button" type="button"
                            class="acl-import-button"><?php _e('Import Product', 'wp-amazon-shop') ?> </button>
                </div>
                <!--acl-col-md-12-->
            </div>
            <!--acl-row-->
        </div>
        <!-- wpas-no-aws-import-products-queue-section-->

        <div class="wpas-no-aws-import-products-log-section">
            <div class="acl-row section-heading">
                <div class="acl-col-md-12">
                    <h3><?php _e('Import Log', 'wp-amazon-shop') ?></h3>
                </div>
                <!--acl-col-md-12-->
            </div>
            <!--acl-row-->
            <div class="acl-row">
                <div class="acl-col-md-4">
                    <ul class="product-log-list">
                        <li>
                        </li>
                    </ul>
                </div>
                <!--acl-col-md-4-->
                <div class="acl-col-md-8">
                    <ul class="product-log-message">

                    </ul>
                </div>
                <!--acl-col-md-8-->
            </div>
            <!--acl-row-->
        </div>
        <!-- wpas-no-aws-import-products-queue-section-->
    </div>
    <!--acl-container-->


    <div id="backTop">

    </div>
    <input type="hidden" id="wpas-ext-values">
</div>
<!--acl_wpas_products_import-->

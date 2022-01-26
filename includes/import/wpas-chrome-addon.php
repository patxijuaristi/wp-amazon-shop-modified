<style>
    .wpas-info-page-container, .wpas-support-container {
        padding-left: 20px;
    }

    .wpas-info-page-headline {
        border-bottom: 1px dashed #cccccc;
        margin: 0 0 10px;
        padding: 10px 0;
    }
</style>
<div class="wrap">

    <div id="poststuff">

        <div id="post-body" class="metabox-holder columns-2">

            <div id="post-body-content" style="position: relative;">
                <div class="wpas-info-page-container">
                    <h2 class="wpas-info-page-headline"><?php _e('WP Amazon Shop : Chrome Extension Authorization ', 'wp-amazon-shop'); ?></h2>
                    <p><?php _e('Since Amazon does not give access to Product Advertising API (PA API) for beginner & impose limitation on who has PA API. See more at ', 'wp-amazon-shop'); ?>
                        <a href="https://docs.aws.amazon.com/AWSECommerceService/latest/DG/TroubleshootingApplications.html#efficiency-guidelines" target="_blank"> <?php _e('Amazon Efficiency Guidelines Docs', 'wp-amazon-shop'); ?></a> </p>
                    <p><?php _e('We have introduce WP Amazon Shop Plugin with charm feature with Chrome Extension that help to import unlimited Products without AWS & PA API.', 'wp-amazon-shop'); ?>
                    </p>

                    <p><strong><?php _e('Follow the ', 'wp-amazon-shop'); ?> </strong> <a href="https://amadercode.com/product-import-docs/" target="_blank"><?php _e('Product Importing Guidelines', 'wp-amazon-shop'); ?> </a> <?php _e('& Enjoy it!', 'wp-amazon-shop'); ?></p>

                    <div class="wpas-ext-auth-container">
                        <form class="wpas-ext-auth-form">
                            <div class="wpas-ext-auth-form-body pb-3">
                                <label for="auth_token"><?php _e('Authentication Token', 'wp-amazon-shop'); ?>
                                    : </label>
                                <input type="text" style="width:350px" name="auth_token" id="auth_token"
                                       value="<?php echo(get_option('acl_wpas_chrome_ext_auth') ? get_option('acl_wpas_chrome_ext_auth') : '') ?>"
                                       placeholder="XaDOQR9YPEL5BMVkDdNjhYKz2K7hAlqZmcxpTmh" required>
                                <button type="button" id="auth-token-generator" class="button button-primary">
                                    <?php
                                    if (get_option('acl_wpas_chrome_ext_auth')) {
                                        _e('Re-Generate Token', 'wp-amazon-shop');
                                    } else {
                                        _e('Generate Token', 'wp-amazon-shop');
                                    }
                                    ?>
                                </button>
                            </div>
                            <div class="wpas-ext-auth-form-btn-container">
                                <input type="button" class="button-primary" id="wpas-ext-auth-form-submit-btn"
                                       value="Save">
                            </div>
                        </form>
                    </div>
                    <!--wpas-ext-auth-container-->

                </div>


            </div>
            <!-- /post-body-content -->
        </div>
        <!-- /post-body-->

    </div>
    <!-- /poststuff -->

</div>
<!-- /wrap -->
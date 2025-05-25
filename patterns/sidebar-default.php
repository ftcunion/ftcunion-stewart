<?php

/**
 * Title: Sidebar
 * Slug: ftcunion-stewart/sidebar-default
 * Categories: sidebar
 */
?>

<!-- wp:group -->
<div class="wp-block-group">
    <!-- wp:group {"className":"mobile-flex","layout":{"type":"default"}} -->
    <div class="wp-block-group mobile-flex">
        <!-- wp:html -->
        <div class="mobile-hide">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 300 300" width=120 height=120>
                <use href="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/images/site-title-svgo.svg#seal" xlink:href="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/images/site-title-svgo.svg#seal" fill="#1d3557" />
            </svg>
        </div>
        <!-- /wp:html -->

        <!-- wp:site-logo {"width":90,"className":"is-style-rounded mobile-hide"} /-->

        <!-- wp:site-title {"level":0} /-->

        <!-- wp:site-tagline {"className":"mobile-hide"} /-->

        <!-- wp:separator {"opacity":"css","className":"has-text-color alignwide is-style-wide mobile-hide"} -->
        <hr class="wp-block-separator has-css-opacity has-text-color alignwide is-style-wide mobile-hide" />
        <!-- /wp:separator -->

        <!-- wp:navigation {"layout":{"type":"flex","setCascadingProperties":true,"justifyContent":"left","orientation":"vertical"},"style":{"spacing":{"blockGap":"0px"}},"icon":"menu","overlayBackgroundColor":"background","overlayTextColor":"foreground"} /-->
    </div>
    <!-- /wp:group -->

    <!-- wp:separator {"opacity":"css","className":"has-text-color alignwide is-style-wide"} -->
    <hr class="wp-block-separator has-css-opacity has-text-color alignwide is-style-wide" />
    <!-- /wp:separator -->

    <!-- wp:social-links {"iconColor":"foreground","iconColorValue":"var:preset|color|foreground","className":"items-justified-left is-style-logos-only"} -->
    <ul class="wp-block-social-links has-icon-color items-justified-left is-style-logos-only">
        <!-- wp:social-link {"url":"#","service":"linkedin"} /-->

        <!-- wp:social-link {"url":"#","service":"facebook"} /-->

        <!-- wp:social-link {"url":"#","service":"github"} /-->

        <!-- wp:social-link {"url":"#","service":"mail"} /-->
    </ul>
    <!-- /wp:social-links -->
</div>
<!-- /wp:group -->

<!-- wp:spacer {"height":30} -->
<div style="height:30px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->
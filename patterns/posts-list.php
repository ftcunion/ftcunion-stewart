<?php

/**
 * Title: Post list
 * Slug: ftcunion-stewart/posts-list
 * Categories: query
 * Block Types: query
 */
?>

<!-- wp:query {"queryId":3,"query":{"perPage":10,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"displayLayout":{"type":"list","columns":2},"layout":{"inherit":false}} -->
<div class="wp-block-query">
    <!-- wp:post-template -->
    <!-- wp:separator {"opacity":"css","className":"is-style-wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}}}} -->
    <hr class="wp-block-separator has-css-opacity is-style-wide"
        style="margin-top:var(--wp--preset--spacing--30);margin-bottom:var(--wp--preset--spacing--30)" />
    <!-- /wp:separator -->

    <!-- wp:columns {"align":"wide","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
    <div class="wp-block-columns alignwide" style="margin-top:0;margin-bottom:0">
        <!-- wp:column {"verticalAlignment":"center","width":"72%"} -->
        <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:72%">
            <!-- wp:post-title {"isLink":true,"fontSize":"extra-large"} /-->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"verticalAlignment":"center","width":"28%","className":"mobile-hide"} -->
        <div class="wp-block-column is-vertically-aligned-center mobile-hide" style="flex-basis:28%">
            <!-- wp:post-date {"format":"M j, Y"} /-->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
    <!-- wp:post-excerpt {"excerptLength":30} /-->
    <!-- /wp:post-template -->

    <!-- wp:separator {"opacity":"css","className":"is-style-wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}}}} -->
    <hr class="wp-block-separator has-css-opacity is-style-wide"
        style="margin-top:var(--wp--preset--spacing--30);margin-bottom:var(--wp--preset--spacing--30)" />
    <!-- /wp:separator -->

    <!-- wp:spacer {"height":"60px"} -->
    <div style="height:60px" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->

    <!-- wp:query-pagination -->
    <div class="wp-block-query-pagination">
        <!-- wp:query-pagination-previous /-->

        <!-- wp:query-pagination-numbers /-->

        <!-- wp:query-pagination-next /-->
    </div>
    <!-- /wp:query-pagination -->

</div>
<!-- /wp:query -->
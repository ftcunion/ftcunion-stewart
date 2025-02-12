<?php

/**
 * Title: Post list without excerpt or featured image
 * Slug: ftcunion-stewart/posts-list-noexcerpt
 * Categories: query, posts
 * Block Types: core/query
 */
?>

<!-- wp:query {"queryId":14,"query":{"perPage":10,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"align":"wide","layout":{"type":"default"}} -->
<div class="wp-block-query alignwide">
    <!-- wp:post-template -->
    <!-- wp:separator {"opacity":"css","className":"has-text-color alignwide is-style-wide"} -->
    <hr class="wp-block-separator has-css-opacity has-text-color alignwide is-style-wide" />
    <!-- /wp:separator -->

    <!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
    <div class="wp-block-columns alignwide are-vertically-aligned-center" style="margin-top:0;margin-bottom:0">
        <!-- wp:column {"verticalAlignment":"center","width":"72%"} -->
        <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:72%">
            <!-- wp:post-title {"isLink":true,"style":{"typography":{"lineHeight":"1.2"}},"fontSize":"extra-large"} /-->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"verticalAlignment":"center","width":"28%","className":"mobile-hide"} -->
        <div class="wp-block-column is-vertically-aligned-center mobile-hide" style="flex-basis:28%">
            <!-- wp:post-date {"format":"M j, Y","isLink":true} /-->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
    <!-- /wp:post-template -->

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
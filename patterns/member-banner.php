<?php
/**
 * Title: Member-only banner
 * Slug: ftcunion-stewart/member-banner
 * Categories: header
 * Block Types: core/template-part/header
 */
?>

<!-- wp:group {"className":"ftcunion-member-banner","layout":{"type":"default"}} -->
<div class="wp-block-group ftcunion-member-banner">
	<!-- wp:paragraph {"align":"center","style":{"spacing":{"padding":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|20","left":"var:preset|spacing|30","right":"var:preset|spacing|30"}}},"backgroundColor":"foreground","textColor":"background"} -->
	<p class="has-text-align-center has-background-color has-foreground-background-color has-text-color has-background"
		style="padding-top:var(--wp--preset--spacing--20);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--20);padding-left:var(--wp--preset--spacing--30)">
		<strong>Member-only resource: Do not share!</strong>
	</p>
	<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
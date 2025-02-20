<?php

// Disable Cloudflare Cache on nocache_headers
add_filter('nocache_headers', function ($headers) {
    return [
        'cdn-cache-control' =>  $headers['cache-control'] ?? 'no-cache, must-revalidate, max-age=0'
    ] + $headers;
});

// Set CDN-Cache-Control header same as Cache-Control if defined or default to 4h (+1Y stale-while-revalidate)
add_filter('wp_headers', function ($headers) {
    return [
        'cdn-cache-control' =>  $headers['cache-control'] ?? 'max-age=14400, stale-while-revalidate=31536000'
    ] + $headers;
});

/**
 * This function will connect wp_mail to your authenticated
 * SMTP server. This improves reliability of wp_mail, and 
 * avoids many potential problems.
 *
 * For instructions on the use of this script, see:
 * https://butlerblog.com/easy-smtp-email-wordpress-wp_mail/
 * 
 * Values for constants are set in wp-config.php
 */
add_action('phpmailer_init', 'send_smtp_email');
function send_smtp_email($phpmailer)
{
    $phpmailer->isSMTP();
    $phpmailer->Host       = SMTP_HOST;
    $phpmailer->SMTPAuth   = SMTP_AUTH;
    $phpmailer->Port       = SMTP_PORT;
    $phpmailer->Username   = SMTP_USER;
    $phpmailer->Password   = SMTP_PASS;
    $phpmailer->SMTPSecure = SMTP_SECURE;
    $phpmailer->From       = SMTP_FROM;
    $phpmailer->FromName   = SMTP_NAME;
}

/****************************************
 * The below are snippets from WPCode
 ****************************************/
/**
 * Allow SVG uploads for administrator users.
 *
 * @param array $upload_mimes Allowed mime types.
 *
 * @return mixed
 */
add_filter(
    'upload_mimes',
    function ($upload_mimes) {
        // By default, only administrator users are allowed to add SVGs.
        // To enable more user types edit or comment the lines below but beware of
        // the security risks if you allow any user to upload SVG files.
        if (!current_user_can('administrator')) {
            return $upload_mimes;
        }

        $upload_mimes['svg']  = 'image/svg+xml';
        $upload_mimes['svgz'] = 'image/svg+xml';

        return $upload_mimes;
    }
);

/**
 * Add SVG files mime check.
 *
 * @param array        $wp_check_filetype_and_ext Values for the extension, mime type, and corrected filename.
 * @param string       $file Full path to the file.
 * @param string       $filename The name of the file (may differ from $file due to $file being in a tmp directory).
 * @param string[]     $mimes Array of mime types keyed by their file extension regex.
 * @param string|false $real_mime The actual mime type or false if the type cannot be determined.
 */
add_filter(
    'wp_check_filetype_and_ext',
    function ($wp_check_filetype_and_ext, $file, $filename, $mimes, $real_mime) {

        if (!$wp_check_filetype_and_ext['type']) {

            $check_filetype  = wp_check_filetype($filename, $mimes);
            $ext             = $check_filetype['ext'];
            $type            = $check_filetype['type'];
            $proper_filename = $filename;

            if ($type && 0 === strpos($type, 'image/') && 'svg' !== $ext) {
                $ext  = false;
                $type = false;
            }

            $wp_check_filetype_and_ext = compact('ext', 'type', 'proper_filename');
        }

        return $wp_check_filetype_and_ext;
    },
    10,
    5
);

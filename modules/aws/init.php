<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Determines which Cerificate Authority file to use.
 *
 * A value of boolean `false` will use the Certificate Authority file available on the system. A value of
 * boolean `true` will use the Certificate Authority provided by the SDK. Passing a file system path to a
 * Certificate Authority file (chmodded to `0755`) will use that.
 *
 * Leave this set to `false` if you're not sure.
 */
define('AWS_CERTIFICATE_AUTHORITY', true);

/**
 * Set the value to true to enable autoloading for classes not prefixed with "Amazon" or "CF". If enabled,
 * load `sdk.class.php` last to avoid clobbering any other autoloaders.
 */
define('AWS_ENABLE_EXTENSIONS', 'false');


/**
 * For documentation, refer to http://docs.amazonwebservices.com/AWSSDKforPHP/latest/
 */
include_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'library/sdk.class.php';

KoAS3::$config = Kohana::config('amazons3');
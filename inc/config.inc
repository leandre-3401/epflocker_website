<?php
/* config.inc Configuration for oAuth Demo project
 *
 * Katy Nicholson, last updated 17/11/2021
 *
 * https://github.com/CoasterKaty
 * https://katytech.blog/
 * https://twitter.com/coaster_katy
 *
 

***RENAME TO config.inc ***

*/
// MySQL connection details
define('_MYSQL_HOST', 'localhost');
define('_MYSQL_USER', 'epflocker');
define('_MYSQL_DB', 'epflocker_db');
define('_MYSQL_PASS', '3pfl0ck3r');


// oAuth details



// TENANTID: Your tenant's ID if you set up the app reg as single tenant, otherwise 'common'

//Scope needs to include the services you wish to access - at a minimum you'll need openid and offline_access for logging on to work. Add in user.read if you want to query user profile via Graph. Separate with %20.

define('_OAUTH_TENANTID', '07c72520-e645-4679-8f55-dc611c975a02');
define('_OAUTH_CLIENTID', '8d177efc-74a0-4bce-bc5c-04eb01347c68');
define('_OAUTH_LOGOUT', 'https://login.microsoftonline.com/common/wsfederation?wa=wsignout1.0');
define('_OAUTH_SCOPE', 'openid%20offline_access%20profile%20user.read');
// Define either the client secret, or the client certificate details
// method = 'certificate' or 'secret'
define('_OAUTH_METHOD', 'secret');
define('_OAUTH_SECRET', 'cB_8Q~GfugmrTSHeqdD5aQcT7nDgofYXV34dgbZN');
// on Windows, the certificate paths should be in the form c:/path/to/cert.crt


// URL to this website, no trailing slash.
define('_URL', 'https://epflocker.mde.epf.fr');
?>


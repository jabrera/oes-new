<?php

/**
 * If true, errors and notice will popup to
 * debug your website
 */
define("DEVELOPMENT_ENVIRONMENT", true);

/**
 * This will be your default controller without
 * the word 'Controller'
 */
define("DEFAULT_CONTROLLER", "o");

/**
 * This will be your default action for every
 * controller. Make sure you have this function
 * in every controller to avoid errors.
 */
define("DEFAULT_ACTION", "index");

/**
 * The primary color of your website
 */
define("PRIMARY_COLOR", "#005cb9");

/**
 * User for database
 */
define("DB_USER", "root");

/**
 * Password for database
 */
define("DB_PASS", "");

/**
 * Host name for database
 */
define("DB_HOST", "localhost");

/**
 * Database name
 */
define("DB_NAME", "oslomvc");

/**
 * Database Engine.
 * mysql | sqlsrv
 */
define("DB_ENGINE", "mysql");

/**
 * The default layout to use in every page.
 * Make sure you have this layout with a
 * .phtml extension in Views/shared/
 */
define("DEFAULT_LAYOUT", "_layout");

/**
 * Default page title for your site. You
 * may change this in your controller
 */
define("PAGETITLE", "Oslo Framework");

/**
 * Unique session prefix
 */
define("SESSION_PREFIX", "oes_");

/**
 * URL of the website
 */
define("SITE_URL", "");

/**
 * General Name of the website
 */
define("SITE_NAME", "Online Enrollment System DLSUD");

/**
 * Image to be displayed when shared in social media
 */
define("SITE_IMG", "");

/**
 * Twitter account of the website
 *
 * Eg.
 * @juvar_a
 */
define("SITE_TWITTER", "");

define("COPYRIGHT", "&copy ".date("Y")." Online Enrolment System DLSUD - Oslo Framework");
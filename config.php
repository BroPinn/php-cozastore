<?php

// Base paths
define('ROOT_DIR', __DIR__);
define('PUBLIC_DIR', ROOT_DIR . '/public');

// Application paths
define('CONTROLLERS_DIR', ROOT_DIR . '/controllers');
define('MODELS_DIR', ROOT_DIR . '/models');
define('VIEWS_DIR', ROOT_DIR . '/views');
define('ROUTE_DIR', ROOT_DIR . '/route');

// Client and Admin specific paths
define('CLIENT_CONTROLLERS_DIR', CONTROLLERS_DIR . '/client');
define('ADMIN_CONTROLLERS_DIR', CONTROLLERS_DIR . '/admin');
define('CLIENT_VIEWS_DIR', VIEWS_DIR . '/client');
define('ADMIN_VIEWS_DIR', VIEWS_DIR . '/admin');

// Asset paths
define('ASSET_DIR', PUBLIC_DIR . '/asset');
define('IMAGES_DIR', ASSET_DIR . '/images');
define('JS_DIR', ASSET_DIR . '/js');
define('VENDOR_DIR', ASSET_DIR . '/vendor');

// Auth paths
define('AUTH_DIR', ROOT_DIR . '/auth');
define('ADMIN_AUTH_DIR', AUTH_DIR . '/admin');
define('CLIENT_AUTH_DIR', AUTH_DIR . '/client');

// Upload paths
define('UPLOADS_DIR', ROOT_DIR . '/uploads');
define('PRODUCT_UPLOADS_DIR', UPLOADS_DIR . '/images');
define('SLIDER_UPLOADS_DIR', UPLOADS_DIR . '/slider');
define('PRODUCT_UPLOADS_URL', 'uploads/images');
define('SLIDER_UPLOADS_URL', 'uploads/slider');
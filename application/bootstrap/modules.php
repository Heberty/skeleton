<?php

/**
 * Enable modules. Modules are referenced by a relative or absolute path.
 */
return [
	// Mix modules
	'base' => MODPATH . 'base', // Common classes
	'admin' => MODPATH . 'admin', // Admin panel (admix)
	'users' => MODPATH . 'users', // Simple ACL
    'configuracoes' => MODPATH . 'configuracoes', // Admin configurations
    'migrations' => MODPATH . 'migrations',
    'logger' => MODPATH . 'logger',
    'pages' => MODPATH . 'pages',
    'sitemaps' => MODPATH . 'sitemaps',
    'contacts' => MODPATH . 'contacts',

    // Local modules
    'fotos' => MODPATH . 'fotos',
	// ...
];

<?php return array(
    'root' => array(
        'name' => 'lcc/lead-capture-crm-lite',
        'pretty_version' => 'dev-master',
        'version' => 'dev-master',
        'reference' => 'd97f64e7ec7e2bd1423536f399f8abb67273bb98',
        'type' => 'wordpress-plugin',
        'install_path' => __DIR__ . '/../../',
        'aliases' => array(),
        'dev' => true,
    ),
    'versions' => array(
        'composer/installers' => array(
            'pretty_version' => 'v1.12.0',
            'version' => '1.12.0.0',
            'reference' => 'd20a64ed3c94748397ff5973488761b22f6d3f19',
            'type' => 'composer-plugin',
            'install_path' => __DIR__ . '/./installers',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'lcc/lead-capture-crm-lite' => array(
            'pretty_version' => 'dev-master',
            'version' => 'dev-master',
            'reference' => 'd97f64e7ec7e2bd1423536f399f8abb67273bb98',
            'type' => 'wordpress-plugin',
            'install_path' => __DIR__ . '/../../',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'roundcube/plugin-installer' => array(
            'dev_requirement' => false,
            'replaced' => array(
                0 => '*',
            ),
        ),
        'shama/baton' => array(
            'dev_requirement' => false,
            'replaced' => array(
                0 => '*',
            ),
        ),
        'wpackagist-plugin/advanced-custom-fields' => array(
            'pretty_version' => '5.12.6',
            'version' => '5.12.6.0',
            'reference' => 'tags/5.12.6',
            'type' => 'wordpress-plugin',
            'install_path' => __DIR__ . '/../../wp-content/plugins/advanced-custom-fields',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
    ),
);

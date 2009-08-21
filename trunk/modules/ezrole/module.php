<?php

$Module = array( 'name' => 'ezrole',
                 'variable_params' => false,
                 'ui_component_match' => 'module' );

$ViewList = array();

$ViewList['action'] = array( 'script' => 'action.php',
                             'ui_context' => 'navigation' );

$ViewList['export'] = array( 'script' => 'export.php',
                             'ui_context' => 'navigation' );

$ViewList['import'] = array( 'script' => 'import.php',
                             'ui_context' => 'navigation' );

?>

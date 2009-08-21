<?php

$http = eZHTTPTool::instance();


if ( $http->hasPostVariable( 'ImportRoleButton' ) )
{
    $module = eZModule::findModule( 'ezrole' );
    $module->redirectToView( 'import' );
    $redirectToView = $module->redirectURI();
    eZURI::transformURI( $redirectToView );
    eZHTTPTool::redirect( $redirectToView );
}
elseif ( $http->hasPostVariable( 'ExportRoleButton' ) )
{
    $module = eZModule::findModule( 'ezrole' );
    $module->redirectToView( 'export' );
    $redirectToView = $module->redirectURI();
    eZURI::transformURI( $redirectToView );
    eZHTTPTool::redirect( $redirectToView );
}

?>

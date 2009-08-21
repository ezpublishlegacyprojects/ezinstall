<?php

$http = eZHTTPTool::instance();
$importRole = false;

if( $http->hasPostVariable( 'ImportRoleButton' ) )
{
    $importFile =  eZHTTPFile::fetch( 'roleImportFile' );

    if( !is_null( $importFile ) )
    {
        $importFileName = $importFile->attribute( 'filename' );
        $importRoleContent = Spyc::YAMLLoad( $importFileName );
        $siteInstall = new eZSiteInstaller();
        $siteInstall->updateRoles( array( 'roles' => $importRoleContent ) );
        $importRole = true;
    }
}
elseif( $http->hasPostVariable( 'RedirectRoleList' ) )
{
    $module = eZModule::findModule( 'role' );
    $module->redirectToView( 'list' );
    $redirectToView = $module->redirectURI();
    eZURI::transformURI( $redirectToView );
    eZHTTPTool::redirect( $redirectToView );
}

require_once( 'kernel/common/template.php' );
$tpl = templateInit();

$tpl->setVariable( 'role_import', $importRole );

$Result = array();

$Result['path'] = array( array( 'url' => 'role/list',
                                'text' => ezi18n( 'kernel/role', 'Role list' ) ),
                        array( 'url' => 'ezrole/export',
                                'text' => ezi18n( 'ezrole', 'Import a role' ) )
                        );

$Result['content'] = $tpl->fetch( 'design:ezrole/import.tpl' );

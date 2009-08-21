<?php

$http = eZHTTPTool::instance();

if( $http->hasPostVariable( 'ExportIDArray' ) )
{
    $exportRoles = array();
    foreach( $http->postVariable( 'ExportIDArray' ) as $roleID )
    {
        $roleObject = eZRole::fetch( $roleID );
        $roleContent = array();
        $roleContent['name'] = $roleObject->attribute( 'name' );
        $policiesContent = array();
        foreach( $roleObject->policyList() as $policyObject )
        {
            $policyContent = array( 'module' => $policyObject->attribute( 'module_name' ),
                                    'view' => $policyObject->attribute( 'function_name' )
                                    );
            $limitationArray = array();
            foreach( $policyObject->attribute( 'limitations' ) as $limitationObject )
            {
                $limitationArray[ $limitationObject->attribute( 'identifier' ) ] = $limitationObject->allValuesAsString();
            }

            if( count( $limitationArray ) > 0 )
                $policyContent['limitations'] = $limitationArray;
            $policiesContent[] = $policyContent;
        }
        $roleContent['policies'] = $policiesContent;
        $exportRoles[] = $roleContent;

    }

    $YAMLData = Spyc::YAMLDump( $exportRoles );
    eZFile::create( 'role_export.txt', false, $YAMLData );
    eZFile::download( 'role_export.txt' );
}

$roleList = eZRole::fetchList();

require_once( 'kernel/common/template.php' );

$tpl = templateInit();

$tpl->setVariable( 'roles', $roleList );

$Result = array();

$Result['content'] = $tpl->fetch( 'design:ezrole/export.tpl' );

?>

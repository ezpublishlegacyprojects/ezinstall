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
                                    'function' => $policyObject->attribute( 'function_name' )
                                    );
            $limitationArray = array();
            foreach( $policyObject->attribute( 'limitations' ) as $limitationObject )
            {
                $limitationArray[ $limitationObject->attribute( 'identifier' ) ] = explode( ',', $limitationObject->allValuesAsString() );
            }

            if( count( $limitationArray ) > 0 )
                $policyContent['limitation'] = $limitationArray;
            $policiesContent[] = $policyContent;
        }
        $roleContent['policies'] = $policiesContent;
        $exportRoles[] = $roleContent;

    }

    $YAMLData = Spyc::YAMLDump( $exportRoles );
    $fileName = 'role_'.$roleContent['name'].'.txt';
    eZFile::create( $fileName , false, $YAMLData );
    eZFile::download( $fileName );
}

$roleList = eZRole::fetchList();

require_once( 'kernel/common/template.php' );

$tpl = templateInit();

$tpl->setVariable( 'roles', $roleList );
$tpl->setVariable( 'role_count', count( $roleList ) );

$Result = array();

$Result['path'] = array( array( 'url' => 'role/list',
                                'text' => ezi18n( 'kernel/role', 'Role list' ) ),
                        array( 'url' => 'ezrole/export',
                                'text' => ezi18n( 'ezrole', 'Export a role' ) )
                        );

$Result['content'] = $tpl->fetch( 'design:ezrole/export.tpl' );

?>

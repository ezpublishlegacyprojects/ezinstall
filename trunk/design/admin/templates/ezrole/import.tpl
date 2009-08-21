<form method="post" action={'ezrole/import'|ezurl} enctype="multipart/form-data">

<div class="context-block">
{* DESIGN: Header START *}<div class="box-header"><div class="box-tc"><div class="box-ml"><div class="box-mr"><div class="box-tl"><div class="box-tr">
<h1 class="context-title">{'Import a role'|i18n( 'ezrole')}</h1>

{* DESIGN: Mainline *}<div class="header-mainline"></div>

{* DESIGN: Header END *}</div></div></div></div></div></div>

{* DESIGN: Content START *}<div class="box-ml"><div class="box-mr"><div class="box-content">
{if $role_import}
    <p>
        {'The roles will be imported'|i18n('ezrole')}
    </p>
{else}
    <label for="role_import_file">Label</label>
    <input type="file" name="roleImportFile" />
{/if}
{* DESIGN: Content END *}</div></div></div>
<div class="controlbar">
{* DESIGN: Control bar START *}<div class="box-bc"><div class="box-ml"><div class="box-mr"><div class="box-tc"><div class="box-bl"><div class="box-br">
<div class="block">
{if $role_import}
        <input class="button" type="submit" name="RedirectRoleList" value="{'Return to the role list'|i18n( 'design/admin/role/list' )}" title="{'Return to the role list'|i18n( 'design/admin/role/list' )}" />
{else}
        <input class="button" type="submit" name="ImportRoleButton" value="{'Import Role'|i18n( 'design/admin/role/list' )}" title="{'Import a role.'|i18n( 'design/admin/role/list' )}" />
        {/if}
    </form>
</div>
{* DESIGN: Control bar END *}</div></div></div></div></div></div>
</div>

</div>

</form>

<?php
/* Smarty version 4.5.5, created on 2025-07-17 17:03:27
  from 'D:\Projects\Hosts\smart-social-modx.local\release\manager\templates\default\element\tv\renders\input\file.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_687902af8e0bb5_60111958',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f2777bc36722cd35e789c497abb556fcf925d4f7' => 
    array (
      0 => 'D:\\Projects\\Hosts\\smart-social-modx.local\\release\\manager\\templates\\default\\element\\tv\\renders\\input\\file.tpl',
      1 => 1743578432,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_687902af8e0bb5_60111958 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\Projects\\Hosts\\smart-social-modx.local\\release\\core\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.replace.php','function'=>'smarty_modifier_replace',),));
?>
<div id="tvpanel<?php echo $_smarty_tpl->tpl_vars['tv']->value->id;?>
"></div>

<?php if ($_smarty_tpl->tpl_vars['disabled']->value) {
echo '<script'; ?>
>
// <![CDATA[

Ext.onReady(function() {
    const fld = MODx.load({
    
        xtype: 'displayfield'
        ,itemId: 'tv<?php echo $_smarty_tpl->tpl_vars['tv']->value->id;?>
'
        ,tv: '<?php echo $_smarty_tpl->tpl_vars['tv']->value->id;?>
'
        ,renderTo: 'tvpanel<?php echo $_smarty_tpl->tpl_vars['tv']->value->id;?>
'
        <?php if ($_smarty_tpl->tpl_vars['tv']->value->value != '') {?>
        ,value: '<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['tv']->value->value, ENT_QUOTES, 'UTF-8', true);?>
'
        <?php }?>
        ,width: 400
        ,msgTarget: 'under'
    
    });
});

// ]]>
<?php echo '</script'; ?>
>
<?php } else {
echo '<script'; ?>
>
// <![CDATA[

Ext.onReady(function() {
    const fld = MODx.load({
    
        xtype: 'modx-panel-tv-file'
        ,renderTo: 'tvpanel<?php echo $_smarty_tpl->tpl_vars['tv']->value->id;?>
'
        ,tv: '<?php echo $_smarty_tpl->tpl_vars['tv']->value->id;?>
'
        ,itemId: 'tv<?php echo $_smarty_tpl->tpl_vars['tv']->value->id;?>
'
        <?php if ($_smarty_tpl->tpl_vars['tv']->value->value != '') {?>
        ,value: '<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['tv']->value->value, ENT_QUOTES, 'UTF-8', true);?>
'
        ,relativeValue: '<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['tv']->value->value, ENT_QUOTES, 'UTF-8', true);?>
'
        <?php }?>
        ,width: 400
        ,msgTarget: 'under'
        ,source: '<?php echo $_smarty_tpl->tpl_vars['source']->value;?>
'
        ,wctx: '<?php if ((($tmp = $_smarty_tpl->tpl_vars['params']->value['wctx'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp)) {
echo $_smarty_tpl->tpl_vars['params']->value['wctx'];
} else { ?>web<?php }?>'
        ,allowBlank: <?php if ($_smarty_tpl->tpl_vars['params']->value['allowBlank'] == 1 || $_smarty_tpl->tpl_vars['params']->value['allowBlank'] == 'true') {?>true<?php } else { ?>false<?php }?>
        <?php if ($_smarty_tpl->tpl_vars['params']->value['allowedFileTypes']) {?>,allowedFileTypes: '<?php echo $_smarty_tpl->tpl_vars['params']->value['allowedFileTypes'];?>
'<?php }?>
        <?php if ((($tmp = $_smarty_tpl->tpl_vars['params']->value['openTo'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp)) {?>,openTo: '<?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['params']->value['openTo'],"'","\\'");?>
'<?php }?>
    
        ,listeners: {
            select: {
                fn: MODx.fireResourceFormChange,
                scope: this
            }
        }
        ,validate: function() {
            return Ext.getCmp('tvbrowser<?php echo $_smarty_tpl->tpl_vars['tv']->value->id;?>
').validate();
        }
    });
    MODx.makeDroppable(Ext.get('tvpanel<?php echo $_smarty_tpl->tpl_vars['tv']->value->id;?>
'), function(v) {
        const cb = Ext.getCmp('tvbrowser<?php echo $_smarty_tpl->tpl_vars['tv']->value->id;?>
');
        if (cb) {
            cb.setValue(v);
            cb.fireEvent('select', {relativeUrl: v});
        }
        return '';
    });
    Ext.getCmp('modx-panel-resource').getForm().add(fld);
});

// ]]>
<?php echo '</script'; ?>
>
<?php }
}
}

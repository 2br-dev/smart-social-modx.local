<?php
/* Smarty version 4.5.5, created on 2025-07-17 16:37:15
  from 'D:\Projects\Hosts\smart-social-modx.local\release\manager\templates\default\element\tv\renders\input\listbox-single.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_6878fc8b53b099_23429019',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a1be8fd6af893a68c1974ac8ea95dc19b5ba092c' => 
    array (
      0 => 'D:\\Projects\\Hosts\\smart-social-modx.local\\release\\manager\\templates\\default\\element\\tv\\renders\\input\\listbox-single.tpl',
      1 => 1743578432,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6878fc8b53b099_23429019 (Smarty_Internal_Template $_smarty_tpl) {
?><select id="tv<?php echo $_smarty_tpl->tpl_vars['tv']->value->id;?>
" name="tv<?php echo $_smarty_tpl->tpl_vars['tv']->value->id;?>
">
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['opts']->value, 'item');
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
?>
        <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['value'];?>
" <?php if ($_smarty_tpl->tpl_vars['item']->value['selected']) {?> selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value['text'];?>
</option>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</select>

<?php echo '<script'; ?>
>
// <![CDATA[

Ext.onReady(function() {
    const fld = MODx.load({
    
        xtype: 'combo'
        ,transform: 'tv<?php echo $_smarty_tpl->tpl_vars['tv']->value->id;?>
'
        ,id: 'tv<?php echo $_smarty_tpl->tpl_vars['tv']->value->id;?>
'
        ,itemId: 'tv<?php echo $_smarty_tpl->tpl_vars['tv']->value->id;?>
'
        ,triggerAction: 'all'
        ,width: 400
        ,maxHeight: 300
        ,allowBlank: <?php if ($_smarty_tpl->tpl_vars['params']->value['allowBlank'] == 1 || $_smarty_tpl->tpl_vars['params']->value['allowBlank'] == 'true') {?>true<?php } else { ?>false<?php }?>
        <?php if ($_smarty_tpl->tpl_vars['params']->value['typeAhead'] == 1 || $_smarty_tpl->tpl_vars['params']->value['typeAhead'] == 'true') {?>
            ,editable: true
            ,typeAhead: true
            ,typeAheadDelay: <?php if ((($tmp = $_smarty_tpl->tpl_vars['params']->value['typeAheadDelay'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp) && (($tmp = $_smarty_tpl->tpl_vars['params']->value['typeAheadDelay'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp) != '') {
echo (($tmp = $_smarty_tpl->tpl_vars['params']->value['typeAheadDelay'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);
} else { ?>250<?php }?>
        <?php } else { ?>
            ,editable: false
            ,typeAhead: false
        <?php }?>
        <?php if ((($tmp = $_smarty_tpl->tpl_vars['params']->value['title'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp)) {?>
            ,title: '<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->tpl_vars['params']->value['title'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
'
        <?php }?>
        <?php if ((($tmp = $_smarty_tpl->tpl_vars['params']->value['listEmptyText'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp)) {?>
            ,listEmptyText: '<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->tpl_vars['params']->value['listEmptyText'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
'
        <?php }?>
        ,forceSelection: <?php if ((($tmp = $_smarty_tpl->tpl_vars['params']->value['forceSelection'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp) && (($tmp = $_smarty_tpl->tpl_vars['params']->value['forceSelection'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp) != 'false') {?>true<?php } else { ?>false<?php }?>
        ,msgTarget: 'under'
    
        ,listeners: {
            select: {
                fn: MODx.fireResourceFormChange,
                scope: this
            },
            afterrender: function(cmp) {
                cmp.clearInvalid();
            }
        }
    });
    Ext.getCmp('modx-panel-resource').getForm().add(fld);
});

// ]]>
<?php echo '</script'; ?>
>
<?php }
}

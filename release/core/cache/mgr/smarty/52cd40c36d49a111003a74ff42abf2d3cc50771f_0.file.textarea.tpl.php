<?php
/* Smarty version 4.5.5, created on 2025-07-17 16:37:16
  from 'D:\Projects\Hosts\smart-social-modx.local\release\manager\templates\default\element\tv\renders\input\textarea.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_6878fc8ce57d82_96641832',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '52cd40c36d49a111003a74ff42abf2d3cc50771f' => 
    array (
      0 => 'D:\\Projects\\Hosts\\smart-social-modx.local\\release\\manager\\templates\\default\\element\\tv\\renders\\input\\textarea.tpl',
      1 => 1743578432,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6878fc8ce57d82_96641832 (Smarty_Internal_Template $_smarty_tpl) {
?><textarea id="tv<?php echo $_smarty_tpl->tpl_vars['tv']->value->id;?>
" name="tv<?php echo $_smarty_tpl->tpl_vars['tv']->value->id;?>
"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['tv']->value->get('value'), ENT_QUOTES, 'UTF-8', true);?>
</textarea>

<?php echo '<script'; ?>
>
// <![CDATA[
document.getElementById('tv<?php echo $_smarty_tpl->tpl_vars['tv']->value->id;?>
').setAttribute('autocomplete', globalAutoCompleteSetting);

Ext.onReady(function() {
    const 
        defaultHeight = 140,
        fld = MODx.load({
        
        xtype: 'textarea',
        itemId: 'tv<?php echo $_smarty_tpl->tpl_vars['tv']->value->id;?>
',
        applyTo: 'tv<?php echo $_smarty_tpl->tpl_vars['tv']->value->id;?>
',
        <?php if ($_smarty_tpl->tpl_vars['tv']->value->get('value') != '') {?>
            value: '<?php echo strtr((string)$_smarty_tpl->tpl_vars['tv']->value->get('value'), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", 
                       "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S",
                       "`" => "\\`", "\${" => "\\\$\{"));?>
',
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['params']->value['textareaGrow'] == 1 || $_smarty_tpl->tpl_vars['params']->value['textareaGrow'] == 'true') {?>
            boxMinHeight: <?php if ($_smarty_tpl->tpl_vars['params']->value['inputHeight'] != '') {
echo $_smarty_tpl->tpl_vars['params']->value['inputHeight'];
} else { ?>defaultHeight<?php }?>,
            grow: true,
            growMin: <?php if ($_smarty_tpl->tpl_vars['params']->value['inputHeight'] != '') {
echo $_smarty_tpl->tpl_vars['params']->value['inputHeight'];
} else { ?>defaultHeight<?php }?>,
            growMax: 1200,
        <?php } else { ?>
            height: <?php if ($_smarty_tpl->tpl_vars['params']->value['inputHeight'] != '') {
echo $_smarty_tpl->tpl_vars['params']->value['inputHeight'];
} else { ?>defaultHeight<?php }?>,
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['params']->value['textareaResizable'] == 1 || $_smarty_tpl->tpl_vars['params']->value['textareaResizable'] == 'true') {?>
            ctCls: 'resizable',
        <?php }?>
        width: '99%',
        enableKeyEvents: true,
        msgTarget: 'under',
        allowBlank: <?php if ($_smarty_tpl->tpl_vars['params']->value['allowBlank'] == 1 || $_smarty_tpl->tpl_vars['params']->value['allowBlank'] == 'true') {?>true<?php } else { ?>false<?php }?>,
    
        listeners: {
            keydown: {
                fn: MODx.fireResourceFormChange,
                scope: this
            }
        }
    });
    MODx.makeDroppable(fld);
    Ext.getCmp('modx-panel-resource').getForm().add(fld);
});

// ]]>
<?php echo '</script'; ?>
>
<?php }
}

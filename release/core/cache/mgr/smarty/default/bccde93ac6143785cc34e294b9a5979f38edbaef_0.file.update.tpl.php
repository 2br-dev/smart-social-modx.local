<?php
/* Smarty version 4.5.5, created on 2025-07-17 17:03:13
  from 'D:\Projects\Hosts\smart-social-modx.local\release\manager\templates\default\resource\update.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_687902a1e6efe8_37874546',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bccde93ac6143785cc34e294b9a5979f38edbaef' => 
    array (
      0 => 'D:\\Projects\\Hosts\\smart-social-modx.local\\release\\manager\\templates\\default\\resource\\update.tpl',
      1 => 1743578434,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_687902a1e6efe8_37874546 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="modx-panel-resource-div"></div>
<div id="modx-resource-tvs-div"><?php echo (($tmp = $_smarty_tpl->tpl_vars['tvOutput']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</div>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['hidden']->value, 'tv', false, NULL, 'tv', array (
));
$_smarty_tpl->tpl_vars['tv']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['tv']->value) {
$_smarty_tpl->tpl_vars['tv']->do_else = false;
?>
    <input type="hidden" id="tvdef<?php echo $_smarty_tpl->tpl_vars['tv']->value->id;?>
" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['tv']->value->default_text, ENT_QUOTES, 'UTF-8', true);?>
" />
    <?php echo $_smarty_tpl->tpl_vars['tv']->value->get('formElement');?>

<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

<?php echo (($tmp = $_smarty_tpl->tpl_vars['onDocFormPrerender']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>

<?php if ($_smarty_tpl->tpl_vars['resource']->value->richtext && $_smarty_tpl->tpl_vars['_config']->value['use_editor']) {?>
    <?php echo (($tmp = $_smarty_tpl->tpl_vars['onRichTextEditorInit']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>

<?php }
}
}

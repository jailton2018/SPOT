<?php
/* Smarty version 3.1.28, created on 2016-10-27 16:50:20
  from "/var/www/infra/views/partial_commons/_header.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_5812142c794104_45242691',
  'file_dependency' => 
  array (
    'b6fd43b4bc9688e7e82e2d3f4636bc83d27119e5' => 
    array (
      0 => '/var/www/infra/views/partial_commons/_header.tpl',
      1 => 1477578061,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5812142c794104_45242691 ($_smarty_tpl) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <title><?php echo $_smarty_tpl->tpl_vars['TITLE']->value;?>
</title>
        <link rel="shortcut icon" href="/favicon.ico" />

        <link rel="stylesheet" type="text/css" media="screen" href="web/css/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="web/css/style.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="web/css/styles.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="web/css/chosen.css" />

        <?php echo '<script'; ?>
 type="text/javascript" src="web/js/jquery-1.11.3.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="web/js/chosen.jquery.js" type="text/javascript" ><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="web/css/bootstrap/js/bootstrap.min.js" type="text/javascript" ><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="web/js/magic.js" type="text/javascript" ><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="web/js/jqueryPaginate.js" type="text/javascript" ><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
>
            $(document).ready(function () {
                $('select').chosen().trigger('chosen:updated');
                $('a').addClass('');
            });
        <?php echo '</script'; ?>
>
    </head>

    <body>

        <div class="page-container">

            <!-- top navbar -->
            <div class="navbar navbar-default ">
                <div class="container">
                    <div class="loading" style="display:none;position:absolute"><img src="web/images/loader.gif" /></div>

                    <div class="navbar-header">

                        <table class="table table-striped table-responsive">
                            <tr>
                                <th class="btn btn-info"    >
                                    <a href="index.php"><strong style="color:white;"><?php echo $_smarty_tpl->tpl_vars['TITLE']->value;?>
</strong></a>
                                </th>
                                <td class="btn btn-primary btn-sm">
                                    UP tagged port
                                </td>
                                <td class="btn btn-success btn-sm">
                                    UP untagged port
                                </td>
                                <td class="btn btn-warning btn-sm">
                                    DOWN tagged port
                                </td>
                                <td class="btn btn-danger btn-sm">
                                    DOWN untagged port
                                </td>

                            </tr>
                        </table>

                    </div>


                </div>



            </div>

<?php }
}



<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">Confirmation</h4>
</div>
<div class="modal-body">
   
   
<?
echo($_REQUEST['id'])
?>
    <p>The content of this modal window has been loaded form a remote source file.</p>
    <p class="text-warning"><small><strong>Note:</strong> This option is deprecated since v3.3.0 and will be removed in v4. Use client-side templating, or a data binding framework, or call jQuery.load yourself instead.</small></p><small>
</small></div><small>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
    <button type="button" onClick="guardar()" class="btn btn-primary">Save changes</button>
</div></small>
</body>
</html>

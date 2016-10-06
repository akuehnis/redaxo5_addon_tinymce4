<?php include 'top.php'; ?>
<div class="col-xs-12">
<form 
    class="form"
    method="GET" 
    action="index.php"
    id="category_selection"
>
<input type="hidden" name="tinymce4_call" value="/file/index" />
<div class="row">
    <div class="col-xs-6">
        <label>Link-Typ</label>
        <div class="form-group">
        <?php echo $form->select('type', array('link' => 'Seite', 'media' => 'Datei'),
            $type, array(
                'onchange' => 'setType()',
                'class' => 'form-control',
            ));?>
        </div>
    </div>
    <div class="col-xs-6">
        <?php if ('link' == $type):?>
            <div class="form-group">
            <label>Sprache</label>
            <?php echo $form->select('clang_id', $language_choices, $clang_id, array(
                    'onchange' => 'setType()',
                    'class' => 'form-control',
                ));?>
            </div>
        <?php else:?>
            <input type="hidden" name="clang_id" value="<?php echo $clang_id;?>" />
        <?php endif;?>
    </div>
</div>

<div class="form-group">
<label>Kategorie</label>
<?php echo $form->select('category_id', $category_choices, $category_id, array(
    'onchange' => 'reload()',
        'class' => 'form-control',
));?>
</div>

<?php if ('media' == $type):?>
    <div class="form-group">
    <?php echo $form->text('search', $search, array(
        'onchange' => 'reload()',
        'class' => 'form-control',
        'placeholder' => 'Suche',

    ));?>
    </div>
<?php endif;?>

</form>
<?php if ('link' == $type):?>
    <h6>Seiten:</h6>
<?php else: ?>
    <h6>Dateien:</h6>
<?php endif;?>

<?php echo $list_content;?>

<script type="text/javascript">
var win = top.tinymce.activeEditor.windowManager.getParams().window;
var field_name = top.tinymce.activeEditor.windowManager.getParams().input;

function returnFile(element) {
    win.document.getElementById(field_name).value = element.dataset.value;
    win.tinymce.activeEditor.windowManager.close();
    return false;

}
function setType(){
    document.querySelector('select[name="category_id"] option[value="0"]').selected = 'selected';
    reload();
    return false;
}
function reload(){
    document.getElementById('category_selection').submit();
    return false;
}

function loadMore(more_link){
    var href = more_link.href;
    more_link.innerHTML = '...';
    more_link.onclick='return false;';
    $.get(href, function(dat) {
        $(more_link).replaceWith(dat);
    });
    return false;
}

</script>

<?php include 'bottom.php'; ?>

<link href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js"></script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        new FroalaEditor('#<?php echo $this->contextList['textareaId'] ?>');
    });
</script>
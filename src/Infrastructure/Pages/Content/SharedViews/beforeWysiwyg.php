<style>
    #content {
        height: 1px;
        background-color: #eee;
        visibility: hidden;
    }

    #contentPreview {
        border: 1px solid darkgray;
        min-height: 450px;
        padding: 10px;
    }
</style>
<script>
    function formatTo(style) {
        document.execCommand(style, false, '');
    }

    function link() {
        var url = prompt("Entrer l'url du lien");
        document.execCommand("createLink", false, url);
    }

    function loadWysiwigBefore() {
        var textareaInput = document.getElementById('content');
        var contentEditable = document.getElementById('contentPreview');

        if (textareaInput && contentEditable) {
            textareaInput.value = contentEditable.innerHTML;
            return true;
        }

        return false;
    }

    function getImage() {
        var file = document.querySelector("input[type=file]").files[0];

        var reader = new FileReader();

        let dataURI;

        reader.addEventListener(
            "load",
            function() {
                dataURI = reader.result;

                const img = document.createElement("img");
                img.src = dataURI;
                document.getElementById('contentPreview').appendChild(img);
            },
            false
        );

        if (file) {
            console.log("s");
            reader.readAsDataURL(file);
        }
    }
</script>
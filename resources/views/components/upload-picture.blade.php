<div class="flex items-center">
    <input type="file" name="picture" id="picture" class="input-file" style="display:none;">
    <button type="button" style="margin-right: 1rem;" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-500 tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150" onclick="document.getElementById('picture').click()">
        Upload Picture
    </button>
    <label for="picture" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md text-xs text-white dark:text-gray-800 tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150" style="display: none;">
        <img id="preview-image" src="{{ asset('photos-icon.svg') }}" alt="Default Picture" class="h-6 w-6 mr-2">
        <span id="file-name" style="display:none;"></span>
    </label>
</div>

<script>
    // Ajoute un écouteur d'événements à l'élément avec l'identifiant 'picture'
    document.getElementById('picture').addEventListener('change', function() {
        // Récupère le fichier sélectionné par l'utilisateur
        var file = this.files[0];
        
        // Vérifie si un fichier a été sélectionné
        if (file) {
            // Récupère le nom du fichier
            var fileName = file.name;
            
            // Crée un objet FileReader pour lire le contenu du fichier
            var reader = new FileReader();
            
            // Définit une fonction à exécuter lorsque la lecture du fichier est terminée
            reader.onload = function(e) {
                // Définit la source de l'élément 'preview-image' avec les données du fichier
                document.getElementById('preview-image').src = e.target.result;
                // Affiche l'élément 'preview-image' en définissant sa propriété 'display' sur 'inline-block'
                document.getElementById('preview-image').style.display = 'inline-block';
                // Affiche le nom du fichier sélectionné
                document.getElementById('file-name').innerText = fileName;
                document.getElementById('file-name').style.display = 'inline-block';
                document.querySelector('label[for="picture"]').style.display = 'inline-flex'; // Afficher l'élément d'aperçu
            }
            
            // Commence à lire le contenu du fichier en tant qu'URL de données (data URL)
            reader.readAsDataURL(file);
        } else {
            // Si aucun fichier n'est sélectionné, cacher l'élément d'aperçu
            document.getElementById('preview-image').style.display = 'none';
            document.getElementById('file-name').innerText = '';
            document.getElementById('file-name').style.display = 'none';
            document.querySelector('label[for="picture"]').style.display = 'none'; // Cacher l'élément d'aperçu
        }
    });
</script>

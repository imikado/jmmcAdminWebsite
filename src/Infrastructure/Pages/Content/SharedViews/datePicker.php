<script>
    document.addEventListener('DOMContentLoaded', function() {

        var options = {
            'autoClose': true,
            'format': 'yyyy-mm-dd',
            'firstDay': 1,
            'i18n': {
                'cancel': 'Annuler',
                'clear': 'Reset',
                'done': 'Selectionner',
                'months': [
                    'Janvier',
                    'Fevrier',
                    'Mars',
                    'Avril',
                    'Mai',
                    'Juin',
                    'Juillet',
                    'Aout',
                    'Septembre',
                    'Octobre',
                    'Novembre',
                    'Decembre'
                ],
                'monthsShort': [
                    'Jan',
                    'Fev',
                    'Mar',
                    'Avr',
                    'Mai',
                    'Juin',
                    'Juil',
                    'Aou',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dec'
                ],
                'weekdays': [
                    'Dimanche',
                    'Lundi',
                    'Mardi',
                    'Mercredi',
                    'Jeudi',
                    'Vendredi',
                    'Samedi'
                ],
                'weekdaysShort': [
                    'Dim',
                    'Lun',
                    'Mar',
                    'Mer',
                    'Jeu',
                    'Ven',
                    'Sam'
                ],
                'weekdaysAbbrev': ['D', 'L', 'M', 'M', 'J', 'V', 'S']
            },

        };

        var elems = document.querySelectorAll('.datepicker');
        var instances = M.Datepicker.init(elems, options);
    });
</script>
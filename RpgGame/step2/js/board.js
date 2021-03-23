 function refreshBoard(params) {
            console.log(params);
            $.get('api.php?' + params, function(data) {
                $('#board').html(data);
            });
        }

        $(document).ready(function() {

            //Déterminer les mouvement a effectuer quand on appuis sur les flèches du clavier 
            document.addEventListener('keyup', function(event) {
                //récupère le joueur selectionné
                let $playerCell = $('.player').parent();

                //Récupère la position de la case du joueur
                let x = $playerCell.data('x');
                let y = $playerCell.data('y');

                switch (event.keyCode) {
                    case 37: // gauche
                        x--;
                        break;
                    case 38: // haut
                        y--;
                        break;
                    case 39: // droite
                        x++;
                        break;
                    case 40: // bas
                        y++;
                        break;
                    default:
                        break;
                }

                if ([37, 38, 39, 40].includes(event.keyCode)) {
                    let $cell = $('.cell[data-x="' + x + '"].cell[data-y="' + y + '"]');
                    if ($cell) {
                        $cell.click();
                    }
                }
            });

            //Éviter le scroll au clavier
            document.addEventListener('keydown', function() {
                event.preventDefault;
            });

            //chargement du plateau newgame
            $('#new-game').on('click', function() {
                refreshBoard('new')
            });

            //Rechargement du plateau au click
            $('#board').on('click', '.cell', function() {

                let x = $(this).data('x');
                let y = $(this).data('y');

                console.log(x + ',' + y);

                refreshBoard('x=' + x + '&y=' + y);
            });

            //Rechargement automatique du plateau toute les 3 secondes
            setInterval(function() {
                refreshBoard('refresh')
            }, 30000);
        });
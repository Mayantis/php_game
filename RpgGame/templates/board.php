<?php
if ($oGame) {
    echo '<span style="color:blue;"><strong>' . $oGame->getCurrentPlayer()->getName() . ' à toi de jouer!</strong></span>';
}
/*
    if (isset($aGameInfo['current_player'])) {
        echo '<span style="color:blue;"><strong>' . $aGameInfo['current_player'] . ' à toi de jouer!</strong></span>';
    } else {

        //Optionel  (pas top) : on simule un clic en erreur pour recuperer les données precedentes
        $aGameInfo = $oGame->selectCell(-1, -1);
        //echo '<span style="color:cyan;"><strong>Sélectionner un pion!</strong></span>';
    }
    */
if (isset($aGameInfo['selected_pawn'])) {
    $pawn = $aGameInfo['selected_pawn'];
    echo PHP_EOL . $pawn . ' : [' . $pawn->getX() . ',' . $pawn->getY() . ']' . PHP_EOL;
}
?>

<div class="row justify-content-center">
    <div class="col-auto border text-center">
        &nbsp;&nbsp;
    </div>
    <?php
    $a = "A";
    foreach ($oGame->getABoard()[0] as $X => $ColX) : ?>
        <div class="col-auto border text-center" style="width:100px">
            <?php
            echo $a++;
            ?>
        </div>
    <?php endforeach;
    ?>
</div>

<?php foreach ($oGame->getABoard() as $iY => $aLineY) : ?>
    <div class="row justify-content-center">
        <div class="col-auto border text-center">
            <?= count($aLineY) - $iY; ?>
        </div>
        <?php foreach ($aLineY as $iX => $mColX) : ?>
            <?php
            $bMovable = false;
            if (isset($aGameInfo['moves'])) {
                $bMovable = (in_array([$iX, $iY], $aGameInfo['moves']));
            }
            $class = $bMovable ? 'moves': '';
            ?>
            <div class="col-auto border text-center cell <?= $class ?> " data-x="<?= $iX; ?>" data-y="<?= $iY; ?>">
                <?php
                $bSelected = false;
                if (isset($aGameInfo['selected_pawn'])) {
                    $bSelected = ($aGameInfo['selected_pawn'] === $mColX);
                }

                if ($mColX instanceof \Model\Pawn) {
                    $style= $bSelected ? 'background-color:white;"' : '"';
                    echo '<span style="color: ' . $mColX->getPlayer()->getTeam() . ';' .$style.'>';
                }
                echo $mColX;
                if ($mColX instanceof \Model\Pawn) {
                    echo '</span>';
                }
                ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endforeach; ?>
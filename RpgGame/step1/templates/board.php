<?php

if (isset($aGameInfo['selected_pawn'])) {
    $pawn = $aGameInfo['selected_pawn'];
    echo PHP_EOL . $pawn . ' : [' . $pawn->getX() . ',' . $pawn->getY() . ']' . PHP_EOL;
}
?>

<?php foreach ($oGame->getABoard() as $iY => $aLineY) : ?>
    <div class="row justify-content-center">
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
                if($mColX instanceof Model\Characters\Character):?>
                    <span class="player">
                <?php endif;
                if($mColX instanceof Model\Monster):?>
                    <span class="monster">
                <?php endif;
                echo $mColX; ?>
                <?php if ($mColX instanceof Model\Characters\Character) : ?>
                    </span>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endforeach; ?>
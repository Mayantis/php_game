<?php

if (isset($aGameInfo['selected_pawn'])) {
    $pawn = $aGameInfo['selected_pawn'];
    echo PHP_EOL . $pawn . ' : [' . $pawn->getX() . ',' . $pawn->getY() . ']' . PHP_EOL;
}
?>
<div class="card">
    <div class="card-header">
        <?php
        $oCharacter = $oPlayer->getCharacter();

        $iHealth = $oCharacter->getHealth();
        $iStrength = $oCharacter->getStrength();
        $iMaxHealth = $oCharacter->getMaxhealth();

        echo $oCharacter->getSymbol();
        echo $oCharacter->getName();
        ?>
    </div>
    <div class="card-body">
        <div>
            <h6 class="card-subtitle">Santé</h6>
            <div class="progress">
                <div class="progress-bar bg-success w-100" role="progressbar" aria-valuenow="<?=$iHealth?>" aria-valuemin="0" aria-valuemax="<?=$iMaxHealth?>"><?=$iHealth?></div>
            </div>
            <p class=""><?= $iHealth ?> points de vie</p>
        </div>
        <div>
            <h6 class="card-subtitle">Force</h6>
            <div class="progress">
                <div class="progress-bar bg-warning w-100" role="progressbar" aria-valuenow="<?= $iStrength ?>" aria-valuemin="0" aria-valuemax="<?= $iStrength ?>"><?= $iStrength ?></div>
            </div>
            <p class=""><?= $iStrength ?> points de force</p>
        </div>
        <?php if ($oCharacter instanceof Model\Characters\Wizard) : ?>
            <?php $iMagic = $oCharacter->getMagic(); ?>
            <div>
                <h6 class="card-subtitle">Magie</h6>
                <div class="progress">
                    <div class="progress-bar bg-warning w-100" role="progressbar" aria-valuenow="<?= $iMagic ?>" aria-valuemin="0" aria-valuemax="<?= $iMagic ?>"><?= $iMagic ?></div>
                </div>
                <p class=""><?= $iMagic ?> points de force</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php foreach ($oGame->getABoard() as $iY => $aLineY) : ?>
    <div class="row justify-content-center">
        <?php foreach ($aLineY as $iX => $mColX) : ?>
            <?php
            $bMovable = false;
            if (isset($aGameInfo['moves'])) {
                $bMovable = (in_array([$iX, $iY], $aGameInfo['moves']));
            }
            $class = $bMovable ? 'moves' : '';
            ?>
            <div class="col-auto border text-center cell <?= $class ?> " data-x="<?= $iX; ?>" data-y="<?= $iY; ?>">
                <?php
                $bSelected = false;
                if ($mColX instanceof Model\Characters\Character) : ?>
                    <span class="player">
                    <?php endif;
                if ($mColX instanceof Model\Monster) : ?>
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
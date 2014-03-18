<?php

// задание 6
// создать калькулятор процентных начислений от вклада на выбранное количество лет
// с заданной процентной ставкой от депозита и стартовой суммой.
// [ так же реализовать расчет реальной суммы с учетом инфляции ]

$numberDeposit = getFromPost('deposit') * exp(getFromPost('period')*log(1 + getFromPost('persent') / 100));
$numberWithInfl = $numberDeposit / bcpow((1 + getFromPost('inflation') / 100), getFromPost('period'), 5);
?>
<form action="index.php" method="post">
Ставка депозита: <input type="text" name="deposit" value="<?php echo getFromPost('deposit') ?>"><br />
Годовая ставка %: <input type="text" name="persent" value="<?php echo getFromPost('persent') ?>"> <br />
Период: <input type="text" name="period" value="<?php echo getFromPost('period') ?>"> <br />
Ожидаемая инфляция: <input type="text" name="inflation" value="<?php echo getFromPost('inflation') ?>"> <br />
<input type="submit" value="Посчитать"><br />
Сумма с учетом начисленных процентов: <?php echo $numberDeposit, '<br />' ?>
Реальная сумма с учетом инфляции: <?php echo $numberWithInfl, '<br />'?>
</form>
<?php

// задание 2
// реализовать функционал по расчету скидки на товар.
// т.е. вводится цена товара, вводится скидка в процентах и результат
// вместе с полученной конечной ценой выводится на экран

$result = getFromPost('price', 0) - getFromPost('discount', 0) * getFromPost('price', 0) / 100;
?>
<form action="index.php" method="post">
  Цена: <input type="text" name="price" value="<?php echo getFromPost('price', 0) ?>"><br />
  Скидка: <input type="text" name="discount" value="<?php echo getFromPost('discount', 0) ?>"> <br />
  <input type="submit" value="Посчитать"><br />
  Результат: <?php echo $result, '<br>' ?>
</form>

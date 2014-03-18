<?php

// задание 3
// реализовать функционал подбора машины по трем характеристикам
// мощность двигателя в лс - до какого значения
// объем двигателя - до какогото значения
// марка автомобиля
// результатом должны быть автомобили удовлетворяющие выбранным условиям
$auto = array(
  array ('auto' => 'Bentley', 'model' => 'Flying Spur', 'lbs' => 400, 'motorV' => 5), 
  array ('auto' => 'Bentley', 'model' => 'Continental', 'lbs' => 800, 'motorV' => 5),
  array ('auto' => 'Mazda',   'model' => '6',           'lbs' => 200, 'motorV' => 2),
  array ('auto' => 'Audi',    'model' => 'A6',          'lbs' => 302, 'motorV' => 3.2),
  array ('auto' => 'Honda',   'model' => 'CrossTour',   'lbs' => 230, 'motorV' => 2.2),
  array ('auto' => 'Porshe',  'model' => 'Cayman',      'lbs' => 600, 'motorV' => 4)
);
?>


<form action="index.php" method="post">
    Показать автомобили:<br />
    Модель:  
    <select name="auto">
        <option value="all"     <?php echo getFromPost('auto') == 'all'     ?  'selected="selected"' : '' ?>>Все</option>
        <option value="Bentley" <?php echo getFromPost('auto') == 'Bentley' ?  'selected="selected"' : '' ?>>Bentley</option>
        <option value="Mazda"   <?php echo getFromPost('auto') == 'Mazda'   ?  'selected="selected"' : '' ?>>Mazda</option>
        <option value="Audi"    <?php echo getFromPost('auto') == 'Audi'    ?  'selected="selected"' : '' ?>>Audi</option>
        <option value="Honda"   <?php echo getFromPost('auto') == 'Honda'   ?  'selected="selected"' : '' ?>>Honda</option>
        <option value="Porshe"  <?php echo getFromPost('auto') == 'Porshe'  ?  'selected="selected"' : '' ?>>Porshe</option>
    </select>    
    <br />
    Количество лошадиных сил: 
    <select name="lbs">
        <option value="all"     <?php echo getFromPost('lbs') == 'all'     ?  'selected="selected"' : '' ?>>Все</option>
        <option value="200"     <?php echo getFromPost('lbs') == '200'     ?  'selected="selected"' : '' ?>>>200</option>
        <option value="300"     <?php echo getFromPost('lbs') == '300'     ?  'selected="selected"' : '' ?>>>300</option>
        <option value="400"     <?php echo getFromPost('lbs') == '400'     ?  'selected="selected"' : '' ?>>>400</option>
    </select>    
    <br />
    Объем двигателя: 
        <select name="volume">
        <option value="all" <?php echo getFromPost('volume') == 'all' ?  'selected="selected"' : '' ?>>Все</option>
        <option value="2"   <?php echo getFromPost('volume') == '2'   ?  'selected="selected"' : '' ?>>>2</option>
        <option value="3"   <?php echo getFromPost('volume') == '3'   ?  'selected="selected"' : '' ?>>>3</option>
        <option value="4"   <?php echo getFromPost('volume') == '4'   ?  'selected="selected"' : '' ?>>>4</option>
    </select>    
    <p><input type="submit" value="Показать"></p>
</form>
<br />


<?php

//$findedCars = $auto;
        
$findedCars = searchChooseCars($auto, 'auto', getSearchParamFromPost('auto', 'all'), '==');
$findedCars = searchChooseCars($findedCars, 'lbs', getSearchParamFromPost('lbs', 'all'), '>');
$findedCars = searchChooseCars($findedCars, 'motorV', getSearchParamFromPost('volume', 'all'), '>');

echo printFindedCars($findedCars);
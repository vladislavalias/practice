<?php
var_dump($_POST) ?>

<form action="index.php" method="post">
  <div>
    <input type="text" name="number[first]" value="<?php echo getFromPost('number.first') ?>">+
    <input type="text" name="number[second]" value="<?php echo getFromPost('number.second') ?>"><br />
    <input type="submit">
  </div>
</form> 


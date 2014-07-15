<?php
var_dump($_POST);
dump(getFromPost('number', FILTER_REQUIRE_ARRAY)) ?>

<form action="index.php" method="post">
  <div>
    <input type="text" name="number[first]" value="<?php echo getFromPost('number.first') ?>">+
    <input type="text" name="number[second]" value="<?php echo getFromPost('number.second') ?>"><br />
    <input type="submit">
  </div>
</form> 


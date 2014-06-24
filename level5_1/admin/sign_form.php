<form action="index.php" method="post">
  <div class="error"><?php echo $errors ?></div>
  <div class="admin_panel">
    <h3>Вход в панель управления</h3>
    <table class="admin_enter">
      <tr>
        <td>Логин: </td>
        <td>
            <input type="text" name="login_form[name]" value="<?php echo filter_input(INPUT_POST, 'name') ?>">
        </td>
      </tr>
      <tr>
        <td>Пароль:</td>
        <td><input type="password" name="login_form[pass]"></td>
      </tr>
      <tr>
          <td colspan="2"><input type="submit" class="button" name="login_form[submit]"></td>
      </tr>
    </table>
  </div>
</form>



<?php
$login = addslashes(trim(filter_input(INPUT_POST, 'name')));
$pass  = trim(filter_input(INPUT_POST, 'pass'));
$where = $login ? sprintf('admin="%s" AND pass="%s"', $login, md5($pass)) : 0;
$arrayUserData = mysqlSelect('admins', '*', $where);
$user = array_pop($arrayUserData);

if ($login || $pass)
{
    if ($user)
    {
      $_SESSION['login'] = $login;
      $_SESSION['permission'] = $user['permission'];
    }
    else
    {
      echo 'Неправильный логин/пароль!';
    }
}
?>

<?php if (!$_SESSION['login']): ?>
    <form action="index.php" method="post">
      <div class="admin_panel">
        <h3>Вход в панель управления</h3>
        <table class="admin_enter">
          <tr>
            <td>Логин: </td>
            <td>
                <input type="text" name="name" value="<?php echo filter_input(INPUT_POST, 'name') ?>">
            </td>
          </tr>
          <tr>
            <td>Пароль:</td>
            <td><input type="password" name="pass"></td>
          </tr>
          <tr>
              <td colspan="2"><input type="submit" class="button"></td>
          </tr>
        </table>
      </div>
    </form>
<?php endif;



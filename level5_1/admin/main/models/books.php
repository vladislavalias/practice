<?php if (getFromGet('action') == 'show' || 'edit' || 'delete'): ?>
<table>
<?php  foreach ($allBooksData as $BookData): ?>
  <tr>
    <td><?php echo $BookData['name'] ?></td>
  
  <?php if (getFromGet('action') == 'edit'): ?> 
    <td>Редактировать</td>
    <?php endif; ?>
   <?php if (getFromGet('action') == 'delete'): ?> 
    <td>Удалить</td>
  <?php endif; ?>
  <?php endforeach; ?>
  </tr>
 <?php endif; ?> 
</table>
<a href="<?php echo getUrl('index.php') ?>">Вернутся к списку действий</a>

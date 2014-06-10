<?php if (getFromGet('action') == 'show' || 'edit' || 'delete'): ?>
<table>
<?php  foreach ($allAuthorsData as $AuthorData): ?>
  <tr>
    <td><?php echo $AuthorData['firstname'].', '.$AuthorData['lastname'] ?></td>
  
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
<a href="<?php echo getUrl('index.php') ?>">Вернуться к списку действий</a>

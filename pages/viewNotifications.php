<h4 class="text-center mb-3">Le tue notifiche</h4>
<table class="table">
  <tbody>
    <?php if (!empty($pageParams["notifiche"])): ?>
        <?php foreach($pageParams["notifiche"] as $not): ?>
            <tr>
                <?php if($not["isLetto"] == 0):?>
                    <td  data-id="<?php echo $not['id']; ?>"><a href="../php/readNotification.php?id=<?php echo $not['id']; ?>"><strong><?php echo $not["titolo"]?></strong></a></td>
                <?php else: ?>
                    <td  data-id="<?php echo $not['id']; ?>"><a href="../php/readNotification.php?id=<?php echo $not['id']; ?>"><?php echo $not["titolo"]?></a></td>
                <?php endif; ?>
                <td class="text-end"><?php echo $not['data']; ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-muted text-center w-100">Nessuna notifica trovata</p>
    <?php endif; ?>
  </tbody>
</table>
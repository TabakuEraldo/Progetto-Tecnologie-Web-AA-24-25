<h2 class="text-center mb-3">Le tue notifiche</h2>
<table class="table">
  <tbody>
    <?php if (!empty($pageParams["notifiche"])): ?>
        <?php foreach($pageParams["notifiche"] as $not): ?>
            <tr>
                <?php if($not["isLetto"] == 0):?>
                    <td  data-id="<?php echo $not['id']; ?>"><strong><?php echo $not["titolo"]?></strong></td>
                <?php else: ?>
                    <td  data-id="<?php echo $not['id']; ?>"><?php echo $not["titolo"]?></td>
                <?php endif; ?>
                <td class="text-end"><a href="../php/readNotification.php?id=<?php echo $not['id']; ?>">leggi</a></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-muted text-center w-100">Nessuna notifica trovata</p>
    <?php endif; ?>
  </tbody>
</table>
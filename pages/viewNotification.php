<h2 class="text-center mb-3">Le tue notifiche</h2>
<table class="table">
  <tbody>
    <?php if (!empty($pageParams["notifiche"])): ?>
        <?php foreach($pageParams["notifiche"] as $not): ?>
            <tr>
                <?php if($not["isLetto"] == 0):?>
                    <th scope="row"><strong><?php echo $not["titolo"]?></strong></th>
                <?php else: ?>
                    <th scope="row"><?php echo $not["titolo"]?></th>
                <?php endif; ?>
                <td class="text-end"><a href=#>leggi</a></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-muted text-center w-100">Nessuna notifica trovata</p>
    <?php endif; ?>
  </tbody>
</table>
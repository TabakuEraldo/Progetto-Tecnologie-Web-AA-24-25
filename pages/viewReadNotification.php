<section class="container mt-5">
    <?php if(!empty($pageParams["readNotifica"])):?>
        <h4 class="mb-3"><?php echo $pageParams["readNotifica"]["titolo"];?></h4>
        <p><?php echo $pageParams["readNotifica"]["testo"]?>. <br><?php echo $pageParams["readNotifica"]["data"]?></p>
    <?php else: ?>
        <p class="text-muted text-center w-100">Nessuna notifica selezionata</p>
    <?php endif;?>
    <a href="../php/notifications.php" class="btn btn-secondary btn-sm">Indietro</a>
</section>


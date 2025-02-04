<section class="container mt-5">
    <?php if(!empty($pageParams["readNotifica"])):?>
        <h2 class="mb-3"><?php echo $pageParams["readNotifica"]["titolo"];?></h2>
        <p><?php echo $pageParams["readNotifica"]["testo"]?></p>
    <?php else: ?>
        <p class="text-muted text-center w-100">Nessuna notifica selezionata</p>
    <?php endif;?>
    <a href="../php/notifications.php" class="btn btn-secondary btn-sm">Indietro</a>
</section>


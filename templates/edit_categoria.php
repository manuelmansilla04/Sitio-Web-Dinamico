<?php require_once 'layout/header.phtml'; ?>

<section class="edit_categoria">
    <form action="editCategoria/<?= $s->id_categoria ?>" method="post">
        <label for="title">Nombre:</label>
        <input type="text" name="title" value="<?= $s->nombre ?>">

        <label for="synopsis">Descripcion:</label>
        <input type="text" name="synopsis" value= "<?= $s->descripcion ?>">

        <label for="img">Portada</label>

        <input type="url" name="img" value="<?= $s->img ?>">

        <button type="submit">GUARDAR</button>
    </form>
    
</section>

<?php require_once 'layout/footer.phtml' ?>
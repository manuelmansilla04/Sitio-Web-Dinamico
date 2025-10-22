<?php require_once 'layout/header.phtml'; ?>

<section class="edit_categoria">
    <form action="editCategoria/<?= $s->id_categoria ?>" method="post">
        <label for="title">Nombre:</label>
        <input type="text" name="title" value="<?= $s->nombre ?>">

        <label for="desc">Descripcion:</label>
        <input type="text" name="desc" value= "<?= $s->descripcion ?>">

        <label for="img">Portada</label>

        <input type="url" name="img" value="<?= $s->img ?>">

        <button type="submit">GUARDAR</button>
    </form>
        <a href="list_categorias">CANCELAR</a>
</section>
<?php require_once 'layout/footer.phtml';?>

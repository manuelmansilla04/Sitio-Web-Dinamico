<?php require_once 'layout/header.phtml' ?>

<section class="add_categoria">
    <form action="addCategoria" method="post">
        <label for="title">Nombre:</label><br>
        <input type="text" name="title"><br>

        <label for="desc">Descripcion:</label>
        <input type="text" name="desc"><br>

        <button type="submit">AGREGAR</button>
    </form>
</section>

<?php require_once 'layout/footer.phtml' ?>

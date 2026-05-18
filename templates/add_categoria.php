<?php require_once 'layout/header.phtml' ?>

<section class="add_categoria">
    <form action="addCategoria" method="post">
        <label for="title">Nombre:</label>
        <input type="text" name="title"><br>

        <label for="synopsis">Descripción:</label>
        <input type="text" name="synopsis"><br>
        
        <label for="img">Imagen:</label>
        <input type="url" name="img"><br>

        <button type="submit">AGREGAR</button>
    </form>
</section>

<?php require_once 'layout/footer.phtml' ?>

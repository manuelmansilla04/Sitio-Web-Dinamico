# Sitio-Web-Dinamico: Tienda de Aromas
Alumno: Franco Manuel Mansilla

Mail: manuelmansilla2004@gmail.com

La "tienda de aromas" ofrece un servicio comercial con la posibilidad de seleccionar productos que el usuario desee. Las compras engloban objetos que puedan aromatizar ambientes y el cuerpo, como fragancias textiles, perfumes, etc.

```text
+-------------------+       1      N      +-------------------+
|     CATEGORIA     |---------------------|     PRODUCTO      |
+-------------------+                     +-------------------+
| id_categoria (PK) |                     | id_producto (PK)  |
| nombre            |                     | nombre            |
| descripcion       |                     | descripcion       |
+-------------------+                     | precio            |
                                          | stock             |
                                          | fecha_alta        |
                                          | id_categoria (FK) |
                                          +-------------------+

Command Bus Training
====================

Para ver los ejemplos necesitareis tener ejecutándose una instancia de Redis en local. La aplicación consiste de 4 rutas

* ```GET /albums``` --> Muestra un listado de todos los álbums.
* ```POST /albums``` --> Crea un nuevo álbum **de forma transaccional**. Necesita de los parámetros ```title``` y ```artist_id``` para funcionar (vía ```$_POST```).
* ```PUT /albums/{id}``` --> Actualiza el título de un álbum **de forma transaccional**. Necesita del parámetro ```title``` para funcionar (vía ```$_POST```).
* ```DELETE /albums/{id}``` --> Encola la eliminación de un álbum. Luego habrá que ejecutar el command ```bernard:consume``` para que la eliminación tenga efecto.

Hay también disponible un test, ```tests/AppBundle/Tests/Controller/AlbumsControllerTest.php```, para poder ver y probar el funcionamiento en detalle

https://github.com/atrapalo/application-services-training/blob/master/tests/AppBundle/Tests/Controller/AlbumsControllerTest.php

Reglas de la kata "Mars Rover"
=

Se requiere implementar la kata denominada "Mars Rover" en PHP. Las reglas son sencillas:

- Se crea un mapa inicial que contiene coordenadas cuyas dimensiones podrán ser seleccionadas por el usuario
- Se crean obstaculos que serán posicionados en coordenadas del mapa que podrán ser seleccionadas por el usuario
- Se introducirán unas coordenadas de inicio y una dirección (Norte, Sur, Este, Oeste)
- La Mars Rover recibirá un set de comandos, los posibles comandos serán:
	Desplazar el Rover hacia adelante o hacia atrás una posición.
	Cambiar la dirección del rovers mediante giros de 90º, tanto a la izquierda como a la derecha.
- Si un movimiento de la Mars Rover provoca que éste se salga del mapa, deberá aparecer en la dirección opuesta del mapa.
	(Si sale por arriba aparece por abajo, igual para los laterales)
- Si la Mars Rover encuentra un obstáculo cuando va a realizar un movimiento, informará al usuario y no realizará el movimiento.

Instalación
= 
- Bajar código 
- composer install

Testear el código
=
php vendor/phpunit/phpunit/phpunit tests


Acerca de
=

He querido darle un enfoque bastante desacoplado, procurando  diferenciar las responsabilidades entre clases
para que pueda extenderse con relativa facilidad. Existen soluciones más sencillas que cumplen 
el enunciado.

Aún así, hay algunos puntos de los que no me siento especialmente orgulloso.

Por ejemplo, el comando MoveCommand contiene lógica acerca de la esfericidad del mundo que posiblemente tendría 
que llevarse a World o a Coordinates. 

También es posible que me haya complicado la vida creando una clase Coordinate para representar coordenadas, pero
será de agradecer si algún día se pide cambiar el modelo a 3D. 

Respecto a las direcciones, me he basado en el patrón estado, donde cada estado conoce a que estado cambia ante 
un suceso. Quizás es excesivo, a fin de cuentas, sólo tenemos 4 posibles direcciones.






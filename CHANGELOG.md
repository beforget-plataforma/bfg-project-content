##  2.2 (junio, 2021)
###  Refactor de API de datos 
* Quitamos la función de Shotcode y la pasamos al nuevo plugin

##  2.1 (mayo, 2021)
###  Corrección de listado en perfiles
* El funcionamiento del filtro por perfil del usuario no era el correcto. Los resultados que se obtenían en algunos casos eran correctos pero en otros no.
El retorno del valor del miembro era un Objecto.

```
//$profileUserID es el ID del perfil que se está visitando.

$args = array(
	'post_type' => 'proyectos',
	'meta_query' => array(
		array(
			'key' => 'miembros',
			'value' => $profileUserID,
			'compare' => 'REGEXP'
		)
	)
);

```

## 2.0 (Mayo, 2021)

### Filtrado de proyectos

* Agregamos iconos a los botones del filtrado. Manejo de errores.
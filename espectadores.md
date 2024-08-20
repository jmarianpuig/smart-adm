# Espectáculos Públicos

## Publico

- id **(PK)**
- nombre y apellidos **UQ**
- apellidos
- edad
- teléfono
- email **UQ**
- foto DNI

## Eventos

- id **(PK)**
- nombre
- descripción
- lugar
- fecha
- status

## Eventos_Publicos

- id **(PK)**
- evento_id **(FK)**
- publico_id **(FK)**


## Relaciones entre las tablas

- un **espectador** tiene muchos **eventos** (_1_M_)
- un **evento** tiene muchos **espectadores** (_1_M_)


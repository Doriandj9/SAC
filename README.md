# Sistema de Aseguramiento de la Calidad
Este es un sistema desarrollado para la Universidad Estatal de Bolívar por un grupo de desarrollo de software como practicas preprofesionales
> :warning: Todos los archivos se encentra en github en el seguiente repositorio[Repositorio SAC](https://github.com/Doriandj9/SAC) seguido deben hacer Restore en la base de datos con el archivo sac que se presenta en la raiz del sistema
## Integrantes del grupo de desarrollo 

- [Leyton Arevalo](https://github.com/Leyton16)
- [Dorian Armijos](https://github.com/Doriandj9)
- [Chimbo Jerson](#)
- [Nataly Fernandez](#)

## Descripcion del Sistema

```html
El sistema de Asegurmiento de la cailidad se base en el patron arquitectonico MVC(Model View Controller) 
empezando donde el la carpeta src/ continen todas las clases que se van usar dentro del sistema 
-controllers esta carpeta contiene todos los controladores del sistema que estan conectados con los modelos
-web esta carpeta continen las clases que utiliza unicamente este sistema como la clase ViewCtroller que contiene todas las rutas del sistema
-frame esta carpeta contiene el codigo que puede ser reutilizdo en otros proyectos como es la clase EntryPoint que es el punto de partida que se encarga de lograr el enrutamiento del sistema
-entity esta carpeta contiene las entidades con las que el sistema va a interactuar como la entidad Teachers(profesores)

Seguido Tenemos la carpeta models donde se encuentra los modelos como es la clase DataBaseTable que contiene todas las consultas a la base de datos que puede realizar un modelo, seguido de esta clase tenemos la carpeta conection que dentro de esta se encuentra la clase con la coneccion a la base de datos

Luego tenemos la carpeta con las Views(vistas) aqui hay las diferentes vistas que genera el sistema las cuales se presentan segun lo dicte el controlador 

```
## Base de Datos

```html
El sistema utiliza la base de datos PostgresSQL siendo la mas utilizada para los sistemas empresariales o robustos y como medida de adaptacion de sistemas dentro de la __Universidad Estatal de Bolivar__
```
### Como empezar a utilizar el sistema
1. Primero se extiendo una vista de inicio de sesión donde unicamente en un principio podra ingresar el administrador que viene previamente incorporado en la base de datos para ello tiene que ingresar su correo electronico y su contraseña
2. Seguido en el apartado de Periodo Academico tiene que ingresar un periodo academico valido en el siguiente formato: 2021-2022 por ejemplo
3. Ingresar una carrera (tener en cuenta que se encuentre previamente almaceda la faculta de dicha carrera) en el apartado de Ingresar Carrera
4. Ingresar un coordinador para esa carrera en el apartado de Ingresar Coordinador 
5. Seguido de eso tendra que ingresar el coordinador al sistema para subir los datos basicos en el apartado de Configuaraciones Basicas con los que el sistema se va a manejar en el siguiente orden:
    -Las Evidencias en el cuadro de Evidencias el archivo tiene que encontrase en archivo JSON con el nombre Evidencias.json
    -La lista de profesores con el nombre ListaProfesores.json aqui hay que tener en cuenta que el sistema guarda a esta lista de profesor en la misma carrera que se encuentra el coordinar que sube este archivo
    -Los criterios con el nombre criterios.json
    -Los estandares con el nombre estandares.json 
    -Los elementos fundamentales con el nombre elementos.json
    -Por ultimo el archivo que contiene que evidencia se encuentra relacionado con el elemento fundamental con el nombre EntregableF.json

6. Con estos pasos los profesores tendran acceso a subir las evidencias dentro del sistema tener en cuenta que para inresar al sistema necesita sumunistrar su correo electronico y su contraseña 


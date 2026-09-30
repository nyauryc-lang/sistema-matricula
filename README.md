# Sistema de Matrícula y Gestión Académica

Sistema web de administración de matrículas, cursos, docentes, estudiantes y registro de calificaciones para instituciones educativas, desarrollado con arquitectura **MVC en PHP** y base de datos relacional compatible con **Supabase (PostgreSQL)** y MySQL.

---

## 🚀 Características

* **Gestión de Estudiantes:** Registro, edición, listado y subida de fotografías de alumnos.
* **Gestión de Profesores y Cursos:** Asignación de especialidades, créditos y docentes por curso.
* **Módulo de Matrícula:** Registro de matrícula con cálculo automático de créditos acumulados y estados.
* **Registro y Control de Notas:** Registro de promedios finales y estado académico (Aprobado / Desaprobado).
* **Reportes y Exportación:** Generación de constancias en PDF y actas en Excel.
* **Seguridad y Control de Acceso:** Sistema de autenticación con control de roles (`admin`, `docente`).
* **Soporte Cloud con Supabase:** Compatible con PostgreSQL en la nube y variables de entorno protegidas (`.env`).

---

## 🛠️ Tecnologías Utilizadas

* **Backend:** PHP 8.x (Patrón MVC - Modelo Vista Controlador)
* **Base de Datos:** PostgreSQL en la nube vía [Supabase](https://supabase.com) (o MySQL / MariaDB local)
* **Frontend:** HTML5, CSS3, JavaScript, Bootstrap
* **Librerías:** Dompdf, PhpSpreadsheet, PHPMailer

---

## 📂 Estructura del Proyecto

```text
sistema-matricula/
├── controladores/     # Controladores MVC (estudiantes, cursos, matricula, notas, login, reportes)
├── modelos/           # Modelos de datos y lógica de negocio
├── vistas/            # Plantillas y vistas PHP organizadas por módulo
│   ├── cursos/
│   ├── estudiantes/
│   ├── login/
│   ├── matricula/
│   ├── notas/
│   ├── paginas/
│   ├── personal/
│   ├── profesores/
│   ├── reportes/
│   └── template/
├── uploads/           # Fotografías y documentos subidos
├── vendor/            # Dependencias externas PHP
├── conexion.php       # Conexión PDO con soporte para variables de entorno
├── index.php          # Punto de entrada de la aplicación
├── ruteador.php       # Enrutamiento dinámico de controladores y acciones
├── script_supabase.sql # Script SQL para Supabase (PostgreSQL)
├── script.sql         # Script SQL clásico para MySQL
├── .env.example       # Plantilla de credenciales y variables de entorno
├── .gitignore         # Exclusión de archivos sensibles y temporales
└── README.md          # Documentación del proyecto
```

---

## ⚙️ Configuración y Puesta en Marcha

### 1. Clonar el repositorio
```bash
git clone https://github.com/nyauryc-lang/sistema-matricula.git
cd sistema-matricula
```

### 2. Configurar la Base de Datos (Supabase)
1. En tu proyecto de Supabase, ve al **SQL Editor**.
2. Ejecuta el archivo [`script_supabase.sql`](./script_supabase.sql) para crear las tablas y datos iniciales.

### 3. Configurar variables de entorno
Crea un archivo `.env` en la raíz del proyecto basado en `.env.example`:
```env
DB_HOST=db.zxscrsojikgbsquyuzxe.supabase.co
DB_PORT=5432
DB_NAME=postgres
DB_USER=postgres
DB_PASSWORD=TU_CONTRASENA_DE_SUPABASE
```

### 4. Ejecutar el proyecto
Puedes servirlo localmente mediante el servidor integrado de PHP:
```bash
php -S localhost:8000
```
O colocar la carpeta en tu servidor Apache / XAMPP (`htdocs/`).

---

## 👤 Autor

* **Estudiante:** nyauryc-lang
* **Institución:** IEST La Recoleta
* **Contacto:** nyauryc@iestlarecoleta.edu.pe

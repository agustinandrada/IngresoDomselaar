
# Ingreso Domselaar

![App Screenshot](https://ingresodomselaar.com.ar/img/logo-estancias-sistema.png)

![App Screenshot](https://www.argdg.com/assets/img/logo-argdg.png)

![App Screenshot](https://i.postimg.cc/wTkMSBJg/Huemul-Solutions.png)

Sistema de Ingreso para barrios privados a partir del DNI de los residentes, para el uso de los guardias de seguridad.


## Tech Stack

**Client:** PHP, Javascript ,Blade, BootstrapCSS

**Server:** PHP, Laravel


## Authors

- [@agustinandrada](https://www.github.com/agustinandrada) -> Developer, Backend, Database and Deploy

- [Argento Alfredo](https://www.argdg.com) -> Product Owner, Designer and Frontend


## Documentation

[Documentation](https://linktodocumentation)


## Demo

[IngesoDomselaar.com](https://ingresodomselaar.com.ar/estancias/login)


## Run Locally

Clone the project

```bash
  git clone https://github.com/agustinandrada/IngresoDomselaar.git
```

Go to the project directory

```bash
  cd IngresoDomselaar
```

Install dependencies

```bash
  npm install
  composer install
```

Create Database and make migrations

```bash
  php artisan migrate --seed
```

Start the server

```bash
  php artisan serve
```




CREATE DATABASE IF NOT EXISTS task_app;

USE task_app;

CREATE TABLE IF NOT EXISTS task(
    id int AUTO_INCREMENT not null,
    name varchar(100) not null,
    description varchar(255) not null,
    primary key(id)
);

INSERT INTO task (name, description) VALUES 
    ('Comprar víveres', 'Hacer una lista de compras y adquirir los víveres necesarios para la semana.'),
    ('Llamar al plomero', 'Programar una cita para reparar una fuga en la cocina.'),
    ('Enviar informe mensual', 'Redactar y enviar el informe de actividades del mes al jefe.'),
    ('Hacer ejercicio', 'Ir al gimnasio para una sesión de entrenamiento de una hora.'),
    ('Preparar presentación', 'Crear una presentación para la reunión de la próxima semana.');

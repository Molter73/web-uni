DROP DATABASE IF EXISTS pandas;
CREATE DATABASE pandas;

USE pandas;

CREATE TABLE posts (title TEXT, date DATE, video TEXT, description TEXT);

INSERT INTO posts (title, date, video, description) VALUES
    ("Pandas rojos", "2023-11-27", "https://www.youtube.com/embed/kuXoM-gWX3E", "Los pandas rojos son pandas? No nos importa mucho, son adorables igualmente"),
    ("Pandas y bananas", "2023-11-26", "https://www.youtube.com/embed/4SZl1r2O_bY", "Los Pandas comen bananas? Mira este vídeo corto que muestra que si! A los pandas les encantan las bananas"),
    ( "Pandas comiendo dulces", "2023-11-24", "https://www.youtube.com/embed/4n0xNbfJLR8", "Los pandas son muy dulces. Aquí hay un vídeo de un panda comiendo dulces.");

-- Create the database
CREATE DATABASE IF NOT EXISTS snuffelmatch;
USE snuffelmatch;

-- Create dier table based on the Dier class from ERD.php
CREATE TABLE IF NOT EXISTS dier (
    id INT AUTO_INCREMENT PRIMARY KEY,
    naam VARCHAR(100) NOT NULL,
    soort VARCHAR(50) NOT NULL,
    ras VARCHAR(50) NOT NULL,
    leeftijd INT NOT NULL,
    beschrijving TEXT NOT NULL,
    asiel_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (asiel_id) REFERENCES asiel(id)
);

-- Insert sample data
INSERT INTO dier (naam, soort, ras, leeftijd, beschrijving, asiel_id) VALUES
('Max', 'hond', 'Labrador Retriever', 2, 'Energieke en vriendelijke labrador die dol is op wandelen en spelen. Goed met kinderen en andere honden.', 1),
('Luna', 'kat', 'Siamees', 1, 'Mooie Siamese kat met opvallende blauwe ogen. Zeer aanhankelijk en dol op knuffelen.', 1),
('Charlie', 'vogel', 'Papegaai', 3, 'Kleurrijke papegaai die graag zingt en geluiden nadoet. Geweldige metgezel voor vogelliefhebbers.', 1),
('Bunny', 'klein', 'Dwergkonijn', 1, 'Schattig dwergkonijn. Zeer zachtaardig en perfect voor gezinnen met kinderen.', 1),
('Rocky', 'hond', 'Duitse Herder', 3, 'Speelse Duitse Herder. Geweldig met kinderen en dol op buitenactiviteiten.', 1),
('Milo', 'kat', 'Tabby', 2, 'Nieuwsgierige en speelse tabby kat. Houdt van verkennen en speelt graag met speeltjes.', 1),
('Tweety', 'vogel', 'Kanarie', 1, 'Lieve kanarie met een prachtige zangstem. Perfect voor het wonen in een appartement.', 1),
('Hammy', 'klein', 'Hamster', 1, 'Vriendelijke hamster die graag in zijn wiel rent en met speeltjes speelt.', 1); 
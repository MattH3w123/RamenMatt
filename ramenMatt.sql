CREATE DATABASE RammenMatt;

CREATE TABLE dania (
    ID_dania INT PRIMARY KEY AUTO_INCREMENT,
    Nazwa_dania text(55),
    opis_nazwa text(255),
    Opis_danie text(255),
    Cena INT,
    Dostepne ENUM('Dostępne', 'Niedostępne') NOT NULL,
    plik VARCHAR(100),
    podstrona VARCHAR(100)
)

CREATE TABLE Klienci (
    ID_klienta INT PRIMARY KEY AUTO_INCREMENT,
    Imie text(50),
    Nazwisko text(70),
    Kodp VARCHAR(10),
    Adres VARCHAR(255),
    Miejscowosc VARCHAR(255),
    Telefon int(9),
    klientZdjecie VARCHAR(100),
    email varchar(50),
    haslo VARCHAR(255)
);


/*zamowienia*/

CREATE TABLE Zamowienia (
    ID_zamowienia INT PRIMARY KEY AUTO_INCREMENT,
    ID_klienta INT,
    ID_dania INT,
    Data_zamowienia DATE, 
    Status ENUM('przyjęte', 'w trakcie realizacji', 'zrealizowane') NOT NULL,
    FOREIGN KEY (ID_klienta) REFERENCES Klienci(ID_klienta),
    FOREIGN KEY (ID_dania) REFERENCES dania(ID_dania)
);

/*opinie*/

CREATE TABLE opinie (
    ID_opinia INT AUTO_INCREMENT PRIMARY KEY,
    ID_klienta INT,
    opinia TEXT(255),
    opPlik VARCHAR(100),
    FOREIGN KEY (ID_klienta) REFERENCES Klienci(ID_klienta),
)

/*Menu przykłady*/
Shoyu Ramen Miso Ramen Tonkotsu Ramen Shio Ramen Vegetarian Ramen
INSERT INTO dania (`ID_dania`, `Nazwa_dania`, `opis_nazwa`, `Cena`, `Dostepne`, 'plik', 'podstrona') 
(NOT NULL, 'Shoyu Ramen', 'Tradycyjny ramen na bazie sosu sojowego', 35.00, 'Dostepne', 'shoyu_ramen.jpeg', 'shoyu-ramen'),

INSERT INTO dania (`ID_dania`, `Nazwa_dania`, `opis_nazwa`,`Cena`, `Dostepne`, 'plik', 'podstrona') 
(NOT NULL, 'Miso Ramen', 'Ramen z pastą miso, bogaty i kremowy', 38.00, 'Dostepne', 'miso_ramen.jpg', 'miso-ramen'),

INSERT INTO dania (`ID_dania`, `Nazwa_dania`, `opis_nazwa`, `Cena`, `Dostepne`, 'plik', 'podstrona') 
(NOT NULL, 'Tonkotsu Ramen', 'Głęboki smak na bazie bulionu wieprzowego', 42.00, 6, 'tonkotsu_ramen.jpg', 'tonkotsu-ramen'),

INSERT INTO dania (`ID_dania`, `Nazwa_dania`, `opis_nazwa`, `Cena`, `Dostepne`, 'plik', 'podstrona') 
(NOT NULL, 'Shio Ramen', 'Delikatny ramen z solnym wykończeniem', 33.00, 'Dostepne', 'shio_ramen.jpg', 'shio-ramen'),

INSERT INTO dania (`ID_dania`, `Nazwa_dania`, `opis_nazwa`, `Cena`, `Dostepne, 'plik', 'podstrona'`) 
(NOT NULL, 'Vegetarian Ramen', 'Wegetariański ramen pełen świeżych warzyw', 36.00, 1, 'vegetarian_ramen.jpeg', 'vegetarian-ramen');

/*klienci przykłady*/

INSERT INTO klienci (`ID_klienta`, `Imie`, `Nazwisko`, `Kodp`, `Adres`, `Miejscowosc` `Telefon`, `klientZdjecie`, `email`, `haslo`) 
VALUES (NOT NULL, 'Marek', 'Kaczmarczyk', '43-267', 'Słowaciekgo 23', 'Krakow', '991997998', 'zdjecie1.jpg', 'słowarek@spawarek.edu' 'password123');

INSERT INTO klienci (`ID_klienta`, `Imie`, `Nazwisko`, `Kodp`, `Adres`, `Miejscowosc` `Telefon`, `klientZdjecie`, `email`, `haslo`) 
VALUES (NOT NULL, 'Damian', 'Marchewka', '11-467', 'roblox 12', 'Olsztyn', '1212121212', 'zdjecie2.jpg', 'marchewka@saperka.edu' 'haslohaslo1');

INSERT INTO klienci (`ID_klienta`, `Imie`, `Nazwisko`, `Kodp`, `Adres`, `Miejscowosc` `Telefon`, `klientZdjecie`, `email`, `haslo`) 
VALUES (NOT NULL, 'Krzysztof', 'Polej', '78-667', 'Mieckiewicza 2', 'Polska', '999123145', 'zdjecie3.jpg', 'K.POLEJ@olej.edu' 'qwertyqwerty12');

INSERT INTO klienci (`ID_klienta`, `Imie`, `Nazwisko`, `Kodp`, `Adres`, `Miejscowosc` `Telefon`, `klientZdjecie`, `email`, `haslo`) 
VALUES (NOT NULL, 'Jakub', 'Ptak', '31-331', 'Oszylna 5', 'Wraszawa', '987165789', 'zdjecie4.jpg', 'letnijakub@mail.hot', 'PtaszekK!');

INSERT INTO klienci (`ID_klienta`, `Imie`, `Nazwisko`, `Kodp`, `Adres`, `Miejscowosc` `Telefon`, `klientZdjecie`, `email`, `haslo`) 
VALUES (NOT NULL, 'Dawid', 'Mazur', '43-677', 'Wybickiego 98', 'Wraszawa', '987654332', 'zdjecie5.jpg', 'DawidosMazurskiMroz@mail.edu', 'Mazureczek001');

/*klienci przykłady*/ 

INSERT INTO Zamowienia ('ID_zamowienia', 'ID_klienta', 'ID_dania', 'Data_zamowienia', 'Status')
VALUES (NOT NULL, 1, 1, '2024-11-1', 'w trakcie realizacji');

INSERT INTO Zamowienia ('ID_zamowienia', 'ID_klienta', 'ID_dania', 'Data_zamowienia', 'Status')
VALUES (NOT NULL, 2, 2, '2024-11-12', 'przyjęte');

INSERT INTO Zamowienia ('ID_zamowienia', 'ID_klienta', 'ID_dania', 'Data_zamowienia', 'Status')
VALUES (NOT NULL, 3, 3, '2024-11-15', 'zrealizowane');

INSERT INTO Zamowienia ('ID_zamowienia', 'ID_klienta', 'ID_dania', 'Data_zamowienia', 'Status')
VALUES(NOT NULL, 4, 4, '2024-11-31', 'przyjęte');



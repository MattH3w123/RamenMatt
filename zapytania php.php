<?php
        $conn = mysqli_connect('localhost', 'root', '', 'RammenMatt');

        if(!$conn){
            die("Błedne połączenie" . mysqli_connect_error());
        }

        $zapytanie1 = "SELECT Nazwa_dania, opis_nazwa, Cena, Dostepne, plik, podstrona FROM dania
                        GROUP BY dania.Nazwa_dania";

        $wynik = mysqli_query($conn, $zapytanie1);

        if($wynik->num_rows > 0) {
            while($row = $wynik->fetch_assoc()) {
                echo"<div class='card-ramen'>" . "<a href ='./jedzenie/" . $row['podstrona'] . ".html'>" . "<img src='" . $row['plik'] . "' alt='ramen' >" . "<h2 class='open-sans-tekstfml'>" . $row['Nazwa_dania'] . "</h2>" . "<h2 class='open-sans-tekstfml'>" . $row['Dostepne'] . "<br>" . $row['Cena'] . "</h2>" . "<p class='open-sans-tekstfml'>" . $row['opis_nazwa'] . "</p>" . "</a>" . "</div>";
            }
        } else {
            echo"brak danych";
        }
                
                
    mysqli_close($conn);
?>

<?php
        $conn = mysqli_connect('localhost', 'root', '', 'RammenMatt');

        if(!$conn){
            die("Błedne połączenie" . mysqli_connect_error());
        }

        $zapytanie2 = "SELECT Imie, Nazwisko, klientZdjecie, opinia, opPlik FROM Klienci INNER JOIN opinie ON opinie.ID_klienta = Klienci.ID_klienta;
                        GROUP BY dania.Nazwa_dania";

        $wynik = mysqli_query($conn, $zapytanie2);

        if($wynik->num_rows > 0) {
            while($row = $wynik->fetch_assoc()) {
                echo"<img src='" . $row['klientZdjecie'] . "' alt='klienta' >" . "<h2 class='open-sans-tekstfml'>" . $row['Imie'] . "<br>" . $row['Nazwisko'] . "</h2>" . "<p class='open-sans-tekstfml'>" . $row['opinia'] . "</p>" . "<img src='" . $row['opPlik'] . "' alt='klienta' >";
            }
        } else {
            echo"brak danych";
        }
                
                
    mysqli_close($conn);
?>


    <!-- klienci rejestracja -->

    <?php
        $conn = mysqli_connect('localhost', 'root', '', 'RammenMatt');

        if(!$conn){
            die("Błedne połączenie" . mysqli_connect_error());
        }

        if (isset($_POST['submit'])) {
            $imie = $_POST['imie'];
            $nazwisko = $_POST['nazwisko'];
            $miejscowosc = $_POST['adrs'];
            $ulica = $_POST['ulica'];
            $pesel = $_POST['pesel'];
            $nr_telefonu = $_POST['telefon'];
            $haslo = password_hash($_POST['haslo'], PASSWORD_DEFAULT);
            $kod = $_POST['kod'];
            $nr_domu = $_POST['numer'];
            $mail = $_POST['mail'];
        
            $zapytanie = "INSERT INTO `Klienci` (`ID_klienta`, `Imie`, `Nazwisko`, `kod`, `miejscowosc`, `ulica`, `nr_domu`, `Telefon`, `klientZdjecie`, `email`, `haslo`) 
            VALUES (NOT NULL, '$imie', '$nazwisko', '$kod', '$miejscowosc', '$ulica', '$nr_domu', '$pesel', '$nr_telefonu', '', '$mail', '$haslo')";
        
            $wynik = mysqli_query($conn, $zapytanie3);
        
            if ($wynik) {
                echo "Rejestracja przebiegła pomyślnie!";
                header("Location: login.php");
                exit();
            } else {
                echo "Błąd podczas rejestracji. Spróbuj ponownie!";
            }
        }
        
        mysqli_close($conn);
    ?>

        <!-- klienci - LOGOWANIE -->

        <?php
        $conn = mysqli_connect('localhost', 'root', '', 'RammenMatt');

        if(!$conn){
            die("Błedne połączenie" . mysqli_connect_error());
        }

        session_start(); 
        if (isset($_POST['submit'])) {
            $mail = $_POST['mail'];
            $haslo = $_POST['haslo'];

            $stmt = $conn->prepare("SELECT id_uzytkownika, haslo FROM `uzytkownicy` WHERE email = '$mail' AND haslo = '$haslo'");
            $stmt->bind_param("ss", $mail, $haslo);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($user_id, $hashed_password);
                $stmt->fetch();

                if (password_verify($haslo, $hashed_password)) {
                    $_SESSION['user_id'] = $user_id;
                    header("Location: ");
                exit();
            } else {
                echo "Błędne hasło!";
            }
        } else {
            echo "Użytkownik o podanym adresie e-mail nie istnieje!";
        }

            $stmt->close();
        }

        mysqli_close($conn);
    ?>

        <!-- klienci - LOGout -->

<?php
    session_start();
    session_unset();
    session_destroy();
    header("Location: index.html");
    exit();
?>


        <!-- klienci - opinia -->

<?php 

    session_start();

    $conn = mysqli_connect('localhost', 'root', '', 'RammenMatt');

    if(!$conn){
        die("Błedne połączenie" . mysqli_connect_error());
    }

    if (!isset($_SESSION['ID_klienta'])) {
        echo "Musisz być zalogowany, aby dodać opinię.";
        exit();
    }

    if (isset($_POST['submit'])) {
        $ID_klienta = $_SESSION['ID_klienta'];
        $opinia = $_POST['opinia'];

        $zapytanie = "INSERT INTO opinie (ID_klienta, opinia) 
                    VALUES ('$ID_klienta', '$opinia')";

        $wynik = mysqli_query($conn, $zapytanie);

        if ($wynik) {
            echo "Opinia została dodana pomyślnie!";
            header("Location: opinie.php"); 
            exit();
        } else {
            echo "Błąd podczas dodawania opinii. Spróbuj ponownie!";
        }
    }
?>

<!-- ZAMAWIANIE -->

<?php
    session_start();
   
    $conn = mysqli_connect('localhost', 'root', '', 'RammenMatt');

    if(!$conn){
        die("Błedne połączenie" . mysqli_connect_error());
    }

    if (!isset($_SESSION['ID_klienta'])) {
        header("Location: login.php"); 
        exit();
    }

    if (isset($_POST['submit'])) {
        $ID_klienta = $_SESSION['ID_klienta'];
        $ID_dania = $_POST['ID_dania'];
        $Data_zamowienia = date('Y-m-d');
        $Status = 'przyjęte';

        $zapytanie = "INSERT INTO Zamowienia (ID_klienta, ID_dania, Data_zamowienia, Status) 
                    VALUES ('$ID_klienta', '$ID_dania', '$Data_zamowienia', '$Status')";

        $wynik = mysqli_query($conn, $zapytanie);

        if ($wynik) {
            echo "Zamówienie zostało złożone pomyślnie!";
            header("Location: moje_zamowienia.php"); 
            exit();
        } else {
            echo "Błąd podczas składania zamówienia. Spróbuj ponownie!";
        }
    }
?>

# FC Barcelona – Strona Kariery Menadżerskiej

Projekt webowy do śledzenia przebiegu kariery menadżerskiej FC Barcelona (tryb kariery w FIFA / FC). Pozwala prowadzić skład, akademię, bazę byłych zawodników, statystyki sezonowe oraz gablotę zdobytych trofeów.

## Funkcje

- Logowanie chronione hasłem (sesja PHP) – dostęp do wszystkich podstron wymaga zalogowania
- **Skład** – podstawowa jedenastka i rezerwowi, z edycją danych zawodnika
- **Akademia** – zawodnicy z pierwszej drużyny, akademii (La Masia) i wypożyczeni, z paskiem potencjału
- **Baza byłych zawodników** – historia transferów (skup/sprzedaż, wiek odejścia, overall start/koniec)
- **Statystyki sezonowe** – tabela mecze/gole/asysty/kartki i nagrody dla każdego sezonu, edytowana inline (AJAX, bez przeładowania strony)
- **Sezony** – zaznaczanie zdobytych trofeów w każdym sezonie; gablota pucharów przelicza się automatycznie
- **Gablota pucharów** – zsumowane trofea domowe i kontynentalne
- **Gabinet trenera** – profil trenera + ręczny licznik dodatkowych pucharów

## Technologie

- PHP (mysqli)
- MySQL / MariaDB
- HTML/CSS – własny motyw w kolorach klubu, bez frameworków
- Vanilla JavaScript (fetch / AJAX do zapisów na żywo)

## Wymagania

- PHP 8+
- MySQL / MariaDB
- Lokalny serwer, np. XAMPP, Laragon lub WAMP

## Instalacja lokalna

1. Sklonuj repozytorium.
2. Zaimportuj bazę danych z pliku `barcelona.sql` (np. przez phpMyAdmin) – utworzy to bazę `barcelona` ze wszystkimi tabelami i przykładowymi danymi.
3. Sprawdź dane połączenia z bazą w plikach `.php` w folderze `barcelona/` (domyślnie: host `localhost`, użytkownik `root`, brak hasła) i dopasuj do swojego środowiska.
4. W pliku [barcelona/login.php](barcelona/login.php) zmień wartość `$HASLO` na własne hasło do logowania.
5. Odpal serwer lokalny i wejdź na `http://localhost/<ścieżka>/barcelona/index.html`.

## Struktura

- `barcelona/` – pliki strony (PHP, HTML, CSS, JS, grafiki)
- `barcelona.sql` – zrzut struktury i danych bazy

## Autor

Wiktor Hutnik

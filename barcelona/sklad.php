<?php require 'auth.php'; ?>
<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>FC Barcelona - Sklad</title>
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:ital,wght@0,300;0,400;0,600;0,700;1,300&display=swap" rel="stylesheet"/>
  <style>
    :root {
      --blau:#004D98; --grana:#A50044; --gold:#EDBB00;
      --dark:#0a0a12; --darker:#06060e; --light:#f0e8d8; --muted:#9a8f7e;
      --card-bg:rgba(255,255,255,0.04); --border:rgba(164,0,68,0.35);
      --border-blue:rgba(0,77,152,0.4);
      --font-display:'Bebas Neue',sans-serif; --font-body:'Barlow',sans-serif;
      --nav-h:70px;

      /* kolory pozycji */
      --pos-br:   #16a34a;
      --pos-so:   #dc2626;
      --pos-lo:   #dc2626;
      --pos-po:   #dc2626;
      --pos-spd:  #0ea5e9;
      --pos-sp:   #0ea5e9;
      --pos-ls:   #7c3aed;
      --pos-ps:   #7c3aed;
      --pos-n:    #7c3aed;
    }
    *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
    html{scroll-behavior:smooth;}
    body{background:var(--darker);color:var(--light);font-family:var(--font-body);line-height:1.6;overflow-x:hidden;}
    a{color:inherit;text-decoration:none;}
    img{display:block;max-width:100%;}

    .topbar{background:var(--grana);text-align:center;font-size:.75rem;letter-spacing:.12em;padding:6px;font-weight:600;text-transform:uppercase;}

    nav{position:sticky;top:0;z-index:100;height:var(--nav-h);background:rgba(10,10,18,0.95);backdrop-filter:blur(12px);border-bottom:2px solid var(--grana);display:flex;align-items:center;justify-content:space-between;padding:0 2rem;gap:1rem;}
    .nav-logo{display:flex;align-items:center;gap:.7rem;font-family:var(--font-display);font-size:1.5rem;letter-spacing:.06em;color:var(--gold);}
    .nav-logo img{height:44px;width:44px;object-fit:contain;}
    .nav-links{display:flex;list-style:none;gap:.2rem;}
    .nav-links a{display:block;padding:.45rem 1rem;font-family:var(--font-display);font-size:.95rem;letter-spacing:.08em;color:var(--light);border-radius:4px;transition:background .2s,color .2s;white-space:nowrap;}
    .nav-links a:hover,.nav-links a.active{background:var(--grana);color:#fff;}

    .page-hero{padding:3.5rem 2rem 2.5rem;max-width:1300px;margin:0 auto;border-bottom:1px solid var(--border);}
    .page-hero h1{font-family:var(--font-display);font-size:clamp(2.8rem,6vw,5.5rem);letter-spacing:.06em;color:#fff;line-height:1;}
    .page-hero h1 span{color:var(--gold);}
    .page-hero p{color:var(--muted);font-size:1rem;margin-top:.5rem;}

    .page-content{max-width:1300px;margin:0 auto;padding:3rem 2rem 5rem;}
    .section-title{font-family:var(--font-display);font-size:2rem;letter-spacing:.1em;border-left:5px solid var(--grana);padding-left:1rem;margin-bottom:1.5rem;}

    /* ===== TABELE SKLADU ===== */
    .sklad-wrap{overflow-x:auto;margin-bottom:3rem;}
    .sklad-table{width:100%;border-collapse:collapse;font-size:.92rem;}

    .sklad-table .group-header td {
      background: linear-gradient(90deg, var(--blau), var(--grana));
      font-family: var(--font-display);
      font-size: 1rem;
      letter-spacing: .15em;
      padding: .6rem 1.2rem;
      text-align: center;
    }

    .sklad-table thead tr{background:linear-gradient(90deg,var(--blau),var(--grana));}
    .sklad-table thead th{
      padding:.75rem 1rem;text-align:center;
      font-family:var(--font-display);letter-spacing:.1em;
      font-weight:400;white-space:nowrap;
    }
    .sklad-table thead th:nth-child(3){text-align:left;}

    .sklad-table tbody tr{
      border-bottom:1px solid rgba(255,255,255,.06);
      transition:background .15s;
    }
    .sklad-table tbody tr:hover{background:rgba(255,255,255,.05);}
    .sklad-table tbody td{
      padding:.65rem 1rem;
      text-align:center;
      color:rgba(240,232,216,.9);
    }
    .sklad-table tbody td:nth-child(3){text-align:left;font-weight:600;}

    /* numer */
    .td-numer{font-family:var(--font-display);font-size:1.1rem;color:var(--gold);}

    /* pozycja badge */
    .pos-badge{
      display:inline-block;
      padding:.18rem .6rem;
      border-radius:4px;
      font-family:var(--font-display);
      font-size:.85rem;
      letter-spacing:.08em;
      color:#fff;
      min-width:42px;
      text-align:center;
    }
    .pos-BR  {background:var(--pos-br);}
    .pos-SO  {background:var(--pos-so);}
    .pos-LO  {background:var(--pos-lo);}
    .pos-PO  {background:var(--pos-po);}
    .pos-SPD {background:var(--pos-spd);}
    .pos-SP  {background:var(--pos-spd);}
    .pos-LS  {background:var(--pos-ls);}
    .pos-PS  {background:var(--pos-ps);}
    .pos-N   {background:var(--pos-n);}

    /* wiek */
    .td-wiek{
      background:var(--grana);
      border-radius:4px;
      font-weight:700;
      color:#fff;
      padding:.2rem .6rem;
      display:inline-block;
      min-width:34px;
    }

    /* overall */
    .td-overall{
      font-family:var(--font-display);
      font-size:1.15rem;
      color:#fff;
      font-weight:700;
    }

    /* ===== PANEL EDYCJI ===== */
    .form-section{margin-top:1rem;padding-top:2.5rem;border-top:1px solid var(--border);}
    .hint-txt{color:var(--muted);font-size:.95rem;margin-bottom:1.5rem;}
    .hint-txt strong{color:var(--gold);}

    .fcb-form{background:rgba(0,77,152,.08);border:1px solid var(--border-blue);border-radius:10px;padding:2rem;max-width:560px;}
    .form-editing-name{font-family:var(--font-display);font-size:1.3rem;color:var(--gold);letter-spacing:.1em;margin-bottom:1.2rem;}
    .form-row{display:grid;grid-template-columns:160px 1fr;align-items:center;gap:.6rem;margin-bottom:1rem;}
    .form-row label{font-size:.82rem;text-transform:uppercase;letter-spacing:.08em;color:var(--muted);font-weight:600;}
    .form-row input,
    .form-row select{
      background:rgba(255,255,255,.07);border:1px solid var(--border-blue);
      border-radius:5px;color:var(--light);font-family:var(--font-body);
      font-size:.95rem;padding:.5rem .8rem;width:100%;transition:border-color .2s;
    }
    .form-row input:focus,.form-row select:focus{outline:none;border-color:var(--gold);}
    .form-row select option{background:#0a0a12;}
    .btn-zapisz{margin-top:.5rem;background:linear-gradient(90deg,var(--grana),var(--blau));color:#fff;border:none;border-radius:5px;font-family:var(--font-display);font-size:1.1rem;letter-spacing:.12em;padding:.6rem 2.5rem;cursor:pointer;transition:opacity .2s,transform .15s;}
    .btn-zapisz:hover{opacity:.88;transform:translateY(-2px);}

    .msg-ok{background:rgba(0,152,77,.15);border:1px solid rgba(0,200,100,.3);border-radius:6px;padding:.7rem 1.2rem;margin-bottom:1.5rem;font-size:.9rem;color:#7effc0;}

    /* edycja - tabela zrodlowa */
    .edit-table-wrap{margin-top:2.5rem;overflow-x:auto;}
    table.edit-tbl{width:100%;border-collapse:collapse;font-size:.88rem;}
    table.edit-tbl thead tr{background:linear-gradient(90deg,var(--blau),var(--grana));}
    table.edit-tbl thead th{padding:.65rem .8rem;text-align:left;font-family:var(--font-display);letter-spacing:.08em;font-weight:400;white-space:nowrap;}
    table.edit-tbl tbody tr{border-bottom:1px solid rgba(255,255,255,.06);transition:background .15s;}
    table.edit-tbl tbody tr:hover{background:rgba(255,255,255,.04);}
    table.edit-tbl tbody td{padding:.55rem .8rem;color:rgba(240,232,216,.82);}
    .td-gold{color:var(--gold);font-weight:600;}
    .btn-edit{background:var(--blau);color:#fff;border:none;border-radius:4px;font-family:var(--font-display);letter-spacing:.08em;font-size:.82rem;padding:.28rem .8rem;cursor:pointer;transition:background .2s;}
    .btn-edit:hover{background:var(--grana);}

    footer{background:var(--dark);border-top:2px solid var(--grana);text-align:center;padding:1.5rem;font-size:.8rem;color:var(--muted);letter-spacing:.06em;text-transform:uppercase;}
    footer span{color:var(--gold);}
  </style>
</head>
<body>

<div class="topbar">Mes que un club - Wiecej niz klub - Since 1899</div>

<nav>
  <div class="nav-logo">
    <img src="zdjecie_herb.png" alt="FCB" onerror="this.style.display='none'"/>
    FC BARCELONA
  </div>
  <ul class="nav-links">
    <li><a href="index.html">Strona Główna</a></li>
    <li><a href="gablota_pucharow.php">Gablota Pucharów</a></li>
    <li><a href="sklad.php" class="active">Skład</a></li>
    <li><a href="statystyki.php">Statystyki Sezonowe</a></li>
    <li><a href="sezony.php">Sezony</a></li>
    <li><a href="byli_zawodnicy.php">Baza Byłych Zawodników</a></li>
    <li><a href="akademia.php">Akademia</a></li>
    <li><a href="trener.php">Gabinet Trenera</a></li>
    <li><a href="logout.php">Wyloguj</a></li>
  </ul>
</nav>

<?php
$conn = mysqli_connect("localhost","root","","barcelona");
if (!$conn) die("<p style='color:red;padding:2rem'>Blad polaczenia: ".mysqli_connect_error()."</p>");

// TYLKO UPDATE
if (isset($_POST["zapisz"])) {
    $id            = (int)$_POST["id"];
    $numer         = (int)$_POST["numer"];
    $pozycja       = mysqli_real_escape_string($conn, strtoupper(trim($_POST["pozycja"])));
    $imie_nazwisko = mysqli_real_escape_string($conn, trim($_POST["imie_nazwisko"]));
    $wiek          = (int)$_POST["wiek"];
    $overall       = (int)$_POST["overall"];
    $typ           = mysqli_real_escape_string($conn, $_POST["typ"]);

    if ($id > 0) {
        mysqli_query($conn,
            "UPDATE sklad SET
                numer=$numer,
                pozycja='$pozycja',
                imie_nazwisko='$imie_nazwisko',
                wiek=$wiek,
                overall=$overall,
                typ='$typ'
             WHERE id=$id"
        );
    }
    echo "<script>window.location='sklad.php?ok=1';</script>";
    exit;
}

// ZALADUJ DO EDYCJI
$edit = null;
if (isset($_GET["edit"])) {
    $id_get = (int)$_GET["edit"];
    $res = mysqli_query($conn, "SELECT * FROM sklad WHERE id=$id_get");
    if ($res && mysqli_num_rows($res) > 0) $edit = mysqli_fetch_assoc($res);
}

// POBIERZ DANE
$podstawowi = [];
$rezerwowi  = [];

/* ---- PODSTAWOWY SKŁAD ---- */
$res_p = mysqli_query($conn, "
SELECT * FROM sklad 
WHERE typ='podstawowy' 
ORDER BY FIELD(pozycja,
    'BR',
    'LO',
    'PO',
    'SO',
    'SPD',
    'SP',
    'LS',
    'PS',
    'N'
)
");

if ($res_p) {
    while ($r = mysqli_fetch_assoc($res_p)) {
        $podstawowi[] = $r;
    }
}

/* ---- REZERWOWI ---- */
$res_r = mysqli_query($conn, "
SELECT * FROM sklad 
WHERE typ='rezerwowy' 
ORDER BY FIELD(pozycja,
    'BR',
    'LO',
    'PO',
    'SO',
    'SPD',
    'SP',
    'LS',
    'PS',
    'N'
)
");

if ($res_r) {
    while ($r = mysqli_fetch_assoc($res_r)) {
        $rezerwowi[] = $r;
    }
}

// helper – kolor pozycji
function posBadge($pos) {
    $p = strtoupper(trim($pos));
    return '<span class="pos-badge pos-'.$p.'">'.htmlspecialchars($p).'</span>';
}

// helper – wiersz zawodnika
function playerRow($row) {
    $overall_color = $row["overall"] >= 88 ? '#6200ff'
                   : ($row["overall"] >= 84 ? '#59ff00'
                   : ($row["overall"] >= 80 ? '#ffaa00' : '#eeff00'));
    echo '<tr>';
    echo '<td class="td-numer">'.$row["numer"].'</td>';
    echo '<td>'.posBadge($row["pozycja"]).'</td>';
    echo '<td>'.htmlspecialchars($row["imie_nazwisko"]).'</td>';
    echo '<td><span class="td-wiek">'.$row["wiek"].'</span></td>';
    echo '<td class="td-overall" style="color:'.$overall_color.'">'.$row["overall"].'</td>';
    echo '<td><a href="sklad.php?edit='.$row["id"].'"><button class="btn-edit">Edytuj</button></a></td>';
    echo '</tr>';
}
?>

<div class="page-hero">
  <h1>Podstawowy <span>Sklad</span></h1>
  <p>Aktualny sklad FC Barcelony – zawodnicy podstawowi i rezerwowi.</p>
</div>

<div class="page-content">

  <?php if (isset($_GET["ok"])): ?>
    <div class="msg-ok">Zapisano zmiany!</div>
  <?php endif; ?>

  <!-- ===== TABELA SKLADU ===== -->
  <div class="sklad-wrap">
    <table class="sklad-table">
      <thead>
        <tr>
          <th>Numer</th>
          <th>Pozycja</th>
          <th>Imie i Nazwisko</th>
          <th>Wiek</th>
          <th>Overall</th>
          <th></th>
        </tr>
      </thead>
      <tbody>

        <!-- PODSTAWOWI -->
        <tr class="group-header">
          <td colspan="6">Podstawowy Skład</td>
        </tr>
        <?php foreach ($podstawowi as $r) playerRow($r); ?>

        <!-- REZERWOWI -->
        <tr class="group-header" style="margin-top:1rem;">
          <td colspan="6">Rezerwowi</td>
        </tr>
        <?php foreach ($rezerwowi as $r) playerRow($r); ?>

      </tbody>
    </table>
  </div>

  <!-- ===== PANEL EDYCJI ===== -->
  <div class="form-section">
    <div class="section-title">Edytuj Zawodnika</div>

    <?php if ($edit === null): ?>
      <p class="hint-txt">Kliknij <strong>Edytuj</strong> przy zawodniku w tabeli powyzej, aby zmienic jego dane.</p>
    <?php else: ?>
      <form class="fcb-form" method="post" action="sklad.php">
        <input type="hidden" name="id" value="<?= (int)$edit["id"] ?>">
        <div class="form-editing-name"><?= htmlspecialchars($edit["imie_nazwisko"]) ?></div>

        <div class="form-row">
          <label for="imie_nazwisko">Imie i Nazwisko</label>
          <input id="imie_nazwisko" type="text" name="imie_nazwisko"
                 value="<?= htmlspecialchars($edit["imie_nazwisko"]) ?>" required>
        </div>
        <div class="form-row">
          <label for="numer">Numer</label>
          <input id="numer" type="number" name="numer" min="1" max="99"
                 value="<?= (int)$edit["numer"] ?>" required>
        </div>
        <div class="form-row">
          <label for="pozycja">Pozycja</label>
          <select id="pozycja" name="pozycja">
            <?php
              $pozycje = ['BR','SO','LO','PO','SPD','SP','LS','PS','N'];
              foreach ($pozycje as $poz):
                $sel = (strtoupper($edit["pozycja"]) == $poz) ? 'selected' : '';
            ?>
              <option value="<?= $poz ?>" <?= $sel ?>><?= $poz ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-row">
          <label for="wiek">Wiek</label>
          <input id="wiek" type="number" name="wiek" min="15" max="45"
                 value="<?= (int)$edit["wiek"] ?>" required>
        </div>
        <div class="form-row">
          <label for="overall">Overall</label>
          <input id="overall" type="number" name="overall" min="1" max="99"
                 value="<?= (int)$edit["overall"] ?>" required>
        </div>
        <div class="form-row">
          <label for="typ">Typ skladu</label>
          <select id="typ" name="typ">
            <option value="podstawowy" <?= $edit["typ"]=="podstawowy"?"selected":"" ?>>Podstawowy</option>
            <option value="rezerwowy"  <?= $edit["typ"]=="rezerwowy" ?"selected":"" ?>>Rezerwowy</option>
          </select>
        </div>

        <button type="submit" name="zapisz" class="btn-zapisz">Zapisz zmiany</button>
      </form>
    <?php endif; ?>

  </div>

</div>

<footer>&copy; 2026 <span>FC Barcelona</span> - Witryna stworzona na potrzeby projektu FIFA Kariera</footer>

</body>
</html>

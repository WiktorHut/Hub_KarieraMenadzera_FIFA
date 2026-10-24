<?php require 'auth.php'; ?>
<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>FC Barcelona - Gablota Pucharów</title>
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:ital,wght@0,300;0,400;0,600;0,700;1,300&display=swap" rel="stylesheet"/>
  <style>
    :root {
      --blau:#004D98; --grana:#A50044; --gold:#EDBB00;
      --dark:#0a0a12; --darker:#06060e; --light:#f0e8d8; --muted:#9a8f7e;
      --card-bg:rgba(255,255,255,0.04); --border:rgba(164,0,68,0.35);
      --border-blue:rgba(0,77,152,0.4);
      --font-display:'Bebas Neue',sans-serif; --font-body:'Barlow',sans-serif;
      --nav-h:70px;
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
    .section-title{font-family:var(--font-display);font-size:2rem;letter-spacing:.1em;border-left:5px solid var(--grana);padding-left:1rem;margin-bottom:1.8rem;}
    .gablota-cols{display:grid;grid-template-columns:1fr 1fr;gap:2rem;}
    @media(max-width:800px){.gablota-cols{grid-template-columns:1fr;}}
    .col-header{font-family:var(--font-display);font-size:1.4rem;letter-spacing:.15em;text-align:center;padding:.7rem 1rem;border-radius:6px 6px 0 0;margin-bottom:.6rem;}
    .col-header.domowe{background:linear-gradient(90deg,var(--blau),#0066cc);}
    .col-header.kontynentalne{background:linear-gradient(90deg,var(--grana),#cc0055);}
    .trofea-lista{display:flex;flex-direction:column;gap:.8rem;}
    .trofe-card{background:var(--card-bg);border:1px solid var(--border-blue);border-radius:8px;overflow:hidden;transition:transform .22s,border-color .22s,box-shadow .22s;}
    .trofe-card:hover{transform:translateY(-3px);border-color:var(--gold);box-shadow:0 6px 28px rgba(237,187,0,.12);}
    .trofe-name{background:linear-gradient(90deg,var(--blau) 0%,var(--grana) 100%);font-family:var(--font-display);font-size:1rem;letter-spacing:.12em;padding:.45rem 1.2rem;text-align:center;}
    .trofe-body{display:flex;align-items:center;gap:1.5rem;padding:1rem 1.5rem;background:rgba(255,255,255,.025);}
    .trofe-img{width:80px;height:80px;object-fit:contain;flex-shrink:0;filter:drop-shadow(0 2px 8px rgba(0,0,0,.6));}
    .trofe-img-placeholder{width:80px;height:80px;background:rgba(255,255,255,.06);border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:.6rem;color:var(--muted);text-align:center;letter-spacing:.05em;text-transform:uppercase;flex-shrink:0;line-height:1.4;}
    .trofe-count{font-family:var(--font-display);font-size:clamp(3.5rem,6vw,5rem);color:var(--blau);line-height:1;text-shadow:0 0 30px rgba(0,77,152,.4);flex:1;text-align:center;}
    .trofe-count.zero{color:rgba(154,143,126,.4);}
    .form-section{margin-top:4rem;padding-top:2.5rem;border-top:1px solid var(--border);}
    .hint-txt{color:var(--muted);font-size:.95rem;margin-bottom:1.5rem;}
    .hint-txt strong{color:var(--gold);}
    .fcb-form{background:rgba(0,77,152,.08);border:1px solid var(--border-blue);border-radius:10px;padding:2rem;max-width:560px;}
    .form-editing-name{font-family:var(--font-display);font-size:1.3rem;color:var(--gold);letter-spacing:.1em;margin-bottom:1.2rem;}
    .form-row{display:grid;grid-template-columns:160px 1fr;align-items:center;gap:.6rem;margin-bottom:1rem;}
    .form-row label{font-size:.82rem;text-transform:uppercase;letter-spacing:.08em;color:var(--muted);font-weight:600;}
    .form-row input{background:rgba(255,255,255,.07);border:1px solid var(--border-blue);border-radius:5px;color:var(--light);font-family:var(--font-body);font-size:.95rem;padding:.5rem .8rem;width:100%;transition:border-color .2s;}
    .form-row input:focus{outline:none;border-color:var(--gold);}
    .btn-zapisz{margin-top:.5rem;background:linear-gradient(90deg,var(--grana),var(--blau));color:#fff;border:none;border-radius:5px;font-family:var(--font-display);font-size:1.1rem;letter-spacing:.12em;padding:.6rem 2.5rem;cursor:pointer;transition:opacity .2s,transform .15s;}
    .btn-zapisz:hover{opacity:.88;transform:translateY(-2px);}
    .edit-table-wrap{margin-top:2.5rem;overflow-x:auto;}
    table{width:100%;border-collapse:collapse;font-size:.9rem;}
    thead tr{background:linear-gradient(90deg,var(--blau),var(--grana));}
    thead th{padding:.75rem 1rem;text-align:left;font-family:var(--font-display);letter-spacing:.1em;font-weight:400;white-space:nowrap;}
    tbody tr{border-bottom:1px solid rgba(255,255,255,.06);transition:background .15s;}
    tbody tr:hover{background:rgba(255,255,255,.04);}
    tbody td{padding:.6rem 1rem;color:rgba(240,232,216,.82);}
    .td-gold{color:var(--gold);font-weight:600;}
    .btn-edit{background:var(--blau);color:#fff;border:none;border-radius:4px;font-family:var(--font-display);letter-spacing:.08em;font-size:.85rem;padding:.3rem .9rem;cursor:pointer;transition:background .2s;}
    .btn-edit:hover{background:var(--grana);}
    .msg-ok{background:rgba(0,152,77,.15);border:1px solid rgba(0,200,100,.3);border-radius:6px;padding:.7rem 1.2rem;margin-bottom:1.5rem;font-size:.9rem;color:#7effc0;}
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
    <li><a href="gablota_pucharow.php" class="active">Gablota Pucharów</a></li>
    <li><a href="sklad.php">Skład</a></li>
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

// TYLKO UPDATE - bez dodawania
if (isset($_POST["zapisz"])) {
    $id      = (int)$_POST["id"];
    $ilosc   = (int)$_POST["ilosc"];
    $zdjecie = mysqli_real_escape_string($conn, trim($_POST["zdjecie"]));
    if ($id > 0) {
        mysqli_query($conn, "UPDATE puchary SET ilosc=$ilosc, zdjecie='$zdjecie' WHERE id=$id");
    }
    echo "<script>window.location='gablota_pucharow.php?ok=1';</script>";
    exit;
}

// ZALADUJ DO EDYCJI
$edit = null;
if (isset($_GET["edit"])) {
    $id_get = (int)$_GET["edit"];
    $res = mysqli_query($conn, "SELECT * FROM puchary WHERE id=$id_get");
    if ($res && mysqli_num_rows($res) > 0) $edit = mysqli_fetch_assoc($res);
}

// DANE DO GABLOTY
$domowe_rows = []; $kontyn_rows = [];
$res_d = mysqli_query($conn, "SELECT * FROM puchary WHERE kategoria='domowe' ORDER BY id");
$res_k = mysqli_query($conn, "SELECT * FROM puchary WHERE kategoria='kontynentalne' ORDER BY id");
if ($res_d) while ($r = mysqli_fetch_assoc($res_d)) $domowe_rows[] = $r;
if ($res_k) while ($r = mysqli_fetch_assoc($res_k)) $kontyn_rows[] = $r;

function renderTrofe($row) {
    $zero = ($row["ilosc"] == 0) ? " zero" : "";
    $img  = !empty($row["zdjecie"])
        ? '<img class="trofe-img" src="'.htmlspecialchars($row["zdjecie"]).'" alt="'.htmlspecialchars($row["nazwa"]).'" onerror="this.style.display=\'none\'">'
        : '<div class="trofe-img-placeholder">brak<br>zdjecia</div>';
    echo '<div class="trofe-card">
      <div class="trofe-name">'.htmlspecialchars($row["nazwa"]).'</div>
      <div class="trofe-body">'.$img.'<div class="trofe-count'.$zero.'">'.(int)$row["ilosc"].'</div></div>
    </div>';
}
?>

<div class="page-hero">
  <h1>Gablota <span>Pucharów</span></h1>
  <p>Trofea zdobyte przez FC Barcelone w rozgrywkach krajowych i europejskich.</p>
</div>

<div class="page-content">

  <?php if (isset($_GET["ok"])): ?>
    <div class="msg-ok">Zapisano zmiany!</div>
  <?php endif; ?>

  <div class="section-title">Trofea</div>
  <div class="gablota-cols">
    <div>
      <div class="col-header domowe">Domowe</div>
      <div class="trofea-lista">
        <?php if (!empty($domowe_rows)) foreach ($domowe_rows as $r) renderTrofe($r);
              else echo '<p style="color:var(--muted);padding:.8rem;">Brak danych.</p>'; ?>
      </div>
    </div>
    <div>
      <div class="col-header kontynentalne">Kontynentalne</div>
      <div class="trofea-lista">
        <?php if (!empty($kontyn_rows)) foreach ($kontyn_rows as $r) renderTrofe($r);
              else echo '<p style="color:var(--muted);padding:.8rem;">Brak danych.</p>'; ?>
      </div>
    </div>
  </div>

  <!-- PANEL EDYCJI -->
  <div class="form-section">
    <div class="section-title">Edytuj Trofeum</div>

    <?php if ($edit === null): ?>
      <p class="hint-txt">Kliknij <strong>Edytuj</strong> przy trofeum w tabeli ponizej, aby zmienic jego ilosc lub zdjecie.</p>
    <?php else: ?>
      <form class="fcb-form" method="post" action="gablota_pucharow.php">
        <input type="hidden" name="id" value="<?= (int)$edit["id"] ?>">
        <div class="form-editing-name"><?= htmlspecialchars($edit["nazwa"]) ?></div>
        <div class="form-row">
          <label for="ilosc">Ilosc</label>
          <input id="ilosc" type="number" name="ilosc" min="0" value="<?= (int)$edit["ilosc"] ?>" required>
        </div>
        <div class="form-row">
          <label for="zdjecie">Plik zdjecia</label>
          <input id="zdjecie" type="text" name="zdjecie" placeholder="np. puchar_laliga.png" value="<?= htmlspecialchars($edit["zdjecie"]) ?>">
        </div>
        <button type="submit" name="zapisz" class="btn-zapisz">Zapisz zmiany</button>
      </form>
    <?php endif; ?>

    <div class="edit-table-wrap">
      <div class="section-title" style="font-size:1.4rem;margin-top:2rem;">Wszystkie rekordy</div>
      <table>
        <thead><tr><th>ID</th><th>Nazwa</th><th>Kategoria</th><th>Ilosc</th><th>Zdjecie</th><th>Akcja</th></tr></thead>
        <tbody>
        <?php
          $all = mysqli_query($conn, "SELECT * FROM puchary ORDER BY kategoria, id");
          if ($all && mysqli_num_rows($all) > 0):
            while ($row = mysqli_fetch_assoc($all)):
        ?>
          <tr>
            <td class="td-gold"><?= $row["id"] ?></td>
            <td><?= htmlspecialchars($row["nazwa"]) ?></td>
            <td><?= $row["kategoria"] ?></td>
            <td class="td-gold"><?= $row["ilosc"] ?></td>
            <td style="font-size:.8rem;color:var(--muted)"><?= htmlspecialchars($row["zdjecie"]) ?></td>
            <td><a href="gablota_pucharow.php?edit=<?= $row["id"] ?>"><button class="btn-edit">Edytuj</button></a></td>
          </tr>
        <?php endwhile; else: echo '<tr><td colspan="6" style="color:var(--muted);padding:1rem;">Brak rekordow.</td></tr>'; endif; ?>
        </tbody>
      </table>
    </div>
  </div>

</div>

<footer>&copy; 2026 <span>FC Barcelona</span> - Witryna stworzona na potrzeby projektu FIFA Kariera</footer>

</body>
</html>

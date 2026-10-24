<?php require 'auth.php'; ?>
<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>FC Barcelona - Baza Bylych Zawodnikow</title>
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:ital,wght@0,300;0,400;0,600;0,700;1,300&display=swap" rel="stylesheet"/>
  <style>
    :root {
      --blau:#004D98; --grana:#A50044; --gold:#EDBB00;
      --dark:#0a0a12; --darker:#06060e; --light:#f0e8d8; --muted:#9a8f7e;
      --card-bg:rgba(255,255,255,0.04); --border:rgba(164,0,68,0.35);
      --border-blue:rgba(0,77,152,0.4);
      --font-display:'Bebas Neue',sans-serif; --font-body:'Barlow',sans-serif;
      --nav-h:70px;
      --pos-br:#16a34a; --pos-so:#dc2626; --pos-lo:#dc2626; --pos-po:#dc2626;
      --pos-spd:#0ea5e9; --pos-sp:#0ea5e9; --pos-ls:#7c3aed; --pos-ps:#7c3aed; --pos-n:#7c3aed;
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

    .page-hero{padding:3.5rem 2rem 2.5rem;max-width:1500px;margin:0 auto;border-bottom:1px solid var(--border);}
    .page-hero h1{font-family:var(--font-display);font-size:clamp(2.8rem,6vw,5.5rem);letter-spacing:.06em;color:#fff;line-height:1;}
    .page-hero h1 span{color:var(--gold);}
    .page-hero p{color:var(--muted);font-size:1rem;margin-top:.5rem;}
    .page-content{max-width:1500px;margin:0 auto;padding:3rem 2rem 5rem;}
    .section-title{font-family:var(--font-display);font-size:2rem;letter-spacing:.1em;border-left:5px solid var(--grana);padding-left:1rem;margin-bottom:1.5rem;}

    /* ===== TABELA BYLYCH ===== */
    .table-wrap{overflow-x:auto;margin-bottom:3rem;}
    .main-table{width:100%;border-collapse:collapse;font-size:.88rem;}
    .main-table thead tr{background:linear-gradient(90deg,var(--blau),var(--grana));}
    .main-table thead th{padding:.75rem .8rem;text-align:center;font-family:var(--font-display);letter-spacing:.1em;font-weight:400;white-space:nowrap;}
    .main-table thead th.th-name{text-align:left;padding-left:1rem;}
    .main-table tbody tr{border-bottom:1px solid rgba(255,255,255,.06);transition:background .15s;}
    .main-table tbody tr:hover{background:rgba(255,255,255,.04);}
    .main-table tbody td{padding:.6rem .8rem;text-align:center;color:rgba(240,232,216,.88);}
    .main-table tbody td.td-name{text-align:left;font-weight:600;padding-left:1rem;}

    /* separator pozycji */
    .main-table .pos-sep td{
      background:linear-gradient(90deg,var(--blau),var(--grana));
      font-family:var(--font-display);font-size:.95rem;
      letter-spacing:.15em;padding:.5rem 1rem;text-align:center;
    }

    /* zdjecie zawodnika */
    .zawodnik-img{width:56px;height:56px;object-fit:cover;border-radius:6px;border:2px solid var(--border-blue);}
    .zawodnik-img-ph{width:56px;height:56px;background:rgba(255,255,255,.06);border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:.55rem;color:var(--muted);text-transform:uppercase;text-align:center;line-height:1.3;margin:auto;}

    /* pozycja badge */
    .pos-badge{display:inline-block;padding:.15rem .55rem;border-radius:4px;font-family:var(--font-display);font-size:.82rem;letter-spacing:.08em;color:#fff;min-width:38px;text-align:center;}
    .pos-BR{background:var(--pos-br);} .pos-SO{background:var(--pos-so);} .pos-LO{background:var(--pos-lo);}
    .pos-PO{background:var(--pos-po);} .pos-SPD{background:var(--pos-spd);} .pos-SP{background:var(--pos-sp);}
    .pos-LS{background:var(--pos-ls);} .pos-PS{background:var(--pos-ps);} .pos-N{background:var(--pos-n);}

    /* overall arrow */
    .ovr-wrap{display:flex;align-items:center;justify-content:center;gap:.4rem;font-family:var(--font-display);font-size:1rem;}
    .ovr-start{color:var(--muted);}
    .ovr-arrow{color:rgba(255,255,255,.3);font-size:.8rem;}
    .ovr-end{font-weight:700;}

    /* skup/sprzedaz */
    .td-money{color:var(--gold);font-weight:600;}

    /* gack */
    .td-gack{color:#7effc0;font-weight:600;}

    /* btn edytuj/usun */
    .btn-edit{background:var(--blau);color:#fff;border:none;border-radius:4px;font-family:var(--font-display);letter-spacing:.08em;font-size:.82rem;padding:.28rem .8rem;cursor:pointer;transition:background .2s;margin-right:.3rem;}
    .btn-edit:hover{background:#0066cc;}
    .btn-del{background:rgba(164,0,68,.7);color:#fff;border:none;border-radius:4px;font-family:var(--font-display);letter-spacing:.08em;font-size:.82rem;padding:.28rem .8rem;cursor:pointer;transition:background .2s;}
    .btn-del:hover{background:var(--grana);}

    /* ===== FORMULARZ ===== */
    .form-section{padding-top:2.5rem;border-top:1px solid var(--border);}
    .fcb-form{background:rgba(0,77,152,.08);border:1px solid var(--border-blue);border-radius:10px;padding:2rem;max-width:680px;}
    .form-grid{display:grid;grid-template-columns:1fr 1fr;gap:1rem;}
    @media(max-width:600px){.form-grid{grid-template-columns:1fr;}}
    .form-row{display:flex;flex-direction:column;gap:.35rem;}
    .form-row label{font-size:.78rem;text-transform:uppercase;letter-spacing:.08em;color:var(--muted);font-weight:600;}
    .form-row input,.form-row select{
      background:rgba(255,255,255,.07);border:1px solid var(--border-blue);
      border-radius:5px;color:var(--light);font-family:var(--font-body);
      font-size:.92rem;padding:.5rem .75rem;width:100%;transition:border-color .2s;
    }
    .form-row input:focus,.form-row select:focus{outline:none;border-color:var(--gold);}
    .form-row select option{background:#0a0a12;}
    .form-row.full{grid-column:1/-1;}
    .btn-zapisz{margin-top:1.2rem;background:linear-gradient(90deg,var(--grana),var(--blau));color:#fff;border:none;border-radius:5px;font-family:var(--font-display);font-size:1.1rem;letter-spacing:.12em;padding:.6rem 2.5rem;cursor:pointer;transition:opacity .2s,transform .15s;}
    .btn-zapisz:hover{opacity:.88;transform:translateY(-2px);}
    .btn-anuluj{margin-top:1.2rem;margin-left:.8rem;background:rgba(255,255,255,.08);color:var(--muted);border:1px solid rgba(255,255,255,.1);border-radius:5px;font-family:var(--font-display);font-size:1rem;letter-spacing:.1em;padding:.6rem 1.5rem;cursor:pointer;transition:background .2s;}
    .btn-anuluj:hover{background:rgba(255,255,255,.15);}
    .form-editing-name{font-family:var(--font-display);font-size:1.2rem;color:var(--gold);letter-spacing:.1em;margin-bottom:1.2rem;}

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
    <li><a href="gablota_pucharow.php">Gablota Pucharów</a></li>
    <li><a href="sklad.php">Skład</a></li>
    <li><a href="statystyki.php">Statystyki Sezonowe</a></li>
    <li><a href="sezony.php">Sezony</a></li>
    <li><a href="byli_zawodnicy.php" class="active">Baza Byłych Zawodników</a></li>
    <li><a href="akademia.php">Akademia</a></li>
    <li><a href="trener.php">Gabinet Trenera</a></li>
    <li><a href="logout.php">Wyloguj</a></li>
  </ul>
</nav>

<?php
$conn = mysqli_connect("localhost","root","","barcelona");
if (!$conn) die("<p style='color:red;padding:2rem'>Blad polaczenia: ".mysqli_connect_error()."</p>");

$pozycje_kolejnosc = ['BR','LO','PO','SO','SPD','SP','LS','PS','N'];

// ── USUN ──────────────────────────────────────────────────────
if (isset($_GET["del"])) {
    $del_id = (int)$_GET["del"];
    if ($del_id > 0) mysqli_query($conn,"DELETE FROM byli_zawodnicy WHERE id=$del_id");
    echo "<script>window.location='byli_zawodnicy.php?ok=1';</script>"; exit;
}

// ── ZAPIS / EDYCJA ────────────────────────────────────────────
if (isset($_POST["zapisz"])) {
    $id             = (int)$_POST["id"];
    $imie_nazwisko  = mysqli_real_escape_string($conn, trim($_POST["imie_nazwisko"]));
    $narodowos      = mysqli_real_escape_string($conn, trim($_POST["narodowos"]));
    $wiek_odejscia  = (int)$_POST["wiek_odejscia"];
    $overall_start  = (int)$_POST["overall_start"];
    $overall_koniec = (int)$_POST["overall_koniec"];
    $gack           = mysqli_real_escape_string($conn, trim($_POST["gack"]));
    $pozycja        = mysqli_real_escape_string($conn, strtoupper(trim($_POST["pozycja"])));
    $skup           = mysqli_real_escape_string($conn, trim($_POST["skup"]));
    $sprzedaz       = mysqli_real_escape_string($conn, trim($_POST["sprzedaz"]));
    $zdjecie        = mysqli_real_escape_string($conn, trim($_POST["zdjecie"]));

    if ($id > 0) {
        mysqli_query($conn,
            "UPDATE byli_zawodnicy SET
                imie_nazwisko='$imie_nazwisko', narodowos='$narodowos',
                wiek_odejscia=$wiek_odejscia, overall_start=$overall_start,
                overall_koniec=$overall_koniec, gack='$gack',
                pozycja='$pozycja', skup='$skup', sprzedaz='$sprzedaz',
                zdjecie='$zdjecie'
             WHERE id=$id");
    } else {
        mysqli_query($conn,
            "INSERT INTO byli_zawodnicy
                (imie_nazwisko,narodowos,wiek_odejscia,overall_start,overall_koniec,gack,pozycja,skup,sprzedaz,zdjecie)
             VALUES
                ('$imie_nazwisko','$narodowos',$wiek_odejscia,$overall_start,$overall_koniec,'$gack','$pozycja','$skup','$sprzedaz','$zdjecie')");
    }
    echo "<script>window.location='byli_zawodnicy.php?ok=1';</script>"; exit;
}

// ── EDYCJA – zaladuj rekord ───────────────────────────────────
$edit = null;
if (isset($_GET["edit"])) {
    $eid = (int)$_GET["edit"];
    $res = mysqli_query($conn,"SELECT * FROM byli_zawodnicy WHERE id=$eid");
    if ($res && mysqli_num_rows($res)>0) $edit = mysqli_fetch_assoc($res);
}

// ── POBIERZ DANE – posortowane wg pozycji ────────────────────
$kolejnosc = implode("','", $pozycje_kolejnosc);
$res_all   = mysqli_query($conn,
    "SELECT * FROM byli_zawodnicy ORDER BY FIELD(pozycja,'$kolejnosc'), imie_nazwisko");

$zawodnicy_by_pos = [];
if ($res_all) {
    while ($r = mysqli_fetch_assoc($res_all)) {
        $zawodnicy_by_pos[$r['pozycja']][] = $r;
    }
}

// helpers
function posBadge($pos) {
    $p = strtoupper(trim($pos));
    return '<span class="pos-badge pos-'.$p.'">'.$p.'</span>';
}
function overallColor($v) {
    if ($v >= 88) return '#6200ff';
    if ($v >= 84) return '#59ff00';
    if ($v >= 80) return '#ffaa00';
    return '#eeff00';
}
function renderImg($zdjecie, $imie) {
    if (!empty($zdjecie)) {
        return '<img class="zawodnik-img" src="'.htmlspecialchars($zdjecie).'" alt="'.htmlspecialchars($imie).'" onerror="this.style.display=\'none\'">';
    }
    return '<div class="zawodnik-img-ph">brak<br>zdjecia</div>';
}
?>

<div class="page-hero">
  <h1>Byli <span>Zawodnicy</span></h1>
  <p>Baza zawodników którzy opuścili FC Barcelone w trakcie kariery menadżerskiej.</p>
</div>

<div class="page-content">

  <?php if (isset($_GET["ok"])): ?>
    <div class="msg-ok">Operacja zakonczona pomyslnie!</div>
  <?php endif; ?>

  <!-- ===== TABELA ===== -->
  <div class="section-title">Lista Byłych Zawodników</div>

  <?php
  $jest_ktokolwiek = false;
  foreach ($pozycje_kolejnosc as $poz) {
      if (!empty($zawodnicy_by_pos[$poz])) { $jest_ktokolwiek = true; break; }
  }
  if (!$jest_ktokolwiek):
  ?>
    <p style="color:var(--muted);margin-bottom:2rem;">Brak zawodnikow w bazie. Dodaj pierwszego uzywajac formularza ponizej.</p>
  <?php else: ?>

  <div class="table-wrap">
  <table class="main-table">
    <thead>
      <tr>
        <th>Zdjęcie</th>
        <th class="th-name">Imię i Nazwisko</th>
        <th>Wiek odejścia</th>
        <th>Narodowość</th>
        <th>Overall</th>
        <th>M/G/A/CK</th>
        <th>Pozycja</th>
        <th>Skup</th>
        <th>Sprzedaż</th>
        <th>Akcja</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($pozycje_kolejnosc as $poz):
        if (empty($zawodnicy_by_pos[$poz])) continue;
    ?>
      <tr class="pos-sep">
        <td colspan="10"><?= $poz ?></td>
      </tr>
      <?php foreach ($zawodnicy_by_pos[$poz] as $row):
          $ovr_end_color = overallColor($row['overall_koniec']);
      ?>
      <tr>
        <td><?= renderImg($row['zdjecie'], $row['imie_nazwisko']) ?></td>
        <td class="td-name"><?= htmlspecialchars($row['imie_nazwisko']) ?></td>
        <td><?= $row['wiek_odejscia'] > 0 ? $row['wiek_odejscia'] : '?' ?></td>
        <td><?= htmlspecialchars($row['narodowos']) ?></td>
        <td>
          <div class="ovr-wrap">
            <span class="ovr-start" style="color:<?= overallColor($row['overall_start']) ?>"><?= $row['overall_start'] ?></span>
            <span class="ovr-arrow">→</span>
            <span class="ovr-end" style="color:<?= $ovr_end_color ?>"><?= $row['overall_koniec'] ?></span>
          </div>
        </td>
        <td class="td-gack"><?= htmlspecialchars($row['gack']) ?: '—' ?></td>
        <td><?= posBadge($row['pozycja']) ?></td>
        <td class="td-money"><?= htmlspecialchars($row['skup']) ?: '—' ?></td>
        <td class="td-money"><?= htmlspecialchars($row['sprzedaz']) ?: '—' ?></td>
        <td style="white-space:nowrap;">
          <a href="byli_zawodnicy.php?edit=<?= $row['id'] ?>">
            <button class="btn-edit">Edytuj</button>
          </a>
          <a href="byli_zawodnicy.php?del=<?= $row['id'] ?>"
             onclick="return confirm('Usunac <?= addslashes(htmlspecialchars($row['imie_nazwisko'])) ?>?')">
            <button class="btn-del">Usun</button>
          </a>
        </td>
      </tr>
      <?php endforeach; ?>
    <?php endforeach; ?>
    </tbody>
  </table>
  </div>
  <?php endif; ?>

  <!-- ===== FORMULARZ ===== -->
  <div class="form-section">
    <div class="section-title">
      <?= $edit ? 'Edytuj Zawodnika' : 'Dodaj Bylego Zawodnika' ?>
    </div>

    <?php if ($edit): ?>
      <div class="form-editing-name"><?= htmlspecialchars($edit['imie_nazwisko']) ?></div>
    <?php endif; ?>

    <form class="fcb-form" method="post" action="byli_zawodnicy.php">
      <input type="hidden" name="id" value="<?= $edit ? (int)$edit['id'] : '' ?>">

      <div class="form-grid">

        <div class="form-row full">
          <label>Imię i Nazwisko</label>
          <input type="text" name="imie_nazwisko" required
                 value="<?= $edit ? htmlspecialchars($edit['imie_nazwisko']) : '' ?>">
        </div>

        <div class="form-row">
          <label>Narodowość</label>
          <input type="text" name="narodowos"
                 value="<?= $edit ? htmlspecialchars($edit['narodowos']) : '' ?>">
        </div>

        <div class="form-row">
          <label>Wiek przy odejściu</label>
          <input type="number" name="wiek_odejscia" min="15" max="50"
                 value="<?= $edit ? (int)$edit['wiek_odejscia'] : '' ?>">
        </div>

        <div class="form-row">
          <label>Overall – poczatek (np. 86)</label>
          <input type="number" name="overall_start" min="1" max="99"
                 value="<?= $edit ? (int)$edit['overall_start'] : '' ?>">
        </div>

        <div class="form-row">
          <label>Overall – koniec (np. 91)</label>
          <input type="number" name="overall_koniec" min="1" max="99"
                 value="<?= $edit ? (int)$edit['overall_koniec'] : '' ?>">
        </div>

        <div class="form-row">
          <label>M/G/A/CK (np. 45/30/12)</label>
          <input type="text" name="gack" placeholder="np. 45/30/15/12"
                 value="<?= $edit ? htmlspecialchars($edit['gack']) : '' ?>">
        </div>

        <div class="form-row">
          <label>Pozycja</label>
          <select name="pozycja">
            <?php foreach ($pozycje_kolejnosc as $poz):
                $sel = ($edit && strtoupper($edit['pozycja'])===$poz) ? 'selected' : '';
            ?>
              <option value="<?= $poz ?>" <?= $sel ?>><?= $poz ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form-row">
          <label>Skup (np. 25 mln.)</label>
          <input type="text" name="skup" placeholder="np. 25 mln. / Akademia / Wolny transfer"
                 value="<?= $edit ? htmlspecialchars($edit['skup']) : '' ?>">
        </div>

        <div class="form-row">
          <label>Sprzedaż (np. 80 mln.)</label>
          <input type="text" name="sprzedaz" placeholder="np. 80 mln. / Koniec kontraktu"
                 value="<?= $edit ? htmlspecialchars($edit['sprzedaz']) : '' ?>">
        </div>

        <div class="form-row full">
          <label>Plik zdjęcia (np. garcia.png)</label>
          <input type="text" name="zdjecie" placeholder="np. zawodnik_garcia.png"
                 value="<?= $edit ? htmlspecialchars($edit['zdjecie']) : '' ?>">
        </div>

      </div><!-- /form-grid -->

      <button type="submit" name="zapisz" class="btn-zapisz">
        <?= $edit ? 'Zapisz zmiany' : 'Dodaj zawodnika' ?>
      </button>
      <?php if ($edit): ?>
        <a href="byli_zawodnicy.php">
          <button type="button" class="btn-anuluj">Anuluj</button>
        </a>
      <?php endif; ?>
    </form>
  </div>

</div>

<footer>&copy; 2026 <span>FC Barcelona</span> - Witryna stworzona na potrzeby projektu FIFA Kariera</footer>
</body>
</html>

<?php require 'auth.php'; ?>
<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>FC Barcelona - Statystyki Sezonowe</title>
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

    .page-hero{padding:3.5rem 2rem 2.5rem;max-width:1700px;margin:0 auto;border-bottom:1px solid var(--border);}
    .page-hero h1{font-family:var(--font-display);font-size:clamp(2.8rem,6vw,5.5rem);letter-spacing:.06em;color:#fff;line-height:1;}
    .page-hero h1 span{color:var(--gold);}
    .page-hero p{color:var(--muted);font-size:1rem;margin-top:.5rem;}

    .page-content{max-width:1700px;margin:0 auto;padding:3rem 2rem 5rem;}
    .section-title{font-family:var(--font-display);font-size:2rem;letter-spacing:.1em;border-left:5px solid var(--grana);padding-left:1rem;margin-bottom:1.5rem;}

    /* ===== DUZA TABELA STATYSTYK ===== */
    .stats-wrap{overflow-x:auto;margin-bottom:3rem;}
    .stats-table{border-collapse:collapse;font-size:.82rem;white-space:nowrap;}

    /* naglowki sezonow - row 1 */
    .stats-table .hdr-season td,
    .stats-table .hdr-season th {
      background: var(--blau);
      font-family:var(--font-display);
      font-size:.9rem;
      letter-spacing:.12em;
      text-align:center;
      padding:.5rem .6rem;
      border:1px solid rgba(255,255,255,.1);
      color:#fff;
    }
    .stats-table .hdr-season td.info-cell {
      background: linear-gradient(90deg,var(--blau),var(--grana));
    }

    /* naglowki kolumn - row 2 */
    .stats-table .hdr-cols th {
      background: var(--grana);
      font-family:var(--font-display);
      font-size:.78rem;
      letter-spacing:.08em;
      padding:.45rem .5rem;
      text-align:center;
      border:1px solid rgba(255,255,255,.1);
    }
    .stats-table .hdr-cols th.info-hdr {
      background: linear-gradient(90deg,var(--blau),var(--grana));
      min-width:40px;
    }
    .stats-table .hdr-cols th.name-hdr {
      min-width:160px;
      text-align:left;
      padding-left:.8rem;
    }

    /* wiersze danych */
    .stats-table tbody tr{border-bottom:1px solid rgba(255,255,255,.06);transition:background .15s;}
    .stats-table tbody tr:hover{background:rgba(255,255,255,.04);}
    .stats-table tbody td{
      padding:.5rem .5rem;
      text-align:center;
      border:1px solid rgba(255,255,255,.06);
      color:rgba(240,232,216,.85);
    }

    /* sekcja separator */
    .stats-table .group-sep td{
      background:linear-gradient(90deg,var(--blau),var(--grana));
      font-family:var(--font-display);
      font-size:.95rem;
      letter-spacing:.15em;
      padding:.5rem 1rem;
      text-align:center;
    }

    .td-numer{font-family:var(--font-display);font-size:1rem;color:var(--gold);}
    .td-name{text-align:left !important;font-weight:600;padding-left:.8rem !important;min-width:160px;}

    .pos-badge{display:inline-block;padding:.1rem .45rem;border-radius:3px;font-family:var(--font-display);font-size:.78rem;color:#fff;min-width:36px;text-align:center;}
    .pos-BR{background:var(--pos-br);} .pos-SO{background:var(--pos-so);} .pos-LO{background:var(--pos-lo);}
    .pos-PO{background:var(--pos-po);} .pos-SPD{background:var(--pos-spd);} .pos-SP{background:var(--pos-sp);}
    .pos-LS{background:var(--pos-ls);} .pos-PS{background:var(--pos-ps);} .pos-N{background:var(--pos-n);}

    .td-wiek{background:var(--grana);border-radius:3px;font-weight:700;color:#fff;padding:.1rem .45rem;display:inline-block;min-width:30px;}
    .td-overall{font-family:var(--font-display);font-size:1rem;font-weight:700;}

    /* komorki edytowalne */
    .stat-cell{cursor:pointer;min-width:55px;position:relative;}
    .stat-cell:hover{background:rgba(0,77,152,.25) !important;}
    .stat-cell.editing{background:rgba(0,77,152,.35) !important;padding:0 !important;}
    .stat-cell input{
      width:100%;height:100%;background:transparent;border:none;
      color:var(--gold);font-family:var(--font-body);font-size:.82rem;
      text-align:center;padding:.5rem .3rem;outline:none;
    }
    .stat-cell.has-value{color:var(--gold);font-weight:600;}

    /* przycisk zapisz wszystko */
    .btn-save-all{
      background:linear-gradient(90deg,var(--grana),var(--blau));
      color:#fff;border:none;border-radius:6px;
      font-family:var(--font-display);font-size:1.1rem;
      letter-spacing:.12em;padding:.7rem 2.5rem;
      cursor:pointer;transition:opacity .2s,transform .15s;
      margin-bottom:1.5rem;
    }
    .btn-save-all:hover{opacity:.88;transform:translateY(-2px);}

    .msg-ok{background:rgba(0,152,77,.15);border:1px solid rgba(0,200,100,.3);border-radius:6px;padding:.7rem 1.2rem;margin-bottom:1.5rem;font-size:.9rem;color:#7effc0;}
    .msg-err{background:rgba(152,0,0,.15);border:1px solid rgba(200,0,0,.3);border-radius:6px;padding:.7rem 1.2rem;margin-bottom:1.5rem;font-size:.9rem;color:#ff8080;}

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
    <li><a href="statystyki.php" class="active">Statystyki Sezonowe</a></li>
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

$sezony = ['25/26','26/27','27/28','28/29','29/30','30/31','31/32',
           '32/33','33/34','34/35','35/36','36/37','37/38','38/39','39/40'];

// ── ZAPIS AJAX ────────────────────────────────────────────────
if (isset($_POST["ajax_save"])) {
    $zawodnik_id = (int)$_POST["zawodnik_id"];
    $sezon       = mysqli_real_escape_string($conn, trim($_POST["sezon"]));
    $pole        = $_POST["pole"]; // 'gack' lub 'nagrody'
    $wartosc     = mysqli_real_escape_string($conn, trim($_POST["wartosc"]));

    if (!in_array($pole, ['gack','nagrody'])) {
        echo json_encode(["ok"=>false,"msg"=>"Nieprawidlowe pole"]);
        exit;
    }
    if (!in_array($sezon, $sezony)) {
        echo json_encode(["ok"=>false,"msg"=>"Nieprawidlowy sezon"]);
        exit;
    }

    // INSERT lub UPDATE
    $sql = "INSERT INTO statystyki (zawodnik_id, sezon, $pole)
            VALUES ($zawodnik_id, '$sezon', '$wartosc')
            ON DUPLICATE KEY UPDATE $pole='$wartosc'";
    $ok = mysqli_query($conn, $sql);
    echo json_encode(["ok"=>$ok]);
    exit;
}

// ── POBIERZ SKLAD ─────────────────────────────────────────────
$podstawowi = [];
$rezerwowi  = [];
$order = "FIELD(pozycja,'BR','LO','PO','SO','SPD','SP','LS','PS','N')";
$res_p = mysqli_query($conn,"SELECT * FROM sklad WHERE typ='podstawowy' ORDER BY $order");
$res_r = mysqli_query($conn,"SELECT * FROM sklad WHERE typ='rezerwowy'  ORDER BY $order");
if ($res_p) while ($r=mysqli_fetch_assoc($res_p)) $podstawowi[]=$r;
if ($res_r) while ($r=mysqli_fetch_assoc($res_r)) $rezerwowi[]=$r;
$wszyscy = array_merge($podstawowi, $rezerwowi);

// ── POBIERZ STATYSTYKI ────────────────────────────────────────
// indeks: [zawodnik_id][sezon] => ['gack'=>..., 'nagrody'=>...]
$stats = [];
$res_s = mysqli_query($conn,"SELECT * FROM statystyki");
if ($res_s) {
    while ($s = mysqli_fetch_assoc($res_s)) {
        $stats[$s['zawodnik_id']][$s['sezon']] = [
            'gack'    => $s['gack'],
            'nagrody' => $s['nagrody']
        ];
    }
}

function posBadge($pos) {
    $p = strtoupper(trim($pos));
    return '<span class="pos-badge pos-'.$p.'">'.$p.'</span>';
}
function overallColor($v) {
    if ($v>=88) return '#6200ff';
    if ($v>=84) return '#59ff00';
    if ($v>=80) return '#ffaa00';
    return '#eeff00';
}
?>

<div class="page-hero">
  <h1>Statystyki <span>Sezonowe</span></h1>
  <p>Kliknij na dowolna komorke M/G/A/CK lub Nagrody, wpisz wartosc i kliknij poza komorka – zapisuje sie automatycznie.</p>
</div>

<div class="page-content">

  <?php if (isset($_GET["ok"])): ?>
    <div class="msg-ok">Zapisano zmiany!</div>
  <?php endif; ?>

  <div class="section-title">Tabela Statystyk</div>

  <div class="stats-wrap">
  <table class="stats-table">

    <!-- ROW 1: naglowki sezonow -->
    <thead>
    <tr class="hdr-season">
      <td class="info-cell" colspan="5">Zawodnicy</td>
      <?php foreach ($sezony as $s): ?>
        <td colspan="2"><?= $s ?></td>
      <?php endforeach; ?>
    </tr>

    <!-- ROW 2: naglowki kolumn -->
    <tr class="hdr-cols">
      <th class="info-hdr">Nr</th>
      <th class="info-hdr">Poz</th>
      <th class="info-hdr name-hdr">Imie i Nazwisko</th>
      <th class="info-hdr">Wiek</th>
      <th class="info-hdr">OVR</th>
      <?php foreach ($sezony as $s): ?>
        <th>M/G/A/CK</th>
        <th>Nagrody</th>
      <?php endforeach; ?>
    </tr>
    </thead>

    <tbody>

    <!-- PODSTAWOWI -->
    <tr class="group-sep"><td colspan="<?= 5 + count($sezony)*2 ?>">Podstawowy Skład</td></tr>
    <?php foreach ($podstawowi as $row):
        $zid = $row['id']; ?>
    <tr>
      <td class="td-numer"><?= $row['numer'] ?></td>
      <td><?= posBadge($row['pozycja']) ?></td>
      <td class="td-name"><?= htmlspecialchars($row['imie_nazwisko']) ?></td>
      <td><span class="td-wiek"><?= $row['wiek'] ?></span></td>
      <td class="td-overall" style="color:<?= overallColor($row['overall']) ?>"><?= $row['overall'] ?></td>
      <?php foreach ($sezony as $s):
          $gack    = isset($stats[$zid][$s]['gack'])    ? $stats[$zid][$s]['gack']    : '';
          $nagrody = isset($stats[$zid][$s]['nagrody']) ? $stats[$zid][$s]['nagrody'] : '';
      ?>
        <td class="stat-cell <?= $gack    ? 'has-value':'' ?>"
            data-id="<?= $zid ?>" data-sezon="<?= $s ?>" data-pole="gack"><?= htmlspecialchars($gack) ?></td>
        <td class="stat-cell <?= $nagrody ? 'has-value':'' ?>"
            data-id="<?= $zid ?>" data-sezon="<?= $s ?>" data-pole="nagrody"><?= htmlspecialchars($nagrody) ?></td>
      <?php endforeach; ?>
    </tr>
    <?php endforeach; ?>

    <!-- REZERWOWI -->
    <tr class="group-sep"><td colspan="<?= 5 + count($sezony)*2 ?>">Rezerwowi</td></tr>
    <?php foreach ($rezerwowi as $row):
        $zid = $row['id']; ?>
    <tr>
      <td class="td-numer"><?= $row['numer'] ?></td>
      <td><?= posBadge($row['pozycja']) ?></td>
      <td class="td-name"><?= htmlspecialchars($row['imie_nazwisko']) ?></td>
      <td><span class="td-wiek"><?= $row['wiek'] ?></span></td>
      <td class="td-overall" style="color:<?= overallColor($row['overall']) ?>"><?= $row['overall'] ?></td>
      <?php foreach ($sezony as $s):
          $gack    = isset($stats[$zid][$s]['gack'])    ? $stats[$zid][$s]['gack']    : '';
          $nagrody = isset($stats[$zid][$s]['nagrody']) ? $stats[$zid][$s]['nagrody'] : '';
      ?>
        <td class="stat-cell <?= $gack    ? 'has-value':'' ?>"
            data-id="<?= $zid ?>" data-sezon="<?= $s ?>" data-pole="gack"><?= htmlspecialchars($gack) ?></td>
        <td class="stat-cell <?= $nagrody ? 'has-value':'' ?>"
            data-id="<?= $zid ?>" data-sezon="<?= $s ?>" data-pole="nagrody"><?= htmlspecialchars($nagrody) ?></td>
      <?php endforeach; ?>
    </tr>
    <?php endforeach; ?>

    </tbody>
  </table>
  </div><!-- /stats-wrap -->

</div>

<footer>&copy; 2026 <span>FC Barcelona</span> - Witryna stworzona na potrzeby projektu FIFA Kariera</footer>

<script>
// Kliknij komorke -> edytuj inline -> zapisz po wyjsciu (blur)
document.querySelectorAll('.stat-cell').forEach(function(cell) {
    cell.addEventListener('click', function() {
        if (cell.querySelector('input')) return; // juz edytowany

        var current = cell.textContent.trim();
        cell.classList.add('editing');
        cell.innerHTML = '';

        var input = document.createElement('input');
        input.type = 'text';
        input.value = current;
        input.maxLength = 50;
        cell.appendChild(input);
        input.focus();
        input.select();

        function saveCell() {
            var val = input.value.trim();
            var zid   = cell.dataset.id;
            var sezon = cell.dataset.sezon;
            var pole  = cell.dataset.pole;

            // Wyslij AJAX
            var fd = new FormData();
            fd.append('ajax_save',    '1');
            fd.append('zawodnik_id', zid);
            fd.append('sezon',       sezon);
            fd.append('pole',        pole);
            fd.append('wartosc',     val);

            fetch('statystyki.php', {method:'POST', body:fd})
              .then(function(r){return r.json();})
              .then(function(data){
                  cell.classList.remove('editing');
                  cell.innerHTML = val;
                  if (val) cell.classList.add('has-value');
                  else     cell.classList.remove('has-value');
              })
              .catch(function(){
                  cell.classList.remove('editing');
                  cell.innerHTML = current;
              });
        }

        input.addEventListener('blur',  saveCell);
        input.addEventListener('keydown', function(e){
            if (e.key === 'Enter')  { input.blur(); }
            if (e.key === 'Escape') {
                cell.classList.remove('editing');
                cell.innerHTML = current;
            }
        });
    });
});
</script>

</body>
</html>

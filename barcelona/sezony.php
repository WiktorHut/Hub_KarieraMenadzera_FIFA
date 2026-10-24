<?php require 'auth.php'; ?>
<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>FC Barcelona - Sezony</title>
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
    .section-title{font-family:var(--font-display);font-size:2rem;letter-spacing:.1em;border-left:5px solid var(--grana);padding-left:1rem;margin-bottom:1.5rem;}
    .sezony-grid{display:flex;flex-direction:column;gap:2rem;}
    .sezon-card{background:var(--card-bg);border:1px solid var(--border-blue);border-radius:10px;overflow:hidden;transition:border-color .2s;}
    .sezon-card:hover{border-color:var(--gold);}
    .sezon-card-header{background:linear-gradient(90deg,var(--blau),var(--grana));font-family:var(--font-display);font-size:1.5rem;letter-spacing:.15em;text-align:center;padding:.7rem 1rem;}
    .puchary-row{display:grid;grid-template-columns:repeat(6,1fr);}
    @media(max-width:900px){.puchary-row{grid-template-columns:repeat(3,1fr);}}
    @media(max-width:500px){.puchary-row{grid-template-columns:repeat(2,1fr);}}
    .puchar-col{border-right:1px solid rgba(255,255,255,.08);display:flex;flex-direction:column;align-items:center;}
    .puchar-col:last-child{border-right:none;}
    .puchar-name{background:var(--grana);width:100%;text-align:center;font-family:var(--font-display);font-size:.78rem;letter-spacing:.08em;padding:.4rem .3rem;min-height:2.2rem;display:flex;align-items:center;justify-content:center;}
    .puchar-body{display:flex;align-items:center;justify-content:center;gap:.6rem;padding:.8rem .4rem;width:100%;background:rgba(255,255,255,.02);flex:1;}
    .puchar-img{width:48px;height:48px;object-fit:contain;filter:drop-shadow(0 2px 6px rgba(0,0,0,.6));}
    .puchar-count{font-family:var(--font-display);font-size:2.8rem;color:rgba(154,143,126,.3);line-height:1;min-width:1.8rem;text-align:center;transition:color .2s;}
    .puchar-count.wygrana{color:var(--gold);}
    .btn-toggle{width:40px;height:40px;border-radius:50%;border:2px solid rgba(255,255,255,.15);background:rgba(255,255,255,.05);color:var(--muted);font-size:1.3rem;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:background .2s,border-color .2s,color .2s,transform .1s;flex-shrink:0;}
    .btn-toggle:hover{transform:scale(1.1);}
    .btn-toggle.aktywny{background:var(--gold);border-color:var(--gold);color:#000;}
    .euro-select{width:100%;background:rgba(0,77,152,.2);border:none;border-top:1px solid rgba(255,255,255,.1);color:var(--light);font-family:var(--font-body);font-size:.72rem;padding:.3rem .2rem;text-align:center;cursor:pointer;}
    .euro-select:focus{outline:none;}
    .euro-select option{background:#0a0a12;}
    .msg-ok{background:rgba(0,152,77,.15);border:1px solid rgba(0,200,100,.3);border-radius:6px;padding:.7rem 1.2rem;margin-bottom:1.5rem;font-size:.9rem;color:#7effc0;display:none;}
    .msg-ok.show{display:block;}
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
    <li><a href="sezony.php" class="active">Sezony</a></li>
    <li><a href="byli_zawodnicy.php">Baza Byłych Zawodników</a></li>
    <li><a href="akademia.php">Akademia</a></li>
    <li><a href="trener.php">Gabinet Trenera</a></li>
    <li><a href="logout.php">Wyloguj</a></li>
  </ul>
</nav>

<?php
$conn = mysqli_connect("localhost","root","","barcelona");
if (!$conn) die("<p style='color:red;padding:2rem'>Blad polaczenia: ".mysqli_connect_error()."</p>");

$sezony_list = ['25/26','26/27','27/28','28/29','29/30','30/31','31/32',
                '32/33','33/34','34/35','35/36','36/37','37/38','38/39','39/40'];

// Mapowanie: pole w sezony => nazwa w tabeli puchary (DOKLADNIE jak w bazie)
$mapa_nazw = [
    'la_liga'             => 'La Liga',
    'super_copa'          => 'Super Copa',
    'copa_de_espana'      => 'Copa de Espa&ntilde;a',  // z bazy: Copa de España
    'puchar_przedsezonowy'=> 'Puchar Przedsezonowy',
    'super_cup'           => 'Super Cup',
];
// Puchary europejskie maja 3 mozliwosci - obslugujemy osobno

// ── AJAX ZAPIS ────────────────────────────────────────────────
if (isset($_POST["ajax_save"])) {
    header('Content-Type: application/json');

    $sezon = mysqli_real_escape_string($conn, trim($_POST["sezon"]));
    $pole  = trim($_POST["pole"]);
    $val   = $_POST["val"];

    $dozwolone_int = ['la_liga','copa_de_espana','super_copa','puchar_europejski','super_cup','puchar_przedsezonowy'];
    $dozwolone_str = ['puchar_europejski_nazwa'];

    if (!in_array($pole, array_merge($dozwolone_int, $dozwolone_str))) {
        echo json_encode(["ok"=>false,"msg"=>"Nieprawidlowe pole"]); exit;
    }

    // Upewnij sie ze rekord istnieje
    mysqli_query($conn, "INSERT IGNORE INTO sezony (sezon) VALUES ('$sezon')");

    if (in_array($pole, $dozwolone_int)) {
        $val = ($val >= 1) ? 1 : 0;
        mysqli_query($conn, "UPDATE sezony SET `$pole`=$val WHERE sezon='$sezon'");
    } else {
        $val = mysqli_real_escape_string($conn, trim($val));
        mysqli_query($conn, "UPDATE sezony SET `$pole`='$val' WHERE sezon='$sezon'");
    }

    // ── PRZELICZ GABLOTE na podstawie ilosc_historyczna + SUM z sezony ──

    // 1. Puchary zwykle (nie europejskie)
    // Uzywamy ID zamiast nazwy – bezpieczniejsze
    // La Liga = id 1
    $pola_id = [
        'la_liga'              => 1,
        'super_copa'           => 2,
        'copa_de_espana'       => 3,
        'puchar_przedsezonowy' => 4,
        'super_cup'            => 8,
    ];

    foreach ($pola_id as $pole_db => $puchar_id) {
        $suma = (int)mysqli_fetch_row(mysqli_query($conn,
            "SELECT COALESCE(SUM(`$pole_db`),0) FROM sezony"))[0];
        $hist = (int)mysqli_fetch_row(mysqli_query($conn,
            "SELECT COALESCE(ilosc_historyczna,0) FROM puchary WHERE id=$puchar_id"))[0];
        $total = $hist + $suma;
        mysqli_query($conn, "UPDATE puchary SET ilosc=$total WHERE id=$puchar_id");
    }

    // 2. Puchary europejskie (id 5=UCL, id 6=UEL, id 7=UECL)
    $ucl  = (int)mysqli_fetch_row(mysqli_query($conn,
        "SELECT COALESCE(SUM(puchar_europejski),0) FROM sezony WHERE puchar_europejski_nazwa='UEFA Champions League'"))[0];
    $uel  = (int)mysqli_fetch_row(mysqli_query($conn,
        "SELECT COALESCE(SUM(puchar_europejski),0) FROM sezony WHERE puchar_europejski_nazwa='UEFA Europa League'"))[0];
    $uecl = (int)mysqli_fetch_row(mysqli_query($conn,
        "SELECT COALESCE(SUM(puchar_europejski),0) FROM sezony WHERE puchar_europejski_nazwa='UEFA Conference League'"))[0];

    $hist_ucl  = (int)mysqli_fetch_row(mysqli_query($conn,"SELECT COALESCE(ilosc_historyczna,0) FROM puchary WHERE id=5"))[0];
    $hist_uel  = (int)mysqli_fetch_row(mysqli_query($conn,"SELECT COALESCE(ilosc_historyczna,0) FROM puchary WHERE id=6"))[0];
    $hist_uecl = (int)mysqli_fetch_row(mysqli_query($conn,"SELECT COALESCE(ilosc_historyczna,0) FROM puchary WHERE id=7"))[0];

    mysqli_query($conn, "UPDATE puchary SET ilosc=".($hist_ucl +$ucl) ." WHERE id=5");
    mysqli_query($conn, "UPDATE puchary SET ilosc=".($hist_uel +$uel) ." WHERE id=6");
    mysqli_query($conn, "UPDATE puchary SET ilosc=".($hist_uecl+$uecl)." WHERE id=7");

    echo json_encode(["ok"=>true, "nowa_wartosc"=>$val]);
    exit;
}

// ── POBIERZ DANE ──────────────────────────────────────────────
$dane = [];
$res = mysqli_query($conn,"SELECT * FROM sezony");
if ($res) while ($r = mysqli_fetch_assoc($res)) $dane[$r['sezon']] = $r;

foreach ($sezony_list as $s) {
    if (!isset($dane[$s])) {
        $dane[$s] = [
            'sezon'=>$s,'la_liga'=>0,'copa_de_espana'=>0,'super_copa'=>0,
            'puchar_europejski_nazwa'=>'UEFA Champions League',
            'puchar_europejski'=>0,'super_cup'=>0,'puchar_przedsezonowy'=>0
        ];
    }
}

$cfg = [
    ['La Liga',              'la_liga',             'puchar_laliga.png'],
    ['Copa de Espana',       'copa_de_espana',       'puchar_copa.png'],
    ['Super Copa',           'super_copa',           'puchar_supercopa.png'],
    ['Puchar Europejski',    'puchar_europejski',    'puchar_ucl.png'],
    ['Super Cup',            'super_cup',            'puchar_supercup.png'],
    ['Puchar Przedsezonowy', 'puchar_przedsezonowy', 'puchar_przedsezonowy.png'],
];
?>

<div class="page-hero">
  <h1>Sezony <span>Kariery</span></h1>
  <p>Kliknij kolko przy pucharze zeby zaznaczyc wygrana w danym sezonie. Gablota aktualizuje sie automatycznie.</p>
</div>

<div class="page-content">
  <div class="msg-ok" id="msg-ok">Zapisano!</div>
  <div class="section-title">Wszystkie Sezony</div>

  <div class="sezony-grid">
  <?php foreach ($sezony_list as $s):
      $d = $dane[$s];
  ?>
    <div class="sezon-card">
      <div class="sezon-card-header">Sezon <?= $s ?></div>
      <div class="puchary-row">
        <?php foreach ($cfg as $p):
            $pole      = $p[1];
            $label     = $p[0];
            $img       = $p[2];
            $val       = (int)($d[$pole] ?? 0);
            $is_euro   = ($pole === 'puchar_europejski');
            $euro_nazwa = $d['puchar_europejski_nazwa'] ?? 'UEFA Champions League';

            if ($is_euro) {
                $label = $euro_nazwa;
                if ($euro_nazwa === 'UEFA Europa League')      $img = 'puchar_uel.png';
                elseif ($euro_nazwa==='UEFA Conference League')$img = 'puchar_uecl.png';
                else $img = 'puchar_ucl.png';
            }

            $sid     = str_replace('/','_',$s);
            $uid     = 'cnt-'.$sid.'-'.$pole;
            $aktywny = $val ? 'aktywny' : '';
        ?>
        <div class="puchar-col">
          <div class="puchar-name" id="lbl-<?= $sid ?>-<?= $pole ?>"><?= htmlspecialchars($label) ?></div>

          <?php if ($is_euro): ?>
          <select class="euro-select" onchange="saveEuroNazwa(this,'<?= $s ?>')">
            <option value="UEFA Champions League"  <?= $euro_nazwa==='UEFA Champions League'  ?'selected':'' ?>>UCL</option>
            <option value="UEFA Europa League"     <?= $euro_nazwa==='UEFA Europa League'     ?'selected':'' ?>>UEL</option>
            <option value="UEFA Conference League" <?= $euro_nazwa==='UEFA Conference League' ?'selected':'' ?>>UECL</option>
          </select>
          <?php endif; ?>

          <div class="puchar-body">
            <img class="puchar-img"
                 id="img-<?= $sid ?>-<?= $pole ?>"
                 src="<?= $img ?>" alt="<?= htmlspecialchars($label) ?>"
                 onerror="this.style.display='none'">
            <div class="puchar-count <?= $val?'wygrana':'' ?>"
                 id="<?= $uid ?>"><?= $val ?></div>
            <button class="btn-toggle <?= $aktywny ?>"
                    id="btn-<?= $sid ?>-<?= $pole ?>"
                    onclick="togglePuchar('<?= $s ?>','<?= $pole ?>',this,'<?= $uid ?>')">
              <?= $val ? '✓' : '○' ?>
            </button>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  <?php endforeach; ?>
  </div>
</div>

<footer>&copy; 2026 <span>FC Barcelona</span> - Witryna stworzona na potrzeby projektu FIFA Kariera</footer>

<script>
function showMsg() {
    var m = document.getElementById('msg-ok');
    m.classList.add('show');
    clearTimeout(window._msgT);
    window._msgT = setTimeout(function(){ m.classList.remove('show'); }, 1800);
}

function togglePuchar(sezon, pole, btnEl, cntId) {
    var cntEl = document.getElementById(cntId);
    var cur   = parseInt(cntEl.textContent) || 0;
    var nv    = cur === 0 ? 1 : 0;

    // Optymistyczny UI – zmien od razu
    cntEl.textContent = nv;
    if (nv === 1) {
        cntEl.classList.add('wygrana');
        btnEl.classList.add('aktywny');
        btnEl.textContent = '✓';
    } else {
        cntEl.classList.remove('wygrana');
        btnEl.classList.remove('aktywny');
        btnEl.textContent = '○';
    }

    var fd = new FormData();
    fd.append('ajax_save','1');
    fd.append('sezon', sezon);
    fd.append('pole',  pole);
    fd.append('val',   nv);

    fetch('sezony.php', {method:'POST', body:fd})
      .then(function(r){ return r.json(); })
      .then(function(data){
          if (!data.ok) {
              // Cofnij zmiane jesli blad
              cntEl.textContent = cur;
              if (cur === 1) { cntEl.classList.add('wygrana'); btnEl.classList.add('aktywny'); btnEl.textContent='✓'; }
              else           { cntEl.classList.remove('wygrana'); btnEl.classList.remove('aktywny'); btnEl.textContent='○'; }
          } else {
              showMsg();
          }
      })
      .catch(function(){
          cntEl.textContent = cur;
      });
}

function saveEuroNazwa(sel, sezon) {
    var nazwa = sel.value;
    var sid   = sezon.replace('/','_');

    var lblEl = document.getElementById('lbl-' + sid + '-puchar_europejski');
    if (lblEl) lblEl.textContent = nazwa;

    var imgEl = document.getElementById('img-' + sid + '-puchar_europejski');
    if (imgEl) {
        if (nazwa==='UEFA Europa League')       imgEl.src = 'puchar_uel.png';
        else if(nazwa==='UEFA Conference League') imgEl.src = 'puchar_uecl.png';
        else                                    imgEl.src = 'puchar_ucl.png';
    }

    var fd = new FormData();
    fd.append('ajax_save','1');
    fd.append('sezon', sezon);
    fd.append('pole',  'puchar_europejski_nazwa');
    fd.append('val',   nazwa);
    fetch('sezony.php', {method:'POST', body:fd})
      .then(function(r){return r.json();})
      .then(function(data){ if(data.ok) showMsg(); });
}
</script>
</body>
</html>

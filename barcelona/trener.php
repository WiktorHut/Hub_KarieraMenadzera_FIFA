<?php require 'auth.php'; ?>
<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>FC Barcelona - Gabinet Trenera</title>
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

    /* ===== HERO – PROFIL TRENERA ===== */
    .trener-hero {
      position: relative;
      background: linear-gradient(135deg, #001730 0%, #1a0010 100%);
      border-bottom: 2px solid var(--grana);
      overflow: hidden;
    }
    .trener-hero::before {
      content:'';
      position:absolute;inset:0;
      background: repeating-linear-gradient(
        45deg,
        transparent,
        transparent 40px,
        rgba(0,77,152,.04) 40px,
        rgba(0,77,152,.04) 80px
      );
    }
    .hero-inner {
      max-width:1400px;margin:0 auto;
      padding:3rem 2rem;
      display:grid;
      grid-template-columns:320px 1fr;
      gap:3rem;
      position:relative;z-index:1;
    }
    @media(max-width:800px){.hero-inner{grid-template-columns:1fr;}}

    /* lewa – zdjecie + dane */
    .trener-left{}
    .trener-photo-wrap {
      position:relative;
      width:220px;
      border-radius:10px;
      overflow:hidden;
      border:3px solid var(--blau);
      box-shadow:0 8px 40px rgba(0,77,152,.4);
      margin-bottom:1.5rem;
    }
    .trener-photo-wrap img {
      width:100%;display:block;
      /* ZDJECIE 1 – zdjecie_trener.jpg */
    }
    .trener-photo-ph {
      width:220px;height:220px;
      background:rgba(255,255,255,.05);
      display:flex;align-items:center;justify-content:center;
      font-size:.75rem;color:var(--muted);text-align:center;
      text-transform:uppercase;letter-spacing:.06em;line-height:1.5;
    }
    .trener-name {
      font-family:var(--font-display);
      font-size:clamp(2rem,4vw,3.2rem);
      letter-spacing:.04em;
      line-height:1;
      margin-bottom:.3rem;
    }
    .trener-name span{color:var(--gold);}
    .trener-formacja {
      font-family:var(--font-display);
      font-size:1.4rem;
      color:var(--blau);
      letter-spacing:.1em;
      margin-top:.4rem;
    }

    /* dane profilu */
    .profil-box {
      background:rgba(0,77,152,.1);
      border:1px solid var(--border-blue);
      border-radius:8px;
      padding:1.2rem 1.4rem;
      margin-top:1.2rem;
    }
    .profil-title {
      font-family:var(--font-display);
      font-size:.9rem;
      letter-spacing:.15em;
      color:var(--muted);
      border-bottom:1px solid rgba(255,255,255,.08);
      padding-bottom:.5rem;
      margin-bottom:.8rem;
    }
    .profil-row {
      display:grid;
      grid-template-columns:160px 1fr;
      gap:.3rem;
      padding:.35rem 0;
      font-size:.88rem;
      border-bottom:1px solid rgba(255,255,255,.04);
    }
    .profil-row:last-child{border-bottom:none;}
    .profil-label{color:var(--muted);font-size:.8rem;}
    .profil-val{color:var(--light);font-weight:600;}

    /* prawa – cytaty + opis */
    .trener-right {
      display:flex;
      flex-direction:column;
      justify-content:center;
      gap:1.5rem;
    }
    .trener-desc {
      font-size:1rem;
      font-weight:300;
      color:rgba(240,232,216,.8);
      line-height:1.9;
      max-width:600px;
    }
    .quotes-wrap{display:flex;flex-direction:column;gap:1rem;}
    .quote-card {
      background:rgba(255,255,255,.04);
      border-left:4px solid var(--gold);
      border-radius:0 8px 8px 0;
      padding:1rem 1.4rem;
    }
    .quote-text {
      font-size:1.05rem;
      font-style:italic;
      color:rgba(240,232,216,.9);
      line-height:1.7;
    }
    .quote-text::before{content:'\201E';}
    .quote-text::after{content:'\201D';}
    .quote-author{
      margin-top:.4rem;
      font-family:var(--font-display);
      font-size:.8rem;
      letter-spacing:.1em;
      color:var(--gold);
    }

    /* ===== GABINET PUCHAROW ===== */
    .page-content{max-width:1400px;margin:0 auto;padding:3rem 2rem 5rem;}
    .section-title{font-family:var(--font-display);font-size:2rem;letter-spacing:.1em;border-left:5px solid var(--grana);padding-left:1rem;margin-bottom:1.8rem;}

    .gabinet-grid{
      display:grid;
      grid-template-columns:repeat(3,1fr);
      gap:1.4rem;
      margin-bottom:3rem;
    }
    @media(max-width:900px){.gabinet-grid{grid-template-columns:repeat(2,1fr);}}
    @media(max-width:500px){.gabinet-grid{grid-template-columns:1fr;}}

    .gabinet-card {
      background:var(--card-bg);
      border:1px solid var(--border-blue);
      border-radius:10px;
      overflow:hidden;
      transition:transform .22s,border-color .22s,box-shadow .22s;
    }
    .gabinet-card:hover {
      transform:translateY(-4px);
      border-color:var(--gold);
      box-shadow:0 8px 32px rgba(237,187,0,.12);
    }
    .gabinet-card-name {
      background:linear-gradient(90deg,var(--blau),var(--grana));
      font-family:var(--font-display);
      font-size:.9rem;
      letter-spacing:.12em;
      padding:.45rem 1rem;
      text-align:center;
    }
    .gabinet-card-body {
      display:flex;
      align-items:center;
      justify-content:center;
      gap:1rem;
      padding:1.2rem 1rem;
      background:rgba(255,255,255,.02);
    }
    .gabinet-img{
      width:70px;height:70px;
      object-fit:contain;
      filter:drop-shadow(0 2px 8px rgba(0,0,0,.6));
      flex-shrink:0;
    }
    .gabinet-count{
      font-family:var(--font-display);
      font-size:clamp(3rem,5vw,4.5rem);
      line-height:1;
      flex:1;
      text-align:center;
      transition:color .2s;
    }
    .gabinet-count.zero{color:rgba(154,143,126,.25);}
    .gabinet-count.wygrana{color:var(--gold);text-shadow:0 0 30px rgba(237,187,0,.3);}

    /* przyciski +/- */
    .gabinet-ctrl{display:flex;flex-direction:column;gap:.4rem;flex-shrink:0;}
    .btn-pm{width:28px;height:28px;border:none;border-radius:5px;font-size:1rem;font-weight:700;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:background .15s,transform .1s;line-height:1;}
    .btn-plus{background:var(--blau);color:#fff;}
    .btn-plus:hover{background:#0066cc;transform:scale(1.1);}
    .btn-minus{background:rgba(164,0,68,.6);color:#fff;}
    .btn-minus:hover{background:var(--grana);transform:scale(1.1);}

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
    <li><a href="sezony.php">Sezony</a></li>
    <li><a href="byli_zawodnicy.php">Baza Byłych Zawodników</a></li>
    <li><a href="akademia.php">Akademia</a></li>
    <li><a href="trener.php" class="active">Gabinet Trenera</a></li>
    <li><a href="logout.php">Wyloguj</a></li>
  </ul>
</nav>

<?php
$conn = mysqli_connect("localhost","root","","barcelona");
if (!$conn) die("<p style='color:red;padding:2rem'>Blad polaczenia: ".mysqli_connect_error()."</p>");

// ── AJAX: zmiana ilosci ───────────────────────────────────────
if (isset($_POST["ajax_save"])) {
    header('Content-Type: application/json');
    $id  = (int)$_POST["id"];
    $val = max(0, (int)$_POST["val"]);
    if ($id > 0) mysqli_query($conn,"UPDATE trener_puchary SET ilosc=$val WHERE id=$id");
    echo json_encode(["ok"=>true]);
    exit;
}

// ── POBIERZ PUCHARY ───────────────────────────────────────────
$puchary = [];
$res = mysqli_query($conn,"SELECT * FROM trener_puchary ORDER BY id");
if ($res) while ($r = mysqli_fetch_assoc($res)) $puchary[] = $r;
?>

<!-- ===== HERO – PROFIL ===== -->
<section class="trener-hero">
  <div class="hero-inner">

    <!-- LEWA: zdjecie + dane -->
    <div class="trener-left">
      <div class="trener-photo-wrap">
        <!-- ZDJECIE 1: zdjecie_trener.jpg – zdjecie trenera -->
        <img src="zdjecie_trener.jpg" alt="Trener"
             onerror="this.outerHTML='<div class=\'trener-photo-ph\'>Zdjecie 1<br>zdjecie_trener.jpg</div>'"/>
      </div>
      <div class="trener-name">Pep <span>Guardiola</span></div>
      <div class="trener-formacja">4-3-3</div>

      <div class="profil-box">
        <div class="profil-title">DANE PROFILU</div>
        <div class="profil-row">
          <span class="profil-label">Nazwisko w kraju</span>
          <span class="profil-val">Josep Guardiola i Sala</span>
        </div>
        <div class="profil-row">
          <span class="profil-label">Urodz. / Wiek</span>
          <span class="profil-val">18 sty 1971 (55)</span>
        </div>
        <div class="profil-row">
          <span class="profil-label">Miejsce urodzenia</span>
          <span class="profil-val">Santpedor, Hiszpania</span>
        </div>
        <div class="profil-row">
          <span class="profil-label">Narodowość</span>
          <span class="profil-val">Hiszpania</span>
        </div>
        <div class="profil-row">
          <span class="profil-label">Licencja trenerska</span>
          <span class="profil-val">Licencja UEFA Pro</span>
        </div>
        <div class="profil-row">
          <span class="profil-label">Pref. formacja</span>
          <span class="profil-val">4-3-3</span>
        </div>
        <div class="profil-row">
          <span class="profil-label">Aktualny klub</span>
          <span class="profil-val" style="color:var(--gold)">FC Barcelona</span>
        </div>
      </div>
    </div>

    <!-- PRAWA: opis + cytaty -->
    <div class="trener-right">
      <p class="trener-desc">
        Josep "Pep" Guardiola to jeden z najwybitniejszych trenerów w historii futbolu.
        Jako zawodnik zdobył z Barceloną m.in. dwa tytuły mistrza Europy.
        Jako szkoleniowiec zrewolucjonował futbol taktyczny – jego filozofia oparta
        na posiadaniu piłki, wysokim presingu i płynnej organizacji gry zmieniła
        sposób myslenia o nowoczesnej piłce nożnej na całym świecie.
        Prowadził z sukcesami Barcelone B, FC Barcelone, Bayern Monachium
        oraz Manchester City, zdobywając tytuły mistrzowskie w trzech krajach.
      </p>

      <div class="quotes-wrap">
        <div class="quote-card">
          <div class="quote-text">Bez piłki jesteśmy nikim. Z piłką możemy być wszystkim.</div>
          <div class="quote-author">— Pep Guardiola</div>
        </div>
        <div class="quote-card">
          <div class="quote-text">Pressing to nie taktyka – to stan umysłu. Musisz chcieć odbierać piłkę bardziej niż przeciwnik chce ja zachować.</div>
          <div class="quote-author">— Pep Guardiola</div>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- ===== GABINET PUCHAROW ===== -->
<div class="page-content">

  <div class="msg-ok" id="msg-ok">Zapisano!</div>
  <div class="section-title">Gabinet Pucharów Trenera</div>

  <div class="gabinet-grid">
  <?php foreach ($puchary as $p):
      $zero = ($p['ilosc'] == 0) ? ' zero' : ' wygrana';
  ?>
    <div class="gabinet-card">
      <div class="gabinet-card-name"><?= htmlspecialchars($p['nazwa']) ?></div>
      <div class="gabinet-card-body">

        <?php if (!empty($p['zdjecie'])): ?>
          <img class="gabinet-img"
               src="<?= htmlspecialchars($p['zdjecie']) ?>"
               alt="<?= htmlspecialchars($p['nazwa']) ?>"
               onerror="this.style.display='none'">
        <?php endif; ?>

        <div class="gabinet-count<?= $zero ?>"
             id="cnt-<?= $p['id'] ?>"><?= (int)$p['ilosc'] ?></div>

        <div class="gabinet-ctrl">
          <button class="btn-pm btn-plus"
                  onclick="zmien(<?= $p['id'] ?>, 1)">+</button>
          <button class="btn-pm btn-minus"
                  onclick="zmien(<?= $p['id'] ?>, -1)">−</button>
        </div>

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
    clearTimeout(window._t);
    window._t = setTimeout(function(){ m.classList.remove('show'); }, 1600);
}

function zmien(id, delta) {
    var el  = document.getElementById('cnt-' + id);
    var cur = parseInt(el.textContent) || 0;
    var nv  = Math.max(0, cur + delta);

    var fd = new FormData();
    fd.append('ajax_save', '1');
    fd.append('id',  id);
    fd.append('val', nv);

    fetch('trener.php', {method:'POST', body:fd})
      .then(function(r){ return r.json(); })
      .then(function(data){
          if (data.ok) {
              el.textContent = nv;
              el.className = 'gabinet-count ' + (nv > 0 ? 'wygrana' : 'zero');
              showMsg();
          }
      });
}
</script>

</body>
</html>

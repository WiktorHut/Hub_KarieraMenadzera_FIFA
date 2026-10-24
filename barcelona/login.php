<?php
session_start();

// ── HASLO – zmien na swoje ────────────────────────────────────
$HASLO = "domyslne";

// Jezeli juz zalogowany – idz na glowna
if (isset($_SESSION["zalogowany"]) && $_SESSION["zalogowany"] === true) {
    header("Location: index.html");
    exit;
}

$blad = "";

if (isset($_POST["login"])) {
    if ($_POST["haslo"] === $HASLO) {
        $_SESSION["zalogowany"] = true;
        // Wróc na strone z ktorej przekierowano
        $redirect = $_SESSION["redirect_after_login"] ?? "index.html";
        unset($_SESSION["redirect_after_login"]);
        header("Location: " . $redirect);
        exit;
    } else {
        $blad = "Nieprawidlowe haslo. Sprobuj ponownie.";
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>FC Barcelona – Logowanie</title>
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:ital,wght@0,300;0,400;0,600;0,700;1,300&display=swap" rel="stylesheet"/>
  <style>
    :root {
      --blau:#004D98; --grana:#A50044; --gold:#EDBB00;
      --darker:#06060e; --light:#f0e8d8; --muted:#9a8f7e;
      --border-blue:rgba(0,77,152,0.4);
      --font-display:'Bebas Neue',sans-serif;
      --font-body:'Barlow',sans-serif;
    }
    *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
    html,body{height:100%;}
    body{
      background:var(--darker);
      color:var(--light);
      font-family:var(--font-body);
      display:flex;
      align-items:center;
      justify-content:center;
      min-height:100vh;
      overflow:hidden;
    }

    /* tlo */
    .bg-wrap{
      position:fixed;inset:0;z-index:0;
      background:linear-gradient(135deg,#001730 0%,#1a0010 100%);
    }
    .bg-wrap::after{
      content:'';position:absolute;inset:0;
      background: repeating-linear-gradient(
        45deg, transparent, transparent 60px,
        rgba(0,77,152,.04) 60px, rgba(0,77,152,.04) 120px
      );
    }
    .bg-stripe{
      position:fixed;top:0;bottom:0;width:5px;left:8%;
      background:linear-gradient(to bottom,var(--blau),var(--grana));
      opacity:.4;z-index:1;
    }

    /* karta logowania */
    .login-wrap{
      position:relative;z-index:2;
      width:100%;max-width:420px;
      padding:0 1.5rem;
    }

    .login-card{
      background:rgba(255,255,255,.04);
      border:1px solid rgba(164,0,68,.4);
      border-radius:14px;
      overflow:hidden;
      box-shadow:0 20px 60px rgba(0,0,0,.6);
    }

    .login-header{
      background:linear-gradient(90deg,var(--blau),var(--grana));
      padding:1.5rem 2rem;
      text-align:center;
    }
    .login-logo{
      display:flex;
      align-items:center;
      justify-content:center;
      gap:.8rem;
      margin-bottom:.3rem;
    }
    .login-logo img{
      height:52px;width:52px;object-fit:contain;
    }
    .login-logo-text{
      font-family:var(--font-display);
      font-size:1.8rem;
      letter-spacing:.08em;
      color:var(--gold);
    }
    .login-subtitle{
      font-size:.8rem;
      letter-spacing:.15em;
      text-transform:uppercase;
      color:rgba(255,255,255,.6);
    }

    .login-body{
      padding:2rem;
    }

    .login-title{
      font-family:var(--font-display);
      font-size:1.6rem;
      letter-spacing:.1em;
      text-align:center;
      margin-bottom:1.8rem;
      color:#fff;
    }

    .form-row{
      display:flex;
      flex-direction:column;
      gap:.4rem;
      margin-bottom:1.2rem;
    }
    .form-row label{
      font-size:.78rem;
      text-transform:uppercase;
      letter-spacing:.1em;
      color:var(--muted);
      font-weight:600;
    }
    .form-row input{
      background:rgba(255,255,255,.07);
      border:1px solid var(--border-blue);
      border-radius:7px;
      color:var(--light);
      font-family:var(--font-body);
      font-size:1rem;
      padding:.7rem 1rem;
      width:100%;
      transition:border-color .2s, background .2s;
      letter-spacing:.05em;
    }
    .form-row input:focus{
      outline:none;
      border-color:var(--gold);
      background:rgba(255,255,255,.1);
    }

    .btn-login{
      width:100%;
      background:linear-gradient(90deg,var(--grana),var(--blau));
      color:#fff;
      border:none;
      border-radius:7px;
      font-family:var(--font-display);
      font-size:1.2rem;
      letter-spacing:.15em;
      padding:.75rem;
      cursor:pointer;
      transition:opacity .2s, transform .15s;
      margin-top:.5rem;
    }
    .btn-login:hover{opacity:.88;transform:translateY(-2px);}
    .btn-login:active{transform:translateY(0);}

    .blad-msg{
      background:rgba(164,0,68,.2);
      border:1px solid rgba(164,0,68,.5);
      border-radius:6px;
      padding:.6rem 1rem;
      margin-bottom:1.2rem;
      font-size:.88rem;
      color:#ffaaaa;
      text-align:center;
    }

    .login-footer{
      text-align:center;
      padding:.8rem;
      font-size:.72rem;
      color:var(--muted);
      letter-spacing:.06em;
      text-transform:uppercase;
      border-top:1px solid rgba(255,255,255,.06);
    }
    .login-footer span{color:var(--gold);}
  </style>
</head>
<body>

<div class="bg-wrap"></div>
<div class="bg-stripe"></div>

<div class="login-wrap">
  <div class="login-card">

    <div class="login-header">
      <div class="login-logo">
        <img src="zdjecie_herb.png" alt="FCB" onerror="this.style.display='none'"/>
        <span class="login-logo-text">FC BARCELONA</span>
      </div>
      <div class="login-subtitle">Panel Menadżera</div>
    </div>

    <div class="login-body">
      <div class="login-title">Logowanie</div>

      <?php if ($blad): ?>
        <div class="blad-msg"><?= htmlspecialchars($blad) ?></div>
      <?php endif; ?>

      <form method="post" action="login.php">
        <div class="form-row">
          <label for="haslo">Hasło</label>
          <input id="haslo" type="password" name="haslo"
                 placeholder="Wpisz hasło..." autofocus required>
        </div>
        <button type="submit" name="login" class="btn-login">Wejdz</button>
      </form>

      <div style="text-align:center;margin-top:1.2rem;">
        <a href="index.html" style="
          display:inline-block;
          color:var(--muted);
          font-size:.82rem;
          letter-spacing:.1em;
          text-transform:uppercase;
          text-decoration:none;
          border-bottom:1px solid rgba(154,143,126,.3);
          padding-bottom:.15rem;
          transition:color .2s,border-color .2s;
        "
        onmouseover="this.style.color='#EDBB00';this.style.borderColor='#EDBB00'"
        onmouseout="this.style.color='#9a8f7e';this.style.borderColor='rgba(154,143,126,.3)'"
        >&#8592; Wróc do strony glownej</a>
      </div>
    </div>

    <div class="login-footer">
      &copy; 2026 <span>FC Barcelona</span> · Projekt FIFA Kariera
    </div>

  </div>
</div>

</body>
</html>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta charset="utf-8" />
<link rel="stylesheet" href="globals.css">
<link rel="stylesheet" href="styleguide.css">
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="blogs">

  <!-- HEADER -->
  <header class="header">
    <img class="group-2" src="https://c.animaapp.com/mo1ut0hc83vJTr/img/group-1000011062-1.png" alt="Valuecast logo" />

    <!-- Hamburger toggle (mobile only) -->
    <button class="hamburger" id="hamburger" aria-label="Open navigation" aria-expanded="false" aria-controls="nav-menu">
      <span></span><span></span><span></span>
    </button>

    <nav class="menu" id="nav-menu" role="navigation">
      <div class="BG"></div>
      <div class="active"></div>
      <ul class="nav-links">
        <li><a href="#">Home</a></li>
        <li><a href="#">Our Approach</a></li>
        <li><a href="#">Portfolio</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#" class="nav-active">Blog</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
    </nav>

    <div class="call-now-CTA">
      <div class="rectangle-3"></div>
      <div class="rectangle-4"></div>
      <div class="text-wrapper-9">Call Now</div>
      <img class="image" src="https://c.animaapp.com/mo1ut0hc83vJTr/img/image-3.png" alt="phone icon" />
    </div>
  </header>

  <!-- HERO -->
  <section class="hero">
    <div class="frame">
      <div class="div">
        <div class="frame-2">
          <div class="rectangle"></div>
          <div class="knowledge-hub">KNOWLEDGE HUB</div>
        </div>
        <p class="text-wrapper">Insights for Forward Thinking Leaders</p>
      </div>
    </div>
    <img class="vector" src="https://c.animaapp.com/mo1ut0hc83vJTr/img/vector.svg" alt="" aria-hidden="true" />
  </section>

  <!-- MIDDLE CONTENT -->
  <img class="middle" src="https://c.animaapp.com/mo1ut0hc83vJTr/img/middle.png" alt="Blog content" />

  <!-- CTA -->
  <section class="cta">
    <div class="frame-3">
      <div class="div">
        <div class="frame-2">
          <div class="rectangle-2"></div>
          <div class="contact-us">CONTACT US</div>
        </div>
        <div class="text-wrapper-2">Explore Your Options</div>
      </div>
      <button class="button-white">
        <p class="explore-more">SCHEDULE A FREE DEMO CALL</p>
        <div class="arrow-right-wrapper">
          <img class="arrow-right" src="https://c.animaapp.com/mo1ut0hc83vJTr/img/arrowright.png" alt="arrow right" />
        </div>
      </button>
    </div>
    <img class="img" src="https://c.animaapp.com/mo1ut0hc83vJTr/img/vector-1.svg" alt="" aria-hidden="true" />
    <img class="vector-2" src="https://c.animaapp.com/mo1ut0hc83vJTr/img/vector-2.svg" alt="" aria-hidden="true" />
  </section>

  <!-- FOOTER -->
  <footer class="footer">
    <div class="footer-top">
      <img class="group" src="https://c.animaapp.com/mo1ut0hc83vJTr/img/group-1000011062.png" alt="Valuecast logo" />
      <nav class="footer-nav" aria-label="Footer navigation">
        <a href="#" class="text-wrapper-3">Our Approach</a>
        <a href="#" class="text-wrapper-3">Our Portfolio</a>
        <a href="#" class="text-wrapper-3">About us</a>
        <a href="#" class="text-wrapper-3">Blog</a>
        <a href="#" class="text-wrapper-3">Contact us</a>
      </nav>
    </div>

    <div class="footer-meta">
      <div class="points">
        <div class="frame-7">
          <img class="img-2" src="https://c.animaapp.com/mo1ut0hc83vJTr/img/frame-48096381.svg" alt="LinkedIn" />
          <div class="text-wrapper-4">Linkedin</div>
        </div>
        <div class="frame-7">
          <img class="img-2" src="https://c.animaapp.com/mo1ut0hc83vJTr/img/prime-twitter.svg" alt="Facebook" />
          <div class="text-wrapper-4">Facebook</div>
        </div>
      </div>
      <div class="points-2">
        <div class="frame-7">
          <img class="img-2" src="https://c.animaapp.com/mo1ut0hc83vJTr/img/mail-sharp.svg" alt="Email" />
          <div class="text-wrapper-5">sales@valuecast.com</div>
        </div>
        <div class="frame-7">
          <img class="img-2" src="https://c.animaapp.com/mo1ut0hc83vJTr/img/call-sharp.svg" alt="Phone" />
          <div class="text-wrapper-4">123-456-7890</div>
        </div>
      </div>
    </div>

    <img class="vector-3" src="https://c.animaapp.com/mo1ut0hc83vJTr/img/vector-20.svg" alt="" aria-hidden="true" />

    <div class="footer-bottom">
      <div class="text-wrapper-6">Copyright &copy; 2025, Valuecast</div>
      <div class="frame-9">
        <div class="text-wrapper-7">Terms and Conditions</div>
        <div class="text-wrapper-7">Privacy Policy</div>
      </div>
    </div>
  </footer>

</div>

<script>
  const hamburger = document.getElementById('hamburger');
  const navMenu = document.getElementById('nav-menu');
  hamburger.addEventListener('click', function() {
    const open = navMenu.classList.toggle('nav-open');
    hamburger.setAttribute('aria-expanded', open);
    hamburger.classList.toggle('is-open', open);
  });
</script>
</body>
</html>
<style>
    @import url("https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css");
@import url("https://fonts.googleapis.com/css?family=Inter:300,500|Outfit:300,400,500");
* {
  -webkit-font-smoothing: antialiased;
  box-sizing: border-box;
}
html,
body {
  margin: 0px;
  min-height: 100%;
  width: 100%;
  overflow-x: hidden;
}
/* a blue color as a generic focus style */
button:focus-visible {
  outline: 2px solid #4a90e2 !important;
  outline: -webkit-focus-ring-color auto 5px !important;
}
a {
  text-decoration: none;
}
/* ─── Base / Reset ─────────────────────────────────────── */
.blogs {
  display: flex;
  flex-direction: column;
  width: 100%;
  max-width: 100vw;
  align-items: flex-start;
  position: relative;
  background-color: var(--ice-white);
  overflow-x: hidden;
}

/* ─── HEADER ───────────────────────────────────────────── */
.blogs .header {
  display: flex;
  width: 100%;
  align-items: center;
  justify-content: space-between;
  padding: 23px clamp(24px, 6.94vw, 100px);
  position: absolute;
  top: 0;
  left: 0;
  z-index: 100;
  background-color: transparent;
  backdrop-filter: blur(34px) brightness(100%);
  -webkit-backdrop-filter: blur(34px) brightness(100%);
}

.blogs .group-2 {
  position: relative;
  width: 131px;
  height: 33px;
  flex-shrink: 0;
}

/* ── Nav pill ── */
.blogs .menu {
  position: relative;
  height: 51px;
  flex: 1 1 auto;
  max-width: 657px;
  margin: 0 24px;
}

.blogs .BG {
  position: absolute;
  inset: 0;
  background-color: #ffffff66;
  border-radius: 25.5px 60px 60px 25.5px;
  opacity: 0.5;
}

.blogs .active {
  position: absolute;
  width: 12.94%;
  height: 100%;
  top: 0;
  left: 69.58%;
  background-color: #0446f2;
  border-radius: 0;
}

/* ── Nav links list (desktop) ── */
.blogs .nav-links {
  list-style: none;
  margin: 0;
  padding: 0;
  position: absolute;
  inset: 0;
  display: flex;
  align-items: center;
  justify-content: space-around;
  padding: 0 16px;
}

.blogs .nav-links a {
  font-family: "Outfit", Helvetica;
  font-weight: 300;
  color: #ffffff;
  font-size: 16px;
  line-height: 24px;
  white-space: nowrap;
  text-decoration: none;
}

.blogs .nav-links a.nav-active {
  font-weight: 500;
}

/* ── Call Now CTA ── */
.blogs .call-now-CTA {
  position: relative;
  width: 170px;
  height: 51px;
  flex-shrink: 0;
}

.blogs .rectangle-3 {
  position: absolute;
  top: 0;
  left: calc(50% + 38px);
  width: 45px;
  height: 51px;
  background-color: #ffffff;
  border-radius: 0px 60px 60px 0px;
}

.blogs .rectangle-4 {
  position: absolute;
  top: 0;
  left: calc(50% - 85px);
  width: 123px;
  height: 51px;
  background-color: #0446f2;
  border-radius: 60px 0px 0px 60px;
}

.blogs .text-wrapper-9 {
  position: absolute;
  top: 11px;
  left: calc(50% - 60px);
  height: 30px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-family: "Outfit", Helvetica;
  font-weight: 500;
  color: #ffffff;
  font-size: 20px;
  text-align: center;
  letter-spacing: 0;
  line-height: 30px;
  white-space: nowrap;
}

.blogs .image {
  position: absolute;
  top: 12px;
  left: 131px;
  width: 21px;
  height: 29px;
  object-fit: cover;
}

/* ── Hamburger (hidden on desktop) ── */
.hamburger {
  display: none;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  gap: 5px;
  width: 40px;
  height: 40px;
  background: transparent;
  border: none;
  cursor: pointer;
  padding: 4px;
  z-index: 200;
  flex-shrink: 0;
}

.hamburger span {
  display: block;
  width: 24px;
  height: 2px;
  background: #ffffff;
  border-radius: 2px;
  transition: all 0.3s ease;
  transform-origin: center;
}

.hamburger.is-open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
.hamburger.is-open span:nth-child(2) { opacity: 0; }
.hamburger.is-open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

/* ─── HERO ─────────────────────────────────────────────── */
.blogs .hero {
  display: flex;
  width: 100%;
  min-height: 552px;
  align-items: flex-start;
  padding: 60px clamp(24px, 6.94vw, 100px);
  position: relative;
  overflow: hidden;
  background:
    linear-gradient(0deg, rgba(0, 5, 26, 0.3) 0%, rgba(0, 5, 26, 0.3) 100%),
    url(https://c.animaapp.com/mo1ut0hc83vJTr/img/hero.png) 50% 50% / cover;
}

.blogs .frame {
  display: flex;
  flex-direction: column;
  width: 100%;
  align-items: flex-start;
  gap: 64px;
  padding: 92px 0px 84px;
  position: relative;
}

.blogs .div {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 28px;
  position: relative;
  align-self: stretch;
  width: 100%;
  flex: 0 0 auto;
}

.blogs .frame-2 {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  position: relative;
  flex: 0 0 auto;
}

.blogs .rectangle {
  position: relative;
  width: 8px;
  height: 8px;
  background-color: var(--electric-blue);
  flex-shrink: 0;
}

.blogs .knowledge-hub {
  position: relative;
  width: fit-content;
  margin-top: -1px;
  font-family: "Inter", Helvetica;
  font-weight: 500;
  color: #ffffff;
  font-size: 14px;
  text-align: center;
  letter-spacing: 0;
  line-height: 16.8px;
  white-space: nowrap;
}

.blogs .text-wrapper {
  position: relative;
  width: min(824px, 100%);
  font-family: "Outfit", Helvetica;
  font-weight: 400;
  color: #ffffff;
  font-size: clamp(36px, 5.5vw, 72px);
  text-align: center;
  letter-spacing: 0;
  line-height: 1.1;
}

.blogs .vector {
  position: absolute;
  right: 1px;
  bottom: -32px;
  width: clamp(200px, 45vw, 653px);
  height: auto;
  pointer-events: none;
}

/* ─── MIDDLE ────────────────────────────────────────────── */
.blogs .middle {
  position: relative;
  width: 100%;
  height: auto;
  display: block;
}

/* ─── CTA ───────────────────────────────────────────────── */
.blogs .cta {
  display: flex;
  flex-direction: column;
  width: 100%;
  min-height: 588px;
  align-items: center;
  justify-content: center;
  gap: 84px;
  padding: clamp(48px, 8.33vw, 120px) clamp(24px, 15vw, 216px);
  position: relative;
  background-color: var(--electric-blue);
  overflow: hidden;
}

.blogs .frame-3 {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 44px;
  position: relative;
  align-self: stretch;
  width: 100%;
  flex: 0 0 auto;
}

.blogs .rectangle-2 {
  position: relative;
  width: 8px;
  height: 8px;
  background-color: var(--sky-blue);
  flex-shrink: 0;
}

.blogs .contact-us {
  position: relative;
  width: fit-content;
  margin-top: -1px;
  font-family: "Inter", Helvetica;
  font-weight: 500;
  color: var(--ice-white);
  font-size: 14px;
  letter-spacing: 0;
  line-height: 16.8px;
  white-space: nowrap;
}

.blogs .text-wrapper-2 {
  position: relative;
  align-self: stretch;
  font-family: "Outfit", Helvetica;
  font-weight: 400;
  color: var(--ice-white);
  font-size: clamp(28px, 3.6vw, 52px);
  text-align: center;
  letter-spacing: 0;
  line-height: 1.1;
}

.blogs .button-white {
  display: inline-flex;
  height: 54px;
  align-items: center;
  justify-content: center;
  gap: 16px;
  padding: 4px 8px 4px 32px;
  position: relative;
  background-color: var(--ice-white);
  border-radius: 120px;
  border: none;
  cursor: pointer;
}

.blogs .explore-more {
  position: relative;
  width: fit-content;
  font-family: var(--BTN-font-family);
  font-weight: var(--BTN-font-weight);
  color: var(--electric-blue);
  font-size: var(--BTN-font-size);
  letter-spacing: var(--BTN-letter-spacing);
  line-height: var(--BTN-line-height);
  white-space: nowrap;
  font-style: var(--BTN-font-style);
  margin: 0;
}

.blogs .arrow-right-wrapper {
  display: flex;
  width: 38px;
  height: 38px;
  align-items: center;
  justify-content: center;
  gap: 8px;
  padding: 8px;
  position: relative;
  border-radius: 72px;
  border: 1.5px solid #0446f2;
  flex-shrink: 0;
}

.blogs .arrow-right {
  width: 24px;
  height: 24px;
}

.blogs .img {
  position: absolute;
  top: -32px;
  right: clamp(-200px, -10vw, -148px);
  width: clamp(200px, 45vw, 653px);
  height: auto;
  pointer-events: none;
}

.blogs .vector-2 {
  position: absolute;
  left: 0;
  bottom: 0;
  width: clamp(150px, 25vw, 363px);
  height: auto;
  pointer-events: none;
}

/* ─── FOOTER ────────────────────────────────────────────── */
.blogs .footer {
  display: flex;
  flex-direction: column;
  width: 100%;
  align-items: center;
  justify-content: center;
  gap: 44px;
  padding: 56px clamp(24px, 6.94vw, 100px);
  position: relative;
  background-color: var(--navy);
  border-bottom: 1px solid #ffffff33;
}

/* footer top row: logo + nav */
.blogs .footer-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  width: 100%;
  max-width: 1360px;
  gap: 24px;
  flex-wrap: wrap;
}

.blogs .group {
  position: relative;
  width: 131px;
  height: 33px;
  flex-shrink: 0;
}

.blogs .footer-nav {
  display: flex;
  align-items: center;
  gap: clamp(12px, 2.5vw, 32px);
  flex-wrap: wrap;
}

.blogs .text-wrapper-3 {
  position: relative;
  width: fit-content;
  font-family: var(--p2-m-font-family);
  font-weight: var(--p2-m-font-weight);
  color: var(--ice-white);
  font-size: var(--p2-m-font-size);
  letter-spacing: var(--p2-m-letter-spacing);
  line-height: var(--p2-m-line-height);
  white-space: nowrap;
  font-style: var(--p2-m-font-style);
  text-decoration: none;
}

/* footer meta row: social + contact */
.blogs .footer-meta {
  display: flex;
  align-items: flex-start;
  justify-content: flex-end;
  gap: clamp(24px, 4vw, 80px);
  width: 100%;
  max-width: 1360px;
  flex-wrap: wrap;
}

.blogs .points,
.blogs .points-2 {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  gap: 12px;
}

.blogs .frame-7 {
  display: flex;
  align-items: center;
  gap: 12px;
  position: relative;
  flex: 0 0 auto;
}

.blogs .img-2 {
  position: relative;
  width: 24px;
  height: 24px;
  flex-shrink: 0;
}

.blogs .text-wrapper-4 {
  position: relative;
  width: fit-content;
  font-family: "Outfit", Helvetica;
  font-weight: 400;
  color: #ffffff;
  font-size: 16px;
  letter-spacing: 0;
  line-height: 22.4px;
  white-space: nowrap;
}

.blogs .text-wrapper-5 {
  position: relative;
  width: fit-content;
  font-family: "Outfit", Helvetica;
  font-weight: 400;
  color: #ffffff;
  font-size: 16px;
  letter-spacing: 0;
  line-height: 22.4px;
  text-decoration: underline;
  white-space: nowrap;
}

.blogs .vector-3 {
  position: relative;
  max-width: 1360px;
  width: 100%;
  height: 1px;
}

/* footer bottom row: copyright + legal */
.blogs .footer-bottom {
  display: flex;
  align-items: center;
  justify-content: space-between;
  width: 100%;
  max-width: 1360px;
  gap: 16px;
  flex-wrap: wrap;
  opacity: 0.8;
}

.blogs .text-wrapper-6 {
  font-family: "Inter", Helvetica;
  font-weight: 300;
  color: var(--ice-white);
  font-size: 14px;
  letter-spacing: 0;
  line-height: 16.8px;
  white-space: nowrap;
}

.blogs .frame-9 {
  display: flex;
  align-items: flex-start;
  gap: 24px;
  flex-wrap: wrap;
}

.blogs .text-wrapper-7 {
  font-family: "Inter", Helvetica;
  font-weight: 300;
  color: var(--ice-white);
  font-size: 14px;
  letter-spacing: 0;
  line-height: 16.8px;
  white-space: nowrap;
}

/* ═══════════════════════════════════════════════════
   TABLET  641px – 1024px
═══════════════════════════════════════════════════ */
@media (max-width: 1024px) {
  /* hide desktop nav pill, show hamburger */
  .blogs .menu {
    display: none;
    position: fixed;
    inset: 0;
    width: 100%;
    height: 100vh;
    max-width: 100%;
    margin: 0;
    background-color: var(--navy);
    z-index: 150;
    padding: 100px 40px 40px;
    flex-direction: column;
    align-items: flex-start;
    gap: 0;
  }

  .blogs .menu.nav-open {
    display: flex;
  }

  .blogs .menu .BG,
  .blogs .menu .active {
    display: none;
  }

  .blogs .nav-links {
    position: relative;
    inset: auto;
    flex-direction: column;
    align-items: flex-start;
    justify-content: flex-start;
    gap: 0;
    padding: 0;
    width: 100%;
  }

  .blogs .nav-links li {
    width: 100%;
    border-bottom: 1px solid #ffffff22;
  }

  .blogs .nav-links a {
    display: block;
    padding: 18px 4px;
    font-size: 20px;
  }

  .hamburger {
    display: flex;
  }

  .blogs .call-now-CTA {
    display: none;
  }

  /* Hero */
  .blogs .hero {
    min-height: 420px;
    padding: 60px clamp(24px, 5vw, 60px);
  }

  .blogs .frame {
    padding: 70px 0 60px;
  }

  /* Footer meta: two columns, left-aligned */
  .blogs .footer-meta {
    justify-content: flex-start;
  }
}

/* ═══════════════════════════════════════════════════
   MOBILE  ≤ 640px
═══════════════════════════════════════════════════ */
@media (max-width: 640px) {
  /* Header */
  .blogs .header {
    padding: 16px 20px;
  }

  .blogs .group-2 {
    width: 100px;
    height: auto;
  }

  /* Hero */
  .blogs .hero {
    min-height: 320px;
    padding: 16px 20px;
  }

  .blogs .frame {
    padding: 60px 0 40px;
    gap: 32px;
  }

  .blogs .text-wrapper {
    font-size: clamp(28px, 8.5vw, 42px);
  }

  .blogs .vector {
    width: clamp(140px, 60vw, 300px);
    bottom: -20px;
  }

  /* Middle image */
  .blogs .middle {
    width: 100%;
  }

  /* CTA */
  .blogs .cta {
    min-height: unset;
    gap: 40px;
    padding: 48px 20px;
  }

  .blogs .frame-3 {
    gap: 28px;
  }

  .blogs .explore-more {
    font-size: 14px;
  }

  .blogs .button-white {
    height: 48px;
    padding: 4px 8px 4px 20px;
    gap: 12px;
  }

  .blogs .img {
    width: clamp(140px, 60vw, 300px);
    top: -16px;
    right: -60px;
  }

  .blogs .vector-2 {
    width: clamp(100px, 40vw, 200px);
  }

  /* Footer */
  .blogs .footer {
    padding: 40px 20px;
    gap: 28px;
  }

  .blogs .footer-top {
    flex-direction: column;
    align-items: flex-start;
    gap: 24px;
  }

  .blogs .footer-nav {
    gap: 12px 20px;
  }

  .blogs .footer-meta {
    flex-direction: column;
    justify-content: flex-start;
    gap: 20px;
  }

  .blogs .footer-bottom {
    flex-direction: column;
    align-items: flex-start;
    gap: 12px;
  }
}
:root {
  --electric-blue: rgba(4, 70, 242, 1);
  --ice-white: rgba(255, 255, 255, 1);
  --steel: rgba(188, 191, 204, 1);
  --navy: rgba(0, 5, 26, 1);
  --blue: rgba(4, 149, 240, 1);
  --sky-blue: rgba(130, 204, 249, 1);
  --black: rgba(55, 55, 55, 1);
  --cloud: rgba(245, 246, 252, 1);
  --p1-r-font-family: "Inter", Helvetica;
  --p1-r-font-weight: 400;
  --p1-r-font-size: 20px;
  --p1-r-letter-spacing: 0px;
  --p1-r-line-height: 140%;
  --p1-r-font-style: normal;
  --BTN-font-family: "Outfit", Helvetica;
  --BTN-font-weight: 400;
  --BTN-font-size: 18px;
  --BTN-letter-spacing: 0px;
  --BTN-line-height: 120.00000762939453%;
  --BTN-font-style: normal;
  --p2-m-font-family: "Inter", Helvetica;
  --p2-m-font-weight: 500;
  --p2-m-font-size: 16px;
  --p2-m-letter-spacing: 0px;
  --p2-m-line-height: 120.00000762939453%;
  --p2-m-font-style: normal;
}

</style>
<?php // About Us Page Section — AgroFanema ?>

<section class="gg-about-us-scope" id="about-lux" aria-label="About AgroFanema">
<style>
.gg-about-us-scope *, .gg-about-us-scope *::before, .gg-about-us-scope *::after {
  box-sizing: border-box; margin: 0; padding: 0;
}

.gg-about-us-scope {
  --deep:#0A1B10;--dark:#0F2418;--mid:#1A3D26;
  --vivid:#2E7D4F;--bright:#3DAA68;
  --gold:#C8A84B;--goldlt:#E2C472;
  --bg:#F5F2EA;--card:#FDFCF8;
  --text:#2A2A26;--muted:#6B6B62;--border:#E2DFD8;
  --pad:clamp(28px,7vw,100px);
  --fdis:'Cormorant Garamond',Georgia,serif;
  --fbody:'Outfit',sans-serif;

  font-family: var(--fbody);
  background: var(--bg);
  color: var(--text);
  overflow: hidden;
}

.gg-about-us-scope .ds{background:var(--deep);color:#fff;}
.gg-about-us-scope .ls{background:var(--bg);color:var(--text);}

@keyframes fadeUp  {from{opacity:0;transform:translateY(40px)}to{opacity:1;transform:none}}
@keyframes fadeIn  {from{opacity:0}to{opacity:1}}
@keyframes scalePop{from{opacity:0;transform:scale(.88)}to{opacity:1;transform:scale(1)}}
@keyframes drawLine{from{stroke-dashoffset:2000}to{stroke-dashoffset:0}}
@keyframes marquee {from{transform:translateX(0)}to{transform:translateX(-50%)}}
@keyframes pulse   {0%,100%{box-shadow:0 0 0 0 rgba(200,168,75,.35)}50%{box-shadow:0 0 0 16px rgba(200,168,75,0)}}
@keyframes kenburns{0%{transform:scale(1) translateX(0)}100%{transform:scale(1.09) translateX(-20px)}}
@keyframes shimmer {from{transform:translateX(-100%)}to{transform:translateX(200%)}}
@keyframes breathe {0%,100%{transform:scale(1)}50%{transform:scale(1.015)}}

.rv{opacity:0;transform:translateY(36px);transition:opacity .85s cubic-bezier(0,0,.2,1),transform .85s cubic-bezier(0,0,.2,1)}
.rv.vis{opacity:1;transform:none}
.rv.d1{transition-delay:.08s}.rv.d2{transition-delay:.18s}.rv.d3{transition-delay:.29s}.rv.d4{transition-delay:.4s}
.rvs{opacity:0;transform:scale(.93);transition:opacity .9s cubic-bezier(0,0,.2,1),transform .9s cubic-bezier(0,0,.2,1)}
.rvs.vis{opacity:1;transform:scale(1)}

/* ════ HERO ════ */
.hero{
  position:relative;
  height: calc(100svh - 78px);
  display:flex;flex-direction:column;justify-content:center;
  overflow:hidden;isolation:isolate;
}
.hero__bg{
  position:absolute;inset:0;z-index:0;
  background:url('https://images.unsplash.com/photo-1500382017468-9049fed747ef?w=1800&q=85&fit=crop')
    center/cover no-repeat;
  animation:kenburns 24s ease-in-out infinite alternate;
  will-change:transform;
}
.hero__overlay{
  position:absolute;inset:0;z-index:1;
  background:
    linear-gradient(to top,
      rgba(5,12,7,.96) 0%,
      rgba(5,12,7,.78) 25%,
      rgba(5,12,7,.44) 52%,
      rgba(5,12,7,.18) 74%,
      rgba(5,12,7,.06) 100%),
    linear-gradient(105deg,
      rgba(5,12,7,.9) 0%,
      rgba(5,12,7,.55) 40%,
      rgba(5,12,7,.1) 70%,
      transparent 100%);
}
.hero__grain{
  position:absolute;inset:0;z-index:2;pointer-events:none;opacity:.05;
  background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 512 512' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.78' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='512' height='512' filter='url(%23n)'/%3E%3C/svg%3E");
  background-size:220px;
}
.hero__botanical{
  position:absolute;top:-80px;right:-80px;
  width:560px;height:560px;z-index:2;pointer-events:none;opacity:.10;
}
.hero__botanical .b1,.hero__botanical .b2,.hero__botanical .b3,.hero__botanical .b4{
  fill:none;stroke-dasharray:2000;stroke-dashoffset:2000;
}
.hero__botanical .b1{stroke:#C8A84B;stroke-width:.7;animation:drawLine 4.5s .3s ease-out forwards}
.hero__botanical .b2{stroke:#C8A84B;stroke-width:.45;animation:drawLine 4.5s .9s ease-out forwards}
.hero__botanical .b3{stroke:#C8A84B;stroke-width:.3;animation:drawLine 4.5s 1.5s ease-out forwards}
.hero__botanical .b4{stroke:#3DAA68;stroke-width:.25;animation:drawLine 4.5s 2.1s ease-out forwards}
.hero__side-label{
  position:absolute;left:26px;top:50%;z-index:4;
  transform:translateY(-50%) rotate(180deg);writing-mode:vertical-rl;
  font-size:9px;font-weight:600;letter-spacing:.32em;text-transform:uppercase;
  color:rgba(255,255,255,.2);display:flex;align-items:center;gap:16px;
  animation:fadeIn 2s 2s both;
}
.hero__side-label::before{
  content:'';display:block;width:1px;height:56px;
  background:linear-gradient(to bottom,transparent,rgba(255,255,255,.22));
}
.hero__content{
  position:relative;z-index:4;
  padding:0 var(--pad);
  max-width:860px;
}
.hero__eyebrow{
  display:inline-flex;align-items:center;gap:14px;
  font-size:10px;font-weight:600;letter-spacing:.34em;text-transform:uppercase;
  color:var(--gold);margin-bottom:30px;
  animation:fadeUp .9s cubic-bezier(0,0,.2,1) both;
}
.hero__eyebrow-dot{
  width:7px;height:7px;border-radius:50%;background:var(--gold);flex-shrink:0;
  animation:pulse 2.6s ease-in-out infinite;
}
.hero__eyebrow-line{display:block;width:38px;height:1px;background:var(--gold)}
.hero__title{
  font-family:var(--fdis);
  font-size:clamp(58px,9.5vw,132px);
  font-weight:300;line-height:.97;letter-spacing:-.022em;color:#fff;
  animation:fadeUp .9s .12s cubic-bezier(0,0,.2,1) both;
}
.hero__title span{display:block}
.hero__title em{display:block;font-style:italic;color:var(--goldlt)}
.hero__underline{
  position:relative;overflow:hidden;
  height:1px;width:clamp(120px,20vw,280px);
  margin:30px 0 34px;
  background:linear-gradient(90deg,var(--gold),rgba(226,196,114,.28) 60%,transparent);
  animation:fadeIn 1s .4s both;
}
.hero__underline::after{
  content:'';position:absolute;inset:0;
  background:linear-gradient(90deg,transparent 0%,rgba(255,255,255,.75) 50%,transparent 100%);
  animation:shimmer 3s 1.6s ease-in-out infinite;
}
.hero__tagline{
  font-size:clamp(14px,1.45vw,17px);line-height:1.88;
  color:rgba(255,255,255,.55);font-weight:300;
  max-width:460px;margin-bottom:42px;
  animation:fadeUp .9s .24s cubic-bezier(0,0,.2,1) both;
}
.hero__badges{
  display:flex;gap:32px;margin-top:24px;
  animation:fadeUp .9s .36s cubic-bezier(0,0,.2,1) both;
}
.hero__badge-item{
  display:flex;align-items:center;gap:12px;
}
.hero__badge-icon{
  width:38px;height:38px;border-radius:50%;
  border:1px solid rgba(200,168,75,.3);
  display:flex;align-items:center;justify-content:center;
  color:var(--gold);
}
.hero__badge-icon svg{width:18px;height:18px;stroke-width:1.5}
.hero__badge-text{
  font-size:9.5px;font-weight:600;letter-spacing:.15em;
  text-transform:uppercase;color:rgba(255,255,255,.7);
  line-height:1.3;
}
.hero__badge-text strong{display:block;color:var(--goldlt);font-weight:700}
.hero__tagline-extra{
  display:none;
  font-size:13.5px;line-height:1.85;
  color:rgba(255,255,255,.42);font-weight:300;
  max-width:100%;margin-bottom:32px;margin-top:-18px;
  animation:fadeUp .9s .3s cubic-bezier(0,0,.2,1) both;
}

/* ════ STORY ════ */
.story{padding:120px var(--pad);position:relative}
.story::before{content:'';position:absolute;inset:0;pointer-events:none;background:radial-gradient(ellipse 60% 50% at 100% 0%,rgba(46,125,79,.06),transparent 60%),radial-gradient(ellipse 40% 40% at 0% 100%,rgba(200,168,75,.04),transparent 60%)}
.story__grid{display:grid;grid-template-columns:1fr 1fr;gap:80px;align-items:center;position:relative;z-index:1}
.story__label{font-size:10.5px;font-weight:600;letter-spacing:.26em;text-transform:uppercase;color:var(--vivid);display:flex;align-items:center;gap:10px;margin-bottom:20px}
.story__label::before{content:'';width:28px;height:1px;background:var(--vivid);display:block}
.story__title{font-family:var(--fdis);font-size:clamp(38px,4.5vw,58px);font-weight:300;line-height:1.1;color:var(--deep);margin-bottom:8px}
.story__title em{font-style:italic;color:var(--gold)}
.story__divider{width:52px;height:2px;background:linear-gradient(90deg,var(--gold),var(--goldlt),transparent);margin:28px 0}
.story__body{font-size:15.5px;line-height:1.9;color:var(--muted);font-weight:300;margin-bottom:20px}
.story__quote{border-left:2px solid var(--gold);padding:4px 0 4px 24px;margin:32px 0;font-family:var(--fdis);font-size:21px;font-style:italic;font-weight:300;color:var(--deep);line-height:1.6;opacity:.8}
.story__metrics{display:flex;gap:40px;margin-top:36px}
.story__metric-num{font-family:var(--fdis);font-size:38px;font-weight:500;color:var(--vivid);line-height:1}
.story__metric-label{font-size:11px;font-weight:500;letter-spacing:.1em;text-transform:uppercase;color:var(--muted);margin-top:4px}
.story__photos{position:relative;height:600px}
.story__photo{position:absolute;border-radius:6px;overflow:hidden;box-shadow:0 24px 60px rgba(10,27,16,.14)}
.story__photo img{width:100%;height:100%;object-fit:cover;display:block}
.story__photo--main{width:78%;height:76%;top:0;left:0}
.story__photo--secondary{width:52%;height:48%;bottom:0;right:0;border:4px solid var(--bg);z-index:2}
.story__corner{position:absolute;top:-16px;left:-16px;width:64px;height:64px;border-top:2px solid rgba(200,168,75,.3);border-left:2px solid rgba(200,168,75,.3);pointer-events:none}
.story__badge{position:absolute;top:42%;right:-20px;width:96px;height:96px;background:var(--gold);border-radius:50%;display:flex;flex-direction:column;align-items:center;justify-content:center;z-index:3;box-shadow:0 10px 32px rgba(200,168,75,.32);animation:pulse 3s ease-in-out infinite}
.story__badge-num{font-family:var(--fdis);font-size:26px;font-weight:600;color:var(--deep);line-height:1}
.story__badge-txt{font-size:8.5px;font-weight:600;letter-spacing:.08em;text-transform:uppercase;color:var(--deep);opacity:.7;text-align:center;line-height:1.4;margin-top:2px}

/* ════ COLLABORATORS ════ */
.collaborators{
  padding:120px var(--pad);
  background:var(--bg);
  position:relative;
}
.collaborators__header{
  text-align:center;
  margin-bottom:60px;
}
.collaborators__label{
  font-size:10.5px;font-weight:600;letter-spacing:.28em;text-transform:uppercase;
  color:var(--vivid);
  display:inline-flex;align-items:center;gap:12px;
  margin-bottom:18px;
}
.collaborators__label::before,.collaborators__label::after{content:'';display:block;width:24px;height:1px;background:var(--vivid)}
.collaborators__title{
  font-family:var(--fdis);
  font-size:clamp(38px,4.5vw,60px);
  font-weight:300;color:var(--deep);line-height:1.05;
  margin-bottom:16px;
}
.collaborators__title em{font-style:italic;color:var(--gold)}
.collaborators__intro{
  font-size:15px;line-height:1.85;
  color:var(--muted);font-weight:300;
  max-width:500px;margin:0 auto;
}
.collaborators__carousel{
  position:relative;
  overflow:hidden;
}
.collaborators__track{
  display:flex;
  gap:40px;
  animation:marquee 30s linear infinite;
}
.collaborators__track:hover{animation-play-state:paused}
.collaborators__item{
  flex-shrink:0;
  width:200px;
  text-align:center;
  padding:20px;
  background:#fff;
  border-radius:12px;
  border:1px solid var(--border);
  transition:transform .3s, box-shadow .3s;
}
.collaborators__item:hover{
  transform:translateY(-5px);
  box-shadow:0 10px 30px rgba(10,27,16,.1);
}
.collaborators__logo{
  width:80px;height:80px;
  margin:0 auto 16px;
  border-radius:8px;
  overflow:hidden;
  background:#f8f8f8;
}
.collaborators__logo img{
  width:100%;height:100%;object-fit:contain;
}
.collaborators__name{
  font-weight:600;
  color:var(--deep);
  margin-bottom:8px;
}
.collaborators__desc{
  font-size:13px;
  color:var(--muted);
  line-height:1.4;
}
.collaborators__link{
  display:inline-block;
  margin-top:12px;
  font-size:12px;
  color:var(--gold);
  text-decoration:none;
  font-weight:500;
}
.collaborators__link:hover{text-decoration:underline}

/* ════ MISSION / VALUES ════ */
.mv{
  padding:120px var(--pad);
  background:var(--card);
  position:relative;overflow:hidden;
}
.mv::before{
  content:'';position:absolute;inset:0;pointer-events:none;
  background:
    radial-gradient(ellipse 55% 55% at 0% 50%,rgba(200,168,75,.06),transparent 60%),
    radial-gradient(ellipse 45% 45% at 100% 50%,rgba(46,125,79,.04),transparent 60%);
}
.mv__header{
  text-align:center;
  margin-bottom:72px;
  position:relative;z-index:1;
}
.mv__label{
  font-size:10.5px;font-weight:600;letter-spacing:.28em;text-transform:uppercase;
  color:var(--vivid);
  display:inline-flex;align-items:center;gap:12px;
  margin-bottom:18px;
}
.mv__label::before,.mv__label::after{content:'';display:block;width:24px;height:1px;background:var(--vivid)}
.mv__title{
  font-family:var(--fdis);
  font-size:clamp(38px,4.5vw,60px);
  font-weight:300;color:var(--deep);line-height:1.05;
  margin-bottom:16px;
}
.mv__title em{font-style:italic;color:var(--gold)}
.mv__intro{
  font-size:15px;line-height:1.85;
  color:var(--muted);font-weight:300;
  max-width:500px;margin:0 auto;
}
.mv__cols{
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:24px;
  position:relative;z-index:1;
}
.mv__panel{
  padding:52px 48px;
  border-radius:12px;
  border:1px solid var(--border);
  background:#fff;
  position:relative;
  transition:border-color .4s, box-shadow .4s, transform .4s;
  cursor:default;
}
.mv__panel:hover{
  border-color:rgba(200,168,75,.4);
  box-shadow:0 12px 48px rgba(10,27,16,.07);
  transform:translateY(-3px);
}
.mv__panel::before{
  content:'';
  position:absolute;top:0;left:0;right:0;height:2px;
  border-radius:12px 12px 0 0;
  background:linear-gradient(90deg,transparent,var(--gold),transparent);
  opacity:0;transition:opacity .4s;
}
.mv__panel:hover::before{opacity:1}
.mv__icon{
  width:48px;height:48px;border-radius:10px;
  background:rgba(46,125,79,.09);
  border:1px solid rgba(46,125,79,.15);
  display:flex;align-items:center;justify-content:center;
  margin-bottom:28px;
  transition:background .4s,transform .4s;
}
.mv__panel:hover .mv__icon{background:rgba(46,125,79,.16);transform:scale(1.07)}
.mv__icon svg{
  width:20px;height:20px;
  stroke:var(--vivid);stroke-width:1.6;
  fill:none;stroke-linecap:round;stroke-linejoin:round;
}
.mv__tag{
  font-size:9.5px;font-weight:700;letter-spacing:.28em;text-transform:uppercase;
  color:var(--gold);margin-bottom:12px;
  display:flex;align-items:center;gap:8px;
}
.mv__tag::before{content:'';display:block;width:16px;height:1px;background:var(--gold)}
.mv__heading{
  font-family:var(--fdis);
  font-size:clamp(26px,2.8vw,38px);
  font-weight:300;color:var(--deep);
  line-height:1.1;margin-bottom:18px;
}
.mv__text{
  font-size:15px;line-height:1.88;
  color:var(--muted);
  font-weight:300;
}

/* ════ PARTNERS CAROUSEL ════ */
.partners {
  background: #0B1E12;
  padding: 50px var(--pad); 
  position: relative;
  overflow: hidden;
  isolation: isolate;
}

/* Noise texture */
.partners::before {
  content: '';
  position: absolute;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 512 512' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.72' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='512' height='512' filter='url(%23n)'/%3E%3C/svg%3E");
  background-size: 200px;
  opacity: .028;
  pointer-events: none;
  z-index: 0;
}

/* Ambient glow blobs */
.partners::after {
  content: '';
  position: absolute;
  inset: 0;
  background:
    radial-gradient(ellipse 55% 60% at 8%  20%, rgba(46,125,79,.11)  0%, transparent 60%),
    radial-gradient(ellipse 40% 50% at 92% 80%, rgba(200,168,75,.08) 0%, transparent 55%),
    radial-gradient(ellipse 30% 40% at 50%  0%, rgba(61,170,104,.06) 0%, transparent 50%);
  pointer-events: none;
  z-index: 0;
}

.partners__header {
  text-align: center;
  margin-bottom: 30px; 
  position: relative;
  z-index: 1;
}

.partners__label {
  font-size: 10px;
  font-weight: 700;
  letter-spacing: .46em;
  text-transform: uppercase;
  color: var(--gold);
  display: inline-flex;
  align-items: center;
  gap: 20px;
  margin-bottom: 16px; /* Reduced from 22px */
}
.partners__label::before,
.partners__label::after {
  content: '';
  display: block;
  width: 40px;
  height: 1px;
  background: linear-gradient(90deg, transparent, var(--gold));
}
.partners__label::after {
  background: linear-gradient(270deg, transparent, var(--gold));
}

.partners__title {
  font-family: var(--fdis);
  font-size: clamp(44px, 5.5vw, 76px);
  color: #fff;
  font-weight: 300;
  line-height: .97;
  margin-bottom: 16px; /* Reduced from 22px */
  letter-spacing: -.022em;
}
.partners__title em {
  font-style: italic;
  color: var(--goldlt);
}

.partners__sub {
  font-size: 15.5px;
  color: rgba(255,255,255,.38);
  font-weight: 300;
  max-width: 540px;
  margin: 0 auto;
  line-height: 1.85;
}

/* ── Viewport & track ── */
.carousel-container {
  position: relative;
  z-index: 1;
}

.carousel-viewport {
  overflow: hidden;
  cursor: grab;
  mask-image: linear-gradient(90deg,
    transparent 0%,
    #000 7%,
    #000 93%,
    transparent 100%);
  -webkit-mask-image: linear-gradient(90deg,
    transparent 0%,
    #000 7%,
    #000 93%,
    transparent 100%);
  padding: 10px 0 14px; 
  user-select: none;
}
.carousel-viewport:active { cursor: grabbing; }

.carousel-track {
  display: flex;
  gap: 22px;
  transition: transform .85s cubic-bezier(.16,1,.3,1);
  will-change: transform;
}

/* ── Slides ── */
.carousel-slide {
  flex: 0 0 calc(25% - 17px);
  min-width: 210px;
  opacity: .38;
  transform: scale(.93) translateY(6px);
  transition:
    opacity   .75s cubic-bezier(.16,1,.3,1),
    transform .75s cubic-bezier(.16,1,.3,1);
}
.carousel-slide.is-active {
  opacity: 1;
  transform: scale(1) translateY(0);
}

/* ── Card ── */
.pitem__card {
  position: relative;
  border-radius: 20px;
  padding: 24px 16px 20px;
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  background: rgba(255,255,255,.035);
  border: 1px solid rgba(255,255,255,.07);
  transition:
    transform    .55s cubic-bezier(.16,1,.3,1),
    border-color .45s ease,
    background   .45s ease,
    box-shadow   .55s cubic-bezier(.16,1,.3,1);
  overflow: hidden;
}
.pitem__card:hover {
  transform: translateY(-11px);
  border-color: rgba(200,168,75,.22);
  background: rgba(255,255,255,.058);
  box-shadow:
    0 32px 64px rgba(0,0,0,.38),
    0  2px 16px rgba(200,168,75,.07),
    inset 0 1px 0 rgba(255,255,255,.06);
}

/* Inner shimmer highlight */
.pitem__card::before {
  content: '';
  position: absolute;
  inset: 0;
  border-radius: inherit;
  background: linear-gradient(
    135deg,
    rgba(255,255,255,.055) 0%,
    transparent            45%,
    rgba(200,168,75,.04)   100%
  );
  opacity: .7;
  pointer-events: none;
  transition: opacity .45s ease;
}

/* Gold top edge line */
.pitem__card::after {
  content: '';
  position: absolute;
  top: 0; left: 20%; right: 20%;
  height: 1px;
  background: linear-gradient(90deg,
    transparent, var(--gold), var(--goldlt), var(--gold), transparent);
  opacity: 0;
  transition: opacity .45s ease, left .45s ease, right .45s ease;
}

.pitem__card:hover::before { opacity: 1; }
.pitem__card:hover::after  { opacity: 1; left: 10%; right: 10%; }

/* ── Logo ring ── */
.pitem__icon {
  width: 120px;
  height: 120px;
  border-radius: 50%;
  border: 1px solid rgba(255,255,255,.1);
  background: rgba(255,255,255,.04);
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 20px;
  position: relative;
  flex-shrink: 0;
  transition:
    border-color .5s ease,
    transform    .5s cubic-bezier(.16,1,.3,1),
    background   .5s ease;
}

/* Outer orbit ring */
.pitem__icon::before {
  content: '';
  position: absolute;
  inset: -7px;
  border-radius: 50%;
  border: 1px solid rgba(200,168,75,.12);
  opacity: 0;
  transition: opacity .5s ease, inset .5s ease;
}

.pitem__card:hover .pitem__icon {
  border-color: rgba(200,168,75,.38);
  background: rgba(255,255,255,.07);
  transform: scale(1.06);
}
.pitem__card:hover .pitem__icon::before {
  opacity: 1;
  inset: -10px;
}

.pitem__icon img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 50%;
  transition: filter .5s ease, transform .5s cubic-bezier(.16,1,.3,1);
}
.pitem__card:hover .pitem__icon img {
  transform: scale(1.06);
}

/* ── Name ── */
.pitem__name {
  font-family: var(--fdis);
  font-size: 19px;
  font-weight: 300;
  color: rgba(255,255,255,.8);
  margin-bottom: 7px;
  letter-spacing: .015em;
  line-height: 1.15;
  transition: color .35s ease;
}
.pitem__card:hover .pitem__name { color: #fff; }

/* ── Type tag ── */
.pitem__type {
  font-size: 9px;
  font-weight: 700;
  letter-spacing: .25em;
  text-transform: uppercase;
  color: rgba(200,168,75,.48);
  margin-bottom: 22px;
  transition: color .35s ease;
}
.pitem__card:hover .pitem__type { color: var(--gold); }

/* ── Divider ── */
.pitem__divider {
  width: 24px;
  height: 1px;
  background: rgba(200,168,75,.2);
  margin-bottom: 22px;
  transition: width .45s cubic-bezier(.16,1,.3,1), background .35s ease;
}
.pitem__card:hover .pitem__divider {
  width: 42px;
  background: rgba(200,168,75,.5);
}

/* ── Link ── */
.pitem__link {
  font-size: 9.5px;
  font-weight: 700;
  letter-spacing: .2em;
  text-transform: uppercase;
  color: rgba(255,255,255,.22);
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  opacity: 0;
  transform: translateY(8px);
  transition:
    color     .38s ease,
    gap       .35s ease,
    opacity   .4s  cubic-bezier(.16,1,.3,1),
    transform .4s  cubic-bezier(.16,1,.3,1);
}
.pitem__link svg {
  width: 10px;
  height: 10px;
  stroke: currentColor;
  stroke-width: 2.5;
  fill: none;
  stroke-linecap: round;
  stroke-linejoin: round;
  transition: transform .32s ease;
}
.pitem__card:hover .pitem__link {
  opacity: 1;
  transform: translateY(0);
  color: var(--goldlt);
  gap: 11px;
}
.pitem__card:hover .pitem__link svg {
  transform: translate(2px,-2px);
}

/* ── Nav buttons ── */
.carousel-nav {
  display: flex;
  justify-content: center;
  gap: 16px;
  margin-top: 24px;
  position: relative;
  z-index: 1;
}
.carousel-btn {
  width: 52px;
  height: 52px;
  border-radius: 50%;
  background: rgba(255,255,255,.04);
  border: 1px solid rgba(255,255,255,.1);
  color: rgba(255,255,255,.65);
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition:
    background    .38s ease,
    border-color  .38s ease,
    color         .38s ease,
    transform     .38s cubic-bezier(.16,1,.3,1);
}
.carousel-btn svg {
  width: 18px;
  height: 18px;
  stroke: currentColor;
  stroke-width: 1.8;
  fill: none;
  stroke-linecap: round;
  stroke-linejoin: round;
  pointer-events: none;
}
.carousel-btn:hover {
  background: var(--gold);
  border-color: var(--gold);
  color: var(--deep);
  transform: scale(1.1);
}
.carousel-btn:disabled {
  opacity: .22;
  cursor: default;
  pointer-events: none;
}

/* ── Dots ── */
.carousel-dots {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 16px;
  margin-top: 18px;
  position: relative;
  z-index: 1;
}
.carousel-dot {
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: rgba(255,255,255,.25);
  border: none;
  padding: 0;
  cursor: pointer;
  position: relative;
  transition: 
    background .4s ease, 
    transform .4s cubic-bezier(.16,1,.3,1), 
    width .4s cubic-bezier(.16,1,.3,1),
    box-shadow .4s ease;
}
.carousel-dot::after {
  content: ''; position: absolute; inset: -10px; border-radius: 50%;
}
.carousel-dot:hover {
  background: rgba(255,255,255,.8);
  transform: scale(1.4);
  box-shadow: 0 0 12px rgba(255,255,255,.4);
}
.carousel-dot.is-active {
  background: var(--gold);
  width: 32px;
  border-radius: 12px;
  transform: scale(1.1);
  box-shadow: 
    0 0 16px rgba(200,168,75,.6),
    inset 0 0 4px rgba(255,255,255,.6);
}

/* ════ CTA ════ */
.cta{padding:130px var(--pad);text-align:center;position:relative;overflow:hidden}
.cta::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 65% 65% at 50% 55%,rgba(46,125,79,.07),transparent);pointer-events:none}
.cta__ring{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);border-radius:50%;pointer-events:none}
.cta__ring:nth-child(1){width:680px;height:680px;border:1px solid rgba(46,125,79,.055)}
.cta__ring:nth-child(2){width:450px;height:450px;border:1px solid rgba(46,125,79,.085)}
.cta__ring:nth-child(3){width:230px;height:230px;border:1px solid rgba(200,168,75,.13)}
.cta__eyebrow{font-size:10.5px;font-weight:600;letter-spacing:.28em;text-transform:uppercase;color:var(--vivid);margin-bottom:22px;position:relative;z-index:1}
.cta__title{font-family:var(--fdis);font-size:clamp(40px,5.5vw,74px);font-weight:300;color:var(--deep);max-width:660px;margin:0 auto 26px;line-height:1.1;position:relative;z-index:1}
.cta__title em{font-style:italic;color:var(--gold)}
.cta__sub{font-size:15.5px;color:var(--muted);max-width:450px;margin:0 auto 52px;font-weight:300;line-height:1.8;position:relative;z-index:1}
.cta__btns{display:flex;gap:14px;justify-content:center;flex-wrap:wrap;position:relative;z-index:1}
.btn{display:inline-flex;align-items:center;gap:10px;padding:16px 38px;font-family:var(--fbody);font-size:12px;font-weight:600;letter-spacing:.12em;text-transform:uppercase;text-decoration:none;border-radius:100px;cursor:pointer;transition:all .38s cubic-bezier(.4,0,.2,1)}
.btn svg{width:15px;height:15px;fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;transition:transform .3s}
.btn:hover svg{transform:translateX(4px)}
.btn--solid{background:var(--deep);color:#fff;border:1px solid var(--deep)}
.btn--solid:hover{background:var(--mid);border-color:var(--mid);box-shadow:0 12px 36px rgba(10,27,16,.18)}
.btn--outline{background:transparent;color:var(--deep);border:1px solid var(--border)}
.btn--outline:hover{border-color:var(--mid);background:rgba(0,0,0,0.03);}

/* ════ RESPONSIVE ════ */
@media(max-width:1100px){
  .carousel-slide { flex: 0 0 calc(33.333% - 15px); }
}
@media(max-width:900px){
  .hero__side-label{display:none}
  .hero__content{padding-top:40px}
  .hero__botanical{width:280px;height:280px;top:-30px;right:-30px}
  .story__grid{grid-template-columns:1fr;gap:48px}
  .story__photos{height:400px;order:-1}
  .mv__cols{grid-template-columns:1fr;gap:16px}
  .carousel-slide { flex: 0 0 calc(50% - 11px); }
}
@media(max-width:640px){
  .hero__title{font-size:clamp(50px,14vw,80px)}
  .hero__tagline{font-size:14px;max-width:100%}
  .hero__tagline-extra{display:block}
  .hero__badges{flex-direction:column;gap:20px;margin-top:32px}
  .hero__badge-item{gap:14px}
  .hero__scroll{bottom:22px}
  .story__metrics{flex-wrap:wrap;gap:22px}
  .story__photos{height:300px}
  .story__badge{right:8px;width:76px;height:76px}
  .story__badge-num{font-size:22px}
  .mv__panel{padding:36px 28px}
  .cta__btns{flex-direction:column;align-items:center}
  .btn{width:100%;justify-content:center}
  .collaborators__item{width:180px}
  .partners { padding: 40px var(--pad); }
  .partners__title { font-size: clamp(32px, 8vw, 44px); }
  .partners__sub { font-size: 14.5px; }
  .pitem__card { padding: 24px 16px 20px; }
  .pitem__icon { width: 100px; height: 100px; margin-bottom: 16px; }
  .pitem__name { font-size: 20px; }
  .carousel-slide { flex: 0 0 100%; }
}
@media(max-width:480px){
  .pitem__link { opacity: 1; transform: none; }
}
@media(max-width:420px){
  .hero__title{font-size:clamp(44px,15vw,68px)}
  .hero__pills{gap:7px}
  .hero__pill{font-size:10px;padding:8px 14px}
  .mv__panel{padding:32px 24px}
  .collaborators__item{width:160px;padding:16px}
  .collaborators__track{gap:20px}
  .pitem__icon { width: 90px; height: 90px; }
}

@media (prefers-reduced-motion: reduce) {
  .carousel-track,
  .carousel-slide,
  .pitem__card,
  .pitem__icon,
  .pitem__link,
  .carousel-dot { transition-duration: .01ms !important; animation: none !important; }
}
</style>

<!-- HERO -->
<div class="ds">
<section class="hero">
  <div class="hero__bg"></div>
  <div class="hero__overlay"></div>
  <div class="hero__grain"></div>

  <svg class="hero__botanical" viewBox="0 0 560 560" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
    <circle class="b1" cx="280" cy="280" r="265"/>
    <circle class="b2" cx="280" cy="280" r="215"/>
    <circle class="b3" cx="280" cy="280" r="158"/>
    <circle class="b4" cx="280" cy="280" r="95"/>
    <line class="b1" x1="280" y1="15" x2="280" y2="545"/>
    <line class="b1" x1="15" y1="280" x2="545" y2="280"/>
    <line class="b2" x1="93" y1="93" x2="467" y2="467"/>
    <line class="b2" x1="467" y1="93" x2="93" y2="467"/>
    <path class="b3" d="M280 15 Q410 130 545 280 Q410 430 280 545 Q150 430 15 280 Q150 130 280 15Z"/>
    <path class="b4" d="M280 65 Q370 170 475 280 Q370 390 280 495 Q190 390 85 280 Q190 170 280 65Z"/>
  </svg>

  <div class="hero__side-label">Scroll to explore</div>

  <div class="hero__content">
    <div class="hero__eyebrow">
      <div class="hero__eyebrow-dot"></div>
      <span class="hero__eyebrow-line"></span>
      The AgroFanema Heritage
    </div>
    <h1 class="hero__title">
      <span>About</span>
      <em>AgroFanema</em>
    </h1>
    <div class="hero__underline"></div>
    <p class="hero__tagline">
      Bridging ancestral soil wisdom with modern organic science to nourish the earth and empower growers worldwide.
    </p>
    <div class="hero__badges">
      <div class="hero__badge-item">
        <div class="hero__badge-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
        </div>
        <div class="hero__badge-text"><strong>Premium</strong>Organic</div>
      </div>
      <div class="hero__badge-item">
        <div class="hero__badge-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        </div>
        <div class="hero__badge-text"><strong>Certified</strong>Standard</div>
      </div>
      <div class="hero__badge-item">
        <div class="hero__badge-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        </div>
        <div class="hero__badge-text"><strong>Since</strong>1994</div>
      </div>
    </div>
  </div>
</section>
</div>

<!-- STORY -->
<div class="ls">
<div class="story">
  <div class="story__grid">
    <div>
      <div class="story__label rv">Our Origin Story</div>
      <h2 class="story__title rv d1">Rooted in a Passion<br><em>for the Earth</em></h2>
      <div class="story__divider rv d2"></div>
      <p class="story__body rv d2">AgroFanema was born from a deep passion for the land and a commitment to sustainable agriculture. Our founders watched generations of farmers nurture the earth — never reaching for synthetic shortcuts, always trusting the wisdom buried in the soil itself.</p>
      <p class="story__body rv d3">After years of research and close collaboration with biologists and small-scale farmers across Europe, Marco set out to transform those ancestral practices into a modern, scalable solution: premium organic fertilizers that any grower could trust completely.</p>
      <blockquote class="story__quote rv d3">"The healthiest plants don't come from bottles — they come from healthy soil. Everything we make is designed to give back what modern farming has taken away."</blockquote>
      <p class="story__body rv d4">Today, AgroFanema is a trusted name distributed across multiple countries, each batch independently verified for organic purity and ecological safety.</p>
      <div class="story__metrics rv d4">
        <div><div class="story__metric-num">28</div><div class="story__metric-label">Countries</div></div>
        <div><div class="story__metric-num">16</div><div class="story__metric-label">Years Active</div></div>
        <div><div class="story__metric-num">50K+</div><div class="story__metric-label">Growers</div></div>
      </div>
    </div>
    <div class="story__photos rvs">
      <div class="story__corner"></div>
      <div class="story__photo story__photo--main"><img src="https://images.unsplash.com/photo-1530836369250-ef72a3f5cda8?w=700&q=80&fit=crop" alt="Organic farming" loading="lazy"/></div>
      <div class="story__photo story__photo--secondary"><img src="https://images.unsplash.com/photo-1416879595882-3373a0480b5b?w=500&q=80&fit=crop" alt="Healthy plants" loading="lazy"/></div>
      <div class="story__badge"><div class="story__badge-num">16</div><div class="story__badge-txt">Years of<br>Excellence</div></div>
    </div>
  </div>
</div>
</div>

<!-- PARTNERS & CERTIFICATIONS -->
<div class="ds">
<section class="partners" aria-label="Partners and Certifications">

  <div class="partners__header rv">
    <div class="partners__label">Trusted Network</div>
    <h2 class="partners__title">Partners &amp; <em>Certifications</em></h2>
    <p class="partners__sub">Independently verified by the world's leading organic and sustainability bodies to ensure the highest standards.</p>
  </div>

  <div class="carousel-container rv d2">
    <div class="carousel-viewport" id="partnersCarousel">
      <div class="carousel-track">
        <!-- injected by JS -->
      </div>
    </div>
    <div class="carousel-nav">
      <button class="carousel-btn" id="partnersPrev" aria-label="Previous">
        <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
      </button>
      <button class="carousel-btn" id="partnersNext" aria-label="Next">
        <svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
      </button>
    </div>
    <div class="carousel-dots"></div>
  </div>

</section>
</div>

<!-- CTA -->
<div class="ls">
<div class="cta">
  <div class="cta__ring"></div><div class="cta__ring"></div><div class="cta__ring"></div>
  <p class="cta__eyebrow rv">Ready to Grow?</p>
  <h2 class="cta__title rv d1">Let the Soil Do<br>the <em>Heavy Lifting</em></h2>
  <p class="cta__sub rv d2">Explore our full range of certified organic fertilizers, or speak with one of our agronomists to find the right formula for your plants.</p>
  <div class="cta__btns rv d3">
    <a href="products.php" class="btn btn--solid">Explore Products <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
    <a href="contact.php" class="btn btn--outline">Contact Us</a>
  </div>
</div>
</div>

<script>
(()=>{
  /* ── Scroll-reveal ── */
  const io = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (e.isIntersecting) { e.target.classList.add('vis'); io.unobserve(e.target); }
    });
  }, { threshold: .08, rootMargin: '0px 0px -30px 0px' });
  document.querySelectorAll('.rv,.rvs').forEach(el => io.observe(el));

  /* ── Partners carousel ── */
  const initPartnersCarousel = async () => {
    let data = [];
    try {
      const res    = await fetch('essentials/collaborator-api.php?action=list');
      const result = await res.json();
      data = result.collaborators || [];
    } catch(err) {
      console.error('Partners fetch error:', err);
    }

    const carousel = document.getElementById('partnersCarousel');
    if (!carousel) return;

    const track  = carousel.querySelector('.carousel-track');
    const dotsEl = document.querySelector('.carousel-dots');
    const prevBtn = document.getElementById('partnersPrev');
    const nextBtn = document.getElementById('partnersNext');

    if (data.length === 0) {
      track.innerHTML = '<div style="width:100%;text-align:center;padding:60px 0;color:rgba(255,255,255,.28);font-family:var(--fbody);font-size:14px;letter-spacing:.1em;">No partners available yet.</div>';
      return;
    }

    /* Render slides */
    track.innerHTML = data.map(item => `
      <div class="carousel-slide">
        <div class="pitem__card">
          <div class="pitem__icon">
            <img src="${item.logo}" alt="${item.name}" loading="lazy" onerror="this.style.display='none'">
          </div>
          <div class="pitem__name">${item.name}</div>
          <div class="pitem__type">${item.type || 'Partner'}</div>
          <div class="pitem__divider"></div>
          ${item.website ? `
            <a href="${item.website}" target="_blank" rel="noopener" class="pitem__link">
              Learn more
              <svg viewBox="0 0 12 12" fill="none" stroke="currentColor">
                <line x1="2" y1="10" x2="10" y2="2"/>
                <polyline points="4 2 10 2 10 8"/>
              </svg>
            </a>` : ''}
        </div>
      </div>
    `).join('');

    const slides = Array.from(track.querySelectorAll('.carousel-slide'));

    /* State */
    let cur    = 0;
    let ipv    = 4;
    let isDrag = false;
    let startX = 0;
    let prevTX = 0;
    let curTX  = 0;
    let autoTimer;

    const getIPV = () => {
      const w = window.innerWidth;
      if (w <= 640)  return 1;
      if (w <= 900)  return 2;
      if (w <= 1100) return 3;
      return 4;
    };
    const maxIdx = () => Math.max(0, data.length - ipv);

    /* Dots */
    const renderDots = () => {
      const n = Math.ceil(data.length / ipv);
      const isMax = cur >= maxIdx();
      const getActive = () => isMax && n > 1 ? n - 1 : Math.floor(cur / ipv);

      dotsEl.innerHTML = Array.from({length: n}, (_, i) =>
        `<button class="carousel-dot${i === getActive() ? ' is-active' : ''}" aria-label="Page ${i+1}"></button>`
      ).join('');
      dotsEl.querySelectorAll('.carousel-dot').forEach((d, i) => {
        d.onclick = () => { cur = i * ipv; update(); resetAuto(); };
      });
    };

    /* Update */
    const update = () => {
      if (cur > maxIdx()) cur = maxIdx();
      if (cur < 0) cur = 0;
      const slideW = 100 / ipv;
      const gapPx  = 22;
      track.style.transform = `translateX(calc(${-cur * slideW}% - ${cur * gapPx / ipv}px))`;
      slides.forEach((s, i) =>
        s.classList.toggle('is-active', i >= cur && i < cur + ipv)
      );
      
      const isMax = cur >= maxIdx();
      const numDots = dotsEl.children.length;
      dotsEl.querySelectorAll('.carousel-dot').forEach((d, i) => {
        const activeIdx = isMax && numDots > 1 ? numDots - 1 : Math.floor(cur / ipv);
        d.classList.toggle('is-active', i === activeIdx);
      });
      prevBtn.disabled = cur === 0;
      nextBtn.disabled = isMax;
    };

    const next = () => { cur < maxIdx() ? cur++ : cur = 0; update(); };
    const prev = () => { cur > 0 ? cur-- : cur = maxIdx(); update(); };

    prevBtn.onclick = () => { prev(); resetAuto(); };
    nextBtn.onclick = () => { next(); resetAuto(); };

    /* Auto-play */
    const startAuto = () => {
      if (data.length > ipv) autoTimer = setInterval(next, 4200);
    };
    const resetAuto = () => { clearInterval(autoTimer); startAuto(); };

    /* Drag / touch */
    const getX = e => e.type.includes('mouse') ? e.pageX : e.touches[0].clientX;

    const onDragStart = e => {
      isDrag = true;
      startX = getX(e);
      prevTX = -cur * (carousel.offsetWidth / ipv);
      track.style.transition = 'none';
      clearInterval(autoTimer);
    };
    const onDragEnd = () => {
      if (!isDrag) return;
      isDrag = false;
      const moved = curTX - prevTX;
      track.style.transition = 'transform .85s cubic-bezier(.16,1,.3,1)';
      if      (moved < -80) next();
      else if (moved > 80)  prev();
      else                  update();
      startAuto();
    };
    const onDragMove = e => {
      if (!isDrag) return;
      curTX = prevTX + getX(e) - startX;
      track.style.transform = `translateX(${curTX}px)`;
    };

    carousel.addEventListener('mousedown',  onDragStart);
    carousel.addEventListener('mouseup',    onDragEnd);
    carousel.addEventListener('mouseleave', onDragEnd);
    carousel.addEventListener('mousemove',  onDragMove);
    carousel.addEventListener('touchstart', onDragStart, { passive: true });
    carousel.addEventListener('touchend',   onDragEnd);
    carousel.addEventListener('touchmove',  onDragMove,  { passive: true });
    carousel.addEventListener('dragstart',  e => e.preventDefault());

    /* Keyboard */
    carousel.setAttribute('tabindex', '0');
    carousel.addEventListener('keydown', e => {
      if (e.key === 'ArrowRight') { next(); resetAuto(); }
      if (e.key === 'ArrowLeft')  { prev(); resetAuto(); }
    });

    /* Resize */
    window.addEventListener('resize', () => { ipv = getIPV(); renderDots(); update(); });

    /* Init */
    ipv = getIPV();
    renderDots();
    update();
    startAuto();
  };

  initPartnersCarousel();
})();
</script>
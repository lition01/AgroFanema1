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
  height: calc(100svh - 78px); /* Exactly fills the remaining viewport height */
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
  padding:0 var(--pad); /* Remove bottom padding to center correctly */
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

/* Hero Badges */
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
/* Scroll cue hidden */

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

/* Section header */
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

/* Two-column layout */
.mv__cols{
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:24px;
  position:relative;z-index:1;
}

/* Each panel */
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

/* Gold top bar on hover */
.mv__panel::before{
  content:'';
  position:absolute;top:0;left:0;right:0;height:2px;
  border-radius:12px 12px 0 0;
  background:linear-gradient(90deg,transparent,var(--gold),transparent);
  opacity:0;transition:opacity .4s;
}
.mv__panel:hover::before{opacity:1}

/* Icon */
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

/* Tag */
.mv__tag{
  font-size:9.5px;font-weight:700;letter-spacing:.28em;text-transform:uppercase;
  color:var(--gold);margin-bottom:12px;
  display:flex;align-items:center;gap:8px;
}
.mv__tag::before{content:'';display:block;width:16px;height:1px;background:var(--gold)}

/* Heading */
.mv__heading{
  font-family:var(--fdis);
  font-size:clamp(26px,2.8vw,38px);
  font-weight:300;color:var(--deep);
  line-height:1.1;margin-bottom:18px;
}

/* Body */
.mv__text{
  font-size:15px;line-height:1.88;
  color:var(--muted);
  font-weight:300;
}

/* ════ PARTNERS ════ */
.partners{background:var(--dark);padding:90px var(--pad);position:relative;overflow:hidden}
.partners::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 70% 80% at 50% 50%,rgba(46,125,79,.07),transparent 65%);pointer-events:none}
.partners__fade-l,.partners__fade-r{position:absolute;top:0;bottom:0;width:180px;z-index:2;pointer-events:none}
.partners__fade-l{left:0;background:linear-gradient(90deg,var(--dark),transparent)}
.partners__fade-r{right:0;background:linear-gradient(270deg,var(--dark),transparent)}
.partners__header{text-align:center;margin-bottom:52px;position:relative;z-index:1}
.partners__label{font-size:10.5px;font-weight:600;letter-spacing:.28em;text-transform:uppercase;color:var(--gold);display:flex;align-items:center;justify-content:center;gap:12px;margin-bottom:18px}
.partners__label::before,.partners__label::after{content:'';display:block;width:24px;height:1px;background:var(--gold)}
.partners__title{font-family:var(--fdis);font-size:clamp(28px,3vw,42px);color:#fff;font-weight:300;margin-bottom:10px}
.partners__sub{font-size:14.5px;color:rgba(255,255,255,.38);font-weight:300;max-width:400px;margin:0 auto}
.rule{display:flex;align-items:center;margin-bottom:44px}
.rule__track{flex:1;height:1px;background:linear-gradient(90deg,transparent,rgba(200,168,75,.22),transparent)}
.rule__dot{width:5px;height:5px;border-radius:50%;background:var(--gold);margin:0 14px;box-shadow:0 0 10px rgba(200,168,75,.5)}
.rule--btm{margin-bottom:0;margin-top:44px}
.marquee{overflow-x:auto;scrollbar-width:none;-ms-overflow-style:none;cursor:grab}
.marquee:active{cursor:grabbing}
.marquee::-webkit-scrollbar{display:none}
.marquee__track{display:flex;width:max-content;animation:marquee 35s linear infinite} /* Adjusted speed for larger items */
.marquee__track:hover{animation-play-state:paused}
.marquee__set{display:flex;align-items:center}
.pitem{display:flex;align-items:center;gap:24px;padding:0 80px;position:relative;opacity:.45;transition:opacity .4s, transform .4s;cursor:default;white-space:nowrap}
.pitem::after{content:'';position:absolute;right:0;top:50%;transform:translateY(-50%);width:1px;height:48px;background:rgba(255,255,255,.1)}
.pitem:hover{opacity:1;transform:scale(1.02)}
.pitem__icon{width:72px;height:72px;border-radius:16px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.12);display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:background .4s,border-color .4s,transform .4s,box-shadow .4s}
.pitem:hover .pitem__icon{background:rgba(200,168,75,.18);border-color:rgba(200,168,75,.4);transform:rotate(-2deg) scale(1.1);box-shadow:0 15px 35px rgba(0,0,0,0.3)}
.pitem__icon img{width:100%;height:100%;object-fit:contain;filter:brightness(0) invert(1) opacity(.7);transition:filter .4s, transform .4s}
.pitem:hover .pitem__icon img{filter:brightness(1) invert(0) opacity(1);transform:scale(1.1)}
.pitem__name{font-family:var(--fdis);font-size:32px;font-weight:500;letter-spacing:.02em;color:#FFFFFF;text-shadow:0 0 20px rgba(255,255,255,0.1);transition:color .4s, text-shadow .4s}
.pitem:hover .pitem__name{color:var(--goldlt);text-shadow:0 0 25px rgba(226,196,114,0.3)}

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
@media(max-width:900px){
  .hero__side-label{display:none}
  .hero__content{padding-top:40px}
  .hero__botanical{width:280px;height:280px;top:-30px;right:-30px}
  .story__grid{grid-template-columns:1fr;gap:48px}
  .story__photos{height:400px;order:-1}
  .mv__cols{grid-template-columns:1fr;gap:16px}
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
}

@media(max-width:420px){
  .hero__title{font-size:clamp(44px,15vw,68px)}
  .hero__pills{gap:7px}
  .hero__pill{font-size:10px;padding:8px 14px}
  .mv__panel{padding:32px 24px}
  .collaborators__item{width:160px;padding:16px}
  .collaborators__track{gap:20px}
}
</style>
</head>
<body>

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



<!-- PARTNERS -->
<div class="ds">
<section class="partners">
  <div class="partners__fade-l"></div>
  <div class="partners__fade-r"></div>
  <div class="partners__header rv">
    <div class="partners__label">Trusted Network</div>
    <h2 class="partners__title">Partners &amp; Certifications</h2>
    <p class="partners__sub">Independently verified by the world's leading organic and sustainability bodies.</p>
  </div>
  <div class="rule rv"><div class="rule__track"></div><div class="rule__dot"></div><div class="rule__track"></div></div>
  <div class="marquee">
    <div class="marquee__track">
      <div class="marquee__set">
        <div class="pitem"><div class="pitem__icon"><img src="https://upload.wikimedia.org/wikipedia/commons/b/b0/Ecocert_logo.svg" alt="ECOCERT"></div><span class="pitem__name">ECOCERT</span></div>
        <div class="pitem"><div class="pitem__icon"><img src="https://www.ifoam.bio/sites/default/files/styles/medium/public/2020-04/ifoam_organics_international_logo_0.png" alt="IFOAM"></div><span class="pitem__name">IFOAM</span></div>
        <div class="pitem"><div class="pitem__icon"><img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/EU-Organic-Logo.svg" alt="EU Organic"></div><span class="pitem__name">EU Organic</span></div>
        <div class="pitem"><div class="pitem__icon"><img src="https://upload.wikimedia.org/wikipedia/commons/1/12/USDA_Organic_seal.svg" alt="USDA Organic"></div><span class="pitem__name">USDA</span></div>
        <div class="pitem"><div class="pitem__icon"><img src="https://upload.wikimedia.org/wikipedia/commons/0/05/Certified_B_Corporation_Logo.svg" alt="B Corp"></div><span class="pitem__name">B Corp</span></div>
        <div class="pitem"><div class="pitem__icon"><img src="https://upload.wikimedia.org/wikipedia/commons/5/5d/SGS_logo.svg" alt="SGS"></div><span class="pitem__name">SGS Cert</span></div>
        <div class="pitem"><div class="pitem__icon"><img src="https://upload.wikimedia.org/wikipedia/en/6/62/Rainforest_Alliance_Certified_logo.svg" alt="Rainforest Alliance"></div><span class="pitem__name">Rainforest</span></div>
        <div class="pitem"><div class="pitem__icon"><img src="https://upload.wikimedia.org/wikipedia/commons/3/36/Fairtrade_International_logo.svg" alt="Fairtrade"></div><span class="pitem__name">Fairtrade</span></div>
        <div class="pitem"><div class="pitem__icon"><img src="https://www.nsf.org/themes/custom/nsf/logo.svg" alt="NSF"></div><span class="pitem__name">NSF Intl</span></div>
        <div class="pitem"><div class="pitem__icon"><img src="https://www.globalgap.org/export/system/.modules/org.globalgap.site.online/resources/img/globalgap-logo.svg" alt="GlobalG.A.P"></div><span class="pitem__name">GlobalG.A.P</span></div>
      </div>
      <div class="marquee__set" aria-hidden="true">
        <div class="pitem"><div class="pitem__icon"><img src="https://upload.wikimedia.org/wikipedia/commons/b/b0/Ecocert_logo.svg" alt="ECOCERT"></div><span class="pitem__name">ECOCERT</span></div>
        <div class="pitem"><div class="pitem__icon"><img src="https://www.ifoam.bio/sites/default/files/styles/medium/public/2020-04/ifoam_organics_international_logo_0.png" alt="IFOAM"></div><span class="pitem__name">IFOAM</span></div>
        <div class="pitem"><div class="pitem__icon"><img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/EU-Organic-Logo.svg" alt="EU Organic"></div><span class="pitem__name">EU Organic</span></div>
        <div class="pitem"><div class="pitem__icon"><img src="https://upload.wikimedia.org/wikipedia/commons/1/12/USDA_Organic_seal.svg" alt="USDA Organic"></div><span class="pitem__name">USDA</span></div>
        <div class="pitem"><div class="pitem__icon"><img src="https://upload.wikimedia.org/wikipedia/commons/0/05/Certified_B_Corporation_Logo.svg" alt="B Corp"></div><span class="pitem__name">B Corp</span></div>
        <div class="pitem"><div class="pitem__icon"><img src="https://upload.wikimedia.org/wikipedia/commons/5/5d/SGS_logo.svg" alt="SGS"></div><span class="pitem__name">SGS Cert</span></div>
        <div class="pitem"><div class="pitem__icon"><img src="https://upload.wikimedia.org/wikipedia/en/6/62/Rainforest_Alliance_Certified_logo.svg" alt="Rainforest Alliance"></div><span class="pitem__name">Rainforest</span></div>
        <div class="pitem"><div class="pitem__icon"><img src="https://upload.wikimedia.org/wikipedia/commons/3/36/Fairtrade_International_logo.svg" alt="Fairtrade"></div><span class="pitem__name">Fairtrade</span></div>
        <div class="pitem"><div class="pitem__icon"><img src="https://www.nsf.org/themes/custom/nsf/logo.svg" alt="NSF"></div><span class="pitem__name">NSF Intl</span></div>
        <div class="pitem"><div class="pitem__icon"><img src="https://www.globalgap.org/export/system/.modules/org.globalgap.site.online/resources/img/globalgap-logo.svg" alt="GlobalG.A.P"></div><span class="pitem__name">GlobalG.A.P</span></div>
      </div>
    </div>
  </div>
  <div class="rule rule--btm"><div class="rule__track"></div><div class="rule__dot"></div><div class="rule__track"></div></div>
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

<!-- COLLABORATORS -->
<div class="ds">
<section class="collaborators">
  <div class="collaborators__header rv">
    <div class="collaborators__label">Our Partners</div>
    <h2 class="collaborators__title">Collaborating for a <em>Greener Future</em></h2>
    <p class="collaborators__intro">We work closely with leading companies in agriculture and sustainability to bring you the best organic solutions.</p>
  </div>
  <div class="collaborators__carousel">
    <div class="collaborators__track" id="collaboratorsTrack">
      <!-- Collaborators will be loaded here -->
    </div>
  </div>
</section>
</div>

<script>
  (()=>{
    const io=new IntersectionObserver(entries=>{
      entries.forEach(e=>{if(e.isIntersecting){e.target.classList.add('vis');io.unobserve(e.target)}});
    },{threshold:.08,rootMargin:'0px 0px -30px 0px'});
    document.querySelectorAll('.rv,.rvs').forEach(el=>io.observe(el));

    // Marquee Drag Scroll
    const marquee = document.querySelector('.marquee');
    let isDown = false;
    let startX;
    let scrollLeft;

    marquee.addEventListener('mousedown', (e) => {
      isDown = true;
      marquee.classList.add('active');
      startX = e.pageX - marquee.offsetLeft;
      scrollLeft = marquee.scrollLeft;
    });
    marquee.addEventListener('mouseleave', () => {
      isDown = false;
    });
    marquee.addEventListener('mouseup', () => {
      isDown = false;
    });
    marquee.addEventListener('mousemove', (e) => {
      if(!isDown) return;
      e.preventDefault();
      const x = e.pageX - marquee.offsetLeft;
      const walk = (x - startX) * 2;
      marquee.scrollLeft = scrollLeft - walk;
    });

    // Load Collaborators
    const loadCollaborators = () => {
      const collaborators = JSON.parse(localStorage.getItem('agro_collaborators_v1') || '[]');
      const track = document.getElementById('collaboratorsTrack');
      if (!track) return;

      if (collaborators.length === 0) {
        track.innerHTML = '<div style="width:100%; text-align:center; padding:40px; color:var(--muted);">No collaborators yet.</div>';
        return;
      }

      // Duplicate for seamless loop
      const allItems = [...collaborators, ...collaborators];
      track.innerHTML = allItems.map(c => `
        <div class="collaborators__item">
          <div class="collaborators__logo">
            <img src="${c.logo}" alt="${c.name} logo" loading="lazy">
          </div>
          <div class="collaborators__name">${c.name}</div>
          <div class="collaborators__desc">${c.description || ''}</div>
          <a href="${c.website}" target="_blank" class="collaborators__link">Visit Website</a>
        </div>
      `).join('');
    };

    loadCollaborators();

    // Listen for storage changes to update collaborators dynamically
    window.addEventListener('storage', (e) => {
      if (e.key === 'agro_collaborators_v1') {
        loadCollaborators();
      }
    });
  })();
  </script>
</section>
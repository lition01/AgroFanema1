<?php // About Us Page Section — AgroFanema ?>

<section class="gg-about-us-scope" id="about-lux" aria-label="About AgroFanema">
  <style>
    .gg-about-us-scope *,
    .gg-about-us-scope *::before,
    .gg-about-us-scope *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    .gg-about-us-scope {
      --deep: #0A1B10;
      --dark: #0F2418;
      --mid: #1A3D26;
      --vivid: #2E7D4F;
      --bright: #3DAA68;
      --gold: #C8A84B;
      --goldlt: #E2C472;
      --bg: #F5F2EA;
      --card: #FDFCF8;
      --text: #2A2A26;
      --muted: #6B6B62;
      --border: #E2DFD8;
      --pad: clamp(28px, 7vw, 100px);
      --fdis: 'Cormorant Garamond', Georgia, serif;
      --fbody: 'Outfit', sans-serif;

      font-family: var(--fbody);
      background: var(--bg);
      color: var(--text);
      overflow: hidden;
    }

    .gg-about-us-scope .ds {
      background: var(--deep);
      color: #fff;
    }

    .gg-about-us-scope .ls {
      background: var(--bg);
      color: var(--text);
    }

    @keyframes fadeUp {
      from {
        opacity: 0;
        transform: translateY(40px)
      }

      to {
        opacity: 1;
        transform: none
      }
    }

    @keyframes fadeIn {
      from {
        opacity: 0
      }

      to {
        opacity: 1
      }
    }

    @keyframes scalePop {
      from {
        opacity: 0;
        transform: scale(.88)
      }

      to {
        opacity: 1;
        transform: scale(1)
      }
    }

    @keyframes drawLine {
      from {
        stroke-dashoffset: 2000
      }

      to {
        stroke-dashoffset: 0
      }
    }

    @keyframes marquee {
      from {
        transform: translateX(0)
      }

      to {
        transform: translateX(-50%)
      }
    }

    @keyframes pulse {

      0%,
      100% {
        box-shadow: 0 0 0 0 rgba(200, 168, 75, .35)
      }

      50% {
        box-shadow: 0 0 0 16px rgba(200, 168, 75, 0)
      }
    }

    @keyframes kenburns {
      0% {
        transform: scale(1) translateX(0)
      }

      100% {
        transform: scale(1.09) translateX(-20px)
      }
    }

    @keyframes shimmer {
      from {
        transform: translateX(-100%)
      }

      to {
        transform: translateX(200%)
      }
    }

    @keyframes breathe {

      0%,
      100% {
        transform: scale(1)
      }

      50% {
        transform: scale(1.015)
      }
    }

    .rv {
      opacity: 0;
      transform: translateY(36px);
      transition: opacity .85s cubic-bezier(0, 0, .2, 1), transform .85s cubic-bezier(0, 0, .2, 1)
    }

    .rv.vis {
      opacity: 1;
      transform: none
    }

    .rv.d1 {
      transition-delay: .08s
    }

    .rv.d2 {
      transition-delay: .18s
    }

    .rv.d3 {
      transition-delay: .29s
    }

    .rv.d4 {
      transition-delay: .4s
    }

    .rvs {
      opacity: 0;
      transform: scale(.93);
      transition: opacity .9s cubic-bezier(0, 0, .2, 1), transform .9s cubic-bezier(0, 0, .2, 1)
    }

    .rvs.vis {
      opacity: 1;
      transform: scale(1)
    }

    /* ════ HERO ════ */
    .hero {
      position: relative;
      height: calc(100svh - 78px);
      display: flex;
      flex-direction: column;
      justify-content: center;
      overflow: hidden;
      isolation: isolate;
    }

    .hero__bg {
      position: absolute;
      inset: 0;
      z-index: 0;
      background: url('https://images.unsplash.com/photo-1500382017468-9049fed747ef?w=1800&q=85&fit=crop') center/cover no-repeat;
      animation: kenburns 24s ease-in-out infinite alternate;
      will-change: transform;
    }

    .hero__overlay {
      position: absolute;
      inset: 0;
      z-index: 1;
      background:
        linear-gradient(to top,
          rgba(5, 12, 7, .96) 0%,
          rgba(5, 12, 7, .78) 25%,
          rgba(5, 12, 7, .44) 52%,
          rgba(5, 12, 7, .18) 74%,
          rgba(5, 12, 7, .06) 100%),
        linear-gradient(105deg,
          rgba(5, 12, 7, .9) 0%,
          rgba(5, 12, 7, .55) 40%,
          rgba(5, 12, 7, .1) 70%,
          transparent 100%);
    }

    .hero__grain {
      position: absolute;
      inset: 0;
      z-index: 2;
      pointer-events: none;
      opacity: .05;
      background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 512 512' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.78' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='512' height='512' filter='url(%23n)'/%3E%3C/svg%3E");
      background-size: 220px;
    }

    .hero__botanical {
      position: absolute;
      top: -80px;
      right: -80px;
      width: 560px;
      height: 560px;
      z-index: 2;
      pointer-events: none;
      opacity: .10;
    }

    .hero__botanical .b1,
    .hero__botanical .b2,
    .hero__botanical .b3,
    .hero__botanical .b4 {
      fill: none;
      stroke-dasharray: 2000;
      stroke-dashoffset: 2000;
    }

    .hero__botanical .b1 {
      stroke: #C8A84B;
      stroke-width: .7;
      animation: drawLine 4.5s .3s ease-out forwards
    }

    .hero__botanical .b2 {
      stroke: #C8A84B;
      stroke-width: .45;
      animation: drawLine 4.5s .9s ease-out forwards
    }

    .hero__botanical .b3 {
      stroke: #C8A84B;
      stroke-width: .3;
      animation: drawLine 4.5s 1.5s ease-out forwards
    }

    .hero__botanical .b4 {
      stroke: #3DAA68;
      stroke-width: .25;
      animation: drawLine 4.5s 2.1s ease-out forwards
    }

    .hero__side-label {
      position: absolute;
      left: 26px;
      top: 50%;
      z-index: 4;
      transform: translateY(-50%) rotate(180deg);
      writing-mode: vertical-rl;
      font-size: 9px;
      font-weight: 600;
      letter-spacing: .32em;
      text-transform: uppercase;
      color: rgba(255, 255, 255, .2);
      display: flex;
      align-items: center;
      gap: 16px;
      animation: fadeIn 2s 2s both;
    }

    .hero__side-label::before {
      content: '';
      display: block;
      width: 1px;
      height: 56px;
      background: linear-gradient(to bottom, transparent, rgba(255, 255, 255, .22));
    }

    .hero__content {
      position: relative;
      z-index: 4;
      padding: 0 var(--pad);
      max-width: 860px;
    }

    .hero__eyebrow {
      display: inline-flex;
      align-items: center;
      gap: 14px;
      font-size: 10px;
      font-weight: 600;
      letter-spacing: .34em;
      text-transform: uppercase;
      color: var(--gold);
      margin-bottom: 30px;
      animation: fadeUp .9s cubic-bezier(0, 0, .2, 1) both;
    }

    .hero__eyebrow-dot {
      width: 7px;
      height: 7px;
      border-radius: 50%;
      background: var(--gold);
      flex-shrink: 0;
      animation: pulse 2.6s ease-in-out infinite;
    }

    .hero__eyebrow-line {
      display: block;
      width: 38px;
      height: 1px;
      background: var(--gold)
    }

    .hero__title {
      font-family: var(--fdis);
      font-size: clamp(58px, 9.5vw, 132px);
      font-weight: 300;
      line-height: .97;
      letter-spacing: -.022em;
      color: #fff;
      animation: fadeUp .9s .12s cubic-bezier(0, 0, .2, 1) both;
    }

    .hero__title span {
      display: block
    }

    .hero__title em {
      display: block;
      font-style: italic;
      color: var(--goldlt)
    }

    .hero__underline {
      position: relative;
      overflow: hidden;
      height: 1px;
      width: clamp(120px, 20vw, 280px);
      margin: 30px 0 34px;
      background: linear-gradient(90deg, var(--gold), rgba(226, 196, 114, .28) 60%, transparent);
      animation: fadeIn 1s .4s both;
    }

    .hero__underline::after {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(90deg, transparent 0%, rgba(255, 255, 255, .75) 50%, transparent 100%);
      animation: shimmer 3s 1.6s ease-in-out infinite;
    }

    .hero__tagline {
      font-size: clamp(14px, 1.45vw, 17px);
      line-height: 1.88;
      color: rgba(255, 255, 255, .55);
      font-weight: 300;
      max-width: 460px;
      margin-bottom: 42px;
      animation: fadeUp .9s .24s cubic-bezier(0, 0, .2, 1) both;
    }

    .hero__badges {
      display: flex;
      gap: 32px;
      margin-top: 24px;
      animation: fadeUp .9s .36s cubic-bezier(0, 0, .2, 1) both;
    }

    .hero__badge-item {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .hero__badge-icon {
      width: 38px;
      height: 38px;
      border-radius: 50%;
      border: 1px solid rgba(200, 168, 75, .3);
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--gold);
    }

    .hero__badge-icon svg {
      width: 18px;
      height: 18px;
      stroke-width: 1.5
    }

    .hero__badge-text {
      font-size: 9.5px;
      font-weight: 600;
      letter-spacing: .15em;
      text-transform: uppercase;
      color: rgba(255, 255, 255, .7);
      line-height: 1.3;
    }

    .hero__badge-text strong {
      display: block;
      color: var(--goldlt);
      font-weight: 700
    }

    /* ════ STORY ════ */
    .story {
      padding: 120px var(--pad);
      position: relative
    }

    .story::before {
      content: '';
      position: absolute;
      inset: 0;
      pointer-events: none;
      background: radial-gradient(ellipse 60% 50% at 100% 0%, rgba(46, 125, 79, .06), transparent 60%), radial-gradient(ellipse 40% 40% at 0% 100%, rgba(200, 168, 75, .04), transparent 60%)
    }

    .story__grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 80px;
      align-items: center;
      position: relative;
      z-index: 1
    }

    .story__label {
      font-size: 10.5px;
      font-weight: 600;
      letter-spacing: .26em;
      text-transform: uppercase;
      color: var(--vivid);
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 20px
    }

    .story__label::before {
      content: '';
      width: 28px;
      height: 1px;
      background: var(--vivid);
      display: block
    }

    .story__title {
      font-family: var(--fdis);
      font-size: clamp(38px, 4.5vw, 58px);
      font-weight: 300;
      line-height: 1.1;
      color: var(--deep);
      margin-bottom: 8px
    }

    .story__title em {
      font-style: italic;
      color: var(--gold)
    }

    .story__divider {
      width: 52px;
      height: 2px;
      background: linear-gradient(90deg, var(--gold), var(--goldlt), transparent);
      margin: 28px 0
    }

    .story__body {
      font-size: 15.5px;
      line-height: 1.9;
      color: var(--muted);
      font-weight: 300;
      margin-bottom: 20px
    }

    .story__quote {
      border-left: 2px solid var(--gold);
      padding: 4px 0 4px 24px;
      margin: 32px 0;
      font-family: var(--fdis);
      font-size: 21px;
      font-style: italic;
      font-weight: 300;
      color: var(--deep);
      line-height: 1.6;
      opacity: .8
    }

    .story__metrics {
      display: flex;
      gap: 40px;
      margin-top: 36px
    }

    .story__metric-num {
      font-family: var(--fdis);
      font-size: 38px;
      font-weight: 500;
      color: var(--vivid);
      line-height: 1
    }

    .story__metric-label {
      font-size: 11px;
      font-weight: 500;
      letter-spacing: .1em;
      text-transform: uppercase;
      color: var(--muted);
      margin-top: 4px
    }

    .story__photos {
      position: relative;
      height: 600px
    }

    .story__photo {
      position: absolute;
      border-radius: 6px;
      overflow: hidden;
      box-shadow: 0 24px 60px rgba(10, 27, 16, .14)
    }

    .story__photo img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block
    }

    .story__photo--main {
      width: 78%;
      height: 76%;
      top: 0;
      left: 0
    }

    .story__photo--secondary {
      width: 52%;
      height: 48%;
      bottom: 0;
      right: 0;
      border: 4px solid var(--bg);
      z-index: 2
    }

    .story__corner {
      position: absolute;
      top: -16px;
      left: -16px;
      width: 64px;
      height: 64px;
      border-top: 2px solid rgba(200, 168, 75, .3);
      border-left: 2px solid rgba(200, 168, 75, .3);
      pointer-events: none
    }

    .story__badge {
      position: absolute;
      top: 42%;
      right: -20px;
      width: 96px;
      height: 96px;
      background: var(--gold);
      border-radius: 50%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      z-index: 3;
      box-shadow: 0 10px 32px rgba(200, 168, 75, .32);
      animation: pulse 3s ease-in-out infinite
    }

    .story__badge-num {
      font-family: var(--fdis);
      font-size: 26px;
      font-weight: 600;
      color: var(--deep);
      line-height: 1
    }

    .story__badge-txt {
      font-size: 8.5px;
      font-weight: 600;
      letter-spacing: .08em;
      text-transform: uppercase;
      color: var(--deep);
      opacity: .7;
      text-align: center;
      line-height: 1.4;
      margin-top: 2px
    }

    /* ════ PARTNERS ════ */
    .partners {
      background: #0B1E12;
      padding: 120px var(--pad);
      position: relative;
      overflow: hidden;
      isolation: isolate;
    }

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

    .partners__header {
      text-align: center;
      margin-bottom: 60px;
      position: relative;
      z-index: 1;
    }

    .partners__label {
      font-size: 10.5px;
      font-weight: 700;
      letter-spacing: .46em;
      text-transform: uppercase;
      color: var(--gold);
      display: inline-flex;
      align-items: center;
      gap: 20px;
      margin-bottom: 22px;
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
      margin-bottom: 22px;
      letter-spacing: -.022em;
    }

    .partners__title em {
      font-style: italic;
      color: var(--goldlt);
    }

    .partners__sub {
      font-size: 15.5px;
      color: rgba(255, 255, 255, .38);
      font-weight: 300;
      max-width: 540px;
      margin: 0 auto;
      line-height: 1.85;
    }

    .carousel-container {
      position: relative;
      z-index: 1;
    }

    .carousel-viewport {
      overflow: hidden;
      cursor: grab;
      mask-image: linear-gradient(90deg, transparent 0%, #000 7%, #000 93%, transparent 100%);
      -webkit-mask-image: linear-gradient(90deg, transparent 0%, #000 7%, #000 93%, transparent 100%);
      padding: 20px 0 30px;
    }

    .carousel-track {
      display: flex;
      gap: 22px;
      transition: transform .85s cubic-bezier(.16, 1, .3, 1);
      will-change: transform;
    }

    .carousel-slide {
      flex: 0 0 calc(25% - 17px);
      min-width: 250px;
      opacity: .38;
      transform: scale(.93) translateY(10px);
      transition: all .75s cubic-bezier(.16, 1, .3, 1);
    }

    .carousel-slide.is-active {
      opacity: 1;
      transform: scale(1) translateY(0);
    }

    .pitem__card {
      position: relative;
      border-radius: 24px;
      padding: 42px 24px 34px;
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      background: rgba(255, 255, 255, .035);
      border: 1px solid rgba(255, 255, 255, .07);
      transition: all .55s cubic-bezier(.16, 1, .3, 1);
      overflow: hidden;
    }

    .pitem__card:hover {
      transform: translateY(-12px);
      border-color: rgba(200, 168, 75, .25);
      background: rgba(255, 255, 255, .05);
      box-shadow: 0 32px 64px rgba(0, 0, 0, .3);
    }

    .pitem__icon {
      width: 140px;
      height: 140px;
      border-radius: 50%;
      border: 1px solid rgba(255, 255, 255, .1);
      background: rgba(255, 255, 255, .04);
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 24px;
    }

    .pitem__icon img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 50%;
    }

    .pitem__name {
      font-family: var(--fdis);
      font-size: 22px;
      color: #fff;
      margin-bottom: 12px;
    }

    .pitem__divider {
      width: 30px;
      height: 1px;
      background: rgba(200, 168, 75, .3);
      margin-bottom: 20px;
    }

    .pitem__link {
      font-size: 10px;
      font-weight: 700;
      letter-spacing: .2em;
      text-transform: uppercase;
      color: var(--goldlt);
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }

    .pitem__link svg {
      width: 12px;
      height: 12px;
      stroke: currentColor;
      fill: none;
      stroke-width: 2;
    }

    .carousel-nav {
      display: flex;
      justify-content: center;
      gap: 16px;
      margin-top: 32px;
    }

    .carousel-btn {
      width: 62px;
      height: 62px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.03);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border: 1px solid rgba(255, 255, 255, 0.08);
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
      position: relative;
      overflow: hidden;
    }

    .carousel-btn::before {
      content: '';
      position: absolute;
      inset: 0;
      background: var(--gold);
      transform: scale(0);
      transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
      z-index: -1;
      border-radius: 50%;
    }

    .carousel-btn:hover:not(.is-disabled) {
      color: var(--deep);
      border-color: var(--gold);
      transform: translateY(-4px);
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3), 0 0 0 4px rgba(200, 168, 75, 0.15);
    }

    .carousel-btn:hover:not(.is-disabled)::before {
      transform: scale(1);
    }

    .carousel-btn svg {
      width: 24px;
      height: 24px;
      stroke: currentColor;
      fill: none;
      stroke-width: 2;
      transition: transform 0.3s ease;
    }

    .carousel-btn:hover:not(.is-disabled) svg {
      transform: scale(1.1);
    }

    .carousel-btn.is-disabled {
      opacity: 0.15;
      cursor: not-allowed;
      filter: grayscale(1);
      transform: none !important;
      box-shadow: none !important;
    }

    .carousel-dots {
      display: flex;
      justify-content: center;
      gap: 14px;
      margin-top: 36px;
    }

    .carousel-dot {
      width: 10px;
      height: 10px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.15);
      border: 1px solid rgba(255, 255, 255, 0.1);
      cursor: pointer;
      transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
      padding: 0;
    }

    .carousel-dot:hover {
      background: rgba(255, 255, 255, 0.3);
      transform: scale(1.2);
    }

    .carousel-dot.is-active {
      background: var(--gold);
      width: 32px;
      border-radius: 20px;
      border-color: var(--gold);
      box-shadow: 0 0 15px rgba(200, 168, 75, 0.4);
    }

    /* ════ CTA ════ */
    .cta {
      padding: 130px var(--pad);
      text-align: center;
      position: relative;
      overflow: hidden
    }

    .cta::before {
      content: '';
      position: absolute;
      inset: 0;
      background: radial-gradient(ellipse 65% 65% at 50% 55%, rgba(46, 125, 79, .07), transparent);
      pointer-events: none
    }

    .cta__ring {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      border-radius: 50%;
      pointer-events: none
    }

    .cta__ring:nth-child(1) {
      width: 680px;
      height: 680px;
      border: 1px solid rgba(46, 125, 79, .055)
    }

    .cta__ring:nth-child(2) {
      width: 450px;
      height: 450px;
      border: 1px solid rgba(46, 125, 79, .085)
    }

    .cta__ring:nth-child(3) {
      width: 230px;
      height: 230px;
      border: 1px solid rgba(200, 168, 75, .13)
    }

    .cta__eyebrow {
      font-size: 10.5px;
      font-weight: 600;
      letter-spacing: .28em;
      text-transform: uppercase;
      color: var(--vivid);
      margin-bottom: 22px
    }

    .cta__title {
      font-family: var(--fdis);
      font-size: clamp(40px, 5.5vw, 74px);
      font-weight: 300;
      color: var(--deep);
      max-width: 660px;
      margin: 0 auto 26px;
      line-height: 1.1
    }

    .cta__title em {
      font-style: italic;
      color: var(--gold)
    }

    .cta__sub {
      font-size: 15.5px;
      color: var(--muted);
      max-width: 450px;
      margin: 0 auto 52px;
      font-weight: 300;
      line-height: 1.8
    }

    .cta__btns {
      display: flex;
      gap: 14px;
      justify-content: center;
      flex-wrap: wrap
    }

    .btn {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 16px 38px;
      font-size: 12px;
      font-weight: 600;
      letter-spacing: .12em;
      text-transform: uppercase;
      text-decoration: none;
      border-radius: 100px;
      transition: all .38s
    }

    .btn svg {
      width: 15px;
      height: 15px;
      fill: none;
      stroke: currentColor;
      stroke-width: 2;
    }

    .btn--solid {
      background: var(--deep);
      color: #fff;
      border: 1px solid var(--deep)
    }

    .btn--solid:hover {
      background: var(--mid);
      transform: translateY(-3px);
      box-shadow: 0 12px 36px rgba(10, 27, 16, .18)
    }

    .btn--outline {
      background: transparent;
      color: var(--deep);
      border: 1px solid var(--border)
    }

    .btn--outline:hover {
      background: rgba(0, 0, 0, 0.03);
      transform: translateY(-3px)
    }

    @media(max-width:900px) {
      .story__grid {
        grid-template-columns: 1fr;
        gap: 48px
      }

      .story__photos {
        height: 400px;
        order: -1
      }

      .carousel-slide {
        flex: 0 0 calc(50% - 11px)
      }
    }

    @media(max-width:640px) {
      .hero__title {
        font-size: clamp(50px, 14vw, 80px)
      }

      .carousel-slide {
        flex: 0 0 100%
      }
    }
  </style>

  <!-- HERO -->
  <div class="ds">
    <section class="hero">
      <div class="hero__bg"></div>
      <div class="hero__overlay"></div>
      <div class="hero__grain"></div>
      <svg class="hero__botanical" viewBox="0 0 560 560" fill="none">
        <circle class="b1" cx="280" cy="280" r="265" />
        <circle class="b2" cx="280" cy="280" r="215" />
        <circle class="b3" cx="280" cy="280" r="158" />
        <circle class="b4" cx="280" cy="280" r="95" />
        <line class="b1" x1="280" y1="15" x2="280" y2="545" />
        <line class="b1" x1="15" y1="280" x2="545" y2="280" />
      </svg>
      <div class="hero__side-label"><?php echo t('scroll_explore'); ?></div>
      <div class="hero__content">
        <div class="hero__eyebrow">
          <div class="hero__eyebrow-dot"></div><span class="hero__eyebrow-line"></span><?php echo t('heritage'); ?>
        </div>
        <h1 class="hero__title"><span><?php echo t('about'); ?></span><em>AgroFanema</em></h1>
        <div class="hero__underline"></div>
        <p class="hero__tagline"><?php echo t('nourish_earth'); ?></p>
        <div class="hero__badges">
          <div class="hero__badge-item">
            <div class="hero__badge-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
              </svg></div>
            <div class="hero__badge-text"><strong><?php echo t('premium_organic'); ?></strong></div>
          </div>
          <div class="hero__badge-item">
            <div class="hero__badge-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                <polyline points="22 4 12 14.01 9 11.01" />
              </svg></div>
            <div class="hero__badge-text"><strong><?php echo t('certified_standard'); ?></strong></div>
          </div>
          <div class="hero__badge-item">
            <div class="hero__badge-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <circle cx="12" cy="12" r="10" />
                <polyline points="12 6 12 12 16 14" />
              </svg></div>
            <div class="hero__badge-text"><strong><?php echo t('since'); ?></strong>1994</div>
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
          <div class="story__label rv"><?php echo t('our_origin'); ?></div>
          <h2 class="story__title rv d1"><?php echo t('rooted_passion'); ?></h2>
          <div class="story__divider rv d2"></div>
          <p class="story__body rv d2"><?php echo t('origin_1'); ?></p>
          <p class="story__body rv d3"><?php echo t('origin_2'); ?></p>
          <blockquote class="story__quote rv d3"><?php echo t('founder_quote'); ?></blockquote>
          <p class="story__body rv d4"><?php echo t('origin_3'); ?></p>
          <div class="story__metrics rv d4">
            <div>
              <div class="story__metric-num">28</div>
              <div class="story__metric-label"><?php echo t('countries'); ?></div>
            </div>
            <div>
              <div class="story__metric-num">32</div>
              <div class="story__metric-label"><?php echo t('years_active'); ?></div>
            </div>
            <div>
              <div class="story__metric-num">50K+</div>
              <div class="story__metric-label"><?php echo t('growers'); ?></div>
            </div>
          </div>
        </div>
        <div class="story__photos rvs">
          <div class="story__corner"></div>
          <div class="story__photo story__photo--main"><img
              src="https://images.unsplash.com/photo-1530836369250-ef72a3f5cda8?w=700&q=80&fit=crop"
              alt="Organic farming" /></div>
          <div class="story__photo story__photo--secondary"><img
              src="https://images.unsplash.com/photo-1416879595882-3373a0480b5b?w=500&q=80&fit=crop"
              alt="Healthy plants" /></div>
          <div class="story__badge">
            <div class="story__badge-num">32</div>
            <div class="story__badge-txt"><?php echo t('years_excellence'); ?></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- PARTNERS -->
  <div class="ds" id="partners-anchor">
    <section class="partners">
      <div class="partners__header">
        <div class="partners__label rv"><?php echo t('trusted_network'); ?></div>
        <h2 class="partners__title rv d1"><?php echo t('partners_certifications'); ?></h2>
        <p class="partners__sub rv d2"><?php echo t('partners_sub'); ?></p>
      </div>

      <div class="carousel-container rv d3">
        <div class="carousel-viewport">
          <div class="carousel-track" id="partTrack">
            <?php
            try {
              $stmt = $pdo->query("SELECT * FROM collaborators ORDER BY created_at DESC");
              $collabs = $stmt->fetchAll();

              if (empty($collabs)) {
                echo '<div style="color:rgba(255,255,255,0.3); text-align:center; width:100%; padding:80px; font-size:18px;">No partners listed yet.</div>';
              } else {
                foreach ($collabs as $index => $c) {
                  $activeClass = ($index === 0) ? "is-active" : "";
                  echo "
                    <div class='carousel-slide $activeClass'>
                      <div class='pitem__card'>
                        <div class='pitem__icon'>
                          <img src='" . htmlspecialchars($c['logo'] ?? '') . "' alt='" . htmlspecialchars($c['name'] ?? '') . "'>
                        </div>
                        <h3 class='pitem__name'>" . htmlspecialchars($c['name'] ?? '') . "</h3>
                        <div class='pitem__divider'></div>
                        <a href='" . htmlspecialchars($c['website'] ?? '#') . "' target='_blank' class='pitem__link'>
                          Visit Website
                          <svg viewBox='0 0 24 24'><path d='M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6M15 3h6v6M10 14L21 3'/></svg>
                        </a>
                      </div>
                    </div>";
                }
              }
            } catch (Exception $e) {
              echo "<!-- Carousel Error: " . $e->getMessage() . " -->";
            }
            ?>
          </div>
        </div>

        <?php if (!empty($collabs) && count($collabs) > 1): ?>
          <div class="carousel-nav">
            <button class="carousel-btn" id="partPrevBtn"><svg viewBox="0 0 24 24">
                <path d="M15 18l-6-6 6-6" />
              </svg></button>
            <button class="carousel-btn" id="partNextBtn"><svg viewBox="0 0 24 24">
                <path d="M9 18l6-6-6-6" />
              </svg></button>
          </div>
          <div class="carousel-dots" id="partDots"></div>
        <?php endif; ?>
      </div>
    </section>
  </div>

  <!-- CTA -->
  <div class="ls">
    <div class="cta">
      <div class="cta__ring"></div>
      <div class="cta__ring"></div>
      <div class="cta__ring"></div>
      <p class="cta__eyebrow rv"><?php echo t('ready_grow'); ?></p>
      <h2 class="cta__title rv d1"><?php echo t('heavy_lifting'); ?></h2>
      <p class="cta__sub rv d2"><?php echo t('cta_sub'); ?></p>
      <div class="cta__btns rv d3">
        <a href="products.php" class="btn btn--solid"><?php echo t('explore_products'); ?> <svg viewBox="0 0 24 24">
            <path d="M5 12h14M12 5l7 7-7 7" />
          </svg></a>
        <a href="contact.php" class="btn btn--outline"><?php echo t('contact_us'); ?></a>
      </div>
    </div>
  </div>

  <script>
    (() => {
      /* Scroll-reveal */
      const io = new IntersectionObserver(entries => {
        entries.forEach(e => {
          if (e.isIntersecting) { e.target.classList.add('vis'); io.unobserve(e.target); }
        });
      }, { threshold: .08 });
      document.querySelectorAll('.rv,.rvs').forEach(el => io.observe(el));

      /* Partners Carousel */
      (() => {
        const track = document.getElementById('partTrack');
        const slides = Array.from(track?.children || []);
        if (slides.length < 2) return;

        const nextBtn = document.getElementById('partNextBtn');
        const prevBtn = document.getElementById('partPrevBtn');
        const dotsNav = document.getElementById('partDots');
        let cur = 0;

        slides.forEach((_, i) => {
          const d = document.createElement('button');
          d.className = `carousel-dot ${i === 0 ? 'is-active' : ''}`;
          d.onclick = () => go(i);
          dotsNav.appendChild(d);
        });
        const dots = Array.from(dotsNav.children || []);

        function getW() {
          const slideW = slides[0]?.getBoundingClientRect()?.width || 0;
          return slideW + 22;
        }

        function go(idx) {
          const len = slides.length;
          // Wrap around for infinite loop
          if (idx < 0) idx = len - 1;
          if (idx >= len) idx = 0;

          cur = idx;
          const w = getW();
          const vpW = track.parentElement.offsetWidth;
          
          // Calculate offset to center the active card
          const centerX = (vpW / 2) - (w / 2);
          const scrollX = centerX - (cur * w);
          
          track.style.transform = `translateX(${scrollX}px)`;

          slides.forEach((s, i) => s.classList.toggle('is-active', i === cur));
          dots.forEach((d, i) => d.classList.toggle('is-active', i === cur));
        }

        if (nextBtn) nextBtn.onclick = () => go(cur + 1);
        if (prevBtn) prevBtn.onclick = () => go(cur - 1);

        go(0); // init state

        let auto = setInterval(() => go(cur + 1), 5000);

        track.parentElement.onmouseenter = () => clearInterval(auto);
        track.parentElement.onmouseleave = () => {
          clearInterval(auto);
          auto = setInterval(() => go(cur + 1), 5000);
        };
        window.addEventListener('resize', () => go(cur));
      })();
    })();
  </script>
</section>
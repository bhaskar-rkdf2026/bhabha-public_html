<script>
if (typeof window.__chromium_devtools_metrics_reporter !== 'function') {
  window.__chromium_devtools_metrics_reporter = function() {};
}
</script>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <link rel="icon" href="<?php echo URL_IMG;?>favicon.png" type="image/gif" sizes="16x16"> 
<!-- Modern Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,600&family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,600&display=swap" rel="stylesheet">
<!-- Font Awesome Icons (Instant Local Loading for Fast Performance) -->
<link rel="stylesheet" href="<?php echo URL_CSS;?>font-awesome.min.css">
<link href="<?php echo URL_CSS;?>bootstrap.min.css" rel="stylesheet">
<!-- BU Global Page Redesign CSS -->
<link href="<?php echo URL_CSS;?>bu-global.css?v=<?php echo time(); ?>" rel="stylesheet">

<style>
/* ============================================================
   BHABHA UNIVERSITY - NEW MODERN HEADER STYLES (Navy & Gold)
   ============================================================ */
:root {
  --bu-navy: #0A1B54;
  --bu-navy-dark: #051235;
  --bu-gold: #FFC107;
  --bu-gold-dark: #D99B00;
  --bu-bg-header: #FAF8F5;
}

/* Reset old header */
#header_2, header#header_2 { display: none !important; }
.kode_navigation, .top_bar_2, .breaking-news-ticker { display: none !important; }

body { font-family: 'Plus Jakarta Sans', sans-serif !important; }

/* ---- TOP UTILITY BAR ---- */
.bu-header-wrapper { position: relative; z-index: 999; }
.bu-topbar {
  background-color: var(--bu-navy) !important;
  padding: 6px 0 !important;
  border-bottom: 1px solid rgba(255,255,255,0.08) !important;
}
.bu-topbar-container {
  display: flex !important;
  align-items: center !important;
  justify-content: space-between !important;
  max-width: 1400px !important;
  margin: 0 auto !important;
  padding: 0 16px !important;
  overflow: hidden !important;
}
.bu-topbar-left {
  display: flex !important;
  align-items: center !important;
  flex-wrap: nowrap !important;
  flex-shrink: 1 !important;
  min-width: 0 !important;
  overflow-x: auto !important;
  scrollbar-width: none !important;
}
.bu-topbar-left::-webkit-scrollbar { display: none !important; }
.bu-topbar-links {
  display: flex !important;
  align-items: center !important;
  gap: 0 !important;
  list-style: none !important;
  margin: 0 !important;
  padding: 0 !important;
  flex-wrap: nowrap !important;
  white-space: nowrap !important;
}
.bu-topbar-links li { margin: 0 !important; padding: 0 !important; flex-shrink: 0 !important; white-space: nowrap !important; }
.bu-topbar-links li a {
  color: rgba(255,255,255,0.92) !important;
  text-decoration: none !important;
  font-size: 10px !important;
  font-weight: 600 !important;
  letter-spacing: 0.5px !important;
  text-transform: uppercase !important;
  padding: 0 9px !important;
  border-right: 1px solid rgba(255,255,255,0.18) !important;
  display: inline-block !important;
  line-height: 1 !important;
  white-space: nowrap !important;
  transition: color 0.2s !important;
}
.bu-topbar-links li:last-child a { border-right: none !important; }
.bu-topbar-links li a:hover { color: var(--bu-gold) !important; text-decoration: none !important; }
.bu-topbar-right {
  display: flex !important;
  align-items: center !important;
  gap: 14px !important;
  flex-shrink: 0 !important;
  white-space: nowrap !important;
}
.bu-topbar-phone {
  color: #fff !important; font-size: 12px !important; font-weight: 700 !important;
  text-decoration: none !important; display: flex !important; align-items: center !important; gap: 6px !important;
}
.bu-topbar-phone i { color: var(--bu-gold) !important; }
.bu-btn-top-gold {
  background-color: var(--bu-gold) !important;
  color: var(--bu-navy) !important;
  font-size: 11px !important;
  font-weight: 800 !important;
  padding: 5px 16px !important;
  border-radius: 3px !important;
  text-decoration: none !important;
  text-transform: uppercase !important;
  letter-spacing: 0.8px !important;
  transition: all 0.2s !important;
  display: inline-block !important;
}
.bu-btn-top-gold:hover {
  background-color: #e0a800 !important; color: #000 !important;
  text-decoration: none !important;
}

/* ---- MAIN HEADER ---- */
.bu-main-header {
  background-color: var(--bu-bg-header) !important;
  border-bottom: 1px solid #E2E8F0 !important;
  box-shadow: 0 2px 12px rgba(0,0,0,0.06) !important;
  overflow: visible !important;
}
.bu-header-container {
  display: flex !important;
  align-items: center !important;
  justify-content: space-between !important;
  max-width: 1380px !important;
  margin: 0 auto !important;
  padding: 10px 24px !important;
  gap: 10px !important;
  flex-wrap: nowrap !important;
  min-width: 0 !important;
}

/* ---- LOGO BRAND ---- */
.bu-brand {
  display: flex !important;
  align-items: center !important;
  gap: 12px !important;
  text-decoration: none !important;
  flex-shrink: 0 !important;
}
.bu-brand-logo { height: 54px !important; width: auto !important; object-fit: contain !important; }
.bu-brand-text { display: flex !important; flex-direction: column !important; }
.bu-brand-title {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: 22px !important;
  font-weight: 800 !important;
  color: var(--bu-navy) !important;
  line-height: 1.1 !important;
  letter-spacing: -0.2px !important;
  display: block !important;
}
.bu-brand-subtitle {
  font-size: 10px !important;
  font-weight: 800 !important;
  letter-spacing: 2.5px !important;
  color: var(--bu-gold-dark) !important;
  text-transform: uppercase !important;
  margin-top: 3px !important;
  display: block !important;
}

/* ---- MAIN NAVBAR ---- */
.bu-navbar { display: flex !important; align-items: center !important; flex: 1 1 0 !important; justify-content: center !important; min-width: 0 !important; overflow: visible !important; }
.bu-nav-menu {
  display: flex !important;
  align-items: center !important;
  list-style: none !important;
  margin: 0 !important;
  padding: 0 !important;
  gap: 0 !important;
  flex-wrap: nowrap !important;
}
.bu-nav-item { position: relative !important; }
.bu-nav-link {
  display: inline-flex !important;
  align-items: center !important;
  gap: 4px !important;
  padding: 16px 9px !important;
  color: var(--bu-navy) !important;
  font-size: 12px !important;
  font-weight: 700 !important;
  text-transform: uppercase !important;
  letter-spacing: 0.6px !important;
  text-decoration: none !important;
  transition: color 0.2s !important;
  position: relative !important;
  white-space: nowrap !important;
}
.bu-nav-link::after {
  content: '' !important;
  position: absolute !important;
  bottom: 8px !important;
  left: 9px !important;
  right: 9px !important;
  height: 2px !important;
  background-color: var(--bu-gold-dark) !important;
  transform: scaleX(0) !important;
  transition: transform 0.25s ease !important;
}
.bu-nav-item:hover > .bu-nav-link { color: var(--bu-navy) !important; text-decoration: none !important; }
.bu-nav-item:hover > .bu-nav-link::after { transform: scaleX(1) !important; }
.bu-nav-link i.fa-angle-down { font-size: 10px !important; transition: transform 0.2s !important; }
.bu-nav-item:hover > .bu-nav-link i.fa-angle-down { transform: rotate(180deg) !important; }

/* ---- DROPDOWN MENU STYLING ---- */
.bu-dropdown {
  position: absolute !important;
  top: 100% !important;
  left: 0 !important;
  min-width: 240px !important;
  background: #fff !important;
  border-radius: 10px !important;
  box-shadow: 0 16px 40px rgba(10,27,84,0.15) !important;
  border: 1px solid #E2E8F0 !important;
  border-top: 3px solid var(--bu-gold) !important;
  padding: 6px !important;
  list-style: none !important;
  margin: 0 !important;
  opacity: 0 !important;
  visibility: hidden !important;
  transform: translateY(8px) !important;
  transition: opacity 0.22s ease, transform 0.22s ease, visibility 0.22s ease !important;
  z-index: 9999 !important;
}
.bu-nav-item:hover > .bu-dropdown {
  opacity: 1 !important;
  visibility: visible !important;
  transform: translateY(0) !important;
}
.bu-dropdown li { list-style: none !important; margin: 0 !important; }
.bu-dropdown li a {
  display: flex !important;
  align-items: center !important;
  justify-content: flex-start !important;
  gap: 8px !important;
  padding: 7px 14px !important;
  color: #334155 !important;
  font-size: 12px !important;
  font-weight: 600 !important;
  text-decoration: none !important;
  border-radius: 6px !important;
  border-left: 3px solid transparent !important;
  transition: all 0.18s ease !important;
  line-height: 1.35 !important;
  white-space: nowrap !important;
}
.bu-dropdown li a:hover {
  background: #F0F4FF !important;
  color: var(--bu-navy) !important;
  border-left-color: var(--bu-gold-dark) !important;
  padding-left: 17px !important;
  text-decoration: none !important;
}

/* Research Dropdown — Class-Based 2 Column */
@media (min-width: 992px) {
  .bu-res-dropdown {
    display: flex !important;
    flex-direction: row !important;
    min-width: 520px !important;
    padding: 10px !important;
    gap: 0 !important;
  }
  .bu-res-col {
    display: flex !important;
    flex-direction: column !important;
    flex: 1 !important;
    min-width: 0 !important;
  }
  .bu-res-col:first-child {
    padding-right: 8px !important;
    border-right: 1px solid #E2E8F0 !important;
  }
  .bu-res-col:last-child { padding-left: 8px !important; }
}
.bu-res-col ul {
  list-style: none !important;
  padding: 0 !important;
  margin: 0 !important;
}
/* Desktop link style for both res-col and acad-col items */
.bu-res-col ul li a,
.bu-acad-col ul li a {
  display: flex !important;
  align-items: center !important;
  justify-content: flex-start !important;
  gap: 8px !important;
  padding: 7px 12px !important;
  color: #334155 !important;
  font-size: 12px !important;
  font-weight: 600 !important;
  text-decoration: none !important;
  border-radius: 6px !important;
  border-left: 3px solid transparent !important;
  transition: all 0.18s ease !important;
  line-height: 1.35 !important;
  white-space: nowrap !important;
}
.bu-res-col ul li a:hover,
.bu-acad-col ul li a:hover {
  background: #F0F4FF !important;
  color: var(--bu-navy) !important;
  border-left-color: var(--bu-gold-dark) !important;
  padding-left: 16px !important;
}
.bu-res-col-heading {
  padding: 6px 12px !important;
  font-size: 11px !important;
  font-weight: 800 !important;
  text-transform: uppercase !important;
  letter-spacing: 0.8px !important;
  color: var(--bu-gold-dark, #D99B00) !important;
  margin-bottom: 2px !important;
}

/* Right-align Research dropdown near right side of navbar */
.bu-nav-item:nth-child(n+5) > .bu-res-dropdown {
  left: auto !important;
  right: 0 !important;
}

/* Academics + Examinations Dropdown — 2 Column */
@media (min-width: 992px) {
  .bu-acad-dropdown {
    display: flex !important;
    flex-direction: row !important;
    min-width: 500px !important;
    padding: 10px !important;
    gap: 0 !important;
  }
  .bu-acad-col {
    display: flex !important;
    flex-direction: column !important;
    flex: 1 !important;
    min-width: 0 !important;
  }
  .bu-acad-col:first-child {
    padding-right: 8px !important;
    border-right: 1px solid #E2E8F0 !important;
  }
  .bu-acad-col:last-child { padding-left: 8px !important; }
}
.bu-acad-col ul {
  list-style: none !important;
  padding: 0 !important;
  margin: 0 !important;
}
.bu-acad-col-heading {
  padding: 6px 12px 6px !important;
  font-size: 11px !important;
  font-weight: 800 !important;
  text-transform: uppercase !important;
  letter-spacing: 0.8px !important;
  color: var(--bu-gold-dark, #D99B00) !important;
  margin-bottom: 4px !important;
  border-bottom: 1px solid #E8EEF4 !important;
  display: flex !important;
  align-items: center !important;
  gap: 5px !important;
}
/* Mobile: stack columns */
@media (max-width: 991px) {
  .bu-acad-dropdown {
    display: block !important;
    min-width: 0 !important;
    padding: 0 !important;
    width: 100% !important;
  }
  .bu-acad-col {
    display: block !important;
    border-right: none !important;
    padding: 0 !important;
  }
  .bu-acad-col-heading {
    color: #FFC107 !important;
    padding: 10px 20px 5px !important;
    border-bottom: 1px solid rgba(255,255,255,0.12) !important;
    margin-top: 4px !important;
  }
  .bu-acad-col ul li a {
    color: rgba(255,255,255,0.78) !important;
    padding: 8px 20px 8px 32px !important;
    font-size: 12px !important;
    display: block !important;
  }
  .bu-acad-col ul li a:hover {
    background: rgba(255,255,255,0.08) !important;
    color: #FFC107 !important;
    padding-left: 36px !important;
  }
}

/* 2-COLUMN MEGA DROPDOWN LAYOUT (About, Schools, Admissions) */
@media (min-width: 992px) {
  .bu-dropdown-2col {
    min-width: 490px !important;
    display: grid !important;
    grid-template-columns: repeat(2, 1fr) !important;
    gap: 3px 6px !important;
    padding: 10px 10px !important;
  }
  .bu-dropdown-2col li a {
    padding: 6px 12px !important;
    font-size: 11.5px !important;
    border-radius: 6px !important;
  }
  .bu-dropdown-2col li a:hover { padding-left: 15px !important; }
  /* Right-align dropdowns near right side of navbar */
  .bu-nav-item:nth-child(n+5) > .bu-dropdown-2col {
    left: auto !important;
    right: 0 !important;
  }

  /* Academics+Examinations 2-col: each col-head starts a new column */
  .bu-acad-dropdown {
    min-width: 500px !important;
    grid-template-columns: repeat(2, 1fr) !important;
    align-items: start !important;
  }
  /* Column headings span full width of their column cell, act as dividers */
  .bu-acad-dropdown .bu-dropdown-col-head {
    grid-column: auto !important;
  }
}

/* Section heading inside 2-col dropdown */
.bu-dropdown-col-head {
  padding: 6px 12px 4px !important;
  font-size: 10.5px !important;
  font-weight: 800 !important;
  text-transform: uppercase !important;
  letter-spacing: 0.9px !important;
  color: var(--bu-gold-dark, #D99B00) !important;
  border-bottom: 1px solid #E2E8F0 !important;
  margin-bottom: 3px !important;
  display: flex !important;
  align-items: center !important;
  gap: 5px !important;
  pointer-events: none !important;
  user-select: none !important;
}
/* Mobile: stack everything in one column */
@media (max-width: 991px) {
  .bu-acad-dropdown {
    grid-template-columns: 1fr !important;
  }
  .bu-dropdown-col-head {
    border-bottom: 1px solid rgba(255,255,255,0.15) !important;
    color: #FFC107 !important;
    padding: 10px 20px 5px !important;
    margin-top: 4px !important;
  }
}



/* Mobile: Research dropdown stacks as single column */
@media (max-width: 991px) {
  .bu-res-dropdown {
    display: block !important;
    flex-direction: column !important;
    min-width: 0 !important;
    padding: 0 !important;
    width: 100% !important;
  }
  .bu-res-col {
    display: block !important;
    border-right: none !important;
    padding: 0 !important;
  }
  .bu-res-col-heading {
    padding: 8px 20px 4px 20px !important;
    font-size: 10px !important;
  }
  .bu-res-col ul li a {
    color: rgba(255,255,255,0.78) !important;
    padding: 8px 20px 8px 32px !important;
    font-size: 12px !important;
    display: block !important;
  }
  .bu-res-col ul li a:hover {
    background: rgba(255,255,255,0.08) !important;
    color: #FFC107 !important;
    padding-left: 36px !important;
  }
}


/* ---- HEADER ACTIONS ---- */
.bu-header-actions { display: flex !important; align-items: center !important; gap: 10px !important; flex-shrink: 0 !important; white-space: nowrap !important; }
.bu-search-btn {
  background: transparent !important; border: none !important;
  color: var(--bu-navy) !important; font-size: 16px !important;
  padding: 8px 10px !important; cursor: pointer !important;
  border-radius: 50% !important; transition: all 0.2s !important;
  display: flex !important; align-items: center !important;
}
.bu-search-btn:hover { background: rgba(10,27,84,0.08) !important; color: var(--bu-gold-dark) !important; }
.bu-btn-navy {
  background-color: var(--bu-navy) !important;
  color: #fff !important;
  font-size: 12px !important;
  font-weight: 800 !important;
  padding: 9px 22px !important;
  border-radius: 4px !important;
  text-decoration: none !important;
  text-transform: uppercase !important;
  letter-spacing: 1px !important;
  transition: all 0.22s !important;
  display: inline-block !important;
  border: 2px solid var(--bu-navy) !important;
}
.bu-btn-navy:hover {
  background-color: var(--bu-gold) !important;
  color: var(--bu-navy) !important;
  border-color: var(--bu-gold) !important;
  text-decoration: none !important;
}

/* ---- NEWS TICKER ---- */
.bu-ticker-wrapper {
  display: flex !important;
  align-items: center !important;
  background: #fff !important;
  /* border-bottom: 1px solid #E2E8F0 !important; */
  height: 38px !important;
  overflow: hidden !important;
}
.bu-ticker-label {
  background: var(--bu-navy) !important;
  color: var(--bu-gold) !important;
  font-size: 10.5px !important;
  font-weight: 800 !important;
  text-transform: uppercase !important;
  letter-spacing: 1px !important;
  padding: 0 18px !important;
  height: 100% !important;
  display: flex !important;
  align-items: center !important;
  gap: 6px !important;
  white-space: nowrap !important;
  flex-shrink: 0 !important;
}
.bu-ticker-content {
  flex: 1 !important;
  overflow: hidden !important;
  padding: 0 15px !important;
  position: relative !important;
  height: 100% !important;
  display: flex !important;
  align-items: center !important;
}
.bu-ticker-list {
  display: flex !important;
  list-style: none !important;
  margin: 0 !important;
  padding: 0 !important;
  gap: 40px !important;
  animation: buTickerScroll 40s linear infinite !important;
  white-space: nowrap !important;
}
@keyframes buTickerScroll {
  0% { transform: translateX(0); }
  100% { transform: translateX(-50%); }
}
.bu-ticker-list li a {
  color: #1e293b !important;
  font-size: 12.5px !important;
  font-weight: 600 !important;
  text-decoration: none !important;
  white-space: nowrap !important;
}
.bu-ticker-list li a:hover { color: var(--bu-navy) !important; text-decoration: underline !important; }

/* ---- SEARCH OVERLAY ---- */
.bu-search-overlay {
  position: fixed !important; top: 0 !important; left: 0 !important;
  width: 100% !important; height: 100% !important;
  background: rgba(10,27,84,0.95) !important;
  z-index: 9999 !important; display: flex !important;
  align-items: center !important; justify-content: center !important;
  opacity: 0 !important; visibility: hidden !important; transition: all 0.3s !important;
}
.bu-search-overlay.active { opacity: 1 !important; visibility: visible !important; }
.bu-search-box { width: 90% !important; max-width: 600px !important; position: relative !important; }
.bu-search-input {
  width: 100% !important; background: transparent !important;
  border: none !important; border-bottom: 2px solid var(--bu-gold) !important;
  color: #fff !important; font-size: 24px !important; font-weight: 600 !important;
  padding: 12px 50px 12px 10px !important; outline: none !important;
}
.bu-search-input::placeholder { color: rgba(255,255,255,0.45) !important; }
.bu-search-submit {
  position: absolute !important; right: 10px !important; top: 50% !important;
  transform: translateY(-50%) !important; background: none !important;
  border: none !important; color: var(--bu-gold) !important; font-size: 22px !important; cursor: pointer !important;
}
.bu-search-close {
  position: absolute !important; top: 30px !important; right: 40px !important;
  background: none !important; border: none !important; color: #fff !important;
  font-size: 34px !important; cursor: pointer !important; line-height: 1 !important;
}
.bu-search-close:hover { color: var(--bu-gold) !important; }

/* ---- MOBILE TOGGLE ---- */
.bu-mobile-toggle {
  display: none !important;
  background: transparent !important; border: none !important;
  color: var(--bu-navy) !important; font-size: 22px !important;
  cursor: pointer !important; padding: 6px !important;
}

/* ---- BLINK ---- */
.bu-blink { animation: buBlink 1.4s infinite !important; }
@keyframes buBlink {
  0%, 100% { opacity: 1; } 50% { opacity: 0.4; }
}

/* ---- RESPONSIVE: 1200px - show smaller text ---- */
@media (max-width: 1200px) {
  .bu-nav-link { font-size: 11.5px !important; padding: 14px 7px !important; }
  .bu-btn-navy { padding: 8px 16px !important; font-size: 11px !important; }
}
/* ---- RESPONSIVE: 1100px ---- */
@media (max-width: 1100px) {
  .bu-nav-link { font-size: 11px !important; padding: 14px 5px !important; }
  .bu-btn-navy { padding: 8px 14px !important; font-size: 11px !important; }
}
/* ---- RESPONSIVE: 992-1099px (key fix for button cutoff) ---- */
@media (max-width: 1050px) {
  .bu-nav-link { font-size: 10.5px !important; padding: 14px 4px !important; letter-spacing: 0.3px !important; }
  .bu-brand-title { font-size: 20px !important; }
  .bu-header-container { gap: 6px !important; padding: 10px 14px !important; }
}
/* ---- TABLET (768px - 991px) ---- */
@media (max-width: 991px) {
  .bu-topbar { display: none !important; }
  .bu-mobile-toggle { display: flex !important; align-items: center !important; justify-content: center !important; }

  /* Hide search button on mobile, keep Apply */
  .bu-header-actions .bu-search-btn { display: none !important; }

  /* Off-canvas drawer */
  .bu-navbar {
    position: fixed !important;
    top: 0 !important;
    left: -300px !important;
    width: 285px !important;
    height: 100vh !important;
    background: var(--bu-navy) !important;
    box-shadow: 4px 0 24px rgba(0,0,0,0.3) !important;
    transition: left 0.3s cubic-bezier(0.4,0,0.2,1) !important;
    overflow-y: auto !important;
    overflow-x: hidden !important;
    z-index: 9998 !important;
    padding: 70px 0 30px !important;
    flex-direction: column !important;
    justify-content: flex-start !important;
    align-items: flex-start !important;
    flex: none !important;
  }
  .bu-navbar.mobile-open { left: 0 !important; }

  .bu-nav-menu {
    flex-direction: column !important;
    align-items: flex-start !important;
    width: 100% !important;
    padding: 0 !important;
    gap: 0 !important;
  }
  .bu-nav-item {
    width: 100% !important;
    border-bottom: 1px solid rgba(255,255,255,0.1) !important;
    position: relative !important;
  }
  .bu-nav-link {
    color: rgba(255,255,255,0.92) !important;
    width: 100% !important;
    justify-content: space-between !important;
    padding: 15px 20px !important;
    font-size: 13px !important;
    white-space: normal !important;
  }
  .bu-nav-link::after { display: none !important; }
  .bu-nav-link i.fa-angle-down { font-size: 13px !important; }

  /* Mobile Dropdown — both ul and div based */
  .bu-dropdown {
    position: static !important;
    opacity: 1 !important;
    visibility: visible !important;
    transform: none !important;
    background: rgba(0,0,0,0.25) !important;
    box-shadow: none !important;
    border: none !important;
    border-radius: 0 !important;
    display: none !important;
    width: 100% !important;
    min-width: 0 !important;
    padding: 4px 0 !important;
    /* Force single column on mobile for grid/flex dropdowns */
    grid-template-columns: 1fr !important;
    flex-direction: column !important;
  }
  .bu-nav-item.open > .bu-dropdown { display: block !important; }
  /* Research dropdown (div-based, flex columns) — stack on mobile */
  .bu-nav-item.open > .bu-dropdown > div {
    flex-direction: column !important;
    border-right: none !important;
    padding-right: 0 !important;
    padding-left: 0 !important;
  }
  .bu-dropdown ul { list-style: none !important; margin: 0 !important; padding: 0 !important; }
  .bu-dropdown li a,
  .bu-dropdown ul li a {
    color: rgba(255,255,255,0.78) !important;
    padding: 10px 20px 10px 32px !important;
    font-size: 12.5px !important;
    border-left: none !important;
  }
  .bu-dropdown li a:hover,
  .bu-dropdown ul li a:hover {
    background: rgba(255,255,255,0.08) !important;
    color: var(--bu-gold) !important;
    padding-left: 36px !important;
  }
  /* Section headings inside Research dropdown */
  .bu-dropdown > div > div:first-child,
  .bu-dropdown > div > div[style*="font-weight"] {
    color: var(--bu-gold) !important;
    padding: 10px 20px 4px 20px !important;
    font-size: 10px !important;
  }

  /* Rotate arrow when open */
  .bu-nav-item.open > .bu-nav-link i.fa-angle-down { transform: rotate(180deg) !important; }

  /* Brand adjustments on tablet */
  .bu-brand-title { font-size: 19px !important; }
  .bu-brand-logo { height: 44px !important; }
  .bu-header-container { padding: 10px 14px !important; gap: 8px !important; }
  .bu-btn-navy { padding: 8px 16px !important; font-size: 11.5px !important; }
}

/* ---- MOBILE (max-width: 575px) ---- */
@media (max-width: 575px) {
  .bu-brand-logo { height: 42px !important; }
  .bu-brand-title { font-size: 17px !important; }
  .bu-brand-subtitle { font-size: 9px !important; letter-spacing: 1.5px !important; }
  .bu-btn-navy { display: none !important; }
  .bu-header-container { gap: 8px !important; padding: 8px 12px !important; }
  .bu-ticker-label { padding: 0 12px !important; font-size: 9.5px !important; }
}

/* ---- BACKDROP for mobile nav ---- */
.bu-nav-backdrop {
  display: none !important;
  position: fixed !important;
  top: 0 !important; left: 0 !important;
  width: 100% !important; height: 100% !important;
  background: rgba(0,0,0,0.5) !important;
  z-index: 9997 !important;
  backdrop-filter: blur(2px) !important;
}
.bu-nav-backdrop.active { display: block !important; }

/* ---- VERY SMALL PHONES (max-width: 480px) ---- */
@media (max-width: 480px) {
  .bu-brand-subtitle { display: none !important; }
  .bu-brand-title { font-size: 15px !important; }
  .bu-brand-logo { height: 36px !important; }
  .bu-brand { gap: 8px !important; }
  .bu-header-container { padding: 8px 10px !important; gap: 6px !important; }
  .bu-header-actions { gap: 6px !important; }
  .bu-mobile-toggle { font-size: 20px !important; padding: 4px 6px !important; }
}

/* ---- EXTRA SMALL PHONES (max-width: 360px) ---- */
@media (max-width: 360px) {
  .bu-brand-logo { height: 30px !important; }
  .bu-brand-title { font-size: 13px !important; max-width: 150px !important; overflow: hidden !important; text-overflow: ellipsis !important; white-space: nowrap !important; }
  .bu-header-container { padding: 6px 8px !important; gap: 4px !important; }
  .bu-mobile-toggle { font-size: 18px !important; padding: 4px !important; }
}
</style>


	<!-- Full Calender CSS -->
	<!-- Owl Carousel CSS -->
	<link href="<?php echo URL_CSS;?>owl.carousel.css" rel="stylesheet">
	<!-- Pretty Photo CSS -->
	<link href="<?php echo URL_CSS;?>prettyPhoto.css" rel="stylesheet">
	<!-- Bx-Slider StyleSheet CSS -->
	<!-- Font Awesome StyleSheet CSS -->
	<link href="<?php echo URL_CSS;?>font-awesome.min.css" rel="stylesheet">
    <!-- DL Menu CSS -->
    <link href="<?php echo URL_JS;?>dl-menu/component.css" rel="stylesheet">
	<link href="<?php echo URL_SVG;?>style.css" rel="stylesheet">
	<!-- Widget CSS -->
	<link href="<?php echo URL_CSS;?>widget.css" rel="stylesheet">
	<!-- Typography CSS -->
	<link href="<?php echo URL_CSS;?>typography.css" rel="stylesheet">
	<!-- Shortcodes CSS -->
	<link href="<?php echo URL_CSS;?>shortcodes.css" rel="stylesheet">
	<!-- Custom Main StyleSheet CSS -->
	<link href="<?php echo URL_ROOT;?>style.css" rel="stylesheet">
	<link href="<?php echo URL_CSS;?>validation.css" rel="stylesheet">
	<!-- Color CSS -->
	<link href="<?php echo URL_CSS;?>color.css" rel="stylesheet">
	<!-- Responsive CSS -->
	<link href="<?php echo URL_CSS;?>responsive.css" rel="stylesheet">
	<!-- BU Comprehensive Responsive CSS (All Devices) -->
	<link href="<?php echo URL_CSS;?>bu-responsive.css" rel="stylesheet">
	<!-- SELECT MENU -->
	<link href="<?php echo URL_CSS;?>breaking-news-ticker.css" rel="stylesheet">
	<!-- SIDE MENU -->
	<link rel="stylesheet" href="<?php echo URL_CSS;?>jquery.sidr.dark.css">
      <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="<?php echo URL_JS;?>jquery.js"></script> 
<!-- OWL Carousel CDN (for hero slider) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <style>
      marquee{
      font-size: 22px;
      font-weight: 500;
      color: #FFF;
      }
      /* Global Image Quality — NO crisp-edges (causes photo blur) */
      img {
        -webkit-backface-visibility: hidden !important;
        backface-visibility: hidden !important;
        image-rendering: auto !important;
      }
      .bu-brand-logo, .bu-footer-logo {
        height: auto !important;
        max-height: 48px !important;
        object-fit: contain !important;
        image-rendering: -webkit-optimize-contrast !important;
        filter: contrast(1.02) saturate(1.03) !important;
      }
    </style>

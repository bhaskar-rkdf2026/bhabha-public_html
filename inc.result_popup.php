<?php
/**
 * inc.result_popup.php
 * Official Notification Modal Popup for Homepage
 * Bhabha University Theme: Deep Navy (#0A1B54, #051235), Royal Gold (#FFC107, #D99B00)
 */
?>
<style>
/* ================================================================
   BHABHA UNIVERSITY — NOTIFICATION MODAL POPUP
   Theme: Deep Navy #0A1B54, Gold #FFC107, Clean White & Slate
   ================================================================ */
.bu-res-popup-overlay {
  position: fixed !important;
  top: 0 !important;
  left: 0 !important;
  right: 0 !important;
  bottom: 0 !important;
  width: 100vw !important;
  height: 100vh !important;
  margin: 0 !important;
  padding: 24px 20px !important;
  background: rgba(5, 18, 53, 0.72) !important;
  backdrop-filter: blur(6px);
  -webkit-backdrop-filter: blur(6px);
  z-index: 99999999 !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  box-sizing: border-box !important;
  opacity: 0;
  visibility: hidden;
  transition: opacity 0.25s ease, visibility 0.25s ease;
}
.bu-res-popup-overlay.show {
  opacity: 1;
  visibility: visible;
}

.bu-res-popup-box {
  background: #ffffff;
  border-radius: 14px;
  max-width: 560px !important;
  width: 92% !important;
  margin: auto !important;
  box-shadow: 0 25px 60px -12px rgba(5, 18, 53, 0.55), 0 0 0 1px rgba(255, 193, 7, 0.35);
  overflow: hidden;
  position: relative;
  transform: scale(0.95);
  transition: transform 0.25s cubic-bezier(0.16, 1, 0.3, 1);
  box-sizing: border-box;
  font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}
.bu-res-popup-overlay.show .bu-res-popup-box {
  transform: scale(1);
}

/* 1. Header (University Navy + Gold Bottom Accent) */
.bu-res-popup-header {
  background: linear-gradient(135deg, #051235 0%, #0A1B54 100%);
  padding: 13px 18px;
  color: #ffffff;
  position: relative;
  border-bottom: 3px solid #FFC107;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.bu-res-header-left {
  display: flex;
  align-items: center;
  gap: 10px;
}
.bu-res-header-bell {
  font-size: 20px;
  color: #FFC107;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  animation: buBellRing 3s ease-in-out infinite;
  transform-origin: top center;
}
@keyframes buBellRing {
  0%, 100% { transform: rotate(0); }
  10%, 30% { transform: rotate(14deg); }
  20%, 40% { transform: rotate(-14deg); }
  50% { transform: rotate(0); }
}
.bu-res-header-text h3 {
  font-size: 14px;
  font-weight: 800;
  margin: 0;
  color: #ffffff;
  line-height: 1.25;
  letter-spacing: -0.2px;
}
.bu-res-header-text p {
  font-size: 10.5px;
  color: rgba(255, 255, 255, 0.8);
  margin: 2px 0 0 0;
  line-height: 1.2;
}

.bu-res-popup-close {
  background: rgba(255, 255, 255, 0.12);
  border: 1px solid rgba(255, 255, 255, 0.2);
  color: #ffffff;
  width: 28px;
  height: 28px;
  border-radius: 50%;
  font-size: 18px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.2s ease;
  line-height: 1;
  padding: 0;
  flex-shrink: 0;
}
.bu-res-popup-close:hover {
  background: #FFC107;
  border-color: #FFC107;
  color: #0A1B54;
  transform: rotate(90deg);
}

/* 2. Body */
.bu-res-popup-body {
  padding: 12px 14px;
  max-height: 310px;
  overflow-y: auto;
  background: #ffffff;
  box-sizing: border-box;
}

/* Custom Sleek Scrollbar */
.bu-res-popup-body::-webkit-scrollbar {
  width: 5px;
}
.bu-res-popup-body::-webkit-scrollbar-track {
  background: #F1F5F9;
  border-radius: 4px;
}
.bu-res-popup-body::-webkit-scrollbar-thumb {
  background: #CBD5E1;
  border-radius: 4px;
}
.bu-res-popup-body::-webkit-scrollbar-thumb:hover {
  background: #94A3B8;
}

.bu-notif-cards-list {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

/* Individual Notification Card */
.bu-notif-card {
  background: #F8FAFC;
  border: 1px solid #E2E8F0;
  border-radius: 8px;
  padding: 9px 12px;
  text-decoration: none !important;
  color: inherit !important;
  display: block;
  transition: all 0.2s ease;
  position: relative;
}
.bu-notif-card:hover {
  transform: translateY(-1.5px);
  background: #FFFDF5;
  box-shadow: 0 4px 14px rgba(10, 27, 84, 0.08);
}

/* Theme Accents */
.bu-notif-card.is-navy {
  border-left: 4px solid #0A1B54;
}
.bu-notif-card.is-navy .bu-notif-tag {
  color: #0A1B54;
}
.bu-notif-card.is-gold {
  border-left: 4px solid #D99B00;
  background: #FFFDF5;
}
.bu-notif-card.is-gold .bu-notif-tag {
  color: #B45309;
}
.bu-notif-card.is-blue {
  border-left: 4px solid #1E40AF;
}
.bu-notif-card.is-blue .bu-notif-tag {
  color: #1E40AF;
}
.bu-notif-card.is-green {
  border-left: 4px solid #059669;
  background: #F0FDF4;
}
.bu-notif-card.is-green .bu-notif-tag {
  color: #059669;
}

.bu-notif-tag {
  font-size: 9.5px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  margin-bottom: 2px;
  display: block;
}

.bu-notif-content {
  font-size: 11.5px;
  color: #374151;
  line-height: 1.4;
  margin: 0;
}
.bu-notif-content strong {
  color: #0A1B54;
  font-weight: 700;
}

/* 3. Footer Bar */
.bu-res-popup-footer {
  background: #ffffff;
  border-top: 1px solid #E5E7EB;
  padding: 11px 18px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 10px;
  box-sizing: border-box;
}

.bu-notif-checkbox-label {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  font-size: 11.5px;
  color: #64748B;
  cursor: pointer;
  user-select: none;
  margin: 0;
  font-weight: 600;
}
.bu-notif-checkbox-label input[type="checkbox"] {
  cursor: pointer;
  width: 14px;
  height: 14px;
  accent-color: #0A1B54;
  margin: 0;
}

.bu-notif-footer-btns {
  display: flex;
  align-items: center;
  gap: 8px;
}
.bu-notif-btn-outline {
  background: #ffffff;
  border: 1.5px solid #CBD5E1;
  color: #0A1B54 !important;
  font-size: 12px;
  font-weight: 700;
  padding: 7px 13px;
  border-radius: 6px;
  text-decoration: none !important;
  display: inline-flex;
  align-items: center;
  gap: 5px;
  transition: all 0.2s ease;
  cursor: pointer;
}
.bu-notif-btn-outline:hover {
  background: #F1F5F9;
  border-color: #0A1B54;
  color: #0A1B54 !important;
}

.bu-notif-btn-close {
  background: #0A1B54;
  border: 1.5px solid #0A1B54;
  color: #ffffff !important;
  font-size: 12px;
  font-weight: 700;
  padding: 7px 16px;
  border-radius: 6px;
  cursor: pointer;
  transition: all 0.2s ease;
  display: inline-flex;
  align-items: center;
  justify-content: center;
}
.bu-notif-btn-close:hover {
  background: #FFC107;
  border-color: #FFC107;
  color: #0A1B54 !important;
}

@media (max-width: 575px) {
  .bu-res-popup-overlay {
    padding: 16px !important;
  }
  .bu-res-popup-box {
    max-width: 95% !important;
    width: 95% !important;
  }
  .bu-res-popup-header {
    padding: 11px 14px;
  }
  .bu-res-popup-body {
    padding: 12px 14px;
    max-height: 310px;
  }
  .bu-res-popup-footer {
    padding: 10px 14px;
    flex-direction: column;
    align-items: stretch;
    gap: 8px;
  }
  .bu-notif-footer-btns {
    justify-content: space-between;
  }
  .bu-notif-btn-outline, .bu-notif-btn-close {
    flex: 1;
    justify-content: center;
  }
}
</style>

<!-- MODAL POPUP COMPONENT (CENTERED SCREEN OVERLAY) -->
<div id="buResultModalOverlay" class="bu-res-popup-overlay" onclick="closeBuResultModal(event)">
  <div class="bu-res-popup-box" style="max-width: 560px !important; width: 92% !important;" onclick="event.stopPropagation()">
    
    <!-- Header -->
    <div class="bu-res-popup-header">
      <div class="bu-res-header-left">
        <div class="bu-res-header-bell">
          <i class="fa fa-bell"></i>
        </div>
        <div class="bu-res-header-text">
          <h3>Bhabha University &mdash; Important Notices &amp; Circulars</h3>
          <p>Latest official notifications, declared examination results &amp; academic circulars</p>
        </div>
      </div>
      <button type="button" class="bu-res-popup-close" onclick="closeBuResultModal()" aria-label="Close">&times;</button>
    </div>

    <!-- Body: Notification Cards with Theme Colored Accents -->
    <div class="bu-res-popup-body">
      <div class="bu-notif-cards-list">
        
        <!-- 1. B.Pharm 4th Sem (Theme Navy Accent) -->
        <a href="https://bhabha.accsofterp.com/Resultsoft_BU/Login.aspx" target="_blank" class="bu-notif-card is-navy">
          <span class="bu-notif-tag">RESULT NOTIFICATION &bull; B.PHARM</span>
          <p class="bu-notif-content">
            <strong>🎓 B.Pharm &ndash; 4th Semester (Regular)</strong> &mdash; Examination results declared and published on the official portal.
          </p>
        </a>

        <!-- 2. Diploma HMCT 1st Year (Theme Gold Accent) -->
        <a href="https://bhabha.accsofterp.com/Resultsoft_BU/Login.aspx" target="_blank" class="bu-notif-card is-gold">
          <span class="bu-notif-tag">RESULT NOTIFICATION &bull; DIPLOMA HMCT</span>
          <p class="bu-notif-content">
            <strong>🍴 Diploma HMCT &ndash; 1st Year (Regular)</strong> &mdash; 1st Year annual examination marksheet and result live.
          </p>
        </a>

        <!-- 3. M.Pharm 2nd Sem (Royal Blue Accent) -->
        <a href="https://bhabha.accsofterp.com/Resultsoft_BU/Login.aspx" target="_blank" class="bu-notif-card is-blue">
          <span class="bu-notif-tag">RESULT NOTIFICATION &bull; M.PHARM</span>
          <p class="bu-notif-content">
            <strong>🔬 M.Pharm &ndash; 2nd Semester (Regular)</strong> &mdash; Post-graduate semester examination results available online.
          </p>
        </a>

        <!-- 4. B.Sc. B.Ed 2nd Sem (Emerald Green Accent) -->
        <a href="https://bhabha.accsofterp.com/Resultsoft_BU/Login.aspx" target="_blank" class="bu-notif-card is-green">
          <span class="bu-notif-tag">RESULT NOTIFICATION &bull; B.SC. B.ED</span>
          <p class="bu-notif-content">
            <strong>📖 B.Sc. B.Ed &ndash; 2nd Semester (Regular)</strong> &mdash; 4-Year integrated programme results declared.
          </p>
        </a>

        <!-- 5. B.Pharm 2nd Sem (Theme Navy Accent) -->
        <a href="https://bhabha.accsofterp.com/Resultsoft_BU/Login.aspx" target="_blank" class="bu-notif-card is-navy">
          <span class="bu-notif-tag">RESULT NOTIFICATION &bull; B.PHARM</span>
          <p class="bu-notif-content">
            <strong>🎓 B.Pharm &ndash; 2nd Semester (Regular)</strong> &mdash; 2nd Semester regular examination results declared.
          </p>
        </a>

      </div>
    </div>

    <!-- Footer Bar -->
    <div class="bu-res-popup-footer">
      <label class="bu-notif-checkbox-label">
        <input type="checkbox" id="buNotifDontShowToday"> Don't show again today
      </label>
      <div class="bu-notif-footer-btns">
        <a href="https://bhabha.accsofterp.com/Resultsoft_BU/Login.aspx" target="_blank" class="bu-notif-btn-outline">
          View Result &nearr;
        </a>
        <button type="button" onclick="closeBuResultModal()" class="bu-notif-btn-close">
          Got it, Close
        </button>
      </div>
    </div>

  </div>
</div>

<script>
(function() {
  var STORAGE_KEY = 'bu_result_popup_dismissed_date';

  function shouldShowPopup() {
    try {
      var savedDate = localStorage.getItem(STORAGE_KEY);
      var today = new Date().toISOString().slice(0, 10);
      if (savedDate === today) {
        return false;
      }
    } catch(e) {}
    return true;
  }

  function openBuResultModal() {
    if (!shouldShowPopup()) return;
    var overlay = document.getElementById('buResultModalOverlay');
    if (overlay) {
      overlay.classList.add('show');
      document.body.style.overflow = 'hidden';
    }
  }

  window.closeBuResultModal = function(e) {
    if (e && e.target && e.target !== e.currentTarget && !e.target.classList.contains('bu-res-popup-close') && !e.target.classList.contains('bu-notif-btn-close')) {
      return;
    }
    
    // Check if user selected "Don't show again today"
    var chk = document.getElementById('buNotifDontShowToday');
    if (chk && chk.checked) {
      try {
        var today = new Date().toISOString().slice(0, 10);
        localStorage.setItem(STORAGE_KEY, today);
      } catch(e) {}
    }

    var overlay = document.getElementById('buResultModalOverlay');
    if (overlay) {
      overlay.classList.remove('show');
      document.body.style.overflow = '';
    }
  };

  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      window.closeBuResultModal();
    }
  });

  window.addEventListener('DOMContentLoaded', function() {
    setTimeout(openBuResultModal, 500);
  });
})();
</script>

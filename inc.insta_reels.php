<?php
// Bhabha University – Official Instagram Reels Section (Direct Inline Player Cards)

$reelsData = [
    [
        'id'        => 'reel-1',
        'title'     => 'Campus Celebrations & Events',
        'code'      => 'Dbr0ycHAi-x',
        'embed_url' => 'https://www.instagram.com/p/Dbr0ycHAi-x/embed/',
        'insta_url' => 'https://www.instagram.com/reel/Dbr0ycHAi-x/'
    ],
    [
        'id'        => 'reel-2',
        'title'     => 'Annual Fest & Activities',
        'code'      => 'DanDix7AeZq',
        'embed_url' => 'https://www.instagram.com/p/DanDix7AeZq/embed/',
        'insta_url' => 'https://www.instagram.com/reel/DanDix7AeZq/'
    ],
    [
        'id'        => 'reel-3',
        'title'     => 'Hi-Tech Skill Labs & Practical',
        'code'      => 'Dacmhdnj8hJ',
        'embed_url' => 'https://www.instagram.com/p/Dacmhdnj8hJ/embed/',
        'insta_url' => 'https://www.instagram.com/reel/Dacmhdnj8hJ/'
    ],
    [
        'id'        => 'reel-4',
        'title'     => 'University Highlights & Moments',
        'code'      => 'DaSehWXDgwj',
        'embed_url' => 'https://www.instagram.com/p/DaSehWXDgwj/embed/',
        'insta_url' => 'https://www.instagram.com/reel/DaSehWXDgwj/'
    ]
];
?>

<!-- ===== INSTAGRAM REELS SECTION ===== -->
<section class="bu-reels-section">
  <div class="bu-reels-container">
    
    <!-- Section Header -->
    <div class="bu-reels-header">
      <span class="bu-reels-label">
        <svg class="bu-ig-icon" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
        LIFE AT BHABHA &nbsp;·&nbsp; INSTAGRAM REELS
      </span>
      <h2 class="bu-reels-title">Inside the <em>University</em></h2>
      <p class="bu-reels-desc">
        Watch real campus moments, student celebrations, and university highlights directly from our official Instagram feed.
      </p>
    </div>

    <!-- 4-Card Reels Grid (Direct Inline Players) -->
    <div class="bu-reels-grid">
      <?php foreach($reelsData as $reel): ?>
      <div class="bu-reel-embed-card">
        <iframe 
          src="<?php echo $reel['embed_url']; ?>" 
          class="bu-reel-embed-iframe"
          frameborder="0" 
          scrolling="no" 
          allowtransparency="true"
          allow="encrypted-media; autoplay; clipboard-write; picture-in-picture">
        </iframe>
        <div class="bu-reel-card-footer">
          <a href="<?php echo $reel['insta_url']; ?>" target="_blank" class="bu-reel-ig-link" title="Watch full video on Instagram">
            <svg viewBox="0 0 24 24" fill="currentColor" width="13" height="13"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
            Instagram Reel
          </a>
          <a href="<?php echo href('enquiry.php'); ?>" class="bu-reel-apply-btn" title="Enquire Now for Admissions">
            APPLY NOW &nbsp;→
          </a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Footer Instagram Follow CTA -->
    <div class="bu-reels-footer">
      <a href="https://www.instagram.com/bhabhauniversitybhopal/" target="_blank" class="bu-reels-follow-btn">
        <svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
        View Instagram Page &nbsp;→
      </a>
    </div>

  </div>
</section>

<!-- ===== STYLES ===== -->
<style>
/* ── Section Wrapper ── */
.bu-reels-section {
  background: #FAF8F5;
  padding: 80px 24px 30px !important;
  width: 100%;
  float: left;
  clear: both;
  box-sizing: border-box;
  font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
}
.bu-reels-container {
  max-width: 1170px !important;
  margin: 0 auto !important;
  padding: 0 15px !important;
  box-sizing: border-box !important;
}

/* ── Header ── */
.bu-reels-header { text-align: center; margin-bottom: 52px; }
.bu-reels-label {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  font-size: 10.5px;
  font-weight: 800;
  letter-spacing: 2px;
  color: #D99B00 !important;
  text-transform: uppercase;
  margin-bottom: 14px;
  background: rgba(255, 193, 7, 0.15) !important;
  padding: 7px 18px;
  border-radius: 30px;
  border: 1px solid rgba(255, 193, 7, 0.35) !important;
}
.bu-ig-icon { width: 15px; height: 15px; color: #D99B00 !important; }
.bu-reels-title {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: clamp(32px, 4.5vw, 52px);
  font-weight: 800;
  color: #0A1B54;
  margin: 0 0 14px;
  line-height: 1.15;
}
.bu-reels-title em { font-style: italic; color: #D99B00; }
.bu-reels-desc {
  font-size: 15.5px;
  color: #64748B;
  max-width: 580px;
  margin: 0 auto;
  line-height: 1.65;
}

/* ── 4-Card Grid ── */
.bu-reels-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 16px;
}

/* ── Direct Inline Embed Card ── */
.bu-reel-embed-card {
  background: #FFFFFF;
  border-radius: 18px;
  overflow: hidden;
  box-shadow: 0 10px 32px rgba(10, 27, 84, 0.12);
  border: 1px solid rgba(0, 0, 0, 0.08);
  display: flex;
  flex-direction: column;
  transition: transform 0.35s ease, box-shadow 0.35s ease;
}
.bu-reel-embed-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 20px 48px rgba(10, 27, 84, 0.24);
}
.bu-reel-embed-iframe {
  width: 100%;
  height: 480px !important;
  border: none;
  display: block;
}
.bu-reel-card-footer {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 10px 14px;
  background: #FAF9F6;
  border-top: 1px solid rgba(0, 0, 0, 0.06);
}
.bu-reel-ig-link {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  font-size: 11.5px;
  font-weight: 700;
  color: #040F4A !important;
  text-decoration: none !important;
  transition: color 0.2s ease;
}
.bu-reel-ig-link:hover {
  color: #3897F0 !important;
}
.bu-reel-apply-btn {
  display: inline-flex;
  align-items: center;
  background: #FFC107 !important;
  color: #040F4A !important;
  font-size: 10.5px;
  font-weight: 800;
  letter-spacing: 0.5px;
  padding: 5px 14px;
  border-radius: 6px;
  text-decoration: none !important;
  box-shadow: none !important;
  transition: all 0.2s ease;
}
.bu-reel-apply-btn:hover {
  background: #040F4A !important;
  color: #FFC107 !important;
}

/* ── Footer CTA ── */
.bu-reels-footer { text-align: center; margin-top: 42px; }
.bu-reels-follow-btn {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: #FFC107 !important;
  color: #040F4A !important;
  font-size: 12.5px;
  font-weight: 800;
  padding: 10px 26px;
  border-radius: 24px;
  text-decoration: none !important;
  box-shadow: 0 6px 20px rgba(255, 193, 7, 0.4) !important;
  transition: transform 0.25s ease, box-shadow 0.25s ease, background 0.25s ease;
}
.bu-reels-follow-btn:hover {
  transform: translateY(-3px);
  background: #E8B200 !important;
  box-shadow: 0 10px 28px rgba(255, 193, 7, 0.55) !important;
  color: #040F4A !important;
}

/* ── Responsive ── */
@media (max-width: 1199px) {
  .bu-reels-grid { grid-template-columns: repeat(2, 1fr); }
  .bu-reel-embed-card { height: 500px; }
}
@media (max-width: 600px) {
  .bu-reels-grid { grid-template-columns: 1fr; }
  .bu-reel-embed-card { height: 480px; }
  .bu-reels-section { padding: 55px 16px 65px; }
}
</style>

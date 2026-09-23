<div class="topbar"><!-- LOGO -->
  <div class="topbar-left">
    <a href="dashboard.php" class="logo" style="display:flex;align-items:center;justify-content:center;height:70px;padding:0 15px;gap:10px;text-decoration:none;">
      <span>
        <img src="<?php echo URL_IMG;?>logo.png" alt="Bhabha University" style="height:50px;max-height:54px;width:auto;object-fit:contain;vertical-align:middle;filter:drop-shadow(0 2px 4px rgba(0,0,0,0.2));">
      </span>
      <i style="display:none;">
        <img src="<?php echo URL_IMG;?>logo.png" alt="BU" style="height:36px;width:auto;object-fit:contain;">
      </i>
      <span class="brand-text d-none d-md-inline-block" style="color:#FFFFFF;font-size:13.5px;font-weight:800;letter-spacing:0.8px;text-align:left;line-height:1.2;font-family:'Plus Jakarta Sans',sans-serif;">
        BHABHA<br><span style="color:#FFC107;font-size:10.5px;font-weight:700;letter-spacing:1px;">UNIVERSITY</span>
      </span>
    </a>
  </div>
  
  <nav class="navbar-custom">
    <ul class="navbar-right d-flex list-inline float-right mb-0 align-items-center" style="height:70px;">
      <li class="dropdown notification-list">
        <div class="dropdown notification-list nav-pro-img">
          <a class="dropdown-toggle nav-link arrow-none waves-effect nav-user d-flex align-items-center" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false" style="padding:0 15px;gap:10px;">
            <div style="width:40px;height:40px;border-radius:50%;background:#FFFFFF;border:2px solid #E2E8F0;display:flex;align-items:center;justify-content:center;overflow:hidden;box-shadow:0 2px 8px rgba(10,27,84,0.1);flex-shrink:0;">
              <img src="<?php echo URL_IMG;?>logo.png" alt="Bhabha Admin" style="width:30px;height:30px;object-fit:contain;">
            </div>
            <div class="d-none d-md-block text-left" style="line-height:1.2;">
              <span style="display:block;font-size:13px;font-weight:700;color:#0A1B54;">Bhabha Admin</span>
              <span style="display:block;font-size:11px;color:#64748B;font-weight:500;">Super Administrator</span>
            </div>
            <i class="mdi mdi-chevron-down d-none d-md-inline-block" style="font-size:16px;color:#64748B;"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right profile-dropdown shadow-lg" style="border-radius:8px;border:1px solid #E2E8F0;min-width:190px;margin-top:8px;">
            <div class="dropdown-header text-muted font-weight-bold font-11 text-uppercase" style="letter-spacing:1px;">Account Session</div>
            <a class="dropdown-item" href="settings.php"><i class="mdi mdi-settings-outline text-primary mr-2"></i> Settings</a>
            <a class="dropdown-item" href="dashboard.php"><i class="mdi mdi-view-dashboard text-primary mr-2"></i> Dashboard</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item text-danger" href="logout.php"><i class="mdi mdi-power text-danger mr-2"></i> Logout</a>
          </div>
        </div>
      </li>
    </ul>
    
    <ul class="list-inline menu-left mb-0">
      <li class="float-left">
        <button class="button-menu-mobile open-left waves-effect" style="background:transparent;border:none;color:#0A1B54;font-size:24px;line-height:70px;padding:0 20px;">
          <i class="mdi mdi-menu"></i>
        </button>
      </li>
    </ul>
  </nav>
</div>

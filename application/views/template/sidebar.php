
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <div class="user-panel">
        <div class="pull-left image">&nbsp;
          <img src="<?php echo base_url() ?>images/<?php echo $this->session->userdata('foto') ?>" class="img-circle" alt="User Image">
        </div>
        <p>
        <div class="pull-left info"><a href="<?php echo site_url('Profil') ?>">
          <p><?php echo $this->session->userdata('nama');
          $id = $this->session->userdata('id_user');?>
          </p>
        </a>
          <a href="<?php echo site_url('Welcome'); ?>"><i class="fa fa-circle text-success"></i> Online</a>
        </div></p>
      </div>
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <!-- <li class="header">MAIN NAVIGATION</li> -->
        <li><a href="<?php echo site_url('Welcome'); ?>"><i class="fa fa-book"></i> <span>Dashboard</span></a></li>
        <?php foreach ($menu as $menu) { 
          $a = $menu->id_menu; 
          ?>
          <li>
            <a href="<?php echo site_url($menu->link); ?>">
              <i class="<?php echo $menu->icon; ?>"></i> <span><?php echo $menu->menu; ?></span>
              
            </a>
          </li>
        <?php } ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
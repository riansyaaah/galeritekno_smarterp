<div class="main-sidebar sidebar-style-2">
	<aside id="sidebar-wrapper">
		<div class="sidebar-brand">
			<a href="index.html">
				<img alt="image" src="assets/img/logo.png" onerror="this.onerror=null;this.src='<?php echo base_url('assets/template/img/logo.png'); ?>';" class="header-logo" /> <span class="logo-name">SpeedLab</span>
			</a>
		</div>
		<ul class="sidebar-menu">
			<li class="menu-header">v1.0.0</li>
			<li class="dropdown <?php if (current_url() == base_url('home')) {
									echo 'active';
								} ?>">
				<a href="<?php echo base_url('home'); ?>" class="nav-link"><span>Menu</span></a>
			</li>
			<li class="dropdown <?php if (current_url() == base_url('dashboard')) {
									echo 'active';
								} ?>">
				<a href="<?php echo base_url('dashboard'); ?>" class="nav-link"><i class="fa fa-desktop"></i><span>Dashboard</span></a>
			</li>
			<?php
			$menuHeaders = array();
			$menuDetails = array();
			$menuHeaderActives = array();

			foreach ($menus as $menu) {
				$menuHeaders[] = array(
					'modul_id'          => $menu['modul_id'],
					'icon'              => $menu['icon'],
					'nama_modul'        => $menu['nama_modul']
				);
				$menuHeaderActives[] = $menu['url'];
			}

			foreach ($menus as $menu) {
				$menuDetails[] = array(
					'modul_id'          => $menu['modul_id'],
					'modul_detail_id'   => $menu['modul_detail_id'],
					'nama_modul_detail' => $menu['nama_modul_detail'],
					'url'               => $menu['url'],
				);
			}
			$uniqMenuHeaders = array_unique($menuHeaders, SORT_REGULAR);
			// var_dump($menuHeaderActives);
			foreach ($uniqMenuHeaders as $m) {
			?>
				<li class="dropdown 
                <?php foreach ($menuDetails as $mdm) {
					if ($mdm['modul_id'] == $m['modul_id']) {
						if (base_url($mdm['url']) == current_url()) {
							echo " active ";
						}
					}
				} ?>
                ">
					<a href="#" class="menu-toggle nav-link has-dropdown">
						<i class="<?= $m['icon']; ?>"></i>
						<span><?= $m['nama_modul']; ?></span></a>
					<ul class="dropdown-menu">
						<?php foreach ($menuDetails as $md) {
							if ($md['modul_id'] == $m['modul_id']) { ?>
								<li <?php if (current_url() == base_url($md['url'])) {
										echo 'class="active"';
									} ?>>
									<a class="nav-link" href="<?php echo base_url($md['url']); ?>"><?= $md['nama_modul_detail']; ?></a>
								</li>
						<?php }
						} ?>
					</ul>
				</li>
			<?php } ?>
		</ul>
	</aside>
</div>

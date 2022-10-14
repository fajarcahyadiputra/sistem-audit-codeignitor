<?php $group = $this->session->userdata()? $this->session->userdata()['group_name']: '' ?>
<div class="sidebar-nav">
    <ul>
        <li class="<?php echo ($this->uri->segment(1) == 'dashboard' ? 'active' : '') ?>"><a href="<?php echo base_url('dashboard') ?>" class="nav-header collapsed"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a></li>
        <?php if($group == 'qs' || $group == 'admin'){ ?>
            <li class="<?php echo ($this->uri->segment(1) == 'pengguna' ? 'active' : '') ?>"><a href="#" data-target=".pengguna" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-users"></i> Pengguna<i class="fa fa-collapse"></i></a></li>
        <li>
            <ul class="pengguna nav nav-list collapse <?php echo ($this->uri->segment(1) == 'pengguna' ? 'in' : '') ?>">
                <li class="<?php echo ($this->uri->segment(1) == 'pengguna' && !$this->uri->segment(2) ? 'active' : '') ?>"><a href="<?php echo base_url('pengguna') ?>"><span class="fa fa-caret-right"></span> Pengguna</a></li>
                <li class="<?php echo ($this->uri->segment(1) == 'pengguna' && $this->uri->segment(2) == 'tambah' ? 'active' : '') ?>"><a href="<?php echo base_url('pengguna/tambah') ?>"><span class="fa fa-caret-right"></span> Tambah Pengguna</a></li>
            </ul>
        </li>
        <li class="<?php echo ($this->uri->segment(1) == 'bagian' ? 'active' : '') ?>"><a href="#" data-target=".bagian" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-users"></i> bagian<i class="fa fa-collapse"></i></a></li>
        <li>
            <ul class="bagian nav nav-list collapse <?php echo ($this->uri->segment(1) == 'bagian' ? 'in' : '') ?>">
                <li class="<?php echo ($this->uri->segment(1) == 'bagian' && !$this->uri->segment(2) ? 'active' : '') ?>"><a href="<?php echo base_url('bagian') ?>"><span class="fa fa-caret-right"></span> Bagian</a></li>
                <li class="<?php echo ($this->uri->segment(1) == 'bagian' && $this->uri->segment(2) == 'tambah' ? 'active' : '') ?>"><a href="<?php echo base_url('bagian/tambah') ?>"><span class="fa fa-caret-right"></span> Tambah Bagian</a></li>
            </ul>
        </li>
        <?php } ?>
       

        <li class="<?php echo ($this->uri->segment(1) == 'document' ? 'active' : '') ?>"><a href="#" data-target=".document" class="nav-header collapsed" data-toggle="collapse"><i class="fas fa-book"></i> document<i class="fa fa-collapse"></i></a></li>
        <li>
            <ul class="document nav nav-list collapse <?php echo ($this->uri->segment(1) == 'document' ? 'in' : '') ?>">
                <li class="<?php echo ($this->uri->segment(1) == 'document' && !$this->uri->segment(2) ? 'active' : '') ?>"><a href="<?php echo base_url('document') ?>"><span class="fa fa-caret-right"></span>Document</a></li>
                <li class="<?php echo ($this->uri->segment(1) == 'document' && $this->uri->segment(2) == 'tambah' ? 'active' : '') ?>"><a href="<?php echo base_url('document/tambah') ?>"><span class="fa fa-caret-right"></span> Tambah Document</a></li>
                <li class="<?php echo ($this->uri->segment(1) == 'document' && $this->uri->segment(2) == 'arsip_document' ? 'active' : '') ?>"><a href="<?php echo base_url('document/arsip_document') ?>"><span class="fa fa-caret-right"></span> Arsip Document</a></li>
            </ul>
        </li>
        <li class="<?php echo ($this->uri->segment(1) == 'audit' ? 'active' : '') ?>"><a href="#" data-target=".audit" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-check-square"></i> audit<i class="fa fa-collapse"></i></a></li>
        <li>
            <ul class="audit nav nav-list collapse <?php echo ($this->uri->segment(1) == 'audit' ? 'in' : '') ?>">
                <li class="<?php echo ($this->uri->segment(1) == 'audit' && !$this->uri->segment(2) ? 'active' : '') ?>"><a href="<?php echo base_url('audit') ?>"><span class="fa fa-caret-right"></span>Audit</a></li>
                <?php if($group == 'qs' || $group == 'admin'){ ?>
                <li class="<?php echo ($this->uri->segment(1) == 'audit' && $this->uri->segment(2) == 'tambah' ? 'active' : '') ?>"><a href="<?php echo base_url('audit/tambah') ?>"><span class="fa fa-caret-right"></span> Tambah Audit</a></li>
                <?php } ?>
            </ul>
        </li>

        <!-- <li class="<?php echo ($this->uri->segment(1) == 'pengaturan' ? 'active' : '') ?>"><a href="<?php echo base_url('pengaturan') ?>" class="nav-header"><i class="fa fa-fw fa-cogs"></i> Pengaturan</a></li> -->
    </ul>
</div>
<div class="content">
    <div class="header">
        <div class="stats">
            <?php echo(isset($addon) ? $addon : '') ?>
        </div>

        <h1 class="page-title"><?php echo $title ?></h1>

    </div>
    <div class="main-content">
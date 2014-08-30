<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li <?php if(strtolower($this->name) === 'dominios'){ ?>class="active"<?php } ?>>
                <a href="#"><i class="fa fa-globe fa-fw"></i> Dominios<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo ROOT_URL; ?>dominios">Listar</a>
                    </li>
                    <li>
                        <a href="<?php echo ROOT_URL; ?>dominios/novo">Cadastrar novo</a>
                    </li>
                    <li>
                        <a href="<?php echo ROOT_URL; ?>dominios/gerenciar">Gerenciar</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li <?php if(in_array(strtolower($this->name),array( 'comemoracoes', 'agendas'))){ ?>class="active"<?php } ?>>
                <a href="#"><i class="fa fa-calendar fa-fw"></i> Comemorações<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo ROOT_URL; ?>comemoracoes">Calendário</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li <?php if(strtolower($this->name) === 'clientes'){ ?>class="active"<?php } ?>>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Clientes<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo ROOT_URL; ?>clientes">Listar</a>
                    </li>
                    <li>
                        <a href="<?php echo ROOT_URL; ?>clientes/novo">Cadastrar novo</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li <?php if(strtolower($this->name) === 'accounts'){ ?>class="active"<?php } ?>>
                <a href="#"><i class="fa fa-users fa-fw"></i> Usuários<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo ROOT_URL; ?>accounts">Listar</a>
                    </li>
                    <li>
                        <a href="<?php echo ROOT_URL; ?>accounts/novo">Cadastrar novo</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
        </ul>
        <!-- /#side-menu -->
    </div>
    <!-- /.sidebar-collapse -->
</nav>
<!-- /.navbar-static-side -->
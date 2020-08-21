<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <section class="sidebar">
        <div class='main-menu mt-10'>
            <!-- Sidebar Menu -->
            <ul class="sidebar-menu" data-widget="tree">

                <li class="{{ request()->is(cb()->getDeveloperPath("modules")."*")?"active":"" }}">
                    <a href='{{ cb()->getDeveloperUrl("modules") }}'><i class='fa fa-cog'></i>
                        <span>Module Generator</span>
                    </a>
                </li>
                <li class="{{ request()->is(cb()->getDeveloperPath("menus")."*")?"active":"" }}">
                    <a href='{{ cb()->getDeveloperUrl("menus") }}'><i class='fa fa-bars'></i>
                        <span>Manage Menus</span>
                    </a>
                </li>
                <li class="{{ request()->is(cb()->getDeveloperPath("roles")."*")?"active":"" }}">
                    <a href='{{ cb()->getDeveloperUrl("roles") }}'><i class='fa fa-key'></i>
                        <span>Manage Roles</span>
                    </a>
                </li>

                <li class="{{ request()->is(cb()->getDeveloperPath("users")."*")?"active":"" }}">
                    <a href='{{ cb()->getDeveloperUrl("users") }}'><i class='fa fa-users'></i>
                        <span>Manage Users</span>
                    </a>
                </li>

                <li class="{{ request()->is(cb()->getDeveloperPath("themes")."*")?"active":"" }}">
                    <a href='{{ cb()->getDeveloperUrl("themes") }}'><i class='fa fa-image'></i>
                        <span>Themes</span>
                    </a>
                </li>

                <li class="{{ request()->is(cb()->getDeveloperPath("appearance")."*")?"active":"" }}">
                    <a href='{{ cb()->getDeveloperUrl("appearance") }}'><i class='fa fa-image'></i>
                        <span>Appearance</span>
                    </a>
                </li>

                <li class="{{ request()->is(cb()->getDeveloperPath("security")."*")?"active":"" }}">
                    <a href='{{ cb()->getDeveloperUrl("security") }}'><i class='fa fa-key'></i>
                        <span>Security</span>
                    </a>
                </li>

                <li class="{{ request()->is(cb()->getDeveloperPath("mail")."*")?"active":"" }}">
                    <a href='{{ cb()->getDeveloperUrl("mail") }}'><i class='fa fa-mail-forward'></i>
                        <span>Mail Configuration</span>
                    </a>
                </li>

                <li class="{{ request()->is(cb()->getDeveloperPath("miscellaneous")."*")?"active":"" }}">
                    <a href='{{ cb()->getDeveloperUrl("miscellaneous") }}'><i class='fa fa-cog'></i>
                        <span>Miscellaneous</span>
                    </a>
                </li>
            </ul><!-- /.sidebar-menu -->
        </div>
    </section>
    <!-- /.sidebar -->
</aside>

<header id="header" class="header-scroll top-header headrom">
    <nav class="navbar navbar-dark" style="padding: 0.7rem 0.01rem; border-radius: 0;">
    <span><a href="/"><img class="navbar-brand" style="padding-left:.9em" src="images/finallogo.png" alt=""  width="270px;"></span> </a>
        <div class="container">
            
            <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
   

           
            <div class="collapse navbar-toggleable-md float-lg-right" id="mainNavbarCollapse">
                <ul class="nav navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?= urlIs('/') ? 'active' : '' ?>" href="/">Home<?php if (urlIs('/')): ?><span class="sr-only">(current)</span><?php endif; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= urlIs('/stalls') ? 'active' : '' ?>" href="/stalls">
                            Stalls
                        </a>
                    </li>
                    <?php if (empty($_SESSION["user_id"])): ?>
                        <li class="nav-item">
                            <a class="nav-links <?= urlIs('/login') ? 'active' : '' ?>" href="/login">
                                Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-links <?= urlIs('/registration') ? 'active' : '' ?>" href="/registration">Register</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a href="/your_orders" class="nav-link <?= urlIs('/your_orders') ? 'active' : '' ?>">My Orders</a>
                        </li>
                        <li class="nav-item">
                            <a href="/logout" class="nav-links <?= urlIs('/logout') ? 'active' : '' ?>">Logout</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</header>
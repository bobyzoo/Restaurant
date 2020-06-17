<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample08"
            aria-controls="navbarsExample08" aria-expanded="false" aria-label="Alternar de navegação">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08">
        <ul class="navbar-nav">
            <li class="nav-item active text-uppercase">
                <a class="nav-link" href="../index.php">Mama's House</a>
            </li>
            <li class="nav-item text-uppercase">
                <a class="nav-link" href="#">Quem Somos</a>
            </li>
            <li class="nav-item text-uppercase">
                <a class="nav-link" href="#">Cardápio</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown08" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">Suspenso</a>
                <div class="dropdown-menu" aria-labelledby="dropdown08">
                    <a class="dropdown-item" href="#">Açao</a>
                    <a class="dropdown-item" href="#">Outra ação</a>
                    <a class="dropdown-item" href="#">Algo mais aqui</a>
                </div>
            </li>
        </ul>

    </div>
    <div class="position-absolute" style="right: 30px;">
        <a <?= isset($_SESSION['carrinho']) ? "href='carrinho.php'" : '' ?>"><i class="fas fa-shopping-cart text-light" style="font-size: 25px"></i></a>
        <span class="badge badge-pill background-color-orange text-white font-weight-light notification"><?= isset($_SESSION['carrinho']) ? count($_SESSION['carrinho']) : 0 ?></span>
    </div>
</nav>
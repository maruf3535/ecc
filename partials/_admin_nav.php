<!-- Admin Navbar Start -->
<div class="container">
        <nav id="admin-nav" class="navbar navbar-expand-lg navbar-dark fs-5 mt-3">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link text-light dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Pending
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="/ECC/partials/_pending_std.php">Students</a></li>
                                <li><a class="dropdown-item" href="/ECC/partials/_pending_tec.php">Teachers</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/ECC/partials/_main_table.php">Main Table</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/ECC/partials/_teacherlist.php">Teachers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/ECC/partials/_class_request.php">Class</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/ECC/partials/_studentlist.php">Students</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/ECC/partials/_normaluserlist.php">User</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/ECC/partials/_contactlist.php">Contact</a>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
    </div>
    <!-- Admin Navbar End -->
<?php
include('./classes/User.php');
require('./script/db_connection.php');
$query = 'SELECT * FROM users WHERE token = "'.$_GET['token'].'"';
$data = $conn->query($query);
$userData = mysqli_fetch_array($data);
$user = new User($userData['nom'], $userData['prenom'], $userData['token'], $userData['role'], $userData['created_at'], $userData['update_at']);
?>

<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">User</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar-->
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-footer">
                        <?php
                        if (isset($_GET['token']) && !empty($_GET['token'])) {
                        ?>
                        <div class="small">Logged in as:</div>
                        <?= $user->getPrenom().' '.$user->getNom() ?>
                            <button class="btn btn-primary d-block mt-1" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                            <button class="btn btn-danger d-block mt-1" data-bs-toggle="modal" data-bs-target="#removeModal">Remove account</button>
                        <?php
                        } else {
                            ?>
                            <a href="login.php" class="btn btn-primary d-block">Login</a>
                        <?php
                        }
                        ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <?php
                if (isset($_GET['token']) && !empty($_GET['token'])) {
                ?>
                <main>
                    <div class="modal fade" id="removeModal" tabindex="-1" aria-labelledby="removeModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Êtes-vous sûr de vouloir supprimer votre compte ?
                                    <hr>
                                    <span class="mb-3">Quelques informations à propos de votre compte</span>
                                    <table class="table">
                                        <thead>
                                        <th>
                                            Champs
                                        </th>
                                        <th>
                                            Valeur
                                        </th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>
                                                    Nom
                                                </th>
                                                <td>
                                                    <?= $user->nom ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    Prénom
                                                </th>
                                                <td>
                                                    <?= $user->prenom ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    Date de création du compte
                                                </th>
                                                <td>
                                                    <?= $user->created_at ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    Dernière modification du compte
                                                </th>
                                                <td>
                                                    <?= $user->update_at ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">Non</button>
                                    <a href="./script/delete_user.php?token=<?= $user->token ?>" class="btn btn-danger">Oui</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="./script/edit_profile.php?token=<?= $user->token ?>">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="nom" name="nom" type="text" placeholder="Dupont" value="<?= $user->nom ?>" required />
                                            <label for="nom">Votre nom</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="prenom" name="prenom" type="text" placeholder="Jean" value="<?= $user->prenom ?>" required />
                                            <label for="nom">Votre prénom</label>
                                        </div>
                                        <button type="submit" class="btn btn-warning ms-auto" data-bs-dismiss="modal">Sauvegarder</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid p-4">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Users
                            </div>
                            <div class="card-body">
                                <table id="usersData">
                                    <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th>Date de création</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <?php
                                    $res = $conn->query('SELECT * FROM users');
                                    while ($data = mysqli_fetch_array($res)) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?= $data['nom'] ?>
                                            </td>
                                            <td>
                                                <?= $data['prenom'] ?>
                                            </td>
                                            <td>
                                                <?= $data['created_at'] ?>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Products
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Description</th>
                                        <th>Stock</th>
                                        <th>Prix</th>
                                    </tr>
                                    </thead>
                                    <tfoot>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <?php
                } else {
                    ?>
                    <div class="alert alert-warning m-4" role="alert">
                        You need to be logged to see the products!
                    </div>
                <?php
                }
                ?>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>

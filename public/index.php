<!doctype html>
<html lang="de">
<?php
define('VALID_CALL', true);
require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once './function_handler.php';
?>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Bebas+Neue|Roboto+Mono&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css?<?php echo time() ?>">

    <title>Maßstabsumrechner</title>
</head>
<body>

<div class="container-fluid">

    <!--    Header Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light border-bottom">

        <div class="container">
            <a class="navbar-brand" href="/">Maßstab Rechner</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Kontakt</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Menu
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Great Tool</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!--    Header Navigation END -->

    <div class="container">
        <!--    Welcome Content -->
        <div class="banner">
            <img src="img/masstabsrechner-logo_300x300.png">
            <h1>Einfach alles berechnen</h1>
            <h2 class="h5 lead">Rechnen Sie Zeichnungs Maßstäbe einfach um</h2>
            <a href="#calculate" class="btn btn-primary">Jetzt Berechnen</a>
        </div>
        <!--    Welcome Content END -->
        <div class="row">
            <div class="col-md-6 pl-5 pr-5">
                <h1>Willkommen beim <span class="text-primary">Maßstabsrechner</span></h1>
                <p class="lead mt-3">In nur drei einfachen schritten Zeichnungs Formate umrechnen.</p>
            </div>
            <div class="col-md-6">
                <ol class="text-muted">
                    <li>Erst den Maßstab der Zeichnung auswählen.</li>
                    <li>Ins erste Feld das real gemeßene Maß von der Zeichnung eintragen.</li>
                    <li>Dann <span class="text-danger">Eingabe-Einheit</span> und <span
                                class="text-success">Ausgabe-Einheit</span> auswählen.
                    </li>
                </ol>
            </div>
        </div>
        <!--    Calculator Content Aria -->
        <div class="row mb-5">
            <div class="col-md-12">
                <!--  CARD -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title" id="calculate">Maßstab wählen:</h5>

                        <!-- Scale Select -->
                        <form action="/" method="post" id="scaleUnit">
                            <input type="hidden" name="execute" value="true">
                            <?php if ($scale->getScaleUnit()): ?>
                                <input type="hidden" name="scale" value="<?php echo $scale->getScaleUnit() ?>">
                            <?php endif; ?>
                            <div class="row">
                                <div class="col">
                                    <?php foreach ($scale->getValidScaleUnit() as $value): ?>
                                        <?php if ($scale->getScaleUnit() == $value): ?>
                                            <button class="btn btn-primary m-1" type="submit" name="scale"
                                                    value="<?php echo $value ?>"><?php echo $value; ?></button>
                                        <?php else: ?>
                                            <button class="btn btn-outline-primary m-1" type="submit" name="scale"
                                                    value="<?php echo $value ?>"><?php echo $value; ?></button>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <!-- Scale Select END -->
                            <hr>

                            <!--  Measured Input Form -->
                            <div class="row">
                                <div class="col">
                                    <div class="input-group">
                                        <?php if ($scale->getFromUnit()): ?>
                                            <input type="hidden" name="fromUnit"
                                                   value="<?php echo $scale->getFromUnit() ?>">
                                        <?php endif; ?>
                                        <input type="text" class="form-control"
                                               value="<?php echo $scale->getInputUnitValue(); ?>" name="inputUnitValue"
                                               aria-label="Setze eine Länge ein" aria-describedby="button-addon4">
                                        <div class="input-group-append" id="button-addon4">
                                            <button class="btn btn-danger dropdown-toggle" type="button"
                                                    data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false"
                                                    id="dropdownMenuReference">
                                                <?php echo $scale->getFromUnit() ?>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                                                <?php foreach ($scale->getValidUnits() as $value): ?>
                                                    <?php if ($scale->getFromUnit() != $value): ?>
                                                        <button type="submit" value="<?php echo $value ?>"
                                                                name="fromUnit"
                                                                class="dropdown-item"
                                                                form="scaleUnit"><?php echo $value ?>
                                                        </button>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <?php foreach ($scale->getResult() as $result): ?>
                                            <?php if ($result['unit'] == $scale->getToUnit()): ?>
                                                <input type="hidden" name="toUnit"
                                                       value="<?php echo $result['unit'] ?>">
                                                <input type="text" class="form-control"
                                                       placeholder="<?php echo $result['value']; ?>"
                                                       aria-label="Setze eine Länge ein"
                                                       aria-describedby="button-addon5">
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                        <div class="input-group-append" id="button-addon5">
                                            <button class="btn btn-success dropdown-toggle" type="button"
                                                    data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false" id="dropdownMenuTo">
                                                <?php echo $scale->getToUnit() ?>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuTo">
                                                <?php foreach (array_reverse($scale->getValidUnits()) as $value): ?>
                                                    <?php if ($scale->getToUnit() != $value): ?>
                                                        <button type="submit" value="<?php echo $value ?>" name="toUnit"
                                                                class="dropdown-item"
                                                                form="scaleUnit"><?php echo $value ?>
                                                        </button>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--  Measured Input Form END-->
                        </form>

                        <!-- Collapse -->
                        <?php if ($scale->getResult()): ?>
                            <p class="mt-5">
                                <button class="btn btn-primary" type="button" data-toggle="collapse"
                                        data-target="#collapse" aria-expanded="false" aria-controls="collapse">
                                    Weitere Ausgabe-Enheiten anzeigen
                                </button>
                            </p>
                            <div class="collapse" id="collapse">
                                <div class="card card-body">
                                    <table class="table table-striped table-responsive-md">
                                        <thead>
                                        <tr>
                                            <th scope="col">Wert</th>
                                            <th scope="col">Einheit</th>
                                            <th scope="col">Beschreibung</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($scale->getResult() as $result): ?>
                                            <tr>
                                                <td class="text-lowercase"><?php echo $result['value']; ?></td>
                                                <td><?php echo $result['unit']; ?></td>
                                                <td><?php echo $result['name']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php endif; ?>
                        <!-- Collapsy -->
                    </div>

                </div>
                <!--  CARD -->
<p class="test_response"></p>
                <!--            Update Description -->
                <div class="row mt-5">
                    <div class="col-md-12">
                        <h5 class="text-warning">Die Funktionen &amp; Updates:</h5>
                        <p class="lead">Die Berechnung der Formate funktioniert fehlerfrei.</p>
                        <p class="lead">Das Limit für die <b>Eingabe</b> Länge ist zurzeit auf 150 Stellen reduziert</p>
                        <p class="lead">Das Limit für die <b>Ausgabe</b> Länge ist zurzeit auf 150 Stellen reduziert</p>
                        <h6 class="h5 text-warning">Geplant ist:</h6>
                        <p class="lead">Erweiterter User-Input Handler zur manipulations vermeidung</p>
                        <p class="lead">Ajax Formular für änderung der Parameter ohne die Seite neu zuladen</p>
                    </div>
                </div>
                <!--            Update Description END -->
            </div>
        </div>
        <!--    Calculator END -->

        <footer class="bg-dark pt-5">
            <div class="container">
                <div class="row pb-2">
                    <div class="col-md-4 col-sm-6">
                        <div class="widget widget-links widget-light pb-2 mb-4">
                            <h3 class="widget-title text-light">Information</h3>
                            <ul class="widget-list">
                                <li class="widget-list-item"><a class="widget-list-link" href="#">Hilfe</a></li>
                                <li class="widget-list-item"><a class="widget-list-link" href="#">Impressum</a></li>
                                <li class="widget-list-item"><a class="widget-list-link" href="#">Dokumentation</a></li>
                                <li class="widget-list-item"><a class="widget-list-link" href="#">Messrechner</a></li>
                                <li class="widget-list-item"><a class="widget-list-link" href="#">Content</a></li>
                                <li class="widget-list-item"><a class="widget-list-link" href="#">Impressum</a></li>
                                <li class="widget-list-item"><a class="widget-list-link" href="#">Jobs</a></li>
                                <li class="widget-list-item"><a class="widget-list-link" href="#">User</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="widget widget-links widget-light pb-2 mb-4">
                            <h3 class="widget-title text-light">Information</h3>
                            <ul class="widget-list">
                                <li class="widget-list-item"><a class="widget-list-link" href="#">Hilfe</a></li>
                                <li class="widget-list-item"><a class="widget-list-link" href="#">Impressum</a></li>
                                <li class="widget-list-item"><a class="widget-list-link" href="#">Dokumentation</a></li>
                                <li class="widget-list-item"><a class="widget-list-link" href="#">Messrechner</a></li>
                                <li class="widget-list-item"><a class="widget-list-link" href="#">Content</a></li>
                                <li class="widget-list-item"><a class="widget-list-link" href="#">Impressum</a></li>
                                <li class="widget-list-item"><a class="widget-list-link" href="#">Jobs</a></li>
                                <li class="widget-list-item"><a class="widget-list-link" href="#">User</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="widget widget-links widget-light pb-2 mb-4">
                            <h3 class="widget-title text-light">Information</h3>
                            <ul class="widget-list">
                                <li class="widget-list-item"><a class="widget-list-link" href="#">Hilfe</a></li>
                                <li class="widget-list-item"><a class="widget-list-link" href="#">Impressum</a></li>
                                <li class="widget-list-item"><a class="widget-list-link" href="#">Dokumentation</a></li>
                                <li class="widget-list-item"><a class="widget-list-link" href="#">Messrechner</a></li>
                                <li class="widget-list-item"><a class="widget-list-link" href="#">Content</a></li>
                                <li class="widget-list-item"><a class="widget-list-link" href="#">Impressum</a></li>
                                <li class="widget-list-item"><a class="widget-list-link" href="#">Jobs</a></li>
                                <li class="widget-list-item"><a class="widget-list-link" href="#">User</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="pb-4 font-size-xs text-light opacity-50 text-center text-md-left">© All rights reserved.
                    Made by <a class="text-light" href="http://messen.redkitty.de/" target="_blank">Redkitty</a></div>
            </div>
        </footer>
    </div>
</div>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
<script src="./js/init.js?<?php echo time() ?>"></script>
</body>
</html>
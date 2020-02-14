<!doctype html>
<html lang="de">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Maßstabsumrechner</title>
</head>
<body>

<?php require_once dirname(__DIR__) . '/vendor/autoload.php'; ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="mt-3"><a href="/">Maßstabsumrechner</a></h1>
            <p class="text-muted">Nur drei einfache Schritte um ein Zeichnungsmaß in ein gewünschtes Format umzurechnen.</p>
            <ul>
                <li>Wähle als erstes den Maßstab durch anklicken</li>
                <li>Trage ins erste Feld das gemeßenes Maß ein</li>
                <li>Wähle die gewünschte <span class="text-danger">Eingabe-Einheit</span> und <span class="text-success">Ausgabe-Einheit</span></li>
            </ul>
            <?php

            //print_r($_GET);
            $scale = new \App\ScaleComputer\ScaleUnit();
           // print_r($scale);

            if (isset($_GET['scale'])) {
                $scale->setScaleUnit($_GET['scale']);
            }

            if (isset($_GET['fromUnit'])) {
                $scale->setFromUnit($_GET['fromUnit']);
            }

            if (isset($_GET['toUnit'])) {
                $scale->setToUnit($_GET['toUnit']);
            }

            if (isset($_GET['inputUnitValue'])) {
                $scale->setInputUnitValue($_GET['inputUnitValue']);
            }

            if (isset($_GET['execute'])) {
                $scale->execute();
            }


            ?>
            <!--  CARD -->
            <div class="card">
                <div class="card-body">

                    <!--                    Scale Select -->
                    <form action="/" method="get" id="scaleUnit">
                        <input type="hidden" name="execute" value="true">
                        <?php
                        if ($scale->getScaleUnit()):?>
                            <input type="hidden" name="scale" value="<?php echo $scale->getScaleUnit() ?>">
                        <?php endif; ?>
                        <div class="row">
                            <div class="col">
                                <?php foreach ($scale->getValidScaleUnit() as $value): ?>
                                <?php if ($scale->getScaleUnit() == $value):?>
                                        <button class="btn btn-primary" type="submit" name="scale" value="<?php echo $value ?>"><?php echo $value ?></button>
                                    <?php else:; ?>
                                        <button class="btn btn-secondary" type="submit" name="scale" value="<?php echo $value ?>"><?php echo $value ?></button>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!--                    Scale Select -->
                        <hr>
                        <!--                    Messuret -->
                        <div class="row">
                            <div class="col">
                                <div class="input-group">
                                    <?php if ($scale->getFromUnit()):?>
                                    <input type="hidden" name="fromUnit" value="<?php echo $scale->getFromUnit() ?>">
                                    <?php endif; ?>
                                    <input type="text" class="form-control"
                                           value="<?php echo $scale->getInputUnitValue(); ?>" name="inputUnitValue"
                                           aria-label="Setze eine Länge ein" aria-describedby="button-addon4">
                                    <div class="input-group-append" id="button-addon4">
                                        <button class="btn btn-danger dropdown-toggle" type="button"
                                                data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false" id="dropdownMenuReference">
                                            <?php echo $scale->getFromUnit() ?>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                                            <?php foreach ($scale->getValidUnits() as $value): ?>
                                                <?php if ($scale->getFromUnit() != $value):?>
                                                    <button type="submit" value="<?php echo $value ?>" name="fromUnit" class="dropdown-item"
                                                            form="scaleUnit"><?php echo $value ?>
                                                    </button>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>

                                    <input type="hidden" name="toUnit" value="<?php echo $scale->getToUnit() ?>">
                                    <input type="text" class="form-control"
                                           placeholder="<?php echo $scale->getOutputValue(); ?>"
                                           aria-label="Setze eine Länge ein" aria-describedby="button-addon5">
                                    <div class="input-group-append" id="button-addon5">
                                        <button class="btn btn-success dropdown-toggle" type="button"
                                                data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false" id="dropdownMenuTo">
                                            <?php echo $scale->getToUnit() ?>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuTo">
                                            <?php foreach (array_reverse($scale->getValidUnits()) as $value): ?>
                                                <?php if ($scale->getToUnit() != $value):?>
                                                    <button type="submit" value="<?php echo $value ?>" name="toUnit" class="dropdown-item"
                                                            form="scaleUnit"><?php echo $value ?>
                                                    </button>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!--                    Messuret -->
                    </form>
                </div>

            </div>
            <!--  CARD -->

        </div>
    </div>
</div>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>

</body>
</html>
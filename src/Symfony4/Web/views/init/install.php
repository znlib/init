<h1>Install</h1>

<?php

echo "<h2>Init</h2>";

if ($initResult) {
    echo "<div class='alert alert-success'>Init success! <br/>" . nl2br($initResult) . "</div>";
}

echo "<h2>Install migrations</h2>";

if ($migrationNames) {
    echo "<div class='alert alert-success'>Install migrations success! <br/>" . implode('<br/>', $migrationNames) . "</div>";
} else {
    echo "<div class='alert alert-warning'>No for install</div>";
}

echo "<h2>Install fixtures</h2>";

if ($fixtureNames) {
    echo "<div class='alert alert-success'>Install fixtures success! <br/>" . implode('<br/>', $fixtureNames) . "</div>";
} else {
    echo "<div class='alert alert-warning'>No for install</div>";
}

?>

<a href="/" class="btn btn-primary">Go home</a>

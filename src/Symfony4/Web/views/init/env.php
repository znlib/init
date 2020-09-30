
<h1>Env</h1>

<form action="install" method="post">
    <div class="form-group">
        <label for="">Driver</label>
        <select name="driver" class="form-control">
            <option value="mysql">MySql</option>
            <option value="pgsql">Postgres</option>
            <option value="sqlite">SqLite</option>
        </select>
    </div>
    <div class="form-group">
        <label for="">Host</label>
        <input name="host" value="localhost" type="text" class="form-control" id="" placeholder="">
    </div>
    <div class="form-group">
        <label for="">Username</label>
        <input name="username" type="text" class="form-control" id="" placeholder="">
    </div>
    <div class="form-group">
        <label for="">Password</label>
        <input name="password" type="password" class="form-control" id="" placeholder="">
    </div>
    <div class="form-group">
        <label for="">Database name</label>
        <input name="dbname" type="text" class="form-control" id="" placeholder="">
    </div>

    <!--<div class="form-group">
        <label for="exampleInputFile">File input</label>
        <input type="file" id="exampleInputFile">
        <p class="help-block">Example block-level help text here.</p>
    </div>
    <div class="checkbox">
        <label>
            <input type="checkbox"> Check me out
        </label>
    </div>-->
    <button type="submit" class="btn btn-default">Install</button>
</form>

<!--<a href="/install.php/install" class="btn btn-primary">Install</a>-->

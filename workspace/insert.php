<html>
    <?php include("head.php");?>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <form id="insert-form" action="insert.php" method="post">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input class="form-control" name="name" id="name" type="text" placeholder="Bob Smith">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" name="email" id="email" type="email" placeholder="bobsmith@email.com">
                        </div>
                        <button class="btn btn-info" type="submit" name="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>

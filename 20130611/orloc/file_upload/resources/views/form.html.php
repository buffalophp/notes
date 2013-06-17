<!doctype html>
<html>
<head>
    <title>Php 101 @ Buffalo Lab</title>
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.css"/>
    <script src="/assets/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <span class="10">
            <h1> Upload an Image </h1>
        </span>
    </div> 

    <?php $dec = new Utility\MessageDecorator($flashBag); $dec->displayMessages(); ?>

    <div class="row pull-left">
        <div class="span5">
            <p> A very simple example of an upload form </p>
            <form class="form-horizontal well" action="<?php echo $_SERVER['PHP_SELF'];?>" name="upload" method="POST" enctype="multipart/form-data">
                <fieldset>
                    <legend>Upload Form</legend>
                    <span class="muted"><i>Effect more pronounced with smaller resolution images</i></span>
                    <br>
                    <br>
                    <input type="hidden" name="MAX_FILE_SIZE" value="2097000000"/>
                    <input class="input-medium" name="file" id="file_input" type="file"/>
                    <br>
                    <br>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </fieldset>
            </form>
        </div>
        <div class="span7">
            <div class="pagination-centered">
                <img src="<?php echo isset($im) && isset($_SESSION[$im->getPath()])  ? '/'.$im->getWebPath() : '/assets/img/no-image.gif'; ?>"/>
            </div>
        </div>
    </div>
</div>
</body>
</html>

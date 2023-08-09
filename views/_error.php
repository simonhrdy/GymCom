
<div class="container">
    <div class="row">
        <div id="main-content" class="col">
            <div class="content-404-wrapper my-5">
                <h2><?php echo $exception->getCode() ?></h2>
                <p><?php echo $exception->getMessage() ?></p>
                <a style="text-decoration: underline;" href="/" class="btn btn-accent">Zpět na úvodní stranu</a>
            </div>
        </div>
    </div>
</div>
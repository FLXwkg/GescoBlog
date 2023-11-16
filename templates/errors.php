<?php $helpers->title('Error 404')?>
<div class='container'>
    <h1 class='row mt-5 pt-5'><?= $statusCode,' ' ,$errorDescription?></h1>
    <p class='row pt-2 ps-4'><?= $errorType ?></p>
    <p class='row pt-2 ps-5'><?= $message ?? '' ?></p>
</div>
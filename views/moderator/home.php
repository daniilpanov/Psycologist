moderator<br>
<?php

use app\controllers\UsersController;

echo "Hello, " . UsersController::get()->getUser()->name;
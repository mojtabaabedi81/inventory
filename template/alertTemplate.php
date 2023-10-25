<?php

if (isset($_SESSION['msg_error'])) {

echo "
<div class='alert alert-danger' role='alert'>
  {$_SESSION['msg_error']}
</div>
";

}

if (isset($_SESSION['msg_success'])) {

echo "
<div class='alert alert-success' role='alert'>
  {$_SESSION['msg_success']}
</div>
";

}

session_destroy();


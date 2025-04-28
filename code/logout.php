<?php
session_start();
require 'include/url-redirect.php';
session_destroy();
redirect('/index.php');
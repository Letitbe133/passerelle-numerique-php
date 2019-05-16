<?php

    // start session
    session_start();
    // destroy session
    session_destroy();
    // redirect user
    header('Location: index.html');
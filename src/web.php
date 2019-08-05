<?php

use BugTracker\Http\Router\Router;
use BugTracker\Views\Pages\Dashboard;

Router::RegisterURL("", new Dashboard());
Router::RegisterURL("index", new Dashboard());
Router::RegisterURL("dashboard", new DashBoard());
<html>
<head>
    <title><?php echo $page->title; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="/resources/css/header.css" />
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidebar">
            <div class="sidebar-sticky">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <a href="/"><img src="/resources/img/logo.png" class="logo"/></a>
                            <hr />
                        </div>
                    </div>
                    <div class="row">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" href="/dashboard"><i class="fa fa-home"></i> Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="/reports"><i class="fa fa-home"></i> Reports</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="/projects"><i class="fa fa-home"></i> Projects</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="/reports/create"><i class="fa fa-home"></i> Create report</a>
                            </li>

                            <!-- if allowed -->
                            <li class="nav-item">
                                <a class="nav-link active" href="/company/edit"><i class="fa fa-home"></i> Update company</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="/users"><i class="fa fa-home"></i> Manage users</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row sticky-bottom">
                        <div class="col-12">
                            <hr />
                            <a class="nav-link" href="/logout"><i class="fa fa-sign-out"></i> Sign out</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-10">
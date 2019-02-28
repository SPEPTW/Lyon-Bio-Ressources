<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>{% block title %}Lyon Bio Ressource{% endblock %}</title>
    {% block stylesheets %}
    <!--     Bootstrap css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- CSS -->
    <link href="css/main.css" type="text/css" rel="stylesheet">
    {% endblock %}
</head>

<body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
        <img class="navbar-brand col-sm-3 col-md-2 mr-0" img src="{{asset('dist/img/logo-LyonBioRessources-1.jpg')}}">

        <ul class="navbar-nav px-4">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="#">Se déconnecter</a>
            </li>
        </ul>
    </nav> 
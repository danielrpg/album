<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ALBUM PANINI</title>
    {{ HTML::style('//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css'); }}
    {{ HTML::style('//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css'); }}
    {{ HTML::style('css/style.css'); }}
    
    {{ HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'); }}
    {{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/jquery.dataTables.min.js'); }}
    {{ HTML::script('//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js'); }}
    {{ HTML::script('js/app.js'); }}
    

</head>
<body>
    <h1>PANINI</h1>
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">ALBUM</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="{{ URL::to('../index.php/albums/show') }}">Álbumes</a></li>
                    <li><a href="{{ URL::to('../index.php/albums/create') }}">Nuevo álbum</a></li>
                    <li><div class="form-group" style="margin-left:460px">
                        <form name="requestForm" action='../../index.php/googleLogin'  method='GET'>
                        <button type="submit" class="btn btn-google-plus">Ingresar con google</button> 
                        <input type="hidden" class="form-control" id="Btnidentifier" name="Btnidentifier" value="login" >
                        </form>

                        </div></li>
                </ul>
            </div>

        </div>

    </nav>
    @if(Session::has('message'))
        <div class="alert alert-{{ Session::get('class') }}">{{ Session::get('message')}}</div>
    @endif
    <div class="panel panel-warning">
        <div class="panel-heading">
                <h4>@yield('subtitle')</h4>
        </div>

        <div class="panel-body">
            @yield('content')
        </div>
    </div>
    @yield('scripts')
</body>
</html>
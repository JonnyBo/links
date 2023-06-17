<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="_token" content="{{ csrf_token() }}" />
    <title>Links Store</title>
    <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css"/>
</head>
<body>
<div class="container">
    <div class="raw justify-content-md-center">
        <div class="col col-md-6">
            <h2>Links Store</h2>
            <form id="formLink">
                <div class="form-row align-items-center">
                    <div class="col-auto">
                        <label for="link">Link:</label>
                        <input type="text" class="form-control" id="link">
                    </div>
                    <div class="col-auto">
                        <button id="ajaxSubmit" type="button" class="btn btn-primary mt-2 mb-2">Submit</button>
                    </div>
                </div>
            </form>
            <div id="lastLinks" class="bg-light mb-2"></div>
        </div>
    </div>
</div>
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>

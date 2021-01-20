<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LaravelRESTAPI</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
  
    <base href="https://demos.telerik.com/kendo-ui/grid/index?autoRun=true&theme=silver">  <!--kenotheam -->
    <style>html { font-size: 14px; font-family: Arial, Helvetica, sans-serif; }</style>
    <title></title>
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2020.3.915/styles/kendo.common.min.css" />
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2020.3.915/styles/kendo.silver.min.css" />
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2020.3.915/styles/kendo.silver.mobile.min.css" />

    <script src="https://kendo.cdn.telerik.com/2020.3.915/js/jquery.min.js"></script>
    <script src="https://kendo.cdn.telerik.com/2020.3.915/js/kendo.all.min.js"></script>
    

</head>
<body>
  <div class="container">
    @yield('main')
  </div>
  <script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>
</html>
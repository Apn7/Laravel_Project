<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title','Bruh')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


    <style>
        .custom-icon {
          font-size: 1.5rem;
          line-height: 1em;
          margin-right: 0.25rem;
          opacity: 0.8;
          transition: 0.3s;
          color: #c71e1e;
        }
      </style>

  </head>
  <body>
    @include('include.header')
    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css"
      rel="stylesheet"
    />

    <script>
        function submitDeleteForm() {
            document.getElementById('deleteCommentForm').submit();
        }
    </script>

  </body>
</html>

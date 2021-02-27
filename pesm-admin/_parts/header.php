<!doctype html>
<html lang="pt">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title><?php echo $title; ?></title>

    <style>
        html,body{
            overflow-x: hidden;
            height: 100%;
            background-color: #007670;
        }

        .thead-dark tr th{
            background-color: #00c2ba!important;
            border-color: #00c2ba!important;
        }


        .btn-primary,.btn-primary:hover,.btn-primary:focus,.btn-primary:not(:disabled):not(.disabled):active{
         background-color: #00c2ba!important;
         border-color:#00c2ba!important;
         font-weight: bold;
         }
         .btn-primary:hover,.btn-primary:focus{
            opacity: .9;
            box-shadow: none!important;
         }

         .btn-primary:not(:disabled):not(.disabled).active:focus, .btn-primary:not(:disabled):not(.disabled):active:focus, .show>.btn-primary.dropdown-toggle:focus{
            box-shadow: none!important;
         }

         .form-control:focus{
            outline: none!important;
            box-shadow: none!important;
            border-color: #00c2ba!important;
         }

         .tapa{
            position: absolute;
            width: 100%;
            height: 100%;
            background-color: rgba(255,255,255,0.8);
            top:0;
            left: 0;
         }


.btn-smx{
    padding: 2px 8px!important;
    font-size: 13px!important;
}

.cursor-pointer{
    cursor: pointer;
    border-radius: 4px;
}
.cursor-pointer:hover{
    background-color: #007670;
    padding: 0 2px;
    color: #fff;

    transition: background-color .4s;
    -o-transition: background-color .4s;
    -moz-transition: background-color .4s;
    -webkit-transition: background-color .4s;
    border-radius: 4px;
}




         .lds-ring {
  display: inline-block;
  position: relative;
  width: 40px;
  height: 40px;
}
.lds-ring div {
  box-sizing: border-box;
  display: block;
  position: absolute;
  width: 34px;
  height: 34px;
  margin: 8px;
  border: 4px solid #00c2ba;
  border-radius: 50%;
  animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
  border-color: #00c2ba transparent transparent transparent;
}
.lds-ring div:nth-child(1) {
  animation-delay: -0.45s;
}
.lds-ring div:nth-child(2) {
  animation-delay: -0.3s;
}
.lds-ring div:nth-child(3) {
  animation-delay: -0.15s;
}
@keyframes lds-ring {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

    </style>
  </head>
  <body>
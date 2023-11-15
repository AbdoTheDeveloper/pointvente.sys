<!DOCTYPE html>
<html>
<head>
    <style type="text/css">
        @import url(https://fonts.googleapis.com/css?family=Roboto:400,500,700);

body {
  background-color: #14acf9;
  font-family: 'Roboto';
}

.center {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  margin: auto;
}

.conf-modal {
  width: 290px;
  max-width: 80%;
  height: 250px;
  background-color: #fafafa;
  border-radius: 3px;
  box-shadow: 0 12px 36px 16px rgba(0, 0, 0, 0.24);
}

.conf-modal h1 {
  font-size: 24px;
  font-weight: 500;
  line-height: 10px;
  display: inline-block;
}

.title-text {
  display: inline-block;
  height: 35px;
  line-height: 52px;
  margin-left: 72px;
  margin-top: 22px;
}

.success h1 {
  color: #26cf36;
}

.title-icon {
  width: 27px;
  height: 27px;
  display: inline-block;
  margin-right: 10px;
  margin-left: 30px;
  margin-top: 30px;
  position: absolute;
}

.conf-modal p {
  color: #737373;
  padding: 15px 30px;
  font-size: 16px;
  line-height: 24px;
}

.modal-footer {
  background: red;
}

.modal-footer .conf-but {
  display: inline-block;
  float: right;
  margin-right: 15px;
  margin-top: 5px;
  text-transform: uppercase;
  font-weight: 800;
  color: #4c4c4c;
  background: none;
  padding: 10px 15px;
  border-radius: 4px;
}

.modal-footer .conf-but:hover {
  background: #eee;
  cursor: pointer;
  opacity: .8;
}

.modal-footer .conf-but.green {
  color: #26cf36;
}
    </style>
    <title></title>
</head>
<body>
<div class="conf-modal center success">
  <div class="title-icon">
    <img src="http://jimy.co/res/icon-success.jpg">
  </div>
  <div class="title-text"><h1>Succès!</h1></div>
  <p>l'installation a été terminé avec succès</p>
  <div class="modal-footer">
    <a class="conf-but green" href="{{url('/')}}">terminer</a>
  </div>
</div>
</body>
</html>
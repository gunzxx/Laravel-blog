{{-- <?php

$db = new PDO('mysql:host=localhost;dbname=gunzxx_blog','root','');
$st = $db->query("SELECT * FROM users");
$st->execute();
var_dump($st->fetchAll(PDO::FETCH_ASSOC))

?> --}}

@extends('layouts/main')

@section('container')
  <h1>About Developer</h1>
  <img src="/img/gunz.png" title="Gunzxx">
  <h3>Guntur Wahyudi</h3>
  <p>@guntur_w123</p>
@endsection
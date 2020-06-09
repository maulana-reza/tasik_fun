<?php 
// to do list
// 1. profile v
// 2. content v
// 3. search content v
// 4. bid
// 5. notifikasi
// ## admin
// 	1. verifikasi
//	 	- member
//	 	- content
//  2. overview all
//  3. users
//  4. option
// 		- advanced
// 
// ## login by no hp
// -> input nomor
// -> menerima kode otp
// -> menginput kode otp
// -> logged in
// 
// ## login by email/username
// -> input email/username,password
// ->logged in
// 
// ## pencarian
// -> has logged in
// -> show page search
// -> input [all_information about car,budget,range]
// -> view with pagination
// -> view map in range with clustering marker
// 
// ## admin
// -> verifikasi content berbayar
// perhitungan : 
// 1 hari * harga 
// -> verifikasi user
// -> chart penjualan berdasarkan : brand,tipe,tanggal
// 
// ## login
// -> by
// : no hp,username,email
// 
// ## upgrade and verifikasi user
// -> to page upgrade
// -> upload document id
// -> (administrator) in page upgrade user
// -> check document by manually
// -> [success] click upgrade will upgrade user to seller
// -> [invalid] click invalid
// -> (user)[invalid] user will can't upgrade again 
// -> (user)[success] can access seller page and become verified 
// 
// ## publish and verifikasi content
// -> add car
// -> publish to sell car
// -> choose payment 
// -> see detail to see step by step how to pay
// -> pay by detail instruction 
// -> upload document to proof a payment
// -> (administrator) see in page verification payment 
// -> check document by manually
// -> [success] approve
// -> [invalid] invalid
// -> (user)[invalid] content will abort to publish
//
<script>
$(window).scroll(function () { 
   if ($(window).scrollTop() >= $(document).height() - $(window).height() - 10) {
      //Add something at the end of the page
   }
});
title
brand_id
model_id
year
price
range

// query
SELECT id,name,lat,lng, ROUND(( 6371 * acos( cos( radians($lat) ) * cos( radians( lat ) ) * cos( radians( lng ) — radians($lng) ) + sin( radians($lat) ) * sin( radians( lat ) ) ) ),(2) ) AS distance FROM jobs HAVING distance < 50 ORDER BY distance;


## bug
duplicate in map and content
tidak masuk information
history bid
add button search               v
after add car redirect to sell  v
otp

waktu
sum 
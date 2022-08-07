// Main
(()=>{for(var e=document.querySelectorAll(".sidebar-item.has-sub"),t=function(){var t=e[r];e[r].querySelector(".sidebar-link").addEventListener("click",(function(e){e.preventDefault();var r=t.querySelector(".submenu");r.classList.contains("active")?r.classList.remove("active"):r.classList.add("active")}))},r=0;r<e.length;r++)t();var a=document.querySelectorAll(".sidebar-toggler");for(r=0;r<a.length;r++){a[r].addEventListener("click",(function(){var e=document.getElementById("sidebar");e.classList.contains("active")?e.classList.remove("active"):e.classList.add("active")}))}if("function"==typeof PerfectScrollbar){var c=document.querySelector(".sidebar-wrapper");new PerfectScrollbar(c)}window.onload=function(){var e=window.innerWidth;e<768&&(console.log("widthnya ",e),document.getElementById("sidebar").classList.remove("active"))},feather.replace()})();
// End Main

let base_url = "http://localhost/admin/datasmp";
// Import Excel Reader
$('#import_excel :file').on('change', function(){
    var formData = new FormData();
    var index = 0;

    formData.append('excel_file', $(this)[0].files[0]);

    // console.log(formData)

    $.ajax({
        url: base_url+"/module/read_excel",
        method: "post",
        dataType: "json",
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            // console.log(data)
            var get = JSON.parse(JSON.stringify(data));
            var i = 1;
            var head = "<tr><th>No</th><th>NIS</th><th>NISN</th><th>Nama Peserta Didik</th><th>JK</th><th>Jenjang</th><th>Angkatan</th><th>Kelas</th></tr>"
            $('.data_siswa thead').append(head)
            $.each(get, function(index,get) {
                if(get[0] > 0){
                    var tableData = "<tr><td class='text-center'>"+ i++ +"</td><td class='text-center'><input type='hidden' name='nis[]' value='"+ get[1] +"'>"+ get[1] +
                    "</td><td class='text-center'><input type='hidden' name='nisn[]' value='"+ get[2] +"'>"+get[2]+
                    "</td><td class='text-left'><input type='hidden' name='nama_siswa[]' value='"+ get[3].toUpperCase() +"'>"+ get[3].toUpperCase() +
                    "</td><td class='text-center'><input type='hidden' name='jk[]' value='"+ get[4] +"'>"+ get[4] +
                    "</td><td class='text-center'><input type='hidden' name='jenjang[]' value='"+ get[5] +"'>"+ get[5] +
                    "</td><td class='text-center'><input type='hidden' name='angkatan[]' value='"+ get[6] +"'>"+ get[6] +"</td>"+
                    "</td><td class='text-center'><input type='hidden' name='kelas[]' value='"+ get[7] +"'>"+ get[7] +"</td></tr>"
                    $('.data_siswa tbody').append(tableData)
                }
            })
        }
    })
  })
  // End Excel

  // Date and Time
$(document).ready(function(){    
    var title = $('.title-page').html()
    $(".menu li[data-url='"+title+"']").addClass("active")
  
    setInterval (function() {
      var current = new Date();
      const months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
      let year = current.getFullYear()
      let mo = months[current.getMonth()]
      let day = String(current.getDate()).padStart('2','0')
      let hr = String(current.getHours()).padStart('2','0')
      let min = String(current.getMinutes()).padStart('2','0')
      let sec = String(current.getSeconds()).padStart('2','0')
      
      var hari = day+" "+mo+" "+year
      var jam = hr+":"+min+":"+sec
      $("#hari").html(hari)
      $("#jam").html(jam)
    },1000);

  })
// End Date and Time

  // Pagination Data Siswa
  load_data();

  function load_data(page){
    $.ajax({
      url: base_url+"/module/getdatasiswa",
      method: "POST",
      data: {page:page},
      dataType: "json",
      success: function(data){
        $('#datasiswa').html(data)
      }
    })
  }

  $(function(){
    $(document).on("click", "ul.pagination li.halaman", function() {
      var page = $(this).attr('id');
      load_data(page);
    });
  });
  // End Pagination

// Search Function
  $('#siswa_name').on('keyup', function(){
    var name = $(this).val()

    if(name != '')
    {
      $.ajax({
        url: base_url+"/module/cari_siswa",
        method: "post",
        data: {name:name},
        success:function(data){
          $('.siswa_list').fadeIn();
          $('.siswa_list').html(data);
        }
      })
    }
  })
  $('#siswa_name').on('blur', function(){
    $('.siswa_list').fadeOut();
  })
  // End Search

  // Get Siswa by Kelas
  $('.absen_kelas').on('change', function(){
    let kelas = $(this).val();
    $.ajax({
      url: base_url+"/module/getsiswakelas",
      method: "post",
      data : {
        kelas : kelas
      },
      success: function(data){
        $('#setKelas').val(kelas)
        $('.save_absen').removeClass('d-none')
        $('#absensi_siswa').html(data)
      }
    })
  })
  
$('.import').on('click', function(){
  $('.modal-header').addClass('bg-success')
  $('.modal-header').removeClass('bg-primary')
  $('.modal-title').html('Import File Excel')
  $('#import').removeClass('d-none')
  $('#add_siswa').addClass('d-none')
})
$('.add_siswa').on('click', function(){
  $('.modal-header').addClass('bg-primary')
  $('.modal-header').removeClass('bg-success')
  $('.modal-title').html('Tambah Data Siswa')
  $('#add_siswa').removeClass('d-none')
  $('#import').addClass('d-none')
})

// ApexChart Dashboard
var SmpL = 481;
var SmpP = 439;

var barOptions = {
  // Jumlah
  series: [
    {
      name: "Laki-laki",
      data: [185, SmpL, 49, 227],
      color: '#006cff'
    },
    {
      name: "Perempuan",
        data: [143, SmpP, 58, 310],
        color: '#ff0084'
      }
    ],
    chart: {
      type: "bar",
      height: 500,
    },
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: "55%",
        // endingShape: "rounded",
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: true,
      width: 2,
      colors: ["transparent"],
    },
    // Judul Per Category
    xaxis: {
      categories: ["MI", "SMP", "SMA", "SMK"],
    },
    // Judulu Data
    yaxis: {
      title: {
        text: "Jumlah Data Siswa",
      },
    },
    // Warna Bar
    fill: {
      opacity: 1,
      colors: ['#006cff','#ff0084']
    },
    tooltip: {
      y: {
        formatter: function(val) {
          return val + " Siswa";
        },
      },
    },
  };
  if($('#bar').length)
  {
    var bar = new ApexCharts(document.querySelector("#bar"), barOptions);
    bar.render()
  }
//   End Apex
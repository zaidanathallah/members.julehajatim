<!-- jQuery -->
<script src="/assets/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="/assets/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/assets/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/assets/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/assets/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="/assets/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="/assets/adminlte/plugins/jszip/jszip.min.js"></script>
<script src="/assets/adminlte/plugins/pdfmake/pdfmake.min.js"></script>
<script src="/assets/adminlte/plugins/pdfmake/vfs_fonts.js"></script>
<script src="/assets/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="/assets/adminlte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="/assets/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="/assets/adminlte/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!--<script src="/assets/adminlte/dist/js/demo.js"></script>-->
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "scrollX": true,
      "responsive": false,
      "buttons": [
        {
          extend: "copy",
          exportOptions: {
            columns: ":not(:last-child)",
            format: {
              body: function (data, row, column, node) {
                return $(node).text().replace(/\s+/g, ' ').trim();
              }
            }
          }
        },
        {
          extend: "csv",
          exportOptions: {
            columns: ":not(:last-child)",
            format: {
              body: function (data, row, column, node) {
                return $(node).text().replace(/\s+/g, ' ').trim();
              }
            }
          }
        },
        {
          extend: "excel",
          title: "Data Keanggotaan Juru Sembelih Halal (Juleha) Jawa Timur",
          filename: "Data_Anggota_Juleha_Jatim_" + new Date().toISOString().slice(0, 10),
          exportOptions: {
            columns: ":not(:last-child)",
            format: {
              body: function (data, row, column, node) {
                return $(node).text().replace(/\s+/g, ' ').trim();
              }
            }
          }
        },
        {
          extend: "pdfHtml5",
          text: "PDF",
          title: "DATA KEANGGOTAAN JURU SEMBELIH HALAL (JULEHA) JAWA TIMUR",
          filename: "Data_Anggota_Juleha_Jatim_" + new Date().toISOString().slice(0, 10),
          orientation: "landscape",
          pageSize: "A4",
          exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8], // Exclude kolom Aksi (index 9)
            format: {
              body: function (data, row, column, node) {
                return $(node).text().replace(/\s+/g, ' ').trim();
              }
            }
          },
          customize: function (doc) {
            doc.defaultStyle.fontSize = 7.5;
            doc.styles.tableHeader.fontSize = 8;
            doc.styles.tableHeader.bold = true;
            doc.styles.tableHeader.fillColor = "#064e3b";
            doc.styles.tableHeader.color = "#ffffff";
            doc.styles.tableHeader.alignment = "center";
            doc.styles.title = {
              color: "#064e3b",
              fontSize: 12,
              bold: true,
              alignment: "center",
              margin: [0, 0, 0, 10]
            };

            if (doc.content[1] && doc.content[1].table) {
              doc.content[1].table.widths = ["11%", "14%", "6%", "8%", "27%", "8%", "8%", "8%", "10%"];
              doc.content[1].layout = {
                hLineWidth: function (i, node) { return 0.5; },
                vLineWidth: function (i, node) { return 0.5; },
                hLineColor: function (i, node) { return "#cbd5e1"; },
                vLineColor: function (i, node) { return "#cbd5e1"; },
                paddingTop: function (i, node) { return 3.5; },
                paddingBottom: function (i, node) { return 3.5; },
                paddingLeft: function (i, node) { return 4; },
                paddingRight: function (i, node) { return 4; }
              };
            }

            doc.footer = function (currentPage, pageCount) {
              return {
                columns: [
                  {
                    text: "Sistem Informasi Manajemen Keanggotaan - Juru Sembelih Halal (Juleha) Jawa Timur",
                    alignment: "left",
                    margin: [40, 0],
                    fontSize: 7,
                    color: "#64748b"
                  },
                  {
                    text: "Halaman " + currentPage.toString() + " dari " + pageCount,
                    alignment: "right",
                    margin: [0, 0, 40, 0],
                    fontSize: 7,
                    color: "#64748b"
                  }
                ]
              };
            };
          }
        },
        {
          extend: "print",
          title: "Data Keanggotaan Juru Sembelih Halal (Juleha) Jawa Timur",
          exportOptions: {
            columns: ":not(:last-child)"
          }
        },
        "colvis"
      ],
      "language": {
        "info": "Menampilkan _START_ - _END_ dari _TOTAL_ data anggota",
        "infoEmpty": "Tidak ada data anggota",
        "infoFiltered": "(disaring dari _MAX_ total data)",
        "search": "Cari Anggota:",
        "paginate": {
          "previous": "‹ Prev",
          "next": "Next ›"
        }
      }
    }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
  });

</script>

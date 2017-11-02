<link rel="stylesheet" type="text/css" href="../css/all.css">
<script src="../js/jquery-3.2.1.slim.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/modernizr.js"></script>
<script src="../js/main.js"></script>
<script src="../js/validator.min.js"></script>
<!-- <script src="../js/sweetalert.min.js"></script> -->
<script src="../tinymce/tinymce.min.js"></script>
<script>
jQuery(document).ready(function($) {
    $("#loading").show();//显示loading
    setTimeout("$('#loading').hide();", 2500);//隐藏loading
     $( "#published_date" ).datepicker({
     dateFormat : "yy年mm月dd日"});
});
  tinymce.init({
   language:'zh_TW',
   selector:'textarea',
   height:'460',
      plugins: [
          "advlist autolink lists link image charmap print preview hr anchor pagebreak",
          "searchreplace wordcount visualblocks visualchars code fullscreen",
          "insertdatetime media nonbreaking save table contextmenu directionality",
          "emoticons template paste textcolor colorpicker textpattern imagetools"
      ],
      toolbar1: "insertfile undo redo | formatselect fontselect fontsizeselect | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table hr pagebreak blockquote",
      toolbar2: "bold italic underline strikethrough subscript superscript | forecolor backcolor charmap emoticons | link unlink image media | cut copy paste | insertdatetime fullscreen code",
      menubar: false,
   image_advtab: true,
  });
</script>

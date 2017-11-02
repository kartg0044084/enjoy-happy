jQuery(document).ready(function($) {
   $('#toggle').click(function() {
   $(this).toggleClass('active');
   $('#overlay').toggleClass('open');
  });
  $(".flexslider").flexslider({
       slideshowSpeed: 5000, //展示时间间隔ms
       animationSpeed: 500, //滚动时间ms
       touch: true //是否支持触屏滑动
   });
});

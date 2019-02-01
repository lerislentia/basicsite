
<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="{{ asset('images/pic02.jpg') }}" alt="Los Angeles">
    </div>

    <div class="item">
      <img src="{{ asset('images/pic03.jpg') }}" alt="Chicago">
    </div>

    <div class="item">
      <img src="{{ asset('images/pic04.jpg') }}" alt="New York">
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


<script type="text/javascript">
$(document).ready(function() {

  $("#myCarousel").carousel();

  // Enable Carousel Indicators
  $(".myCarousel").click(function(){
    $("#myCarousel").carousel(1);
  });
});
</script>


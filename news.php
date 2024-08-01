<?php
    include 'includes/header.php';
    $recent = $con->query("SELECT * FROM news");
    while($news = $recent->fetch_assoc()){
        
    
?>
<section>
      <div class="container">
      	       
        <div class="row">
          <div class="col-md-8 col-lg-7 text-content"> 
            <h2><?=$news['heading']?></h2>
            <blockquote class="blockquote">
            <div class="author">Date:-  <?=$news['date']?></div>
              <p class="mb-0"><?=$news['description']?></p>
            </blockquote>
          </div>
          <div class="col-md-4 col-lg-5 mt-5 ">
            <p class="mt-4"><img src="uploads/news/<?=$news['image']?>" alt="news" class="img-fluid mg-thumbnail" width="80"></p>
          </div>
        </div>

        </div>
    </section>
<?php
}
    include 'includes/footer.php';
?>
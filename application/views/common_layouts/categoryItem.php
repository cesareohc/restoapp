<div class="categorySection">
  <div class="container restaurant-container">
    <div class="item-wrapper">
      <div class="topCategory itemList">
         <?php foreach ($categories as $key => $cat): ?>
           <a href="<?= base_url('item-types/'.$slug.'/'.md5($cat['id'])) ;?>" class="items"> 
             <div class="singleCatItem">
                  <div class="catTop img bg_loader" data-src="<?= get_img($cat['thumb'],'',1) ;?>" style="background: url(<?= img_loader();?>);">
                  </div>
                  <h4><?= html_escape($cat['name']);?></h4>
                </div>
           </a>
        <?php endforeach ?>
      </div>
       <div class="arrowsection">
          <a href="javascript:;"  class="arrow-left"><i class="icofont-simple-left"></i></i></a>
          <a href="javascript:;" class="arrow-right"><i class="icofont-simple-right"></i></i></a>
        </div>
    </div>
   
  </div>
</div>
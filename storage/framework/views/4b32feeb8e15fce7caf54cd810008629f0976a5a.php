<?php $__env->startSection('content'); ?>
<div class="row">
   <div class="col-xl-3 col-lg-6 col-xs-12">
    <div class="card">
      <div class="card-body">
        <div class="card-block">
          <div class="media">
            <a href="<?php echo e(route('route_lists_list', ['id', 'DESC'])); ?>">
              <div class="media-body text-xs-left">
                <h3 class="cyan">Пътни листове</h3>
                <span>Преглед, редакция, изтриване</span>
              </div>
              <div class="media-right media-middle">
                <i class="fas fa-list-ul"></i>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-lg-6 col-xs-12">
    <div class="card">
      <div class="card-body">
        <div class="card-block">
          <div class="media">
            <a href="">
              <div class="media-body text-xs-left">
                <h3 class="pink">Пътен лист</h3>
                <span>Добави нов документ</span>
              </div>
              <div class="media-right media-middle">
                <i class="fas fa-boxes"></i>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-lg-6 col-xs-12">
    <div class="card">
      <div class="card-body">
        <div class="card-block">
          <div class="media">
             <a href="<?php echo e(route('documents_list', ['id', 'DESC'])); ?>">
              <div class="media-body text-xs-left">             
                <h3 class="teal">Товарителници</h3>
                <span>Преглед</span>            
              </div>
              <div class="media-right media-middle">
                <i class="fas fa-clipboard-list"></i>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-lg-6 col-xs-12">
    <div class="card">
      <div class="card-body">
        <div class="card-block">
          <div class="media">
            <a href="<?php echo e(route('create_data_by_hand')); ?>">
              <div class="media-body text-xs-left">
                <h3 class="deep-orange">Данни</h3>
                <span>Ръчно въвеждане на данни за товар</span>
              </div>
              <div class="media-right media-middle">
                <i class="fas fa-pencil-alt"></i>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div> 
</div>
<!--/ stats -->

<!-- Recent invoice with Statistics -->
<div class="row match-height">
  <div class="col-xl-4 col-xs-12">
    <div class="card">
      <a href="<?php echo e(route('reports_original_init')); ?>">
        <div class="card-body">
          <div class="media">
            <div class="p-2 text-xs-center bg-deep-orange media-left media-middle">
              <i class="fas fa-barcode"></i>
            </div>
            <div class="p-2 media-body">
              <h5 class="deep-orange">Справка Оригинал</h5>            
            </div>
          </div>
        </div>
      </a>
    </div>
    <div class="card">
      <a href="<?php echo e(route('reports_international_init')); ?>">
        <div class="card-body">
          <div class="media">
            <div class="p-2 text-xs-center bg-cyan media-left media-middle">
              <i class="fas fa-drafting-compass"></i>
            </div>
            <div class="p-2 media-body">
              <h5 class="cyan">Международен транспорт</h5>            
            </div>
          </div>
        </div>
      </a>
    </div>
    <div class="card">
      <a href="<?php echo e(route('reports_noname_init')); ?>">
      <div class="card-body">
        <div class="media">          
          <div class="p-2 text-xs-center bg-teal media-left media-middle">
            <i class="fas fa-bezier-curve"></i>
          </div>
          <div class="p-2 media-body">
            <h5 class="teal">Справка Без име</h5>
          </div>                     
        </div>
      </div>
    </a>
    </div>
    <div class="card">
      <a href="<?php echo e(route('reports_spravka_init')); ?>">      
        <div class="card-body">
          <div class="media">
            <div class="p-2 text-xs-center bg-indigo media-left media-middle">
              <i class="fas fa-chess-knight"></i>
            </div>
            <div class="p-2 media-body">
              <h5 class="indigo">Справка Справка</h5>
            </div>                  
          </div>
        </div>
      </a>
    </div>   
  </div>
  <div class="col-xl-4 col-xs-12">    
    <div class="card">
      <a href="<?php echo e(route('reports_drivers_to_days_init')); ?>">      
        <div class="card-body">
          <div class="media">
            <div class="p-2 text-xs-center bg-lime bg-darken-2 media-left media-middle">
              <i class="fas fa-code-branch"></i> 
            </div>
            <div class="p-2 media-body">
              <h5 class="indigo">Шофьори - по дни</h5>
            </div>                  
          </div>
        </div>
      </a>
    </div>
    <div class="card">
      <a href="<?php echo e(route('reports_drivers_for_period_init')); ?>">      
        <div class="card-body">
          <div class="media">
            <div class="p-2 text-xs-center bg-danger bg-lighten-2 media-left media-middle">
              <i class="fas fa-chess"></i>
            </div>
            <div class="p-2 media-body">
              <h5 class="indigo"> Шофьори - сумарна</h5>
            </div>                  
          </div>
        </div>
      </a>
    </div>
    <div class="card">
      <a href="<?php echo e(route('reports_province_drivers_in_sofia_init')); ?>">      
        <div class="card-body">
          <div class="media">
            <div class="p-2 text-xs-center bg-warning bg-accent-3 media-left media-middle">
              <i class="fas fa-dice-d20"></i>
            </div>
            <div class="p-2 media-body">
              <h5 class="indigo"> Шофьори - провинциални </h5>
            </div>                  
          </div>
        </div>
      </a>
    </div>
  </div>
  <div class="col-xl-4 col-xs-12">
    <div class="card">                           
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<section id="navigation-main">  
<div class="navbar">
	<div class="navbar-inner">
    <div class="container">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
  
          <div class="nav-collapse">
			<?php $this->widget('zii.widgets.CMenu',array(
                    'htmlOptions'=>array('class'=>'nav'),
                    'submenuHtmlOptions'=>array('class'=>'dropdown-menu'),
					'itemCssClass'=>'item-test',
                    'encodeLabel'=>false,
                    'items'=>array(
						array('label'=>'Home', 'url'=>array('/site/index'),'linkOptions'=>array("data-description"=>"Your home page"),),
                                   
						array('label'=>'Music Styles <span class="caret"></span>', 'url'=>array('/musictype/index'),'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown","data-description"=>"4 major styles"),
                        'items'=>array(
                            array('label'=>'Rock/Pop', 'url'=>array('/musictype/rock')),
							array('label'=>'Hiphop', 'url'=>array('/musictype/hiphop')),
							array('label'=>'Country', 'url'=>array('/musictype/country')),
							array('label'=>'Jazz/Blues', 'url'=>array('/musictype/jazz')),
                        )),
						
						array('label'=>'Peoples <span class="caret"></span>', 'url'=>array('/site/page', 'view'=>'columns'),'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown","data-description"=>"Browse People"),
                        'items'=>array(
                            array('label'=>'All Artists', 'url'=>array('/artist/index')),
							array('label'=>'Popular Users', 'url'=>array('/user/index')),
                        )),

                        array('label'=>'Concerts <span class="caret"></span>', 'url'=>array('/site/page', 'view'=>'columns'),'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown","data-description"=>"Browse Concerts"),
                        'items'=>array(
                            array('label'=>'Future Concerts', 'url'=>array('/concert/index')),
                            array('label'=>'Past Concerts', 'url'=>array('/concert/index')),
                        )),
                                   
                        array('label'=>'Search', 'url'=>array('/site/search'),'linkOptions'=>array("data-description"=>"search what you want"),),
                       
                        array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                        array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest,),
                    ),
                )); ?>
    	</div>
    </div>
	</div>
</div>
</section><!-- /#navigation-main -->
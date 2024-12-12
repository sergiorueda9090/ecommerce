<?php  echo $this->extend('template/layout'); ?>
<?php  echo $this->section("content"); ?>
    <!--=====================================
    Breadcrumb
    ======================================-->  
	
	<div class="ps-breadcrumb">

        <div class="container">

            <ul class="breadcrumb">

                <li><a href="<?php base_url() ?>">Home</a></li>

                <li>404 Page</li>

            </ul>

        </div>

    </div>

    <!--=====================================
    404 Content
    ======================================-->
   <div class="ps-page--404">
        <div class="container">
            <div class="ps-section__content"><img src="<?php base_url() ?>assets/img/404.jpg" alt="">
                <h3>ohh! page not found</h3>
                <p>It seems we can't find what you're looking for. Perhaps searching can help or go back to<a href="<?php echo base_url() ?>"> Homepage</a></p>
                <form class="ps-form--widget-search" action="do_action" method="get">
                    <input class="form-control" type="text" placeholder="Search...">
                    <button><i class="icon-magnifier"></i></button>
                </form>
            </div>
        </div>
    </div>
  
    <!--=====================================
	Newletter
	======================================-->  

    <div class="ps-newsletter">

        <div class="container">

            <form class="ps-form--newsletter" action="do_action" method="post">

                <div class="row">

                    <div class="col-xl-5 col-12 ">
                        <div class="ps-form__left">
                            <h3>Newsletter</h3>
                            <p>Subcribe to get information about products and coupons</p>
                        </div>
                    </div>

                    <div class="col-xl-7 col-12 ">

                        <div class="ps-form__right">

                            <div class="form-group--nest">

                                <input class="form-control" type="email" placeholder="Email address">
                                <button class="ps-btn">Subscribe</button>

                            </div>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>

<?php  echo $this->endSection("content"); ?>
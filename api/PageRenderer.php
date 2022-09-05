<?php
@require_once("CurlAPI.php");
@require_once("SystemConstants.php");

class PageRenderer {

    protected $MENU_LIST_FILE=
    	array("index"=>"index.php",
            "portfolio"=>"portfolio.php",
            "about"=>"about.php",
            "contact"=>"contact.php",
            "privacypolicy"=>"privacypolicy.php",
            "sitemap"=>"sitemap.php");

    protected $MENU_LIST_TITLES=
    	array("index"=>"Welcome",
            "about"=>"About",
            "portfolio"=>"Portfolio",
            "contact"=>"Contact",
            "privacypolicy"=>"Privacy Policy",
            "sitemap"=>"Site Map"
            );

    protected $PAGE = "";
    protected $CURRENT_DIRECTORY = "";
    protected $SLUG = "";
    protected $TITLE = "";


    public function __construct($page=""){

        // $this->PAGE = $page;
        if ($page=="") {
            $this->PAGE = "index";
        } // if ($page=="") {
    	else {
    		$larr_Page = explode("/", $page);
    		$this->PAGE = $larr_Page[0];
	        if (count($larr_Page)>1) {
	        	$this->SLUG = $larr_Page[1];
	        	$this->CURRENT_DIRECTORY = "../";
	        } // if (count($larr_Page)>1) {
    	} // ELSE ng if ($page=="") {

        $this->TITLE = "";
        if (array_key_exists($this->PAGE, $this->MENU_LIST_TITLES)) {
            $this->TITLE = $this->MENU_LIST_TITLES[$this->PAGE] . " | ".META_DESCRIPTION ;
        } // if (array_key_exists($this->PAGE, $this->MENU_LIST_TITLES)) {
        else {
            $this->TITLE = "Page not found. | ".META_DESCRIPTION ;
        } // ELSE ng if (array_key_exists($this->PAGE, $this->MENU_LIST_TITLES)) {

        

    } // public function __construct($page=""){

    public function render(){
    	$this->renderHead();
    	$this->renderNavigation();

    	if (array_key_exists($this->PAGE, $this->MENU_LIST_TITLES)) {
	    	if (file_exists("includes/".$this->MENU_LIST_FILE[$this->PAGE])) {

	    		$CURRENT_DIRECTORY = $this->CURRENT_DIRECTORY;
	    		$SLUG = $this->SLUG;

	    		include_once ("includes/".$this->MENU_LIST_FILE[$this->PAGE]);
	    	} // if (file_exists("includes/".$this->MENU_LIST_FILE[$this->PAGE])) {
	    	else {
				include_once ("includes/404.php");
	    	} // ELSE ng if (file_exists("includes/".$this->MENU_LIST_FILE[$this->PAGE])) {
    	} // if (array_key_exists($this->PAGE, $this->MENU_LIST_TITLES)) {
    	else {
    		include_once ("includes/404.php");
    	} // ELSE ng if (array_key_exists($this->PAGE, $this->MENU_LIST_TITLES)) {
    	//include_once ("includes/under_construction.php");
    	
    	$this->renderFooter();
    	
    } // public function render(){

    private function renderHead(){
	?>  
        <!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="<?php echo META_CHARSET ?>">
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="application-name" content="<?php echo META_SYSTEMNAME ?>">
                <meta name="description" content="<?php echo META_DESCRIPTION ?>">
                <meta name="author" content="<?php echo META_AUTHOR ?>">
                <meta name="keywords" content="<?php echo SEO_KEYWORDS ?>,<?php echo str_replace(' ',',',META_SYSTEMNAME) ?>,<?php echo str_replace(' ',',',META_AUTHOR) ?>,<?php echo str_replace(' ',',',META_DESCRIPTION) ?>">

                <!-- OG Meta Tags to improve the way the post looks when you share the page on Facebook, Twitter, LinkedIn -->
                <meta property="og:site_name" content="<?php echo META_SYSTEMNAME;?>" /> <!-- website name -->
                <meta property="og:site" content="<?php echo ABSOLUTE_PATH;?>" /> <!-- website link -->
                <meta property="og:title" content="<?php echo $this->TITLE?>"/> <!-- title shown in the actual shared post -->

                <!-- Dynamic based on page? -->
                <meta property="og:description" content="<?php echo META_DESCRIPTION;?>" /> <!-- description shown in the actual shared post -->
                <meta property="og:image" content="" /> <!-- image link, make sure it's jpg -->
                <meta property="og:url" content="" /> <!-- where do you want your post to link to -->
                <meta name="twitter:card" content="summary_large_image"> <!-- to have large image post format in Twitter -->    

                <title><?php echo $this->TITLE?></title>

                <!-- Styles -->
                <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
                <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
                <link href="css/bootstrap.min.css<?php echo VERSION_AFFIX;?>" rel="stylesheet">
                <link href="css/fontawesome-all.min.css<?php echo VERSION_AFFIX;?>" rel="stylesheet">
                <link href="css/swiper.css<?php echo VERSION_AFFIX;?>" rel="stylesheet">
                <link href="css/styles.css<?php echo VERSION_AFFIX;?>" rel="stylesheet">

                <!-- Favicon  -->
                <link rel="icon" href="images/favicon.png<?php echo VERSION_AFFIX;?>">

                <!--[if lt IE 9]>
                <script src="js/html5shiv.js<?php echo VERSION_AFFIX; ?>"></script>
                <script src="js/respond.min.js<?php echo VERSION_AFFIX; ?>"></script>
                <![endif]-->       
                <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $this->CURRENT_DIRECTORY;?>images/apple-touch-icon-144-precomposed.png<?php echo VERSION_AFFIX; ?>">
                <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $this->CURRENT_DIRECTORY;?>images/apple-touch-icon-114-precomposed.png<?php echo VERSION_AFFIX; ?>">
                <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $this->CURRENT_DIRECTORY;?>images/apple-touch-icon-72-precomposed.png<?php echo VERSION_AFFIX; ?>">
                <link rel="apple-touch-icon-precomposed" href="<?php echo $this->CURRENT_DIRECTORY;?>images/apple-touch-icon-57-precomposed.png<?php echo VERSION_AFFIX; ?>">

                <!-- Scripts -->
                <script src="js/bootstrap.min.js<?php echo VERSION_AFFIX;?>" defer></script> <!-- Bootstrap framework -->
                <script src="js/swiper.min.js<?php echo VERSION_AFFIX;?>" defer></script> <!-- Swiper for image and text sliders -->
                <script src="js/purecounter.min.js<?php echo VERSION_AFFIX;?>" defer></script> <!-- Purecounter counter for statistics numbers -->
                <script src="js/isotope.pkgd.min.js<?php echo VERSION_AFFIX;?>" defer></script> <!-- Isotope for filter -->
                <script src="js/scripts.js<?php echo VERSION_AFFIX;?>" defer></script> <!-- Custom scripts -->

            </head>
            <body>



	<?php
    } // private function renderHead(){

    private function renderNavigation(){
    ?>
        
        <!-- Navigation -->
        <nav id="navbar" class="navbar navbar-expand-lg fixed-top navbar-dark" aria-label="Main navigation">
            <div class="container">
                <!-- Image Logo -->
                <a class="navbar-brand logo-image" href="<?php echo $this->CURRENT_DIRECTORY;?>index"><img src="images/bobsologolarge.png" alt="alternative"></a> 
                <a class="navbar-brand logo-text" href="<?php echo $this->CURRENT_DIRECTORY;?>index">Software Dev</a>

                <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
                    <ul class="navbar-nav ms-auto navbar-nav-scroll">
                    
                        <li class="nav-item">
                            <a class="nav-link <?php if ($this->PAGE=="index") {echo 'class="active"'; } ?>" aria-current="page" href="<?php echo $this->CURRENT_DIRECTORY;?>index">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?php if ($this->PAGE=="about") {echo 'class="active"'; } ?>" aria-current="page" href="<?php echo $this->CURRENT_DIRECTORY;?>about">About</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?php if ($this->PAGE=="portfolio") {echo 'class="active"'; } ?>" aria-current="page" href="<?php echo $this->CURRENT_DIRECTORY;?>portfolio">Portfolio</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?php if ($this->PAGE=="contact") {echo 'class="active"'; } ?>" aria-current="page" href="<?php echo $this->CURRENT_DIRECTORY;?>contact">Contact</a>
                        </li>

                        <?php /*
                        <li class="nav-item">
                            <a class="nav-link" href="#services">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#projects">Projects</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-expanded="false">Drop</a>
                            <ul class="dropdown-menu" aria-labelledby="dropdown01">
                                <li><a class="dropdown-item" href="article.html">Article Details</a></li>
                                <li><div class="dropdown-divider"></div></li>
                                <li><a class="dropdown-item" href="terms.html">Terms Conditions</a></li>
                                <li><div class="dropdown-divider"></div></li>
                                <li><a class="dropdown-item" href="privacy.html">Privacy Policy</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">Contact</a>
                        </li>
                        */ ?>
                    </ul>
                    <span class="nav-item social-icons">
                        <span class="fa-stack">
                            <a href="<?php echo FACEBOOK_LINK;?>" target="_blank">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-facebook-f fa-stack-1x"></i>
                            </a>
                        </span>
                        <span class="fa-stack">
                            <a href="<?php echo LINKEDIN_LINK;?>" target="_blank">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-linkedin fa-stack-1x"></i>
                            </a>
                        </span>
                        <span class="fa-stack">
                            <a href="<?php echo VIBER_LINK;?>" target="_blank">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-viber fa-stack-1x"></i>
                            </a>
                        </span>
                    </span>
                </div> <!-- end of navbar-collapse -->

            </div> <!-- end of container -->
        </nav> <!-- end of navbar -->
        <!-- end of navigation -->
            
        
    <?php
    } // private function renderNavigation(){

	private function renderFooter(){
	?>
                <!-- Footer -->
                <div class="footer">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="footer-col first">
                                    <h6>About this website</h6>
                                    <p class="p-small">
                                        Bob So is a senior software developer that loves making systems that helps companies ease their process. This website was made to showcase his portfolio and offer services that your company might need.
                                    </p>
                                    <p class="p-small">
                                        For more information, kindly check the pages provided on this website. I'm reachable through <a href="<?php echo FACEBOOK_LINK;?>" target="_blank">Facebook</a> and <a href="<?php echo VIBER_LINK;?>" target="_blank">Viber</a>.
                                    </p>
                                </div> <!-- end of footer-col -->
                                <div class="footer-col second">
                                    <h6>Links</h6>
                                    <ul class="list-unstyled li-space-lg p-small">
                                        <li><a href="<?php echo $this->CURRENT_DIRECTORY;?>sitemap">Site Map</a></li>
                                        <li><a href="<?php echo $this->CURRENT_DIRECTORY;?>privacypolicy">Privacy Policy</a></li>
                                        
                                        <li>&nbsp;</li>
                                        <li><a href="<?php echo $this->CURRENT_DIRECTORY;?>index">Home</a></li>
                                        <li><a href="<?php echo $this->CURRENT_DIRECTORY;?>about">About</a></li>
                                        <li><a href="<?php echo $this->CURRENT_DIRECTORY;?>portfolio">Portfolio</a></li>
                                        <li><a href="<?php echo $this->CURRENT_DIRECTORY;?>contact">Contact</a></li>
                                    </ul>
                                </div> <!-- end of footer-col -->
                                <div class="footer-col third">
                                    <span class="fa-stack">
                                        <a href="<?php echo FACEBOOK_LINK;?>" target="_blank">
                                            <i class="fas fa-circle fa-stack-2x"></i>
                                            <i class="fab fa-facebook-f fa-stack-1x"></i>
                                        </a>
                                    </span>
                                    <span class="fa-stack">
                                        <a href="<?php echo LINKEDIN_LINK;?>" target="_blank">
                                            <i class="fas fa-circle fa-stack-2x"></i>
                                            <i class="fab fa-linkedin fa-stack-1x"></i>
                                        </a>
                                    </span>
                                    <span class="fa-stack">
                                        <a href="<?php echo GITHUB_LINK;?>" target="_blank">
                                            <i class="fas fa-circle fa-stack-2x"></i>
                                            <i class="fab fa-github fa-stack-1x"></i>
                                        </a>
                                    </span>
                                    <span class="fa-stack">
                                        <a href="<?php echo INSTAGRAM_LINK;?>" target="_blank">
                                            <i class="fas fa-circle fa-stack-2x"></i>
                                            <i class="fab fa-instagram fa-stack-1x"></i>
                                        </a>
                                    </span>
                                    <br>
                                    <span class="fa-stack">
                                        <a href="<?php echo DISCORD_LINK;?>" target="_blank">
                                            <i class="fas fa-circle fa-stack-2x"></i>
                                            <i class="fab fa-discord fa-stack-1x"></i>
                                        </a>
                                    </span>
                                    <span class="fa-stack">
                                        <a href="<?php echo YOUTUBE_LINK;?>" target="_blank">
                                            <i class="fas fa-circle fa-stack-2x"></i>
                                            <i class="fab fa-youtube fa-stack-1x"></i>
                                        </a>
                                    </span>
                                    <span class="fa-stack">
                                        <a href="<?php echo TWITTER_LINK;?>" target="_blank">
                                            <i class="fas fa-circle fa-stack-2x"></i>
                                            <i class="fab fa-twitter fa-stack-1x"></i>
                                        </a>
                                    </span>
                                    <span class="fa-stack">
                                        <a href="<?php echo VIBER_LINK;?>" target="_blank">
                                            <i class="fas fa-circle fa-stack-2x"></i>
                                            <i class="fab fa-viber fa-stack-1x"></i>
                                        </a>
                                    </span>
                                    
                                    
                                    
                                    
                                    <p class="p-small">Do you need a software? Mail me <a href="mailto:bob@bobso.ph" target="_blank"><strong>bob@bobso.ph</strong></a></p>
                                </div> <!-- end of footer-col -->
                            </div> <!-- end of col -->
                        </div> <!-- end of row -->
                    </div> <!-- end of container -->
                </div> <!-- end of footer -->  
                <!-- end of footer -->


                <!-- Copyright -->
                <div class="copyright">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <p class="p-small">Copyright © <?php echo date("Y");?> <br>
                                    <a href="<?php echo LINKEDIN_LINK;?>"><?php echo META_AUTHOR;?></a> <br>
                                    All Rights Reserved.
                                </p>
                            </div> <!-- end of col -->
                        </div> <!-- enf of row -->

                    </div> <!-- end of container -->
                </div> <!-- end of copyright --> 
                <!-- end of copyright -->

                <!-- Back To Top Button -->
                <button onclick="topFunction()" id="myBtn">
                    <img src="images/up-arrow.png" alt="alternative">
                </button>
                <!-- end of back to top button -->
                <div id="dialog-modal-wrapper" style="display:none"></div>
            </body>
		</html>
		
	<?php
	} // private function renderFooter(){

	

} // class PageRenderer {

?>   
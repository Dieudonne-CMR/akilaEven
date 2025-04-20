<!-- ================================
       START FOOTER AREA
================================= -->
<section class="footer-area section-bg padding-top-40px padding-bottom-30px" >
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-8">
          <div class="term-box footer-item">
            <ul class="list-items list--items d-flex align-items-center">
              <li><a href="#">Conditions générales</a></li>
              <li><a href="#">Politique de confidentialité</a></li>
              <li><a href="#">Centre d'aide</a></li>
            </ul>
          </div>
        </div>
        <!-- end col-lg-8 -->
        <div class="col-lg-4">
          <div class="footer-social-box text-end">
            <ul class="social-profile">
              <li>
                <a href="#"><i class="lab la-facebook-f"></i></a>
              </li>
              <li>
                <a href="#"><i class="lab la-twitter"></i></a>
              </li>
              <li>
                <a href="#"><i class="lab la-instagram"></i></a>
              </li>
              <li>
                <a href="#"><i class="lab la-linkedin-in"></i></a>
              </li>
            </ul>
          </div>
        </div>
        <!-- end col-lg-4 -->
      </div>
      <!-- end row -->
    </div>
    <div class="mt-4 mb-5 section-block"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-3 responsive-column">
          <div class="footer-item">
            <div class="footer-logo padding-bottom-30px">
              <a href="{{route('home')}}" class="foot__logo">AkilaEven</a>
            </div>
            <!-- end logo -->
            <p class="footer__desc">
              Votre plateforme pour la réservation de salles de fêtes et chambres d'hôtel partout au Cameroun.
            </p>
            <ul class="pt-3 list-items">
              <li>
                Douala, Cameroun<br />
                Avenue de la Liberté
              </li>
              <li>+237 123 456 789</li>
              <li><a href="mailto:contact@akilaeven.com">contact@akilaeven.com</a></li>
            </ul>
          </div>
          <!-- end footer-item -->
        </div>
        <!-- end col-lg-3 -->
        <div class="col-lg-3 responsive-column">
          <div class="footer-item">
            <h4
              class="pb-3 title curve-shape margin-bottom-20px"
              data-text="curvs"
            >
              Entreprise
            </h4>
            <ul class="list-items list--items">
              <li><a href="{{route('site.bl-about.about')}}">À propos</a></li>
              <li><a href="#">Services</a></li>
              <li><a href="#">Offres d'emploi</a></li>
              <li><a href="#">Actualités</a></li>
              <li><a href="#">Support</a></li>
            </ul>
          </div>
          <!-- end footer-item -->
        </div>
        <!-- end col-lg-3 -->
        <div class="col-lg-3 responsive-column">
          <div class="footer-item">
            <h4
              class="pb-3 title curve-shape margin-bottom-20px"
              data-text="curvs"
            >
              Nos offres
            </h4>
            <ul class="list-items list--items">
              <li><a href="#">Salles de fêtes</a></li>
              <li><a href="#">Chambres d'hôtel</a></li>
              <li><a href="#">Offres spéciales</a></li>
              <li><a href="#">Partenaires</a></li>
              <li><a href="#">Créer un compte</a></li>
            </ul>
          </div>
          <!-- end footer-item -->
        </div>
        <!-- end col-lg-3 -->
        <div class="col-lg-3 responsive-column">
          <div class="footer-item">
            <h4
              class="pb-3 title curve-shape margin-bottom-20px"
              data-text="curvs"
            >
              Moyens de paiement
            </h4>
            <p class="pb-3 footer__desc">
              Payez comme vous le souhaitez, nous prenons en charge tous les moyens de paiement.
            </p>
            <img src="{{asset('assets_site/images/payment-img.png')}}" alt="Moyens de paiement" />
          </div>
          <!-- end footer-item -->
        </div>
        <!-- end col-lg-3 -->
      </div>
      <!-- end row -->
      <div class="section-block"></div>
      <div class="row">
        <div class="col-lg-12">
          <div class="text-center copy-right padding-top-30px">
            <p class="copy__desc">
              &copy; Copyright AkilaEven <span id="get-year">{{date('Y')}}</span>. Tous droits réservés.
            </p>
          </div>
          <!-- end copy-right -->
        </div>
        <!-- end col-lg-12 -->
      </div>
      <!-- end row -->
    </div>
    <!-- end container -->
</section>
<!-- end footer-area -->
<!-- ================================
     START FOOTER AREA
================================= -->

<!-- start back-to-top -->
<div id="back-to-top">
  <i class="la la-angle-up" title="Retour en haut"></i>
</div>
<!-- end back-to-top -->

<style>
  .foot__logo {
    font-size: 24px;
    font-weight: 700;
    color: #287dfa;
    text-decoration: none;
    transition: color 0.3s ease;
  }
  
  .foot__logo:hover {
    color: #0056b3;
  }
</style> 
    <footer class="not_print">
      <nav>
        <ul>
          <li style="float: left; list-style: none; margin: 20px;"><a href="./impressum" rel="external" target="_blank">Impressum</a></li>
          <li style="float: left; list-style: none; margin: 20px;"><a href="./datenschutz" rel="external" target="_blank">Datenschutzerklärung</a></li>
        </ul>
      </nav>
    </footer>
    <div id="footer-cookie">
      <span id="description">
        Wir nutzen Cookies, um Ihnen ein besseres Nutzererlebnis zu ermöglichen. Keine Sorge, wir speichern dadurch keine Daten von Ihnen. Mit Nutzung dieser Seite akzeptieren Sie funktionelle Cookies.  <a href="https://www.verbraucherzentrale.de/wissen/digitale-welt/datenschutz/cookies-kontrollieren-und-verwalten-11996#0" target="_blank">Was sind Cookies?</a><!-- - <a href="#" target="_blank">Mehr erfahren</a>-->
      </span>
      <span id="accept"><a href="javascript:void(0)" title="Ok, verstanden">Ok, verstanden</a></span>
    </div>

    <script>
      var footerCookie = document.querySelector("#footer-cookie");
      var footerCookieAccept = document.querySelector("#accept");
      if (document.cookie.indexOf("CookieBanner=") == -1) {
        footerCookie.style.display = "block";
      }
      footerCookieAccept.onclick = function(e) {
        var cookieDate = new Date();
        cookieDate.setTime(new Date().getTime() + 31104000000);
        document.cookie = "CookieBanner = 1; path=/; secure; expires=" + cookieDate.toUTCString();
        footerCookie.style.display = "none";
      };
    </script>
    </div>
    </div>
    </div>

    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/browser.min.js"></script>
    <script src="assets/js/breakpoints.min.js"></script>
    <script src="assets/js/util.js"></script>
    <script src="assets/js/main.js"></script>

  </body>
</html>

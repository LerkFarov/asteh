<footer class="footer">
    <div class="col-sm-12">
        <div class="col-sm-2">
            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/footer_logo.png" alt="Аренда инструмента">
        </div>
        <div class="col-sm-10">
            <div class="col-sm-2" style="padding: 0 3px;">
                <div class="col-sm-12" style="padding:0px; text-align:center;">
                    <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/footer_time_icon.png">
                </div>
                <div class="col-sm-12 footer_icon_text"  style="padding:0px">
                     <span>График работы:</span><br>
                    <?php print_r(get_option('theme_worktext')); ?>
                </div>
            </div>
            <div class="col-sm-2" style="padding: 0 3px;">
                <div class="col-sm-12" style="padding:0px; text-align:center;">
                    <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/footer_marker_icon.png">
                </div>
                <div class="col-sm-12 footer_icon_text"  style="padding:0px">
                    <span>Адрес:</span><br>
                    <?php print_r(get_option('theme_address')); ?>
                </div>
            </div>
            <div class="col-sm-2" style="padding: 0 3px;">
                <div class="col-sm-12" style="padding:0px; text-align:center;">
                    <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/footer_telefon_icon.png">
                </div>
                <div class="col-sm-12 footer_icon_text"  style="padding:0px">
                    <span>Телефон:</span><br>
                    <?php print_r(get_option('theme_telephone')); ?>
                </div>
            </div>
            <div class="col-sm-2" style="padding: 0 0px;">
                <div class="col-sm-12" style="padding:0px; text-align:center;">
                    <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/footer_mail_icon.png">
                </div>
                <div class="col-sm-12 footer_icon_text" style="padding:0px;">
                    <span>E-mail:</span><br>
                    <?php print_r(get_option('theme_email')); ?>
                </div>
                <noindex><div class="col-sm-12" style="text-align: right; margin-top: 11px;">
                   <!-- Yandex.Metrika informer -->
                    <a href="https://metrika.yandex.ru/stat/?id=36317435&amp;from=informer"
                    target="_blank" rel="nofollow"><img src="https://informer.yandex.ru/informer/36317435/1_1_FFFFFFFF_EFEFEFFF_0_uniques"
                    style="width:80px; height:15px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (уникальные посетители)" onclick="try{Ya.Metrika.informer({i:this,id:36317435,lang:'ru'});return false}catch(e){}" /></a>
                    <!-- /Yandex.Metrika informer -->
                    
                    <!-- Yandex.Metrika counter -->
                    <script type="text/javascript">
                        (function (d, w, c) {
                            (w[c] = w[c] || []).push(function() {
                                try {
                                    w.yaCounter36317435 = new Ya.Metrika({
                                        id:36317435,
                                        clickmap:true,
                                        trackLinks:true,
                                        accurateTrackBounce:true,
                                        webvisor:true
                                    });
                                } catch(e) { }
                            });
                    
                            var n = d.getElementsByTagName("script")[0],
                                s = d.createElement("script"),
                                f = function () { n.parentNode.insertBefore(s, n); };
                            s.type = "text/javascript";
                            s.async = true;
                            s.src = "https://mc.yandex.ru/metrika/watch.js";
                    
                            if (w.opera == "[object Opera]") {
                                d.addEventListener("DOMContentLoaded", f, false);
                            } else { f(); }
                        })(document, window, "yandex_metrika_callbacks");
                    </script>
                    <noscript><div><img src="https://mc.yandex.ru/watch/36317435" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
                    <!-- /Yandex.Metrika counter -->
					<script>
					  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
					  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
					  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
					  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

					  ga('create', 'UA-37039421-45', 'auto');
					  ga('send', 'pageview');

					</script>
					<!-- Top100 (Kraken) Counter -->
					<script>
						(function (w, d, c) {
						(w[c] = w[c] || []).push(function() {
							var options = {
								project: 4458131
							};
							try {
								w.top100Counter = new top100(options);
							} catch(e) { }
						});
						var n = d.getElementsByTagName("script")[0],
						s = d.createElement("script"),
						f = function () { n.parentNode.insertBefore(s, n); };
						s.type = "text/javascript";
						s.async = true;
						s.src =
						(d.location.protocol == "https:" ? "https:" : "http:") +
						"//st.top100.ru/top100/top100.js";

						if (w.opera == "[object Opera]") {
						d.addEventListener("DOMContentLoaded", f, false);
					} else { f(); }
					})(window, document, "_top100q");
					</script>
					<noscript><img src="//counter.rambler.ru/top100.cnt?pid=4458131"></noscript>
					<!-- END Top100 (Kraken) Counter -->
                    </div></noindex>
					
<script type="text/javascript">(function(w,doc) {
if (!w.__utlWdgt ) {
    w.__utlWdgt = true;
    var d = doc, s = d.createElement('script'), g = 'getElementsByTagName';
    s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
    s.src = ('https:' == w.location.protocol ? 'https' : 'http')  + '://w.uptolike.com/widgets/v1/uptolike.js';
    var h=d[g]('body')[0];
    h.appendChild(s);
}})(window,document);
</script>
<div data-background-alpha="0.0" data-buttons-color="#FFFFFF" data-counter-background-color="#ffffff" data-share-counter-size="12" data-top-button="false" data-share-counter-type="disable" data-share-style="1" data-mode="share" data-like-text-enable="false" data-hover-effect="rotate-cw" data-mobile-view="true" data-icon-color="#ffffff" data-orientation="fixed-right" data-text-color="#000000" data-share-shape="round-rectangle" data-sn-ids="vk.ok.fb.tw.mr.em." data-share-size="30" data-background-color="#ffffff" data-preview-mobile="false" data-mobile-sn-ids="fb.vk.tw.wh.ok.vb." data-pid="1508786" data-counter-background-alpha="1.0" data-following-enable="false" data-exclude-show-more="false" data-selection-enable="true" class="uptolike-buttons" ></div>
            </div>
            <div class="col-sm-4">
                <div class="col-sm-12 social_icons">
                    <div class="col-sm-2 pull-right" style="padding:3px;"><a href="<?php print_r(get_option('theme_soc_ok')); ?>"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/social/ok.png" alt="vk" style="width:100%;"></a></div>
                    <div class="col-sm-2 pull-right" style="padding:3px;"><a href="<?php print_r(get_option('theme_soc_f')); ?>"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/social/f.png" alt="vk" style="width:100%;"></a></div>
                    <div class="col-sm-2 pull-right" style="padding:3px;"><a href="<?php print_r(get_option('theme_soc_m')); ?>"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/social/m.png" alt="vk" style="width:100%;"></a></div>
                    <div class="col-sm-2 pull-right" style="padding:3px;"><a href="<?php print_r(get_option('theme_soc_t')); ?>"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/social/t.png" alt="vk" style="width:100%;"></a></div>
                    <div class="col-sm-2 pull-right" style="padding:3px;"><a href="<?php print_r(get_option('theme_soc_vk')); ?>"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/social/vk.png" alt="vk" style="width:100%;"></a></div>
                </div>
                <div class="col-sm-12 social_icons">
                    <p style="color:white; font-size: 9px; font-family: 'Exo 2'; margin-top: 10px;" class="pull-right">© 2017. Все права защищены</p>
                    <a href="http://adtherapy.ru/"><img class="pull-right" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/logo.png" style="width:90%" alt="logo"></a>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
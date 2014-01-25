<?php
require_once ('view/header.php');
?>
    <div data-role="page" class="ui-responsive-panel" id="panel-fixed-page1" data-url="panel-fixed-page1" data-add-back-btn="true" data-back-btn-text="Inapoi">
		<div class="header">
			<div data-role="header" class="ui-bar ui-bar-a" data-theme="none" style="background:none; border: 0px;">
				<span></span>
				<h1 style="margin: 0px; font-size: 22px;"><a href="/" style="color:white !important">Webex - Alertele mele</a></h1>
				<a href="#add-form" data-role="button" data-icon="bars" data-iconpos="notext" data-iconpos="right"   data-iconshadow="false" data-inline="true" class="ui-btn-right pad2l pad2t pad2b pad2r" >Meniu</a> 
			</div>	
		</div> <!-- end header -->
		<div data-role="panel" data-position="right" data-position-fixed="true" data-display="overlay" data-theme="b" id="add-form" style="overflow-y:auto;overflow-x:hidden;background:#277182">
			<strong>Meniu</strong>
				<ul data-role="listview" data-inset="true">				 					
					<li><a href="/Contact/">Contact</a></li>
					<li><a href="/Settings/">Settings</a></li>
				</ul>
			</div><!-- --> 
			<!-- /panel -->	
		<div class="cb"></div>
		<div>	
			<div class="localitati mar10t">
				<ul data-role="listview" data-inset="true">
												<li><a href="/Alerte/" id="11">Alerte pret</a></li>
												<li><a href="/recurente/index" id="13">Cumparaturi recurente</a></li>
												<li><a href="/Random/" id="35">Produsul zilei</a></li>			
				</ul>
			</div>			
			
		</div> <!-- end content -->
	</div>	
	<script type="text/javascript">
		$( document ).on( "pageinit", "#panel-fixed-page1", function() {	
			$('a.native-anchor').bind('click', function(ev) {
				 var target = $( $(this).attr('href') ).get(0).offsetTop;
				 $.mobile.silentScroll(target);
				 return false;
			});
		});
	</script>
	<div class="cb"></div>
</div><!-- end main -->

<?
require_once ('view/footer.php');
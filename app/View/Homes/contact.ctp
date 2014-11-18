<div class="container">
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<picture>
				<!--[if IE 9]><video style="display: none;"><![endif]-->
				<source media="(-webkit-min-device-pixel-ratio: 2)" srcset="#"></source>
				<source media="(min-resolution: 192dpi)" srcset="#"></source>
				<source srcset="#"></source>
				<?php echo $this->Html->image('logo-contact.jpg', array('alt' =>'Contact Us', 'style' => 'max-width: 100%; height: auto; width: auto\9; border-radius: 4px;'));?>
				<!--[if IE 9]></video><![endif]-->
			</picture>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<h2 class="underlined">Liên hệ</h2>
			<h5><?php echo @$company['address'];?></h5>
			<p><span class="glyphicon glyphicon-phone-alt"></span> &nbsp; <?php echo @substr($company['phone'], 0, 18);?></p>
			<p><span class="glyphicon glyphicon-phone"></span> &nbsp; <?php echo @substr($company['phone'], 20, @(strlen($company['phone']) - 20));?></p>
			<p>&nbsp;</p>
			<p>Mọi thắc mắc xin liên hệ</p>
			<p><a href="mailto:<?php echo @$company['email'];?>" class="mbt-button"><?php echo @$company['email'];?><script type="text/javascript">
				/* &lt;![CDATA[ */
				(function(){try{var s,a,i,j,r,c,l,b=document.getElementsByTagName("script");l=b[b.length-1].previousSibling;a=l.getAttribute('data-cfemail');if(a){s='';r=parseInt(a.substr(0,2),16);for(j=2;a.length-j;j+=2){c=parseInt(a.substr(j,2),16)^r;s+=String.fromCharCode(c);}s=document.createTextNode(s);l.parentNode.replaceChild(s,l);}}catch(e){}})();
				/* ]]&gt; */
				</script></a></p>
			<p>&nbsp;</p>
			<p>Bạn đang tìm kiếm cơ hội hợp tác với Flowersinlove?</p>
			<p><a href="mailto:<?php echo @$company['email'];?>" class="mbt-button"><?php echo @$company['email'];?><script type="text/javascript">
			/* &lt;![CDATA[ */
			(function(){try{var s,a,i,j,r,c,l,b=document.getElementsByTagName("script");l=b[b.length-1].previousSibling;a=l.getAttribute('data-cfemail');if(a){s='';r=parseInt(a.substr(0,2),16);for(j=2;a.length-j;j+=2){c=parseInt(a.substr(j,2),16)^r;s+=String.fromCharCode(c);}s=document.createTextNode(s);l.parentNode.replaceChild(s,l);}}catch(e){}})();
			/* ]]&gt; */
			</script></a></p>
			<p>Chúng tôi luôn hoan nghênh mọi cơ hội hợp tác!</p>
		</div>
	</div>
</div>


<div class="container main-container headerOffset">
	<?php echo $this->Session->flash(); ?>
  	<div class="row">
		<div class="row ol-lg-6 col-md-6 col-sm-12 col-xs-12">
			<h2 class="underlined">Ý kiến</h2>
			<form class="rule-form" role="form" method="post" onsubmit="return validateForm()" action="<?php echo $this->Html->url(array('controller' => 'homes', 'action' => 'save_feedback')); ?>">
				<div class="form-group col-md-10 col-sm-12">
					<label for="email" class="control-label">Địa chỉ email</label>
	          		<div >
	            		<input name="email" id="email" class="form-control input" size="20" type="text">
	          		</div>
	        	</div>
	        	<div class="form-group col-md-10 col-sm-12">
	        		<label for="name" class="control-label">Tên</label>
	          		<div >
	            		<input name="name" id="name" class="form-control input"  size="20"  type="text">
	          		</div>
	        	</div>
	        	<div class="form-group col-md-10 col-sm-12">
	            	<label for="content" class="control-label">Nội dung</label>
	                <div>
	                	<textarea name="content" id="content" class="form-control" rows="7"></textarea>
	                </div>
	             </div>
	             <div class="form-group col-md-10 col-sm-12">
	             	<button class="btn btn-primary pull-right" name="submit" id="submit">Gửi Ý Kiến</button>
	             </div>
             </form>
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

<?php echo $this->Html->scriptStart( array('block' => 'script') ); ?>
function validateForm() {
	var name = $('#name').val();
	var email = $('#email').val();
	var content = $('#content').val();
	
	var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	if (email == null || email == "" || !(re.test(email))) {
        alert("Email không hợp lệ");
        return false;
    }
    
    if (name == null || name == "") {
        alert("Nhập tên");
        return false;
    }
    
    if (content == null || content == "") {
        alert("Nhập nội dung");
        return false;
    }
}

<?php echo $this->Html->scriptEnd(); ?>
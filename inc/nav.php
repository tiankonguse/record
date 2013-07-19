					<span><a title="home page" class="" href="index.php">home</a></span> 
					<?php  if(strcmp($user,"share_admin")==0){ ?>
						<span><a title="write" class="" href="write.php">write</a></span> 
						<span><a title="login" class="" href="logout.php">logout</a></span> 
					<?php  } else {?>
						<span><a title="login" class="" href="login.php">login</a></span> 
					<?php }?>
{include file="header.tpl" title="FrozenFlower - Request Membership"}
		<div id="center">
         <div class="article">
            <div class="title">Request Membership</div>
            <div class="text">
				   <h2>Want to become a member of FrozenFlower?</h2>
				   <p>We are allways looking for new quality photoblogs to be featured in FrozenFlower. Do you think you have what it takes? If you do, request a membership. But before, please make sure that:</p>
                                   <ul>
                                     <li>Photos on your feed are at least 500px wide or tall</li>
                                     <li>Your photos allow other websites to use them</li>
                                   </ul>
				   <h2>Membership Request Form:</h2>
                                   <form method="post" action="submitrequest.php">
                                   <p>Name: <input type="text" name="name" /></p>
                                   <p>Email: <input type="text" name="email" /></p>
                                   <p>Photoblog Name: <input type="text" name="photoblogName" /></p>
                                   <p>Photoblog Address: <input type="text" name="photoblogUrl" /></p>
                                   <p>Feed: <input type="text" name="feed" /></p>
                                   <p>Small Description: <input type="text" name="description" /></p>
                                   <p>Message: <input type="text" name="message" /></p>
                                   <p><input type="submit" /></p>
                                   </form>
				</div>
         </div>
      </div>
{include file="right.tpl" feeds=$feeds}
{include file="footer.tpl"}

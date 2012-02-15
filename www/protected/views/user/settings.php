<?php $this->pageTitle=Yii::app()->name . ' - My Settings'; ?>
<div class="content user_settings">
	<div class="left_col">
		<div class="title"><span>Profile</span><input type="button" class="button" value="Save" /></div>
		<div class="text">
			<input type="text" value="Full Name" />
			<input type="text" value="Email" />
		</div>
		<div class="title"><span>Password</span><input type="button" class="button" value="Change" /></div>
		<div class="text">
			<input type="text" value="New password" />
			<input type="text" value="Type it again" />
		</div>
	</div>
	<div class="right_col">
		<div class="title"><span>Feed</span><input type="button" class="button" value="Save" /></div>
		<div class="text">
			<div class="row">
				<span>Show only</span><input type="text" class="select" value="lessons" readonly />
			</div>
			<div class="row">
				<span>Send new</span><input type="text" class="select" value="lessons" readonly /><span>on email</span>
			</div>
			<input type="hidden" name="show_option" />
			<input type="hidden" name="email_option" />
		</div>
	</div>
</div>



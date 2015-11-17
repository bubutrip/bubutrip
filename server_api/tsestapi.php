<div>Test AppApi</div>
<form action="serviceapi.php?model=AppApi" method="post">
	<div>
		<label for="">PostValue</label>
		<input type="text" name="event" style="width:100%" value='{"success":true,"user_id":"FYJdEaJ+uqs=","user_email":"josh@masterhand.com.tw","device_id":"jl+1UoNuGQooptzuYxhfyg=="}'>
	</div>
	<input type="submit" value="送出" >
</form>
<br>
<form action="test.php" method="post">
	<div>
		<label for="">Test echo all port</label>
		<input type="text" name="event" value='{"success":true,"user_id":"12345","user_email":"josh@masterhand.com.tw","device_id":"a1s2d3f4g5h6"}'>
	</div>
	<input type="submit" value="送出" >
</form>
<br>
<div>Test WebApi Login</div>
<form action="serviceapi.php?model=WebApi&function=web_login" method="post">
	<div>
		<label for="">Acc</label>
		<input type="text" name="email" value="jake@jbravo.com.tw" data-info="">
	</div>
	<div>
		<label for="">Pwd</label>
		<input type="password" name="passwd" value="pan410622">
	</div>
	<input type="submit" value="送出" >
</form>
<div>Test WebApi Reg</div>
<form action="serviceapi.php?model=WebApi&function=reg_user" method="post">
	<div>
		<label for="">name</label>
		<input type="text" name="name" value="jake" data-info="">
	</div>
	<div>
		<label for="">Acc</label>
		<input type="text" name="email" value="jake@jbravo.com.tw" data-info="">
	</div>
	<div>
		<label for="">Pwd</label>
		<input type="password" name="passwd" value="pan410622">
		<input type="password" name="passwd2" value="pan410622">
	</div>
	<div>
		<label for="">area_no</label>
		<input type="text" name="area_no" value="0" data-info="">
	</div>
	<div>
		<label for="">age_group_bit</label>
		<input type="text" name="age_group_bit" value="0" data-info="">
	</div>
	<div>
		<label for="">travel_area_bit</label>
		<input type="text" name="travel_area_bit" value="0" data-info="">
	</div>
	<input type="hideen" name="com_key" value="akfgjarg">
	<input type="submit" value="送出" >
</form>

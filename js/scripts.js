
if ($('#hockeyLine').length > 0) {

	// Add HockeyLine
	$('#submit-hockeyLine').on('click', function(){

		$.post(window.baseUrl + '/priceGuide/addHockeyLine', $('#add-hockeyLine-form').serialize(), function(html) {
		}).success(function(data) {
			if (data.error) {
				alert(data.error);
			} else {
				location.reload();
			}
		});
    
	});
	// End Add HockeyLine

	//Edit HockeyLine
	$('#hockeyLineTable').find('[data-id]').on('click', function(){

		$.post(window.baseUrl + '/priceGuide/editHockeyLine', {'id' : $(this).attr('data-id')}, function(html) {
		}).success(function(data) {

			$.each(data, function(key, value) {
				$('#edit-hockeyLine-form').find('[name="HockeyLine[' + key + ']"]').val(value);
			});
			
		});
    
	});
	

	$('#edit-submit-hockeyLine').on('click', function(){

		var row_id = 'tr_'+$('#edit-hockeyLine-form').find('[name="HockeyLine[id]"]').val();

		$.post(window.baseUrl + '/priceGuide/editSubmitHockeyLine', $('#edit-hockeyLine-form').serialize(), function(html) {
		}).success(function(data) {
			if (data.error) {
				alert(data.error);
			} else {
				//location.reload();
				var curr = window.location.href;
				//alert(curr);
				var currency_index = curr.indexOf("curr=");
				var currency = "";
				if(currency_index>0){
					currency = curr.substring(currency_index, currency_index+6);
				}

				var tmp_curr = curr.split("?");
				curr = tmp_curr[0];

				var ran = Math.floor(Math.random() * 1000);

				if(tmp_curr.length>1){
					
					if(currency!=""){
						window.location.href = curr + '?'+currency+'&'+ran+'#'+row_id;
					}else{
						window.location.href = curr + '?'+ran+'#'+row_id;
					}
					
				}else{
					window.location.href = curr + '?'+ran+'#'+row_id;
				}
			}
		});
    
	});
	
	$('#edit-submit-sortdata').on('click', function(){

		$.post(window.baseUrl + '/priceGuide/editSubmitSortdata', $('#edit-sortdata-form').serialize(), function(html) {
		}).success(function(data) {
			if (data.error) {
				alert(data.error);
			} else {
				location.reload();
			}
		});
    
	});
	// End Edit HockeyLine

	// Add Extras
	$('#submit-extras').on('click', function(){

		$.post(window.baseUrl + '/priceGuide/addExtras', $('#add-extras-form').serialize(), function(html) {
		}).success(function(data) {
			if (data.error) {
				alert(data.error);
			} else {
				location.reload();
			}
		});
    
	});
	// End Add Extras

	//Edit Extras
	$('#extrasTable').find('[data-id]').on('click', function(){

		$.post(window.baseUrl + '/priceGuide/editExtras', {'id' : $(this).attr('data-id')}, function(html) {
		}).success(function(data) {

			$.each(data, function(key, value) {
				$('#edit-extras-form').find('[name="Extras[' + key + ']"]').val(value);
			});
			
		});
    
	});

	$('#edit-submit-extras').on('click', function(){

		$.post(window.baseUrl + '/priceGuide/editSubmitExtras', $('#edit-extras-form').serialize(), function(html) {
		}).success(function(data) {
			if (data.error) {
				alert(data.error);
			} else {
				location.reload();
			}
		});
    
	});
	// End Edit Extras
	
	
}

if ($('#tracksuits').length > 0) {
	// Add Tracksuits
	$('#submit-tracksuits').on('click', function(){

		$.post(window.baseUrl + '/priceGuide/addTracksuits', $('#add-tracksuits-form').serialize(), function(html) {
		}).success(function(data) {
			if (data.error) {
				alert(data.error);
			} else {
				location.reload();
			}
		});
    
	});
	// End Add Tracksuits

	// Edit Tracksuits
	$('#tracksuitsTable').find('[data-id]').on('click', function(){
		$.post(window.baseUrl + '/priceGuide/editTracksuits', {'id' : $(this).attr('data-id')}, function(html) {
		}).success(function(data) {

			$.each(data, function(key, value) {
				$('#edit-tracksuits-form').find('[name="Tracksuits[' + key + ']"]').val(value);
			});
			
		});
    
	});

	$('#edit-submit-tracksuits').on('click', function(){

		var row_id = 'tr_'+$('#edit-tracksuits-form').find('[name="Tracksuits[id]"]').val();

		$.post(window.baseUrl + '/priceGuide/editSubmitTracksuits', $('#edit-tracksuits-form').serialize(), function(html) {
		}).success(function(data) {
			if (data.error) {
				alert(data.error);
			} else {
				
				//location.reload();
				var curr = window.location.href;
				//alert(curr);
				var currency_index = curr.indexOf("curr=");
				var currency = "";
				if(currency_index>0){
					currency = curr.substring(currency_index, currency_index+6);
				}

				var tmp_curr = curr.split("?");
				curr = tmp_curr[0];

				var ran = Math.floor(Math.random() * 1000);

				if(tmp_curr.length>1){
					
					if(currency!=""){
						window.location.href = curr + '?'+currency+'&'+ran+'#'+row_id;
					}else{
						window.location.href = curr + '?'+ran+'#'+row_id;
					}
					
				}else{
					window.location.href = curr + '?'+ran+'#'+row_id;
				}
			}
		});
    
	});
	// End Edit Tracksuits
}

if ($('#hoodies').length > 0) {
	// Add Hoodies
	$('#submit-hoodies').on('click', function(){

		$.post(window.baseUrl + '/priceGuide/addHoodies', $('#add-hoodies-form').serialize(), function(html) {
		}).success(function(data) {
			if (data.error) {
				alert(data.error);
			} else {
				location.reload();
			}
		});
    
	});
	// End Add Hoodies

	// Edit Hoodies
	$('[id="hoodiesTable"]').find('[data-id]').on('click', function(){
		$.post(window.baseUrl + '/priceGuide/editHoodies', {'id' : $(this).attr('data-id')}, function(html) {
		}).success(function(data) {

			$.each(data, function(key, value) {
				$('#edit-hoodies-form').find('[name="Hoodies[' + key + ']"]').val(value);
			});
			
		});
    
	});

	$('#edit-submit-hoodies').on('click', function(){

		var row_id = 'tr_'+$('#edit-hoodies-form').find('[name="Hoodies[id]"]').val();

		$.post(window.baseUrl + '/priceGuide/editSubmitHoodies', $('#edit-hoodies-form').serialize(), function(html) {
		}).success(function(data) {
			if (data.error) {
				alert(data.error);
			} else {
				//location.reload();
				var curr = window.location.href;
				//alert(curr);
				var currency_index = curr.indexOf("curr=");
				var currency = "";
				if(currency_index>0){
					currency = curr.substring(currency_index, currency_index+6);
				}

				var tmp_curr = curr.split("?");
				curr = tmp_curr[0];

				var ran = Math.floor(Math.random() * 1000);

				if(tmp_curr.length>1){
					
					if(currency!=""){
						window.location.href = curr + '?'+currency+'&'+ran+'#'+row_id;
					}else{
						window.location.href = curr + '?'+ran+'#'+row_id;
					}
					
				}else{
					window.location.href = curr + '?'+ran+'#'+row_id;
				}
			}
		});
    
	});
	// End Edit Hoodies
}
/*
if ($('#tracksuits').length > 0) {
	// Add Tracksuits
	$('#submit-tracksuits').on('click', function(){

		$.post(window.baseUrl + '/priceGuide/addTracksuits', $('#add-tracksuits-form').serialize(), function(html) {
		}).success(function(data) {
			if (data.error) {
				alert(data.error);
			} else {
				location.reload();
			}
		});
    
	});
	// End Add Tracksuits

	// Edit Tracksuits
	$('#tracksuitsTable').find('[data-id]').on('click', function(){
		$.post(window.baseUrl + '/priceGuide/editTracksuits', {'id' : $(this).attr('data-id')}, function(html) {
		}).success(function(data) {

			$.each(data, function(key, value) {
				$('#edit-tracksuits-form').find('[name="Tracksuits[' + key + ']"]').val(value);
			});
			
		});
    
	});

	$('#edit-submit-tracksuits').on('click', function(){

		$.post(window.baseUrl + '/priceGuide/editSubmitTracksuits', $('#edit-tracksuits-form').serialize(), function(html) {
		}).success(function(data) {
			if (data.error) {
				alert(data.error);
			} else {
				location.reload();
			}
		});
    
	});
	// End Edit Tracksuits
}
*/
if ($('#tshirts').length > 0) {
	// Add Tshirts
	$('#submit-tshirts').on('click', function(){

		$.post(window.baseUrl + '/priceGuide/addTshirts', $('#add-tshirts-form').serialize(), function(html) {
		}).success(function(data) {
			if (data.error) {
				alert(data.error);
			} else {
				location.reload();
			}
		});
    
	});
	// End Add Tshirts

	// Edit Tshirts
	$('[id="tshirtsTable"]').find('[data-id]').on('click', function(){
		$.post(window.baseUrl + '/priceGuide/editTshirts', {'id' : $(this).attr('data-id')}, function(html) {
		}).success(function(data) {

			$.each(data, function(key, value) {
				$('#edit-tshirts-form').find('[name="Tshirts[' + key + ']"]').val(value);
			});
			
		});
    
	});

	$('#edit-submit-tshirts').on('click', function(){

		var row_id = 'tr_'+$('#edit-tshirts-form').find('[name="Tshirts[id]"]').val();

		$.post(window.baseUrl + '/priceGuide/editSubmitTshirts', $('#edit-tshirts-form').serialize(), function(html) {
		}).success(function(data) {
			if (data.error) {
				alert(data.error);
			} else {
				//location.reload();
				var curr = window.location.href;
				//alert(curr);
				var currency_index = curr.indexOf("curr=");
				var currency = "";
				if(currency_index>0){
					currency = curr.substring(currency_index, currency_index+6);
				}

				var tmp_curr = curr.split("?");
				curr = tmp_curr[0];

				var ran = Math.floor(Math.random() * 1000);

				if(tmp_curr.length>1){
					
					if(currency!=""){
						window.location.href = curr + '?'+currency+'&'+ran+'#'+row_id;
					}else{
						window.location.href = curr + '?'+ran+'#'+row_id;
					}
					
				}else{
					window.location.href = curr + '?'+ran+'#'+row_id;
				}
			}
		});
    
	});
	// End Edit Tshirts
}

if ($('#polo').length > 0) {
	// Add Polo
	$('#submit-polo').on('click', function(){

		$.post(window.baseUrl + '/priceGuide/addPolo', $('#add-polo-form').serialize(), function(html) {
		}).success(function(data) {
			if (data.error) {
				alert(data.error);
			} else {
				location.reload();
			}
		});
    
	});
	// End Add Polo

	// Edit Polo
	$('[id="poloTable"]').find('[data-id]').on('click', function(){
		$.post(window.baseUrl + '/priceGuide/editPolo', {'id' : $(this).attr('data-id')}, function(html) {
		}).success(function(data) {

			$.each(data, function(key, value) {
				$('#edit-polo-form').find('[name="Polo[' + key + ']"]').val(value);
			});
			
		});
    
	});

	$('#edit-submit-polo').on('click', function(){

		var row_id = 'tr_'+$('#edit-polo-form').find('[name="Polo[id]"]').val();

		$.post(window.baseUrl + '/priceGuide/editSubmitPolo', $('#edit-polo-form').serialize(), function(html) {
		}).success(function(data) {
			if (data.error) {
				alert(data.error);
			} else {
				//location.reload();
				var curr = window.location.href;
				//alert(curr);
				var currency_index = curr.indexOf("curr=");
				var currency = "";
				if(currency_index>0){
					currency = curr.substring(currency_index, currency_index+6);
				}

				var tmp_curr = curr.split("?");
				curr = tmp_curr[0];

				var ran = Math.floor(Math.random() * 1000);

				if(tmp_curr.length>1){
					
					if(currency!=""){
						window.location.href = curr + '?'+currency+'&'+ran+'#'+row_id;
					}else{
						window.location.href = curr + '?'+ran+'#'+row_id;
					}
					
				}else{
					window.location.href = curr + '?'+ran+'#'+row_id;
				}
			}
		});
    
	});
	// End Edit Polo
}

if ($('#baseball').length > 0) {
	// Add Baseball
	$('#submit-baseball').on('click', function(){

		$.post(window.baseUrl + '/priceGuide/addBaseball', $('#add-baseball-form').serialize(), function(html) {
		}).success(function(data) {
			if (data.error) {
				alert(data.error);
			} else {
				location.reload();
			}
		});
    
	});
	// End Add Baseball

	// Edit Baseball
	$('#baseballTable').find('[data-id]').on('click', function(){
		$.post(window.baseUrl + '/priceGuide/editBaseball', {'id' : $(this).attr('data-id')}, function(html) {
		}).success(function(data) {

			$.each(data, function(key, value) {
				$('#edit-baseball-form').find('[name="Baseball[' + key + ']"]').val(value);
			});
			
		});
    
	});

	$('#edit-submit-baseball').on('click', function(){

		var row_id = 'tr_'+$('#edit-baseball-form').find('[name="Baseball[id]"]').val();

		$.post(window.baseUrl + '/priceGuide/editSubmitBaseball', $('#edit-baseball-form').serialize(), function(html) {
		}).success(function(data) {
			if (data.error) {
				alert(data.error);
			} else {
				//location.reload();
				var curr = window.location.href;
				//alert(curr);
				var currency_index = curr.indexOf("curr=");
				var currency = "";
				if(currency_index>0){
					currency = curr.substring(currency_index, currency_index+6);
				}

				var tmp_curr = curr.split("?");
				curr = tmp_curr[0];

				var ran = Math.floor(Math.random() * 1000);

				if(tmp_curr.length>1){
					
					if(currency!=""){
						window.location.href = curr + '?'+currency+'&'+ran+'#'+row_id;
					}else{
						window.location.href = curr + '?'+ran+'#'+row_id;
					}
					
				}else{
					window.location.href = curr + '?'+ran+'#'+row_id;
				}
			}
		});
    
	});
	// End Edit Baseball
}

if ($('#basketball').length > 0) {
	// Add Basketball
	$('#submit-basketball').on('click', function(){

		$.post(window.baseUrl + '/priceGuide/addBasketball', $('#add-basketball-form').serialize(), function(html) {
		}).success(function(data) {
			if (data.error) {
				alert(data.error);
			} else {
				location.reload();
			}
		});
    
	});
	// End Add Basketball

	// Edit Basketball
	$('#basketballTable').find('[data-id]').on('click', function(){
		$.post(window.baseUrl + '/priceGuide/editBasketball', {'id' : $(this).attr('data-id')}, function(html) {
		}).success(function(data) {

			$.each(data, function(key, value) {
				$('#edit-basketball-form').find('[name="Basketball[' + key + ']"]').val(value);
			});
			
		});
    
	});

	$('#edit-submit-basketball').on('click', function(){

		var row_id = 'tr_'+$('#edit-basketball-form').find('[name="Basketball[id]"]').val();

		$.post(window.baseUrl + '/priceGuide/editSubmitBasketball', $('#edit-basketball-form').serialize(), function(html) {
		}).success(function(data) {
			if (data.error) {
				alert(data.error);
			} else {
				//location.reload();
				var curr = window.location.href;
				//alert(curr);
				var currency_index = curr.indexOf("curr=");
				var currency = "";
				if(currency_index>0){
					currency = curr.substring(currency_index, currency_index+6);
				}

				var tmp_curr = curr.split("?");
				curr = tmp_curr[0];

				var ran = Math.floor(Math.random() * 1000);

				if(tmp_curr.length>1){
					
					if(currency!=""){
						window.location.href = curr + '?'+currency+'&'+ran+'#'+row_id;
					}else{
						window.location.href = curr + '?'+ran+'#'+row_id;
					}
					
				}else{
					window.location.href = curr + '?'+ran+'#'+row_id;
				}
			}
		});
    
	});
	// End Edit Basketball
}

if ($('#soccer').length > 0) {
	// Add Soccer
	$('#submit-soccer').on('click', function(){

		$.post(window.baseUrl + '/priceGuide/addSoccer', $('#add-soccer-form').serialize(), function(html) {
		}).success(function(data) {
			if (data.error) {
				alert(data.error);
			} else {
				location.reload();
			}
		});
    
	});
	// End Add Soccer

	// Edit Soccer
	$('#soccerTable').find('[data-id]').on('click', function(){
		$.post(window.baseUrl + '/priceGuide/editSoccer', {'id' : $(this).attr('data-id')}, function(html) {
		}).success(function(data) {

			$.each(data, function(key, value) {
				$('#edit-soccer-form').find('[name="Soccer[' + key + ']"]').val(value);
			});
			
		});
    
	});

	$('#edit-submit-soccer').on('click', function(){

		var row_id = 'tr_'+$('#edit-soccer-form').find('[name="Soccer[id]"]').val();

		$.post(window.baseUrl + '/priceGuide/editSubmitSoccer', $('#edit-soccer-form').serialize(), function(html) {
		}).success(function(data) {
			if (data.error) {
				alert(data.error);
			} else {
				//location.reload();
				var curr = window.location.href;
				//alert(curr);
				var currency_index = curr.indexOf("curr=");
				var currency = "";
				if(currency_index>0){
					currency = curr.substring(currency_index, currency_index+6);
				}

				var tmp_curr = curr.split("?");
				curr = tmp_curr[0];

				var ran = Math.floor(Math.random() * 1000);

				if(tmp_curr.length>1){
					
					if(currency!=""){
						window.location.href = curr + '?'+currency+'&'+ran+'#'+row_id;
					}else{
						window.location.href = curr + '?'+ran+'#'+row_id;
					}
					
				}else{
					window.location.href = curr + '?'+ran+'#'+row_id;
				}
			}
		});
    
	});
	// End Edit Soccer
}

if ($('#volleyball').length > 0) {
	// Add Volleyball
	$('#submit-volleyball').on('click', function(){

		$.post(window.baseUrl + '/priceGuide/addVolleyball', $('#add-volleyball-form').serialize(), function(html) {
		}).success(function(data) {
			if (data.error) {
				alert(data.error);
			} else {
				location.reload();
			}
		});
    
	});
	// End Add Volleyball

	// Edit Volleyball
	$('#volleyballTable').find('[data-id]').on('click', function(){
		$.post(window.baseUrl + '/priceGuide/editVolleyball', {'id' : $(this).attr('data-id')}, function(html) {
		}).success(function(data) {

			$.each(data, function(key, value) {
				$('#edit-volleyball-form').find('[name="Volleyball[' + key + ']"]').val(value);
			});
			
		});
    
	});

	$('#edit-submit-volleyball').on('click', function(){

		var row_id = 'tr_'+$('#edit-volleyball-form').find('[name="Volleyball[id]"]').val();

		$.post(window.baseUrl + '/priceGuide/editSubmitVolleyball', $('#edit-volleyball-form').serialize(), function(html) {
		}).success(function(data) {
			if (data.error) {
				alert(data.error);
			} else {
				//location.reload();
				var curr = window.location.href;
				//alert(curr);
				var currency_index = curr.indexOf("curr=");
				var currency = "";
				if(currency_index>0){
					currency = curr.substring(currency_index, currency_index+6);
				}

				var tmp_curr = curr.split("?");
				curr = tmp_curr[0];

				var ran = Math.floor(Math.random() * 1000);

				if(tmp_curr.length>1){
					
					if(currency!=""){
						window.location.href = curr + '?'+currency+'&'+ran+'#'+row_id;
					}else{
						window.location.href = curr + '?'+ran+'#'+row_id;
					}
					
				}else{
					window.location.href = curr + '?'+ran+'#'+row_id;
				}
			}
		});
    
	});
	// End Edit Volleyball
}

// 
// Notes
// 
if ($('#notesTable').length > 0) {
	// Edit Notes
	$('#edit-submit-note').on('click', function(){

		$.post(window.baseUrl + '/priceGuide/editSubmitNotes', $('#edit-notes-form').serialize(), function(html) {
		}).success(function(data) {
			if (data.error) {
				alert(data.error);
			} else {
				location.reload();
			}
		});
		
	});
	// End Edit Notes
}

// 
// Header



if ($('#user').length > 0) {
	// Add User
	$('#submit-user').on('click', function(){

		$.post(window.baseUrl + '/user/addUser', $('#add-user-form').serialize(), function(html) {
		}).success(function(data) {
			if (data.error) {
				alert(data.error);
			} else {
				location.reload();
			}
		});
    
	});
	// End Add User

	// Edit User
	$('[id="userTable"]').find('[data-id]').on('click', function(){
		$.post(window.baseUrl + '/user/editUser', {'id' : $(this).attr('data-id')}, function(html) {
		}).success(function(data) {

			$.each(data, function(key, value) {
				$('#edit-user-form').find('[name="User[' + key + ']"]').val(value);
			});

			$('#User_username', '#edit-user-form').attr('readonly', true);
			
		});
    
	});

	$('#edit-submit-user').on('click', function(){

		$.post(window.baseUrl + '/user/editSubmitUser', $('#edit-user-form').serialize(), function(html) {
		}).success(function(data) {
			if (data.error) {
				alert(data.error);
			} else {
				location.reload();
			}
		});
    
	});
	// End Edit User
}

if ($('#profile-top').length > 0) {

	// Edit Profile
	$('#profile-top').on('click', function(){
		$.post(window.baseUrl + '/user/profile', {'id' : $(this).attr('user-key')}, function(html) {
		}).success(function(data) {

			$.each(data, function(key, value) {
				$('#edit-profile').find('[name="User[' + key + ']"]').val(value);
			});
			
		});
    
	});

	$('#edit-submit-profile').on('click', function(){

		$.post(window.baseUrl + '/user/editSubmitUser', $('#edit-profile').serialize(), function(html) {
		}).success(function(data) {
			if (data.error) {
				alert(data.error);
			} else {
				location.reload();
			}
		});
    
	});
	// End Edit Profile
}

if ($('#calculator').length > 0) {
	// Add Baseball
	/*$('#submit-calculator').on('click', function(){

		$.post(window.baseUrl + '/calculator/addCalculator', $('#add-calculator-form').serialize(), function(html) {
		}).success(function(data) {
			if (data.error) {
				alert(data.error);
			} else {
				location.reload();
			}
		});
    
	});*/
	// End Add Calculator

	// Edit Calculator
	$('#calculatorTable').find('[data-id]').on('click', function(){
		$.post(window.baseUrl + '/calculator/editCalculator', {'id' : $(this).attr('data-id')}, function(html) {
		}).success(function(data) {

			$.each(data, function(key, value) {
				$('#edit-calculator-form').find('[name="Calculator[' + key + ']"]').val(value);
			});
			
		});
    
	});
	
	$('#salesOrders').find('[data-id]').on('click', function(){
		$.post(window.baseUrl + '/calculator/editSaleOrders', {'id' : $(this).attr('data-id')}, function(html) {
		}).success(function(data) {

			$.each(data, function(key, value) {
				$('#edit-calculator-form').find('[name="SalesOrders[' + key + ']"]').val(value);
			});
			
		});
    
	});
	
	$('#calculatorUSDcomTable').find('[data-id]').on('click', function(){
		$.post(window.baseUrl + '/calculator/editCalculator', {'id' : $(this).attr('data-id')}, function(html) {
		}).success(function(data) {

			$.each(data, function(key, value) {
				$('#edit-calculator-form').find('[name="Calculator[' + key + ']"]').val(value);
				
				// $('#responseDiv').append(value);
				
			});
			
		});
    
	});
	
	$('.sales_Responsible_sales').find('[data-id]').on('click', function(){
		$.post(window.baseUrl + '/calculator/addCalculatorSales', {'id' : $(this).attr('data-id')}, function(html) {
		}).success(function(data) {

			$.each(data, function(key, value) {
				$('#add-calculatorsales-form').find('[name="Calculator[' + key + ']"]').val(value);
				
				// $('#responseDiv').append(value);
				
			});
			
		});
    
	});
	$('.data_invoice').find('[data-id]').on('click', function(){
		$.post(window.baseUrl + '/calculator/editCalculatorInvoice', {'id' : $(this).attr('data-id')}, function(html) {
		}).success(function(data) {

			$.each(data, function(key, value) {
				$('#edit-calculatorinvoice-form').find('[name="Calculator[' + key + ']"]').val(value);
				
				// $('#responseDiv').append(value);
				
			});
			
		});
    
	});
	
	$('.sales_Responsible_manager').find('[data-id]').on('click', function(){
		$.post(window.baseUrl + '/calculator/editCalculatorSalesManager', {'id' : $(this).attr('data-id')}, function(html) {
		}).success(function(data) {

			$.each(data, function(key, value) {
				$('#edit-calculatorManager-form').find('[name="Calculator[' + key + ']"]').val(value);
				
				// $('#responseDiv').append(value);
				
			});
			
		});
    
	});
	
	$('.sales_Responsible_salesrep').find('[data-id]').on('click', function(){
		$.post(window.baseUrl + '/calculator/editCalculatorSalesRep', {'id' : $(this).attr('data-id')}, function(html) {
		}).success(function(data) {

			$.each(data, function(key, value) {
				$('#edit-calculatorRep-form').find('[name="Calculator[' + key + ']"]').val(value);
				
				// $('#responseDiv').append(value);
				
			});
			
		});
    
	});
	
	$('.sales_Responsible_processor').find('[data-id]').on('click', function(){
		$.post(window.baseUrl + '/calculator/editCalculatorSalesProcessor', {'id' : $(this).attr('data-id')}, function(html) {
		}).success(function(data) {

			$.each(data, function(key, value) {
				$('#edit-calculatorProcessor-form').find('[name="Calculator[' + key + ']"]').val(value);
				
				// $('#responseDiv').append(value);
				
			});
			
		});
    
	});
	
	$('#calculatorCADcomTable').find('[data-id]').on('click', function(){
		$.post(window.baseUrl + '/calculator/editCalculator', {'id' : $(this).attr('data-id')}, function(html) {
		}).success(function(data) {

			$.each(data, function(key, value) {
				$('#edit-calculator-form').find('[name="Calculator[' + key + ']"]').val(value);
			});
			
		});
    
	});
	
	$('#calculatorSGDcomTable').find('[data-id]').on('click', function(){
		$.post(window.baseUrl + '/calculator/editCalculator', {'id' : $(this).attr('data-id')}, function(html) {
		}).success(function(data) {

			$.each(data, function(key, value) {
				$('#edit-calculator-form').find('[name="Calculator[' + key + ']"]').val(value);
			});
			
		});
    
	});
	
	$('#calculatorTHBcomTable').find('[data-id]').on('click', function(){
		$.post(window.baseUrl + '/calculator/editCalculator', {'id' : $(this).attr('data-id')}, function(html) {
		}).success(function(data) {

			$.each(data, function(key, value) {
				$('#edit-calculator-form').find('[name="Calculator[' + key + ']"]').val(value);
			});
			
		});
    
	});
	
	

	$('#edit-submit-calculator').on('click', function(){

		$.post(window.baseUrl + '/calculator/editSubmitCalculator', $('#edit-calculator-form').serialize(), function(html) {
		}).success(function(data) {
			if (data.error) {
				alert(data.error);
			} else {
				location.reload();
			}
		});
    
	});
	// End Edit Calculator
	
	// Edit Payment
	$('#paymentTable').find('[data-id]').on('click', function(){
		$.post(window.baseUrl + '/calculator/editPayment', {'id' : $(this).attr('data-id')}, function(html) {
		}).success(function(data) {

			$.each(data, function(key, value) {
				$('#edit-payment-form').find('[name="Calculator[' + key + ']"]').val(value);
			});
			
		});
    
	});
	
	
	// End Edit Payment
}

$('#calculatorSendTable').find('[data-id]').on('click', function(){
		$.post(window.baseUrl + '/calculator/editSendmail', {'id' : $(this).attr('data-id')}, function(html) {
		}).success(function(data) {

			$.each(data, function(key, value) {
				$('#send-mail-form').find('[name="Calculator[' + key + ']"]').val(value);
			});
			
		});
    
	});
	$('#calculatorUSDTable').find('[data-id]').on('click', function(){
		$.post(window.baseUrl + '/calculator/editSendmail', {'id' : $(this).attr('data-id')}, function(html) {
		}).success(function(data) {

			$.each(data, function(key, value) {
				$('#send-mail-form').find('[name="Calculator[' + key + ']"]').val(value);
			});
			
		});
    
	});
	$('#calculatorCADTable').find('[data-id]').on('click', function(){
		$.post(window.baseUrl + '/calculator/editSendmail', {'id' : $(this).attr('data-id')}, function(html) {
		}).success(function(data) {

			$.each(data, function(key, value) {
				$('#send-mail-form').find('[name="Calculator[' + key + ']"]').val(value);
			});
			
		});
    
	});
	$('#calculatorSGDTable').find('[data-id]').on('click', function(){
		$.post(window.baseUrl + '/calculator/editSendmail', {'id' : $(this).attr('data-id')}, function(html) {
		}).success(function(data) {

			$.each(data, function(key, value) {
				$('#send-mail-form').find('[name="Calculator[' + key + ']"]').val(value);
			});
			
		});
    
	});
	$('#calculatorTHBTable').find('[data-id]').on('click', function(){
		$.post(window.baseUrl + '/calculator/editSendmail', {'id' : $(this).attr('data-id')}, function(html) {
		}).success(function(data) {

			$.each(data, function(key, value) {
				$('#send-mail-form').find('[name="Calculator[' + key + ']"]').val(value);
			});
			
		});
    
	});
	
	$('table').find('[data-id]').on('click', function(){
		$.post(window.baseUrl + '/calculator/editSendmail', {'id' : $(this).attr('data-id')}, function(html) {
		}).success(function(data) {

			$.each(data, function(key, value) {
				$('#send-mail-form').find('[name="Calculator[' + key + ']"]').val(value);
			});
			
		});
    
	});
	
$('#send-submit-mail').on('click', function(){

		$.post(window.baseUrl + '/calculator/sendSubmitMailCustomer', $('#send-mail-form').serialize(), function(html) {
		}).success(function(data) {
			if (data.error) {
				alert(data.error);
			} else {
				location.reload();
			}
		});
    
	});	

if ($('#bankTable').length > 0) {
	// Edit Notes
	$('#edit-submit-bank').on('click', function(){

		$.post(window.baseUrl + '/calculator/editSubmitBank', $('#edit-bank-form').serialize(), function(html) {
		}).success(function(data) {
			if (data.error) {
				alert(data.error);
			} else {
				location.reload();
			}
		});
		
	});
	// End Edit Notes
}


// Function All

$('.confirm').on('click', function(){

	if(confirm("Are you sure?")) {
		window.location=$(this).attr('del-link') + '/id/' + $(this).attr('del-id');
	} else {
		return false;
	};
});

// check Numeric
// $('.numeric').on('keypress', function(e){
// 	return checkNumeric(e);
// });

// $('.phoneNumber').on('keypress', function(e){
// 	return checkPhoneNumber(e);
// });

// function checkNumeric(e) {
// 	if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 46) {
//         return false;
//     }
// }

// function checkPhoneNumber(e) {
// 	if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 45) {
//         return false;
//     }
// }

$('.btn-group > label').on('click', function () {
	var link = $(this).attr('link');
	$.post(window.baseUrl + '/priceGuide/setSessionMenu', {'tbl-type': $(this).attr('tbl-type')}, function(html) {
	}).success(function(data) {
		window.location = window.baseUrl + '/priceGuide/' + link;
	});
})

// Edit Header
	$('#edit-submit-header').on('click', function(){

		$.post(window.baseUrl + '/priceGuide/editSubmitHeader', $('#edit-header-form').serialize(), function(html) {
		}).success(function(data) {
			if (data.error) {
				alert(data.error);
			} else {
				location.reload();
			}
		});
		
	});
	
	$('#edit-submit-dheader').on('click', function(){

		$.post(window.baseUrl + '/priceGuide/editSubmitDheader', $('#edit-dheader-form').serialize(), function(html) {
		}).success(function(data) {
			if (data.error) {
				alert(data.error);
			} else {
				location.reload();
			}
		});
		
	});
	
	
	$('#edit-submit-dealersheader').on('click', function(){

		$.post(window.baseUrl + '/priceGuide/editSubmitDealersheader', $('#edit-dealersheader-form').serialize(), function(html) {
		}).success(function(data) {
			if (data.error) {
				alert(data.error);
			} else {
				location.reload();
			}
		});
		
	});
	
	$('#edit-submit-topic').on('click', function(){

		$.post(window.baseUrl + '/priceGuide/editSubmitTopic', $('#edit-topic-form').serialize(), function(html) {
		}).success(function(data) {
			if (data.error) {
				alert(data.error);
			} else {
				location.reload();
			}
		});
		
	});
	// End Edit Header

	$('#edit-submit-highlight').on('click', function(){

		$.post(window.baseUrl + '/priceGuide/editSubmitHighlight', $('#edit-highlight-form').serialize(), function(html) {
		}).success(function(data) {
			if (data.error) {
				alert(data.error);
			} else {
				location.reload();
			}
		});
		
	});
	// End Edit Header



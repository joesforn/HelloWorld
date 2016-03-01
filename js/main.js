//message holder for error messages
var errorMsgHolder
//Used to make sure we can send data at the end of the checks!
var sendData;
$(document).ready(function(e) {
	
	//Data we'll send via AJAX
	var data = {
		fname:"",
		lname:"",
		address1:"",
		address2:"",
		city:"",
		state:"",
		zip:"",
		country:""
	};
	
	errorMsgHolder = $("#error_message");
	
	//Get all of our form holders, allow us to change their class for visual feedback
	var fname = $("#fname");
	var lname = $("#lname");
	var address = $("#address");
	var address2 = $("#address2");
	var city = $("#city");
	var state = $("#state");
	var zip = $("#zip");
	var country = $("#country");
	
	$("input[type*='submit']").click(function(e) {
		
		sendData = true;
		
		//These 2 will always be correct
		state.addClass("has-success");
		address2.addClass("has-success");
		
		//Collect all the data
		data.fname = $("input[name*='fname']").val().trim();
		data.lname = $("input[name*='lname']").val().trim();
		data.address1 = $("input[name*='address1']").val().trim();
		data.address2 = $("input[name*='address2']").val().trim();
		data.city = $("input[name*='city']").val().trim();
		data.state = $("select[name*='state']").val();
		data.zip = $("input[name*='zip']").val();
		data.country = $("select[name*='country']").val().toUpperCase();
		
		//Reset the error messages text!
		errorMsgHolder.html("");
		
		//Check that all fields are filled and correct
		if(data.fname.length <= 0)
			ShowErrorMessage("Please include your first name!",fname);
		else
			Accepted(fname);
		
		if(data.lname.length <= 0)
			ShowErrorMessage("Please include your last name!",lname);	
		else
			Accepted(lname);
			
		if(data.address1.length <= 0)
			ShowErrorMessage("Please include your address!",address);	
		else
			Accepted(address);
		
		if(data.city.length <= 0)
			ShowErrorMessage("Please include your city!",city);
		else
			Accepted(city);
		
		if(data.zip.length < 5 || data.zip.length > 9)
			ShowErrorMessage("Zip Codes must be between 5-9 digits!",zip);
		else
			Accepted(zip);
		
		if(data.country.toUpperCase() != "USA")
			ShowErrorMessage("Sorry! But we only accept United States right now!",country);
		else
			Accepted(country);
		
		if(sendData)
		{
			//Send data via AJAX! Allows us to confirm server validation without loading the confirmation page!
			errorMsgHolder.hide();
			$.ajax(
			{
				data:data,
				url:"php/datasaver.php",
				type:"POST",
				dataType:"JSON",
				error:function(e)
				{
					$("#loading").hide();
					ShowErrorMessage(e.responseText,null);
				},
				success:function(e)
				{
					if(e.success != null)
					{
						$("#register_body").slideUp("slow","swing",function()
						{
							window.location = "confirm.php?fname="+data.fname+"&lname="+data.lname;	
						});
					}
					else if(e.error != null)
					{
						$("#loading").hide();
						ShowErrorMessage(e.error,null);
					}
					
				}
			});
		}
    });
});
//Display the error message!
function ShowErrorMessage(msg, element)
{
	errorMsgHolder.append("<li>"+msg+"</li>");
	errorMsgHolder.show();
	sendData = false;
	if(element != null)
		element.addClass("has-error");
}
//Apply the right class for accepted answers!
function Accepted(element)
{
	element.addClass("has-success");
	element.removeClass("has-error");
}

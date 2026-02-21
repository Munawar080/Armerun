
function calendar_book($attr) {
    $args = shortcode_atts( array(
     
            'room' => 'https://hotelarmerun.book.rentl.io/?',
            'lang2' => 'hr',
            'lang' => 'hr-HR'
 
        ), $attr );
	if ($args['lang2'] === 'hr') {
$osobe = "Osoba:";
$djeca = "Djece:";
$sobe = "Broj soba";	
$booknow = "Provjeri dostupnost";		
} else {
$osobe = "Adults:";
$djeca = "Children:";
$sobe = "Rooms:";
$booknow = "Check availability";	}
$id_gen = "shortcode". time() . rand(1000, 9999);
$shortcode_id = strval($id_gen);
?>
<div class="datepicker">
    <wc-datepicker id="datepicker" style="flex-direction: column-reverse;" locale="<?php echo $args['lang']; ?>" range>
	<a class="booknow_button brxe-button Button_button__n1Heo Button_button--regular__DZ7HP Button_button--inverse__GER3l Button_button--full__AwA7X Button_button--animatedOutline___KRhA Header_asideBookButton__uXBeK bricks-button bricks-background-primary" id="booking<?php echo $shortcode_id; ?>" href="#"><?php echo $booknow; ?></a>	
	<div class="picker" style="display: flex;justify-content: space-evenly;">
    <div>
        <span><?php echo $osobe; ?></span>
        <input class="brojOdrasli" type="number" name="brojOdrasli" value="1" min="0" max="20" step="1">
    </div>
    <div style="margin:0px 50px;">
        <span><?php echo $djeca; ?></span>
        <input class="brojDjece" type="number" name="brojDjece" value="0" min="0" max="20" step="1">
    </div>
    <div>
        <span><?php echo $sobe; ?></span>
        <input class="brojSoba" type="number" name="brojSoba" value="1" min="0" max="20" step="1">
    </div>
</div>
		
	</wc-datepicker>
	
    <script>

datepicker = document.querySelectorAll('#datepicker');  

datepicker.forEach(element => {
	element.disableDate = function(date) {
    today = new Date(); 
    ;
    return date <= today.setDate(today.getDate() - 1);
	};

    element.addEventListener('selectDate', function(event) {
            var startDate= new Date(element.value[0]);
            var startDay = startDate.getDate().toString().padStart(2, "0");
            var startMonth = (startDate.getMonth() + 1).toString().padStart(2, "0");
            var startYear = startDate.getFullYear();
            var endDate= new Date(element.value[1]);
            var endDay = endDate.getDate().toString().padStart(2, "0");
            var endMonth = (endDate.getMonth() + 1).toString().padStart(2, "0");
            var endYear = endDate.getFullYear();			
			var brojOdrasli = event.currentTarget.querySelector('.brojOdrasli').value;
			var brojDjece = event.currentTarget.querySelector('.brojDjece').value;
			var brojSoba = event.currentTarget.querySelector('.brojSoba').value; 
			var <?php echo $shortcode_id; ?> = "<?php echo $args['room']; ?>"
            var lang = '<?php echo $args['lang2']; ?>';
		if (brojDjece === "0") {
  			brojDjece = "";
			}
            startDate2 = (startDay + "-" + startMonth + "-" + startYear);
            endDate2 = (endDay + "-" + endMonth + "-" + endYear);
			var bookingLink = document.getElementById('booking<?php echo $shortcode_id; ?>');
      		bookingLink.href = ""+<?php echo $shortcode_id; ?>+"&language="+lang+"&from="+startDate2+"&to="+endDate2+"&adults="+brojOdrasli+"&children="+brojDjece+"&rooms="+brojSoba+"";

    });
	    element.addEventListener('input', function(event) {
            var startDate= new Date(element.value[0]);
            var startDay = startDate.getDate().toString().padStart(2, "0");
            var startMonth = (startDate.getMonth() + 1).toString().padStart(2, "0");
            var startYear = startDate.getFullYear();
            var endDate= new Date(element.value[1]);
            var endDay = endDate.getDate().toString().padStart(2, "0");
            var endMonth = (endDate.getMonth() + 1).toString().padStart(2, "0");
            var endYear = endDate.getFullYear();			
			var brojOdrasli = event.currentTarget.querySelector('.brojOdrasli').value;
			var brojDjece = event.currentTarget.querySelector('.brojDjece').value;
			var brojSoba = event.currentTarget.querySelector('.brojSoba').value; 
			var <?php echo $shortcode_id; ?> = "<?php echo $args['room']; ?>"
            var lang = '<?php echo $args['lang2']; ?>';
			if (brojDjece === "0") {
  			brojDjece = "";
			}
            startDate2 = (startDay + "-" + startMonth + "-" + startYear);
            endDate2 = (endDay + "-" + endMonth + "-" + endYear);
			var bookingLink = document.getElementById('booking<?php echo $shortcode_id; ?>');
      		bookingLink.href = ""+<?php echo $shortcode_id; ?>+"&language="+lang+"&from="+startDate2+"&to="+endDate2+"&adults="+brojOdrasli+"&children="+brojDjece+"&rooms="+brojSoba+"";
    });
});
</script>
</div>
<?php
}
add_shortcode('book_now', 'calendar_book');


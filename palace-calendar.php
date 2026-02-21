function calendar_book_now_calendar($attr) {

    $args = shortcode_atts(array(
        'room'  => 'https://palacedivnic.book.rentl.io?',
        'lang2' => 'en',
        'lang'  => 'en-US'
    ), $attr);

    if ($args['lang2'] === 'hr') {
        $osobe = "Osoba:";
        $djeca = "Djece:";
        $sobe = "Broj soba";
        $booknow = "Provjeri dostupnost";
    } else {
        $osobe = "Adults:";
        $djeca = "Children:";
        $sobe = "Rooms:";
        $booknow = "Check availability";
    }

    $id_gen = "calendar_" . time() . rand(1000, 9999);
    $shortcode_id = strval($id_gen);

    ob_start();
    ?>

    <div class="datepicker" id="<?php echo esc_attr($shortcode_id); ?>">

        <wc-datepicker 
            class="wc-datepicker"
            id="datepicker-<?php echo esc_attr($shortcode_id); ?>"
            style="flex-direction: column-reverse;" 
            locale="<?php echo esc_attr($args['lang']); ?>" 
            range>

            <a class="booknow_button bricks-button bricks-background-primary"
               id="booking-<?php echo esc_attr($shortcode_id); ?>"
               href="#">
                <?php echo esc_html($booknow); ?>
            </a>

            <div class="picker" style="display:flex;justify-content:space-evenly;">
                <div>
                    <span><?php echo esc_html($osobe); ?></span>
                    <input class="brojOdrasli" type="number" value="1" min="0" max="20">
                </div>

                <div style="margin:0 50px;">
                    <span><?php echo esc_html($djeca); ?></span>
                    <input class="brojDjece" type="number" value="0" min="0" max="20">
                </div>

                <div>
                    <span><?php echo esc_html($sobe); ?></span>
                    <input class="brojSoba" type="number" value="1" min="0" max="20">
                </div>
            </div>

        </wc-datepicker>
    </div>

    <script>
    (function(){

        const wrapper = document.getElementById("<?php echo esc_js($shortcode_id); ?>");
        if (!wrapper) return;

        const datepicker = document.getElementById("datepicker-<?php echo esc_js($shortcode_id); ?>");
        const bookingLink = document.getElementById("booking-<?php echo esc_js($shortcode_id); ?>");

        if (!datepicker || !bookingLink) return;

        const baseUrl = "<?php echo esc_js($args['room']); ?>";
        const lang = "<?php echo esc_js($args['lang2']); ?>";

        datepicker.disableDate = function(date) {
            const today = new Date();
            today.setHours(0,0,0,0);
            return date < today;
        };

        function formatDate(d) {
            return String(d.getDate()).padStart(2,'0') + '-' +
                   String(d.getMonth()+1).padStart(2,'0') + '-' +
                   d.getFullYear();
        }

        function updateLink() {

            if (!datepicker.value || datepicker.value.length < 2) return;

            const startDate = new Date(datepicker.value[0]);
            const endDate   = new Date(datepicker.value[1]);

            const adults   = wrapper.querySelector(".brojOdrasli").value;
            let children   = wrapper.querySelector(".brojDjece").value;
            const rooms    = wrapper.querySelector(".brojSoba").value;

            if (children === "0") children = "";

            let url = baseUrl;
            if (!url.includes("?")) url += "?";
            if (!url.endsWith("?") && !url.endsWith("&")) url += "&";

            bookingLink.href =
                url +
                "language=" + lang +
                "&from=" + formatDate(startDate) +
                "&to=" + formatDate(endDate) +
                "&adults=" + adults +
                "&children=" + children +
                "&rooms=" + rooms;
        }

        datepicker.addEventListener("selectDate", updateLink);
        datepicker.addEventListener("input", updateLink);
        datepicker.addEventListener("change", updateLink);

        wrapper.querySelectorAll("input").forEach(inp => {
            inp.addEventListener("input", updateLink);
        });

    })();
    </script>

    <?php
    return ob_get_clean();
}

add_shortcode('book_now_calendar', 'calendar_book_now_calendar');

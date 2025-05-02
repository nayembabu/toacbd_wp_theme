$(document).ready(function() {
    var $ticker = $('.topLetastNewsRight');
    var $tickerItems = $('.news-ticker');

    // প্রথমে টিকার আইটেমগুলোর জন্য স্লাইডিং শুরু
    $tickerItems.each(function() {
        var $this = $(this);
        var tickerWidth = $this.outerWidth(); // প্রতিটি আইটেমের আউটার উইডথ বের করল
        $this.css('right', tickerWidth);
    });

    // স্লাইডিং এনিমেশন চালু করা
    setInterval(function() {
        $tickerItems.each(function() {
            var $this = $(this);
            var tickerWidth = $this.outerWidth(); // আইটেমের প্রস্থ বের করল
            $this.animate({
                right: -tickerWidth
            }, 5000, function() {
                // যখন স্লাইডিং শেষ হবে, তখন আইটেমটিকে পুনরায় প্রথমে নিয়ে আসবে
                $(this).css('right', tickerWidth);
            });
        });
    }, 5000); // প্রতি 5 সেকেন্ড পর পর স্লাইড হবে



});




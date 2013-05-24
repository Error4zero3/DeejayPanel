$(window).load(function() {
    // Flot
    var d1 = [];
    for (var i = 0; i <= 20; i += 1)
        d1.push([i, parseInt(32 + (Math.random() * 35))]);

    var d2 = [];
    for (var i = 0; i <= 20; i += 1)
        d2.push([i, parseInt(32 + (Math.random() * 55))]);

    var d3 = [];
    for (var i = 0; i <= 10; i += 1)
        d3.push([i, parseInt(31 + (Math.random() * 7))]);

    var ds = new Array();

    ds.push({
        label:"Clicks per month",
        data:d1,
        bars: {
            show: true, 
            barWidth: 0.2, 
            order: 1,
            lineWidth : 2
        }
    });
    ds.push({
        label:"Referalls per month",
        data:d2,
        bars: {
            show: true, 
            barWidth: 0.2, 
            order: 2
        }
    });
    ds.push({
        label:"Downloads per month",
        data:d3,
        bars: {
            show: true, 
            barWidth: 0.2, 
            order: 3
        }
    });
    if($('.flot-line').length > 0)
    {
        $.plot($(".flot-line"),
            [
            {
                label: "Resources used",
                data: d2,
                lines: {show: true, fill:true},
                points: {show: false},
                color: '#fd6e58' 
            },
            {
                label: "Traffic used",
                data: d1,
                lines: {show: true},
                points: {show: true},
                color: '#3d62b1'
            }
            ],
            {
                'yaxis' : {
                    autoscaleMargin:0.7
                },
                'grid' : {
                    borderColor:'#999',
                    borderWidth:1
                }
            }
            );
    }

    // flot - live
    if($('.flot-live').length > 0){
        $(function () {
            var data = [], totalPoints = 300;
            function getRandomData() {
                if (data.length > 0)
                    data = data.slice(1);

                while (data.length < totalPoints) {
                    var prev = data.length > 0 ? data[data.length - 1] : 50;
                    var y = prev + Math.random() * 10 - 5;
                    if (y < 0)
                        y = 0;
                    if (y > 100)
                        y = 100;
                    data.push(y);
                }

                var res = [];
                for (var i = 0; i < data.length; ++i)
                    res.push([i, data[i]])
                return res;
            }

            var updateInterval = 30;


            var options = {
                series: { shadowSize: 0 },
                yaxis: { min: 0, max: 100 },
                xaxis: { show: false }
            };
            var plot = $.plot($(".flot-live"), [ getRandomData() ], options);

            function update() {
                plot.setData([ getRandomData() ]);
                plot.draw();

                setTimeout(update, updateInterval);
            }

            update();
        });
}

    // flot - pie
    if($('.flot-pie').length > 0)
    {
       $.plot($(".flot-pie"),
        [
        {
            label: "Visitors from EU",
            data: 3
        },
        {
            label: "Visitors from US",
            data: 8
        },
        {
            label: "Visitors from RUS",
            data: 5
        }
        ],
        {
            series:{
                pie:{
                    show:true
                }
            }
        }
        );
   }

   if($('.flot-bar').length > 0)
   {
    $.plot($(".flot-bar"),ds,
    {
        'grid' : {
            borderColor:'#999',
            borderWidth:1
        }
    }
    );
}

    // Calendar
    if($(".calendar").length > 0)
    {
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        $('.calendar').fullCalendar('addEventSource', [
        {
            title: 'All Day Event',
            start: new Date(y, m, 1)
        },
        {
            title: 'Long Event',
            start: new Date(y, m, d-5),
            end: new Date(y, m, d-2)
        },
        {
            id: 999,
            title: 'Repeating Event',
            start: new Date(y, m, d-3, 16, 0),
            allDay: false
        },
        {
            id: 999,
            title: 'Repeating Event',
            start: new Date(y, m, d+4, 16, 0),
            allDay: false
        },
        {
            title: 'Meeting',
            start: new Date(y, m, d, 10, 30),
            allDay: false
        },
        {
            title: 'Lunch',
            start: new Date(y, m, d, 12, 0),
            end: new Date(y, m, d, 14, 0),
            allDay: false
        },
        {
            title: 'Birthday Party',
            start: new Date(y, m, d+1, 19, 0),
            end: new Date(y, m, d+1, 22, 30),
            allDay: false
        },
        {
            title: 'Click for Google',
            start: new Date(y, m, 28),
            end: new Date(y, m, 29),
            url: 'http://google.com/'
        }
        ]);
}

$('.table-mail > tbody > tr').click(function(e){
    var el = $(this);
    var checkbox = el.find('.table-checkbox > input');
    el.toggleClass('warning');
    
    if(e.target.nodeName != 'INPUT')
    {
        checkbox.prop('checked', !(checkbox.prop('checked')));
    }
});

$('.table-mail .sel-star').click(function(e){
    e.preventDefault();
    e.stopPropagation();
    var el = $(this);
    el.toggleClass('active').find('i').toggleClass('icon-star-empty').toggleClass('icon-star');
});

$(".toggle-active").click(function(e){
    $(this).toggleClass('button-active');
    e.preventDefault();
});

function progressStep(){
    var el = $(".status.button .status-bottom .progress .bar");
    var current = parseInt(el.html());
    var next = current + Math.round(Math.random() * 10);
    if(next / 100 >= 1){
        next = next % 100;
    }
    el.css('width', next+"%").html(next+"%");

    setTimeout(function(){
        progressStep();
    }, 1500);
}
progressStep();

});
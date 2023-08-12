"use strict";

var KTCalendarBasic = function() {

    return {
        //main function to initiate the module
        init: function() {
            var todayDate = moment().startOf('day');
            var YM = todayDate.format('YYYY-MM');
            var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
            var TODAY = todayDate.format('YYYY-MM-DD');
            var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

            var calendarEl = document.getElementById('kt_calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid', 'list' ],
                themeSystem: 'bootstrap',

                isRTL: KTUtil.isRTL(),

                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,List'
                    // right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },

                height: 800,
                contentHeight: 780,
                aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio

                nowIndicator: true,
                now: TODAY + 'T09:25:00', // just for demo

                views: {
                    dayGridMonth: { buttonText: 'month' },
                    List: { buttonText: 'List' }

                    // dayGridMonth: { buttonText: 'month' },
                    // timeGridWeek: { buttonText: 'week' },
                    // timeGridDay: { buttonText: 'day' }                    
                },

                defaultView: 'dayGridMonth',
                defaultDate: TODAY,

                editable: true,
                eventLimit: true, // allow "more" link when too many events
                navLinks: true,
                events: 
                    {
                        url: 'dataEvents.php',

                    },
                
                eventClick: function(event) {
                    if (event.url) {
                        $.fancybox({
                            'href': event.url,
                            'type': 'iframe',
                            'autoScale': false,
                            'openEffect': 'elastic',
                            'openSpeed': 'fast',
                            'closeEffect': 'elastic',
                            'closeSpeed': 'fast',
                            'closeBtn': true,
                            onClosed: function() {
                                parent.location.reload(true);
                            },
                            helpers: {
                                thumbs: {
                                    width: 50,
                                    height: 50
                                },

                                overlay: {
                                    css: {
                                        'background': 'rgba(49, 176, 213, 0.7)'
                                    }
                                }
                            }
                        });
                        return false;
                    }
                },
                eventRender: function(info) {
                    var element = $(info.el);

                    if (info.event.extendedProps && info.event.extendedProps.description) {
                        if (element.hasClass('fc-day-grid-event')) {
                            element.data('content', info.event.extendedProps.description);
                            element.data('placement', 'top');
                            KTApp.initPopover(element);
                        } else if (element.hasClass('fc-time-grid-event')) {
                            element.find('.fc-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                        } else if (element.find('.fc-list-item-title').lenght !== 0) {
                            element.find('.fc-list-item-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                        }
                    }
                }
            });

            calendar.render();
        }
    };
}();

jQuery(document).ready(function() {
    KTCalendarBasic.init();
});

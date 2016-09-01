
$('#calendar').fullCalendar({
     lang: 'zh-tw',
     contentHeight: 550,
     eventLimit: true,
     header: {
         left: 'title',
         center: '',
         right: 'today prev,next'
     },
     views: {
         month: {
             titleFormat: 'Y年 M月',
             eventLimit: 3
         }
     },
     eventSources: [
         {
             url: 'api/calendar'
         }
     ]
 });

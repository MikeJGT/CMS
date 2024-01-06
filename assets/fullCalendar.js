import { Calendar } from 'fullcalendar';
import interactionPlugin from '@fullcalendar/interaction';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';



document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var calendar = new Calendar(calendarEl, {
        plugins: [interactionPlugin, dayGridPlugin, timeGridPlugin, listPlugin],
        customButtons: {
            myCustomButton: {
                text: 'Add Event',
                click: function () {
                    // alert('RouterLink or modal');
                    window.location.assign("/full/calendar/new_event")
                }
            }
        },
        headerToolbar: {
            left: 'prev,next today myCustomButton',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
        initialDate: '2024-01-01',
        navLinks: true, // can click day/week names to navigate views
        editable: true,
        dayMaxEvents: true, // allow "more" link when too many events
        eventSources: [
            {
                url: '/full/calendar/events',
                method: 'POST'
            }
        ],
        eventColor:'#fff',
        eventBorderColor:'#000'
    });
    calendar.render();
});


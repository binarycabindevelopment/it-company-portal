<script>
    $( document ).ready(function() {
        $('.calendar').fullCalendar({
            eventSources: [
                {
                    url: '{{ url('/api/calendar/schedule/'.$schedule->id) }}',
                    color: '#364150',
                    textColor: 'white'
                }
            ]
        });
    });
</script>
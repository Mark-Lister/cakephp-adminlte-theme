function webSocketSetup(id, sessionName, user, interval, timeout) {
    sessionName = (sessionName.replace(/[^a-z0-9]/gi, '')).toLowerCase();
    var csrfToken = $('[name=_csrfToken]').val();
    var websocketConnection = true;
    var connection = new autobahn.Connection({ url: 'wss://team.southpacificavionics.com/wss', realm: 'realm1' });
    connection.onopen = function(session) {
        console.log(sessionName);
        session.publish(sessionName, ['new', user]);
        function onevent(args){
            console.log('event')
            if (args[0] === 'new') {
                if (args[1] == user){
                    connection.close();
                }
            }
        }
        ////////AUTO SAVE /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        setInterval(function() {
            if (websocketConnection === false) {
                return false;
            }
            $.ajax({
                type: 'POST',
                url: id,
                data: $('form').serialize(),
                headers: {
                    Accept: "application/json"
                },
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('X-CSRF-Token', csrfToken);
                },
                success: function(result) {
                    console.log(result);
                    session.publish(sessionName, ['save']);
                }
            });
            
        }, interval);
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        var idleTime = 0;
        function timerIncrement() {
            idleTime = idleTime + 1;
            if (idleTime >= timeout) {
                connection.close();
            }
        }
        $(document).ready(function () {
            //Increment the idle time counter every minute.
            var idleInterval = setInterval(timerIncrement, 60000); // 1 minute

            //Zero the idle timer on mouse movement.
            $(this).mousemove(function (e) {
                idleTime = 0;
            });
            $(this).keypress(function (e) {
                idleTime = 0;
            });
        });
        
        session.subscribe(sessionName, onevent);

    };

    connection.open();
    connection.onclose = function(reason, details) {
        websocketConnection = false;
        //alert('Your Connection to the websocket was timed out to save data you will be reconnected.');  
        $popup = $('<div title="Your Connection to the websocket was timed out!">');
        $popup.append('<p>Due to multiple tabs, time limit, or internet connection. You can close this tab or click reload to reconnect.</p>');
        $popup.dialog({

                modal: true,
                autoOpen: true,
                buttons: {
                    'Reload': function() {
                        location.reload();
                    }

                },
                beforeClose: function (event, ui) { location.reload(); },
                width: "600px"

            }).prev(".ui-dialog-titlebar").css("background","red");
        websocketConnection = false;
        //
    }
    //WEBSOCKET END ////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
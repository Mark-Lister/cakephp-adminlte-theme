function webSocketSetup(id, sessionName, user, interval, timeout) {
    sessionName = (sessionName.replace(/[^a-z0-9]/gi, '')).toLowerCase();
    var csrfToken = $('[name=_csrfToken]').val();
    //WEBSOCKET START LIVE EDIT WITH LABELS////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    var tab = $('.tab-pane.active');
    $('.tab-pane').on('click', function() {
        tab = this;
    });
    var autosaveConnection = true;
    var autosave = new autobahn.Connection({ url: 'wss://team.southpacificavionics.com/wss', realm: 'realm1' });
    var markers = {};
    autosave.onopen = function(session) {
        session.publish(sessionName, ['new', user]);
        const CLASSES = {
            marker: 'input__marker',
            visible: 'input__marker--visible'
        };

        

        const createMarker = (content, modifier) => {
            // create a marker for the input
            const marker = document.createElement('div');
            marker.classList.add(CLASSES.marker, `${CLASSES.marker}--${modifier}`);
            marker.textContent = content;
            return marker;
        };

        function onevent(args) {
            if (args[0] === 'editing') {

                //checks if its a checkbox
                if ($('#' + args[1]).is(":checkbox")) {
                    $('#' + args[1]).prop('checked', args[2]);
                }
                //sets the text value
                $('#' + args[1]).val(args[2]);
                //console.log(args[2]);
                //check if user has a marker already on your screen
                if (args[4] in markers) {
                    //if they do it fetches that elements
                    marker = markers[args[4]];
                    //sets the new position for the marker
                    marker[2] = $('#' + args[1]).caret('position', args[3]).left;
                    marker[3] = $('#' + args[1]).caret('position', args[3]).top;
                } else {
                    //creates a new marker
                    marker = createMarker(args[4]);
                    //adds marker and its current details to the list of markers

                    //checks if the element is inside the tab
                    markers[args[4]] = [marker, args[1], $('#' + args[1]).caret('position', args[3]).left, $('#' + args[1]).caret('position', args[3]).top, null];
                    if ($('#' + args[1]).parents('#' + args[5]).length == 1) {
                        //flashes a warning if it's in a tab
                        $('a[href="#' + args[5] + '"]').append($('<div class="fa fa-fw fa-warning blink" style="color:orange"></div>'));
                        markers[args[4]][4] = args[5];
                    }

                    $('#' + args[1]).on('scroll', function() {

                        const x = $('#' + args[1]).offset().left;
                        const y = $('#' + args[1]).offset().top;
                        bottomWidth = 0;
                        topWidth = 0;
                        for (var person in markers) {
                            marker = markers[person];
                            input = $('#' + marker[1]);
                            if (args[1] == marker[1]) {

                                if (y + marker[3] - $('#' + args[1]).scrollTop() > y + $('#' + args[1]).height()) {
                                    marker[0].setAttribute('style', `left: ${bottomWidth + x + $('#'+args[1]).width() / 2.5}px; top: ${y + $('#'+args[1]).height() + (2 * $(marker[0]).height())}px`);
                                    bottomWidth += $(marker[0]).width() + 10;
                                } else if (y + marker[3] - $('#' + args[1]).scrollTop() < y) {

                                    marker[0].setAttribute('style', `left: ${topWidth + x + ($('#'+args[1]).width() / 2.5)}px; top: ${y - ($(marker[0]).height())}px`);
                                    topWidth += $(marker[0]).width() + 10;
                                } else {
                                    marker[0].setAttribute('style', `left: ${x + marker[2]}px; top: ${y + marker[3] - $('#'+args[1]).scrollTop()}px`);
                                }


                            }
                            if (marker[4] != null) {
                                tab = $('.tab-pane.active').attr('id');
                                if (tab === marker[4]) {
                                    $(marker[0]).show();
                                } else {
                                    $(marker[0]).hide();

                                }

                            }
                        }
                    });



                    document.body.appendChild(marker);



                }

                $('#' + args[1]).scroll();
            }

            if (args[0] === 'new') {
                if (args[1] == user){
                    autosave.close();
                }
            }

            if (args[0] === 'unfocus' || args[0] === 'disconnect') {
                if (args[3] in markers) {
                    if (markers[args[3]][4] != null) {
                        $('a[href="#' + markers[args[3]][4] + '"]').children().remove();
                    }
                    marker = markers[args[3]];
                    document.body.removeChild(marker[0]);
                    delete markers[args[3]];
                }
            }


        }

        // 1) subscribe to a topic
        console.log(sessionName);
        session.subscribe(sessionName, onevent);

        $("form :input").on('input', function() {

            $(this).change();

        });

        $("form :input").on('change', function() {
            var cursorPosition = $(this).caret('pos');

            if ($(this).is(":checkbox")) {
                session.publish(sessionName, ['editing', $(this).attr('id'), $(this).prop("checked"), cursorPosition, user, $(tab).attr('id')]);
            } else {
                session.publish(sessionName, ['editing', $(this).attr('id'), $(this).val(), cursorPosition, user, $(tab).attr('id')]);
            }
        });

        $("form :input").on('blur', function() {
            session.publish(sessionName, ['unfocus', $(this).attr('id'), $(this).val(), user, $(tab).attr('id')]);
        });

        var formState = $('form').serialize();
        var previousState = formState;
        ////////AUTO SAVE /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        setInterval(function() {
            if (autosaveConnection === false) {
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
                autosave.close();
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

        

    };
    autosave.open();
    autosave.onclose = function(reason, details) {
        autosaveConnection = false;
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
        autosaveConnection = false;
        //
    }

    //WEBSOCKET END ////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
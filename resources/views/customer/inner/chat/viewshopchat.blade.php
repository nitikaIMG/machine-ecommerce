@extends('customer.layouts.main')

@push('custom_css')
@endpush

@section('content')
    <section class="main-wraper">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('customer.inner.leftmenu')
                </div>
                <div class="col-md-9">
                    <div class="card p30" id="myTab">
                        <!-- <div class="header">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="title">Chat with {{ $participants->implode('name', ',') }}
                                    </div>
                                </div>
                            </div>

                        </div> -->

                        <div class="chat-wraper">

                            <div class="chat-content chat-translate" style="height:400px;">
                                <div class="virtual-chat order-chat">
                                                    <div class="content">
                                                        <p class="chat">
                                                             <span class="translation"><a href="javascript:void(0)">Shop Name : {{ $participants->implode('name', ',') }}</a></span>
                                                            
                                                        </p>
                                                    </div>
                                                </div>
                                
                                @foreach ($messages as $message)
                                    <div class="virtual-chat {{ $message->user_id === $user->id ? 'even' : '' }}"
                                        style="max-width: inherit">
                                        <div class="content">
                                            <p class="chat {{ $message->user_id === $user->id ? 'even' : '' }}">
                                                <span class="english"> {{ $message->message }}</span>
                                                <span class="english"
                                                    style="font-size: 12px;font-weight: 100;
                                                color: #888;"><i>
                                                        - {{ $message->created_at->format('M d,Y h:i A') }}</i></span>
                                            </p>
                                        </div>
                                    </div>
                                @endforeach


                                   
                                <!-- <div class="testing"> Mark testing </div> -->

                                  <br><br>


                            </div>
                            <div class="chat-typing">
                                <form id="chat-submit" class="d-flex align-items-center"
                                    action="{{ route('chat.channel.messages.send', ['channel' => $channel->id]) }}"
                                    method="post">
                                    @csrf
                                    <input id="chat-submit-input" type="text" name="message" class="message-input"
                                        placeholder="Write a message..." autocomplete="off">

                                    <div class="btns">
                                        <button type="submit" class="" id="chat-submit-button">
                                            <img src="{{ asset('web/images/send-icon.svg') }}" alt="">
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script id="chat_text_template" type="text/template">
        <li class="chat clearfix d-flex justify-content-{styles.direction}">
            <div class="chat-body clearfix">
                <p class="header primary-font font-weight-bold chat__name">
                    {user.name}
                </p>
                <p class="chat__text">
                    {message.text}
                </p>
                <p class="mt-2 p-0 text-xs chat__date">
                    {message.created_at}
                </p>
            </div>
        </li>
    </script>
@endsection

@section('scripts')
    <script src="{{ asset('vendor/inputmask/jquery.inputmask.min.js') }}"></script>
    <script>
        /* https://stevenlevithan.com/assets/misc/date.format.js */
        var dateFormat = function() {
            var t = /d{1,4}|m{1,4}|yy(?:yy)?|([HhMsTt])\1?|[LloSZ]|"[^"]*"|'[^']*'/g,
                e =
                /\b(?:[PMCEA][SDP]T|(?:Pacific|Mountain|Central|Eastern|Atlantic) (?:Standard|Daylight|Prevailing) Time|(?:GMT|UTC)(?:[-+]\d{4})?)\b/g,
                a = /[^-+\dA-Z]/g,
                m = function(t, e) {
                    for (t = String(t), e = e || 2; t.length < e;) t = "0" + t;
                    return t
                };
            return function(d, n, r) {
                var y = dateFormat;
                if (1 != arguments.length || "[object String]" != Object.prototype.toString.call(d) || /\d/.test(
                        d) || (n = d, d = void 0), d = d ? new Date(d) : new Date, isNaN(d)) throw SyntaxError(
                    "invalid date");
                "UTC:" == (n = String(y.masks[n] || n || y.masks.default)).slice(0, 4) && (n = n.slice(4), r = !0);
                var s = r ? "getUTC" : "get",
                    i = d[s + "Date"](),
                    o = d[s + "Day"](),
                    u = d[s + "Month"](),
                    M = d[s + "FullYear"](),
                    l = d[s + "Hours"](),
                    T = d[s + "Minutes"](),
                    h = d[s + "Seconds"](),
                    c = d[s + "Milliseconds"](),
                    g = r ? 0 : d.getTimezoneOffset(),
                    S = {
                        d: i,
                        dd: m(i),
                        ddd: y.i18n.dayNames[o],
                        dddd: y.i18n.dayNames[o + 7],
                        m: u + 1,
                        mm: m(u + 1),
                        mmm: y.i18n.monthNames[u],
                        mmmm: y.i18n.monthNames[u + 12],
                        yy: String(M).slice(2),
                        yyyy: M,
                        h: l % 12 || 12,
                        hh: m(l % 12 || 12),
                        H: l,
                        HH: m(l),
                        M: T,
                        MM: m(T),
                        s: h,
                        ss: m(h),
                        l: m(c, 3),
                        L: m(c > 99 ? Math.round(c / 10) : c),
                        t: l < 12 ? "a" : "p",
                        tt: l < 12 ? "am" : "pm",
                        T: l < 12 ? "A" : "P",
                        TT: l < 12 ? "AM" : "PM",
                        Z: r ? "UTC" : (String(d).match(e) || [""]).pop().replace(a, ""),
                        o: (g > 0 ? "-" : "+") + m(100 * Math.floor(Math.abs(g) / 60) + Math.abs(g) % 60, 4),
                        S: ["th", "st", "nd", "rd"][i % 10 > 3 ? 0 : (i % 100 - i % 10 != 10) * i % 10]
                    };
                return n.replace(t, function(t) {
                    return t in S ? S[t] : t.slice(1, t.length - 1)
                })
            }
        }();
        dateFormat.masks = {
            default: "ddd mmm dd yyyy HH:MM:ss",
            shortDate: "m/d/yy",
            mediumDate: "mmm d, yyyy",
            longDate: "mmmm d, yyyy",
            fullDate: "dddd, mmmm d, yyyy",
            shortTime: "h:MM TT",
            mediumTime: "h:MM:ss TT",
            longTime: "h:MM:ss TT Z",
            isoDate: "yyyy-mm-dd",
            isoTime: "HH:MM",
            isoDateTime: "yyyy-mm-dd'T'HH:MM",
            isoUtcDateTime: "UTC:yyyy-mm-dd'T'HH:MM:ss'Z'"
        }, dateFormat.i18n = {
            dayNames: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sunday", "Monday", "Tuesday", "Wednesday",
                "Thursday", "Friday", "Saturday"
            ],
            monthNames: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec", "January",
                "February", "March", "April", "May", "June", "July", "August", "September", "October", "November",
                "December"
            ]
        }, Date.prototype.format = function(t, e) {
            return dateFormat(this, t, e)
        };

        /* Nano Template Engine */
        /* github.com/trix/nano - v1 - MIT license */
        function _template_nano(e, t) {
            return e.replace(/\{([\w\.]*)\}/g, function(e, n) {
                var r = n.split("."),
                    i = t[r.shift()];
                for (var s = 0, o = r.length; s < o; s++) i = i[r[s]];
                return typeof i !== "undefined" && i !== null ? i : ""
            })
        }

        // now
        function _get_datetime(datetimeStr = null) {
            const date = datetimeStr ? new Date(datetimeStr) : new Date();
            return date.format('isoDate', false) + ' ' + date.format('isoTime', false);
        }

        // el: jQuery
        function _show_loader(show = true, el = null) {
            const _loader = '<div class="nano-loader"></div>';
            const _body = el ? el : $('body');

            show ? _body.append(_loader) : _body.find(".nano-loader").remove();
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script src="{{ asset('vendor/pusher/app.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            let ajaxGoing = false;

            const template = $("#chat_text_template").html();

            const chats_dom = $("ul.chats");

            const chat_body = $(".chats-body");

            const chat_input = $("#chat-submit-input");

            const _trigger_scroll = function() {
                chat_body.animate({
                    scrollTop: chat_body.get(0).scrollHeight
                }, 850);
            }

            const chat_body_top =
                (chat_body[0].clientHeight - chat_body[0].scrollHeight) + 10;

            // chat_body.on('scroll', function(event) {
            //     var element = event.target;

            //     // scrolled to the very top
            //     if (element.scrollTop < chat_body_top) {
            //      // load more chat items from the server
            //     }
            // });

            // subscribe to this private channel
            Echo.private('chat.{{ $channel->id }}')
                .listen('MessageSent', function(data) {
                    data['styles'] = {
                        direction: 'start'
                    };

                    chats_dom.append(
                        _template_nano(template, data)
                    );

                    _trigger_scroll();
                });

            $("#chat-submit").submit(function(e) {
                e.preventDefault();

                const self = $(this);

                let messageText = chat_input.val().trim();

                if (messageText === '' || ajaxGoing) {
                    return;
                }

                const formdata = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: self.prop('action'),
                    data: formdata,
                    processData: false,
                    contentType: false,
                    beforeSend: function(request) {
                        request.setRequestHeader('X-Socket-ID', Echo.socketId());

                        ajaxGoing = true;
                        self.css({
                            'pointer-events': 'none',
                            'opacity': '0.6'
                        });

                        chats_dom.append(
                            _template_nano(template, {
                                'user': {
                                    'name': '{{ $user->name }}'
                                },
                                'styles': {
                                    'direction': 'end'
                                },
                                'message': {
                                    'text': messageText,
                                    'created_at': _get_datetime()
                                }
                            })
                        );

                        _trigger_scroll();
                    },
                    success: function(response) {
                        self.get(0).reset();
                    },
                    complete: function() {
                        ajaxGoing = false;
                        self.css({
                            'pointer-events': 'auto',
                            'opacity': '1'
                        });
                    }
                });

            });
        });
    </script>
@endsection

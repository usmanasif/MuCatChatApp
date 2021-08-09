<x-app-layout>

    <div id="message-box">

    </div>
    <div class="relative flex w-full h-screen overflow-hidden antialiased bg-gray-200">
        <!-- left -->
        <div
            class="relative flex flex-col hidden h-full bg-white border-r border-gray-300 shadow-xl md:block transform transition-all duration-500 ease-in-out"
            style="width: 24rem">

            <div class="border-b shadow-bot">
                <ul class="flex flex-row items-center inline-block px-2 list-none select-none">
                    <li class="flex-auto px-1 mx-1 -mb-px text-center rounded-t-lg cursor-pointer last:mr-0 hover:bg-gray-200">
                        <a class="flex items-center justify-center block py-2 text-xs font-semibold leading-normal tracking-wide border-b-2 border-blue-500">
                            All
                        </a>
                    </li>
                </ul>
            </div>

            <div
                class="relative mt-2 mb-4 overflow-x-hidden overflow-y-auto scrolling-touch lg:max-h-sm scrollbar-w-2 scrollbar-track-gray-lighter scrollbar-thumb-rounded scrollbar-thumb-gray">
                <ul class="flex flex-col inline-block w-full h-screen px-2 select-none">
                    @foreach ($all_users as $user)
                        <li class="flex flex-no-wrap items-center pr-3 text-black rounded-lg cursor-pointer mt-200 py-65 hover:bg-gray-200"
                            style="padding-top: 0.65rem; padding-bottom: 0.65rem">
                            <div class="flex justify-between w-full focus:outline-none link-user"
                                 target="{{$user->id}}">
                                <div class="flex justify-between w-full">
                                    <div
                                        class="relative flex items-center justify-center w-12 h-12 ml-2 mr-3 text-xl font-semibold text-white bg-blue-500 rounded-full flex-no-shrink">
                                        <img class="object-cover w-12 h-12 rounded-full"
                                             src={{$user->profile_photo_url}}
                                                 alt="">
                                        <div
                                            class="absolute bottom-0 right-0 flex items-center justify-center bg-white rounded-full"
                                            style="width: 0.80rem; height: 0.80rem">
                                            <div class="bg-green-500 rounded-full"
                                                 style="width: 0.6rem; height: 0.6rem"></div>
                                        </div>
                                    </div>
                                    <div class="items-center flex-1 min-w-0">
                                        <div class="flex justify-between mb-1">
                                            <h2 class="text-sm font-semibold text-black">{{ $user->name }}</h2>
                                            <div class="flex">

                                                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                                     width="19" height="14" viewBox="0 0 19 14"
                                                     style="color: transparent">
                                                    <path fill-rule="nonzero"
                                                          d="M7.96833846,10.0490996 L14.5108251,2.571972 C14.7472185,2.30180819 15.1578642,2.27443181 15.428028,2.51082515 C15.6711754,2.72357915 15.717665,3.07747757 15.5522007,3.34307913 L15.4891749,3.428028 L8.48917485,11.428028 C8.2663359,11.6827011 7.89144111,11.7199091 7.62486888,11.5309823 L7.54038059,11.4596194 L4.54038059,8.45961941 C4.2865398,8.20577862 4.2865398,7.79422138 4.54038059,7.54038059 C4.7688373,7.31192388 5.12504434,7.28907821 5.37905111,7.47184358 L5.45961941,7.54038059 L7.96833846,10.0490996 L14.5108251,2.571972 L7.96833846,10.0490996 Z"/>
                                                </svg>
                                                @php
                                                    $message = $user->last_conversation_message($sender)
                                                @endphp
                                                <span
                                                    class="ml-1 text-xs font-medium text-gray-600">{{ $message ? date("F j, Y, g:i a", strtotime($message->created_at)) : ''}}</span>
                                            </div>
                                        </div>
                                        <div class="flex justify-between text-sm leading-none truncate">

                                            <span>{{ $message ? $message->message_source : 'No conversation' }}</span>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>


            <div class="fixed absolute bottom-0 right-0 z-40 mb-6 mr-4">
                <button
                    class="flex items-center justify-center w-12 h-12 mr-3 text-xl font-semibold text-white bg-blue-500 rounded-full focus:outline-none flex-no-shrink">
                    <svg class="w-6 h-6 text-white fill-current" xmlns="http://www.w3.org/2000/svg" width="24"
                         height="24" viewBox="0 0 24 24">
                        <path fill-rule="nonzero"
                              d="M3,17.46 L3,20.5 C3,20.78 3.22,21 3.5,21 L6.54,21 C6.67,21 6.8,20.95 6.89,20.85 L17.4562847,10.2933914 C17.6300744,10.1200486 17.6494989,9.85064903 17.514594,9.65572084 L17.4564466,9.58644661 L17.4564466,9.58644661 L14.4135534,6.54355339 C14.2182912,6.34829124 13.9017088,6.34829124 13.7064466,6.54355339 L3.15,17.1 C3.05,17.2 3,17.32 3,17.46 Z M20.71,7.04 C21.1,6.65 21.1,6.02 20.71,5.63 L18.37,3.29 C17.98,2.9 17.35,2.9 16.96,3.29 L15.4835534,4.76644661 C15.2882912,4.96170876 15.2882912,5.27829124 15.4835534,5.47355339 L18.5264466,8.51644661 C18.7217088,8.71170876 19.0382912,8.71170876 19.2335534,8.51644661 L20.71,7.04 Z"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- center -->
        @if(isset($receiver_obj))
            <div class="relative flex flex-col flex-1">
                <div class="z-20 flex flex-grow-0 flex-shrink-0 w-full pr-3 bg-white border-b">
                    <div
                        class="w-12 h-12 mx-4 my-2 bg-blue-500 bg-center bg-no-repeat bg-cover rounded-full cursor-pointer"
                        style="background-image: url({{$receiver_obj->profile_photo_url}})">
                    </div>
                    <div class="flex flex-col justify-center flex-1 overflow-hidden cursor-pointer">
                        <div
                            class="overflow-hidden text-base font-medium leading-tight text-gray-600 whitespace-no-wrap">
                            {{$receiver_obj->name}}
                        </div>
                        <div class="overflow-hidden text-sm font-medium leading-tight text-gray-600 whitespace-no-wrap"
                             id="status">
                            Offline
                        </div>
                    </div>
                </div>
                <div
                    class="top-0 bottom-0 left-0 right-0 flex flex-col flex-1 overflow-hidden bg-transparent bg-bottom bg-cover">
                    <div class="self-center flex-1 w-full max-w-xl">
                        <div class="relative flex flex-col py-1 m-auto" id="messag-chat-box">
                            @if($receiver_obj->conversation_all_messages($sender)->count())
                                @foreach($receiver_obj->conversation_all_messages($sender) as $message)
                                    @if($message->user_id == $sender)
                                        <div class="self-end w-3/4 my-2 bg-green-200">
                                            <div
                                                class="p-4 text-sm bg-white rounded-t-lg rounded-l-lg shadow bg-green-200">
                                                {{$message->message_source}}
                                                <div class="ml-1 text-xs font-medium text-gray-600">
                                                    {{ date("F j, Y, g:i a", strtotime($message->created_at))}}
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="self-start w-3/4 my-2">
                                            <div class="p-4 text-sm bg-white rounded-t-lg rounded-r-lg shadow">
                                                {{$message->message_source}}
                                                <div class="ml-1 text-xs font-medium text-gray-600">
                                                    {{ date("F j, Y, g:i a", strtotime($message->created_at))}}
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                @endforeach
                            @else
                                <div class="self-center">
                                    <div class="p-1 ">
                                        !!Beginning of conversation &#128522;!!
                                    </div>
                                </div>

                            @endif

                        </div>
                    </div>
                    <div
                        class="relative flex items-center self-center w-full max-w-xl p-4 overflow-hidden text-gray-600 focus-within:text-gray-400">
                        <div class="w-full">
                            <form id="chatbox-form">
                                <input type="hidden" value="{{$receiver}}" name="receiver">
                                <input type="hidden" value="{{$conversation->id}}" name="conversation_id">
                                <input type="search"
                                       class="w-full py-2 pl-10 text-sm bg-white border border-transparent appearance-none rounded-tg placeholder-gray-800 focus:bg-white focus:outline-none focus:border-blue-500 focus:text-gray-900 focus:shadow-outline-blue"
                                       style="border-radius: 25px"
                                       placeholder="Message..." autocomplete="off" name="message">

                                <span class="absolute inset-y-0 right-0 flex items-center pr-6">
                <button type="submit" class="p-1 focus:outline-none focus:shadow-none hover:text-blue-500">
                  <svg class="w-6 h-6 fill-current" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                       viewBox="0 0 24 24">
                    <path fill-rule="nonzero"
                          d="M6.43800037,12.0002892 L6.13580063,11.9537056 C5.24777712,11.8168182 4.5354688,11.1477159 4.34335422,10.2699825 L2.98281085,4.05392998 C2.89811796,3.66698496 2.94471512,3.2628533 3.11524595,2.90533607 C3.53909521,2.01673772 4.60304421,1.63998415 5.49164255,2.06383341 L22.9496381,10.3910586 C23.3182476,10.5668802 23.6153089,10.8639388 23.7911339,11.2325467 C24.2149912,12.1211412 23.8382472,13.1850936 22.9496527,13.6089509 L5.49168111,21.9363579 C5.13415437,22.1068972 4.73000953,22.1534955 4.34305349,22.0687957 C3.38131558,21.8582835 2.77232686,20.907987 2.9828391,19.946249 L4.34336621,13.7305987 C4.53547362,12.8529444 5.24768451,12.1838819 6.1356181,12.0469283 L6.43800037,12.0002892 Z M5.03153725,4.06023585 L6.29710294,9.84235424 C6.31247211,9.91257291 6.36945677,9.96610109 6.44049865,9.97705209 L11.8982869,10.8183616 C12.5509191,10.9189638 12.9984278,11.5295809 12.8978255,12.182213 C12.818361,12.6977198 12.4138909,13.1022256 11.8983911,13.1817356 L6.44049037,14.0235549 C6.36945568,14.0345112 6.31247881,14.0880362 6.29711022,14.1582485 L5.03153725,19.9399547 L21.6772443,12.0000105 L5.03153725,4.06023585 Z"/>
                  </svg>
                </button>
              </span>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="relative flex flex-col flex-1">
                <div class="self-center">
                    <div class="p-1 ">
                        !!No Conversation selected &#128522;!!
                    </div>
                </div>
            </div>

        @endif

    </div>


    {{--    <form id="chatbox-form">--}}
    {{--        <input type="hidden" value="{{$receiver}}" name="receiver">--}}
    {{--        <input type="text" value="" name="message">--}}
    {{--        <input type="submit">--}}
    {{--    </form>--}}


</x-app-layout>

<script>
    @if(isset($receiver))
    let receiver_id = {{$receiver}};
    let conversation_id = {{$conversation->id}};
    @endif
    let user_id = {{ auth()->user()->id  }};
</script>




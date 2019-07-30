@php

$unReadMessages = Auth::user()->messages->where('read',0)->sortByDesc('id');

@endphp

<!-- top navigation -->
<div class="top_nav">

    <div class="nav_menu">
        <nav class="" role="navigation">
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a class="text-bold">@naira(Auth::user()->balance)</a>
                </li>

                <li role="presentation" class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-envelope-o"></i>
                        <span class="badge bg-green">{{ $unReadMessages->count() }}</span>
                    </a>
                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
                        @foreach ($unReadMessages as $unReadMessage)
                        <li>
                            <a href="{{ route('messages.message',$unReadMessage->id) }}">
                                <span class="image">
                                    <img src="images/img.jpg" alt="Profile Image" />
                                </span>
                                <span>
                                    <span>{{ $unReadMessage->sender->name }}</span>
                                    <span class="time"> {{ $unReadMessage->created_at->diffForHumans() }}</span>
                                </span>
                                <span class="message">
                                {{ str_limit($unReadMessage->content, 12, '...') }}
                                </span>
                            </a>
                            @if($loop->iteration >= 5)
                                @break;
                            @endif
                        </li>
                        <!-- end message -->
                        @endForeach
                        <li>
                            <div class="text-center">
                                <a href="{{ route('messages.inbox') }}">
                                    <strong>See All Messages</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
    </div>

</div>
<!-- /top navigation -->

<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li>
                <a href="javascript:void(0)" data-toggle="sidebar" class="nav-link nav-link-lg">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown dropdown-list-toggle">
            <a href="javascript:void(0)" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg">
                <i class="far fa-bell"></i>
                @isset($totalNotif)
                @if ($totalNotif > 0)
                <b style="
                content: '';
                position: absolute;                
                border-radius: 50%;
                color:#f2f2f2;
                margin:-5px 0px 0px 4px;
                -webkit-animation: pulsate 1s ease-out;
                animation: pulsate 1s ease-out;
                -webkit-animation-iteration-count: infinite;
                animation-iteration-count: infinite;
                opacity: 1;
            ">{{$totalNotif}}</b>
                @endif
                @endisset
            </a>

            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="dropdown-header">
                    {{ __('Notifikasi') }}
                </div>
                <div class="dropdown-list-content dropdown-list-icons">
                    {{-- Basic Notification --}}
                    @isset($notifications)
                    @foreach ($notifications as $row)
                    <a href="#" class="dropdown-item dropdown-item-unread removeThisData{{$row->id}}">
                        <div class="dropdown-item-icon bg-info text-white">
                            <i class="fas fa-info"></i>
                        </div>
                        <div class="dropdown-item-desc dropDataNotification">
                            Rp. {{ __(number_format($row->total,2,".",",")) }}
                            <div class="time text-primary">{{ __(date('d F Y',strtotime($row->liquid_date))) }}</div>
                            <button class="btn btn-icon icon-left btn-success " onclick="konfirmasi({{$row->id}})"
                                style="margin-right:10px;margin-top:10px">
                                <i class="far fa-check-circle"></i>{{ __('Konfirmasi') }}
                            </button>
                        </div>
                    </a>
                    @endforeach
                    @endisset
                    {{-- Notification PDL --}}
                    @isset($notificationsPdl)
                    @foreach ($notificationsPdl as $row)
                    <a href="{{route('proposalLoan.index')}}"
                        class="dropdown-item dropdown-item-unread removeThisData{{$row->id}}">
                        <div class="dropdown-item-icon bg-info text-white">
                            <i class="fas fa-info"></i>
                        </div>
                        <div class="dropdown-item-desc dropDataNotification">
                            Rp. {{ __(number_format($row->total,2,".",",")) }}
                            <div class="time text-primary">{{ __(date('d F Y',strtotime($row->date))) }}</div>
                            <button class="btn btn-icon icon-left btn-primary "
                                onclick="{{route('proposalLoan.index')}}" style="margin-right:10px;margin-top:10px">
                                <i class="far fa-check-circle"></i>{{ __('Lihat Data') }}
                            </button>
                        </div>
                    </a>
                    @endforeach
                    @endisset
                    {{-- Notification Manager --}}
                    @isset($notificationsManager)
                    @foreach ($notificationsManager as $row)
                    <a href="{{route('proposalLoan.index')}}"
                        class="dropdown-item dropdown-item-unread removeThisData{{$row->id}}">
                        <div class="dropdown-item-icon bg-info text-white">
                            <i class="fas fa-info"></i>
                        </div>
                        <div class="dropdown-item-desc dropDataNotification">
                            Rp. {{ __(number_format($row->total,2,".",",")) }}
                            <div class="time text-primary">{{ __(date('d F Y',strtotime($row->date))) }}</div>
                            <button class="btn btn-icon icon-left btn-primary "
                                onclick="{{route('proposalLoan.index')}}" style="margin-right:10px;margin-top:10px">
                                <i class="far fa-check-circle"></i>{{ __('Lihat Data') }}
                            </button>
                        </div>
                    </a>
                    @endforeach
                    @endisset
                    {{-- Notification Report --}}
                    @isset($notificationsReport)
                    @foreach ($notificationsReport as $row)
                    <a href="{{route('report.approvalSalesDailyReport',$row->id)}}"
                        class="dropdown-item dropdown-item-unread removeThisData{{$row->id}}">
                        <div class="dropdown-item-icon bg-info text-white">
                            <i class="fas fa-info"></i>
                        </div>
                        <div class="dropdown-item-desc dropDataNotification">
                            @if($row->total == 0)
                            Submit Dari Kasir Ke Manager
                            @else
                            Rp. {{ __(number_format($row->total,2,".",",")) }}
                            @endif
                            <div class="time text-primary">{{ __(date('d F Y',strtotime($row->date))) }}</div>
                            @if($row->total == 0)
                            <button class="btn btn-icon icon-left btn-primary "
                                onclick="{{route('report.approvalSalesDailyReport',$row->id)}}"
                                style="margin-right:10px;margin-top:10px">
                                <i class="far fa-check-circle"></i>{{ __('Lihat Data') }}
                            </button>
                            @else
                            <button class="btn btn-icon icon-left btn-primary "
                                onclick="{{route('report.approvalSalesDailyReport',$row->id)}}"
                                style="margin-right:10px;margin-top:10px">
                                <i class="far fa-check-circle"></i>{{ __('Lihat Data') }}
                            </button>
                            @endif

                        </div>
                    </a>
                    @endforeach
                    @endisset
                    {{-- Notification Pay
                    @isset($notificationsPayInstallment)
                    @foreach ($notificationsPayInstallment as $row)
                    <a href="{{route('payInstallments.show',$row->id)}}" class="dropdown-item">
                        <div class="dropdown-item-icon bg-info text-white">
                            <i class="fas fa-info"></i>
                        </div>
                        <div class="dropdown-item-desc">
                            {{ __('Pembayaran Angsuran Ke ').$row->installment }}
                            <p>{{ __('Rp. ').__(number_format($row->real,2,".",",")) }}</p>
                            <div class="time text-primary">{{ __(date('d F Y',strtotime($row->pay_date))) }}</div>
                        </div>
                    </a>
                    <a class="btn btn-icon icon-left btn-primary btn-block"
                        href="{{route('payInstallments.pay',$row->id)}}" style="border-radius: 0 !important;">
                        <i class="far fa-check-circle"></i>{{ __('Terima Pembayaran') }}
                    </a>
                    @endforeach
                    @endisset --}}
                </div>
                <div class="dropdown-footer text-center ">
                    <a href="javascript:void(0)">
                        @isset($totalNotif)
                        @if ($totalNotif > 0)
                        {{ $totalNotif }}
                        @endif
                        @endisset
                        @empty($totalNotif)
                        {{ __('0') }}
                        @endempty
                        {{ __(' Notifikasi') }}
                    </a>
                </div>
            </div>
        </li>
        <li class="dropdown">
            <a href="javascript:void(0)" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{ asset('assets/img/avatar.png') }}" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">{{ __('Hai, ') . Auth::user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">{{ Auth::user()->Previlege->name }}</div>
                <a href="{{ route('users.profile') }}" class="dropdown-item has-icon" style="cursor: pointer">
                    <i class="far fa-user"></i> {{ __('Profile') }}
                </a>
                <a id="name" class="dropdown-item has-icon" style="cursor: pointer">
                    <i class="fas fa-pen"></i> {{ __('Ganti Nama') }}
                </a>
                <a href="{{ route('users.password') }}" class="dropdown-item has-icon">
                    <i class="fas fa-key"></i> {{ __('Ganti Password') }}
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();"
                    class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> {{ __('auth.logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>
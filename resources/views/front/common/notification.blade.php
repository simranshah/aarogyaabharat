<div class="notificationPop winScrollStop">
    <div class="notificationBlock">
        <h4>Notifications</h4>
        <a onClick="closeonotificationPopUp()"><img src="{{ asset('front/images/cross.svg') }}" alt="" /></a>

        @if ($notifications->isEmpty())
        <div class="notificationitem">
           <p>No notifications found.</p>
        </div> 
        @else
            @foreach ($notifications as $notification)
                <div class="notificationitem">
                    <div class="notiicon">
                        {{-- <img src="{{ asset('front/images/flat_offer.svg') }}" /> --}}
                    </div>
                    <div>
                        @php
                            // Handle both formats
                            $data = is_string($notification->data) 
                                ? json_decode($notification->data, true) 
                                : ($notification->data ?? []);
                        @endphp
                        <h4>{{ $data['title'] ?? 'Notification Title' }}</h4>
                        <p>{{ $data['message'] ?? 'Notification message here.' }}</p>
                       
                    </div>
                    @if(auth()->check())
                        <a href="#;" class="notidelete" data-id="{{ $notification->id }}">
                            <img src="{{ asset('front/images/delete.svg') }}" alt="delete" />
                        </a>
                    @endif
                </div>
            @endforeach
        @endif
    </div>
</div>
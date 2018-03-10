<script>
   @foreach ($notifications as $notification)
       @php
           $config = Config('Notify.options');
       @endphp
       @if (count($notification['options']) > 0)
          {{-- Merge user supplied options with default options --}}
          @php
             $config = array_merge($config, $notification['options']);
          @endphp

       @endif
     {{-- create the notification --}}
     var notification = new NotificationFx({
            message : "<span class='icon  text-{{$notification['type']}}'><i class='{{$notification['icon']}}'></i></span><p class= text-{{$notification['type']}}>{{$notification['message']}}</p>",
            layout : 'attached',
            effect : 'bouncyflip',
            type   : 'notice',  {{-- notice, warning or error --}}
        });
     {{-- show the notification --}}
     notification.show();
   @endforeach
</script>

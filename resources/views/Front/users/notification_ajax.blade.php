 <input type="hidden" name="currentTime" value="<?php echo date('Y-m-d H:i:s');?>">

  @if(!empty($notifications))
  @foreach($notifications as $key => $value)
  <?php 

    if(empty($value['notification_user']['profile_image'])){
      $profile_image = url('/').'/profile_image/admin-avatar.png';  
    }else{
      $profile_image = url('/').'/profile_image/'.$value['notification_user']['profile_image'];
    }
    $time = date('Y-m-d H:i:s',strtotime($value['created_at']));
    $timeAgo = time_elapsed_string($time,0);

  ?>
    <div class="card p-3 border-0 mb-3">
      <div class="row align-items-center">
        <div class="col-auto">
          <span class="avatar avatar-lg" style="background-image: url({{$profile_image}})">
            <span class="avatar-status bg-green"></span>
          </span>
        </div>
        <div class="col">
          <h5 class="mb-0">{{$value['notification_user']['first_name'] . " " .      $value['notification_user']['last_name']}}</h5>
          <p class="mb-0">{{$value['message']}}</p>
        </div>
        <div class="col-auto">
          <p class="mb-0 text-muted">{{$timeAgo}}</p>
        </div>
      </div>
    </div>
    @endforeach
    @else
    No record Found
    @endif
    {{ $notifications->render() }}

    <?php 


    function time_elapsed_string($datetime, $full = false) {
      $now = new DateTime;
      $ago = new DateTime($datetime);
      $diff = $now->diff($ago);

      $diff->w = floor($diff->d / 7);
      $diff->d -= $diff->w * 7;

      $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
      );
      foreach ($string as $k => &$v) {
        if ($diff->$k) {
          $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        }else {
          unset($string[$k]);
        }
      }
      if (!$full) $string = array_slice($string, 0, 1);
      return $string ? implode(', ', $string) . ' ago'  : 'just now';
    }



    

    ?>

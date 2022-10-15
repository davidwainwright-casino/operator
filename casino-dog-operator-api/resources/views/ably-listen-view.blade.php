<script type="text/javascript" src="//cdn.ably.io/lib/ably.min-1.js"></script>
<script src="//jsbin-files.ably.io/js/jquery-1.8.3.min.js"></script>
<h1>Simple API Example</h1>

<p>Ably provides a simple API that keeps developers happy. <a href="https://ably.com/docs/">View the API documentation.</a></p>

<div class="row">
  <input id="publish" type="submit" value="Publish a message">
</div>

<p>You can even publish using a curl command from your terminal to our REST API:</p>
<ul class="row" id="channel-status"></ul>



<style id="jsbin-css">
body {
  font: 14px 'Helvetica Neue', Helvetica, Arial, sans-serif;
}

h1 {
  background: url('//jsbin-files.ably.io/images/ably-logo.png') no-repeat;
  background-size: 110px;
  font-size: 18px;
  font-weight: bold;
  padding: 8px 0 0 120px;
  height: 42px;
}

.row {
  margin-bottom: 1em;
}

</style>
<script>
/**
 *  Note: this example uses a demo API key. Your own API keys are available in your account dashboard: 'https://ably.com/accounts/'.
 */
const ably = new Ably.Realtime('{{$data['API_KEY']}}');
const channel = ably.channels.get('{{$data['CHANNEL']}}');

$('input#publish').on('click', function() {
  channel.publish('greeting', 'Hello from the browser');
});

channel.subscribe(function(message) {
  show('⬅ Received: ' + message.data);
});

function show(status) {
  $('#channel-status').append($('<li>').text(status).css('color', 'green'));
}
</script>

@php 
        Ably::channel($data['CHANNEL'])->publish('test_redirect_ping', request()->path().' from '.request()->ip(), request()->ip());

@endphp
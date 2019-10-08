# audio-stream-proxy
Share audio without giving ip<br>
dependencies: dyndns (or you can hardcode ip by removing lines 13-34 and adding $ip='your_ip';)<br>
if you don't have password on server, change line 36 to $file='http://' . $ip . ':' . $port . '/stream.mp3';

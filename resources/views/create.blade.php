<h1>Hello World.</h1>

<form action="{{ route('sms.store') }}" method="post">

{{-- 
    <div class="form-group">
        <label for="source">Source</label>
        <input type="text" name="source" id="source" class="form-control" placeholder="Source">
    </div>
     --}}
    <div class="form-group">
        <label for="destination">Destination</label>
        <input type="text" name="destination" id="destination" class="form-control" placeholder="Destination">
    </div>

    <div class="form-group">
        <label for="message">Message</label>
        <textarea name="message" id="message" class="form-control" placeholder="Message"></textarea>
    </div>

    <button type="submit">Send</button>


</form>
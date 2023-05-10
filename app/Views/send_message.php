<!DOCTYPE html>
<html>
<head>
    <title>Send Message</title>
</head>
<body>
    <h1>Send Message</h1>
    <form method="post" action="<?php echo base_url('/send-message') ?>">
        <input type="hidden" name="to_user_id" value="<?php echo $toUserId ?>">
        <textarea name="message" required></textarea>
        <br>
        <button type="submit">Send Message</button>
    </form>
</body>
</html>

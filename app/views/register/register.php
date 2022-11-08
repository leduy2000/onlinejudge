<div class="modal mlT">
    <div>
        <h1>Register</h1>
    </div>
    <form>
        <div class="modal-label mlT">First Name</div>
        <input id="firstname" class="modal-input" type="text" placeholder="Enter First Name">
        <div class="modal-label mlT">Last Name</div>
        <input id="lastname" class="modal-input" type="text" placeholder="Enter Last Name">
        <div class="modal-label mlT">Email</div>
        <input id="email" class="modal-input" type="text" placeholder="Enter Email">
        <div class="modal-label mlT">Password</div>
        <input id="password" type="password" placeholder="Enter Password" class="modal-input">
        <div class="modal-label mlT">Confirm Password</div>
        <input id="confirm-password" type="password" placeholder="Confirm Password" class="modal-input">
    </form>
    <button id="register-btn" class="btn-ui btn-green modal-btn mlT width-full">Register</button>
</div>

<script>
    $('#register-btn').click(function() {
        User.form.create();
    });
</script>
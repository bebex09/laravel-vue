<template>
  <main class="login-form mt-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header bg-primary text-white">Log In</div>
            <div class="card-body">
              <form>
                <div class="form-group">
                  <label for="email_address">E-Mail Address</label>
                  <input type="email" class="form-control" required autofocus placeholder="Email">
                </div>

                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" placeholder="Password" required>
                </div>

                <div class="form-group">
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="remember">
                    <label class="form-check-label" for="remember">Remember Me</label>
                  </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block mt-4">Login</button>
                <div class="text-center mt-3">
                  <a href="#" class="btn btn-link">Forgot Your Password?</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
export default {
    name: 'LogIn'
}
</script>
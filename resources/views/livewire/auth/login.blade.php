<div>
    <div class="login-form">
        <form wire:submit.prevent="login">
          <h1>Login</h1>
          <div class="content">
            <div class="input-field">
              <input type="text" placeholder="Username" class="@error('username') is-invalid @enderror" autocomplete="nope" wire:model.defer="username">
              @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
              @enderror
            </div>
            <div class="input-field">
              <input type="password" placeholder="Password" class="@error('password') is-invalid @enderror" autocomplete="new-password" wire:model="password">
              @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
              @enderror
            </div>
            <a href="#" class="link">Forgot Your Password?</a>
          </div>
          <div class="action">
            <button wire:click="register">Register</button>
            <button type="submit">Sign in</button>
          </div>
        </form>
      </div>
</div>

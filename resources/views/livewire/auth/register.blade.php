<div>
    <div class="login-form">
        <form wire:submit.prevent="signUp">
          <h1>Register</h1>
          <div class="content">
            <div class="input-field">
                <input type="text" placeholder="First Name" value="{{ old('first_name') }}" class="@error('first_name') is-invalid @enderror" autocomplete="nope" wire:model.defer="first_name">
                @error('first_name')
                      <span class="text-danger" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                @enderror
              </div>
              <div class="input-field">
                <input type="text" placeholder="Last Name" value="{{ old('last_name') }}" class="@error('last_name') is-invalid @enderror" autocomplete="nope" wire:model.defer="last_name">
                @error('last_name')
                      <span class="text-danger" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                @enderror
              </div>
              <div class="input-field">
                @if ($avator)
                <div>
                    <label for="name" class="col-form-label">{{ __('Image Preview') }}</label>
                    <img src="{{ $avator->temporaryUrl() }}" class="img-thumbnail" style="border-radius: 50px; height:50px; width:50px;" alt="Preview">
                </div>
                @endif
                <input type="file" value="{{ old('avator') }}" class="@error('avator') is-invalid @enderror" autocomplete="nope" wire:model.defer="avator">
                @error('avator')
                      <span class="text-danger" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                @enderror
              </div>

            <div class="input-field">
              <input type="text" placeholder="Username" value="{{ old('username') }}" class="@error('username') is-invalid @enderror" autocomplete="nope" wire:model.defer="username">
              @error('username')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
              @enderror
            </div>
            <div class="input-field">
                <input type="email" value="{{ old('email') }}" placeholder="Email" class="@error('email') is-invalid @enderror" autocomplete="nope" wire:model.defer="email">
                @error('email')
                      <span class="text-danger" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                @enderror
              </div>
            <div class="input-field">
              <input type="password" placeholder="Password" class="@error('password') is-invalid @enderror" autocomplete="new-password" wire:model="password">
              @error('password')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
              @enderror
            </div>
            <div class="input-field">
                <input type="password" placeholder="Confirm Password" wire:model="password_confirmation">
              </div>
          </div>
          <div class="action">
            <button wire:click="signIn">Sign in</button>
            <button type="submit">Register</button>
          </div>
        </form>
      </div>
</div>

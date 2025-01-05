<div>
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12">
                <div class="login-card">
                    <form class="login-form">
                        <div class="col-12 mb-4 text-center">
                            <img src="{{ asset('assets/images/logo/logo.png') }}" alt="" style="height: 100px; width: auto" class="img-fluid">
                            <h4 class="mt-3">ठाणे महानगरपालिका माझी वसुंधरा</h4>
                        </div>
                        @csrf

                        <h4 class="text-center">पासवर्ड रीसेट करा (Reset Password)</h4>
                        <br>

                        @if($step == 1 || $step == 2)

                            <div class="form-group mt-2">
                                <label>ईमेल (Email)</label>
                                <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                                    <input type="email" class="form-control @if($errors->has('email')) is-invalid @endif" wire:model.defer="email" id="email">
                                </div>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        @endif

                        @if ($step == 2)
                            <div class="form-group">
                                <label>सत्यापन कोड (Verification Code)</label>
                                <div class="input-group"><span class="input-group-text"><i class="icon-line-dashed"></i></span>
                                    <input class="form-control @error('verification_code') is-invalid @enderror" type="number" name="verification_code" id="verification_code" wire:model.defer="verification_code" placeholder="सत्यापन कोड (Verification Code)">
                                </div>
                                @error('verification_code')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        @endif

                        @if($step == 3)
                            <div class="form-group">
                                <label>नवीन पासवर्ड (New Password)</label>
                                <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                                    <input class="form-control @error('new_password') is-invalid @enderror" type="password" id="new_password" name="new_password" wire:model.defer="new_password" placeholder="*********">
                                    <span class="input-group-text" id="password_eye" onclick="showHidePassword1()"><i class="eye fa fa-eye-slash"></i></span>
                                </div>
                                @error('new_password')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>पासवर्डची पुष्टी करा (Confirm Password)</label>
                                <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                                    <input class="form-control @error('verification_code') is-invalid @enderror" type="password" id="confirm_password" name="confirm_password" wire:model.defer="confirm_password" placeholder="*********">
                                </div>
                                @error('confirm_password')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        @endif


                        <div class="form-group d-flex justify-content-between">
                            <button class="btn btn-primary w-auto" wire:click.prevent="submit()" wire:loading.attr="disabled" type="submit">सबमिट करा</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

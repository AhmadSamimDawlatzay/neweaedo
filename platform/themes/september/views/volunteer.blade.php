<section class="section--volunteer">
  <div class="section__content">
    <section class="section--auth">

      <form class="form--auth tracking-form" style="max-width: 100%" enctype="multipart/form-data" method="POST"
        action="{{ route('volunteer') }}">
        @csrf
        <div class="form__header">
          <h3>{{ __('Volunteer registeration') }}</h3>
          <p>{{ __('Volunteer registeration form') }}</p>
        </div>
        <div class="form__content">
          <div class="row">

            <div class="col-lg-6">
              <div class="form-group">
                <label for="txt-order-id">{{ __('Name') }}<sup>*</sup></label>
                <input class="form-control" name="name" id="txt-order-id" type="text"
                  value="{{ old('name', request()->input('name')) }}" placeholder="{{ __('Name') }}">
                @if ($errors->has('name'))
                  <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
              </div>
            </div>
            <div class="col-lg-6">

              <div class="form-group">
                <label for="txt-email">{{ __('Email Address') }}<sup>*</sup></label>
                <input class="form-control" name="email" id="txt-email" type="email"
                  value="{{ old('email', request()->input('email')) }}"
                  placeholder="{{ __('Please enter your email address') }}">
                @if ($errors->has('email'))
                  <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="txt-order-id">{{ __('Educaltion level') }}<sup>*</sup></label>
                <select name="education_level" id="" class="form-select form-control">
                  <option value="1">Elementary School (Grades 1-5 or 1-6)</option>
                  <option value="2">Middle School (Grades 6-8)</option>
                  <option value="3">High School (Grades 9-12)</option>
                  <option value="4">Associate Degree (2 years)</option>
                  <option value="5">Bachelor\'s Degree (4 years)</option>
                  <option value="6">Master\'s Degree</option>
                  <option value="7">Doctorate (Ph.D.)</option>
                </select>
                @if ($errors->has('education_level'))
                  <span class="text-danger">{{ $errors->first('education_level') }}</span>
                @endif
              </div>
            </div>
            <div class="col-lg-6">


              <div class="form-group">
                <label for="txt-order-id">{{ __('Experience Level') }}<sup>*</sup></label>
                <input class="form-control" name="experience_level" id="txt-order-id" type="text"
                  value="{{ old('experience_level', request()->input('experience_level')) }}"
                  placeholder="{{ __('Experience Level') }}">
                @if ($errors->has('experience_level'))
                  <span class="text-danger">{{ $errors->first('experience_level') }}</span>
                @endif
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="txt-order-id">{{ __('Position') }}<sup>*</sup></label>
                <input class="form-control" name="position" id="txt-order-id" type="text"
                  value="{{ old('position', request()->input('position')) }}" placeholder="{{ __('Position') }}">
                @if ($errors->has('position'))
                  <span class="text-danger">{{ $errors->first('position') }}</span>
                @endif
              </div>
            </div>

            <div class="col-lg-6">
              <div class="form-group">
                <label for="txt-order-id">{{ __('Phone') }}<sup>*</sup></label>
                <input class="form-control" name="phone" type="number"
                  value="{{ old('phone', request()->input('phone')) }}" placeholder="{{ __('Phone') }}">
                @if ($errors->has('phone'))
                  <span class="text-danger">{{ $errors->first('phone') }}</span>
                @endif
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="txt-order-id">{{ __('Remark') }}<sup>*</sup></label>
                <textarea name="remark" id="" cols="30" rows="5" class="form-control"
                  placeholder="{{ __('Remark') }}"></textarea>
                @if ($errors->has('remark'))
                  <span class="text-danger">{{ $errors->first('remark') }}</span>
                @endif
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-3">
              <div class="form-group">
                <label for="txt-order-id">{{ __('Image') }}<sup>*</sup></label>
                <input title="Your image here please" class="form-control" name="image" type="file"
                  value="{{ old('image', request()->input('image')) }}" placeholder="{{ __('image') }}">
                @if ($errors->has('image'))
                  <span class="text-danger">{{ $errors->first('image') }}</span>
                @endif
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label for="txt-order-id">{{ __('CV') }}<sup>*</sup></label>
                <input class="form-control" name="cv" type="file">
                @if ($errors->has('cv'))
                  <span class="text-danger">{{ $errors->first('cv') }}</span>
                @endif
              </div>
            </div>

            <div class="col-lg-3">
              <div class="form-group">
                <label for="txt-order-id">{{ __('ID card front image') }}<sup>*</sup></label>
                <input class="form-control" name="id_card_front" type="file">
                @if ($errors->has('id_card_front'))
                  <span class="text-danger">{{ $errors->first('id_card_front') }}</span>
                @endif
              </div>
            </div>

            <div class="col-lg-3">
              <div class="form-group">
                <label for="txt-order-id">{{ __('ID card back image') }}<sup>*</sup></label>
                <input class="form-control" name="id_card_back" type="file"
                  value="{{ old('id_card_back', request()->input('id_card_back')) }}"
                  placeholder="{{ __('id_card_back') }}">
                @if ($errors->has('id_card_back'))
                  <span class="text-danger">{{ $errors->first('id_card_back') }}</span>
                @endif
              </div>
            </div>
          </div>


          <div class="form__actions">
            <button type="submit" class="btn--custom btn--rounded ">{{ __('Send') }}</button>
          </div>
        </div>
      </form>

  </div>
  <div class="section__footer text-center">
    <div class="custom-pagination">
      ss
    </div>
  </div>
</section>

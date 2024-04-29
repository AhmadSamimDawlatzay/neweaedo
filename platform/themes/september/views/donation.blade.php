<article class="post--detail">
  <div class="post__header">
    <h1>{!! BaseHelper::clean($donation->name) !!}</h1>
    <p>{{ $donation->created_at->translatedFormat('d M, Y') }} </p>
  </div>
  <div class="post__content">
    <div class="row">

      <div class="col-lg-8">
        <div class="ck-content">{!! BaseHelper::clean($donation->remark) !!}</div>
      </div>
      <div class="col-lg-4">
        {{-- /////////////////// --}}
        <div class="section__content">
          <section class="section--auth">
            <form class="form--auth tracking-form" style="max-width: 100%" enctype="multipart/form-data" method="POST"
              action="{{ route('donate') }}">
              @csrf
              <div class="form__header">
                <h3>{{ __('Donate') }}</h3>
                <p>{{ __('Donation form') }}</p>
              </div>
              <div class="form__content">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label for="txt-order-id">{{ __('Name') }}<sup>*</sup></label>
                      <input class="form-control" name="name" id="txt-order-id" type="text"
                        value="{{ old('name', request()->input('name')) }}" placeholder="{{ __('Name') }}">
                      @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                      @endif
                    </div>
                  </div>

                  <div class="col-lg-12">
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

                  <div class="col-lg-12">
                    <div class="form-group">
                      <label for="txt-order-id">{{ __('Phone') }}<sup>*</sup></label>
                      <input class="form-control" name="phone" id="txt-order-id" type="number"
                        value="{{ old('phone', request()->input('phone')) }}" placeholder="{{ __('Phone') }}">
                      @if ($errors->has('phone'))
                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label for="txt-order-id">{{ __('Amount') }}<sup>*</sup></label>
                      <input class="form-control" name="amount" id="txt-order-id" type="number"
                        value="{{ old('amount', request()->input('amount')) }}" placeholder="{{ __('Amount') }}">
                      @if ($errors->has('amount'))
                        <span class="text-danger">{{ $errors->first('amount') }}</span>
                      @endif
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
                <input type="hidden" name="donation_id" value="{{ $donation->id }}" id="">
                <div class="form__actions">
                  <button type="submit" class="btn--custom btn--rounded ">{{ __('Donate') }}</button>
                </div>
              </div>
            </form>

        </div>
        {{-- /////////////////// --}}
        <br>
        <img src="{{ RvMedia::getImageUrl($donation->image, 'medium', false, RvMedia::getDefaultImage()) }}"
          alt="{{ $donation->name }}" loading="lazy" />
      </div>
    </div>
    {{-- @if (!$donation->tags->isEmpty())
            <strong>{{ __('Tags') }}: </strong>
            <span>
                @foreach ($donation->tags as $tag)
                    <a href="{{ $tag->url }}">{{ $tag->name }}</a>@if (!$loop->last),@endif
                @endforeach
            </span>
        @endif --}}
    <br />
    {!! apply_filters(BASE_FILTER_PUBLIC_COMMENT_AREA, null, $donation) !!}
  </div>
</article>

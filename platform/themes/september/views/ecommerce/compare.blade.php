<section class="section section--shopping-cart">
    <div class="section__header">
        <h3>{{ __('Compare') }}</h3>
    </div>
    <div class="section__content">
        @if ($products->count())
            <div class="table-responsive table__compare">
                <table class="table table-bordered text-center">
                    <tbody>
                        <tr class="pr_image">
                            <td class="text-muted font-md fw-600">{{ __('Preview') }}</td>
                            @foreach($products as $product)
                                <td class="row_img">
                                    <a href="{{ $product->original_product->url }}"><img src="{{ RvMedia::getImageUrl($product->image, 'thumb', false, RvMedia::getDefaultImage()) }}" alt="{{ $product->name }}" loading="lazy"/></a>
                                </td>
                            @endforeach
                        </tr>
                        <tr class="pr_title">
                            <td class="text-muted font-md fw-600">{{ __('Name') }}</td>

                            @foreach($products as $product)
                                <td class="product_name">
                                    <h5><a href="{{ $product->original_product->url }}">{!! BaseHelper::clean($product->name) !!}</a></h5>
                                </td>
                            @endforeach
                        </tr>
                        <tr class="pr_price">
                            <td class="text-muted font-md fw-600">{{ __('Price') }}</td>

                            @foreach($products as $product)
                                <td class="product_price">
                                    <span class="price">{{ format_price($product->front_sale_price_with_taxes) }}</span> @if ($product->front_sale_price !== $product->price) <del>{{ format_price($product->price_with_taxes) }} </del> <small>({{ get_sale_percentage($product->price, $product->front_sale_price) }})</small> @endif
                                </td>
                            @endforeach
                        </tr>
                        @if (EcommerceHelper::isReviewEnabled())
                            <tr class="pr_rating">
                                <td class="text-muted font-md fw-600">{{ __('Rating') }}</td>
                                @foreach($products as $product)
                                    <td>
                                        <div class="rating_wrap">
                                            <div class="rating">
                                                <div class="product_rate" style="width: {{ $product->reviews_avg * 20 }}%"></div>
                                            </div>
                                            <span class="rating_num">({{ $product->reviews_count }})</span>
                                        </div>
                                    </td>
                                @endforeach
                            </tr>
                        @endif

                        <tr class="description">
                            <td class="text-muted font-md fw-600">{{ __('Description') }}</td>
                            @foreach($products as $product)
                                <td class="row_text font-xs">
                                    <p>
                                        {!! BaseHelper::clean($product->description) !!}
                                    </p>
                                </td>
                            @endforeach
                        </tr>

                        @foreach($attributeSets as $attributeSet)
                            @if ($attributeSet->is_comparable)
                                <tr>
                                    <td class="text-muted font-md fw-600">
                                        {{ $attributeSet->title }}
                                    </td>

                                    @foreach($products as $product)
                                        @php
                                            $attributes = app(\Botble\Ecommerce\Repositories\Interfaces\ProductInterface::class)->getRelatedProductAttributes($product)->where('attribute_set_id', $attributeSet->id)->sortBy('order');
                                        @endphp

                                        @if ($attributes->count())
                                            @if ($attributeSet->display_layout == 'dropdown')
                                                <td>
                                                    {{ $attributes->pluck('title')->implode(', ') }}
                                                </td>
                                            @elseif ($attributeSet->display_layout == 'text')
                                                <td class="product--detail">
                                                    <div class="text-swatches-wrapper attribute-swatches-wrapper attribute-swatches-wrapper form-group product__attribute product__color">
                                                        <div class="attribute-values">
                                                            <ul class="text-swatch attribute-swatch color-swatch">
                                                                @foreach($attributes as $attribute)
                                                                    <li data-slug="{{ $attribute->slug }}">
                                                                        <div>
                                                                            <label>
                                                                                <input class="product-filter-item" type="radio" name="attribute_{{ $attribute->productAttributeSet->slug }}"
                                                                                       value="{{ $attribute->id }}" disabled>
                                                                                <span style="cursor: default">{{ $attribute->title }}</span>
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                            @else
                                                <td class="product--detail">
                                                    <div class="visual-swatches-wrapper attribute-swatches-wrapper form-group product__attribute product__color">
                                                        <div class="attribute-values">
                                                            <ul class="visual-swatch color-swatch attribute-swatch">
                                                                @foreach($attributes as $attribute)
                                                                    <li class="attribute-swatch-item" style="display: inline-block">
                                                                        <div class="custom-radio">
                                                                            <label>
                                                                                <input class="form-control product-filter-item" name="attribute_{{ $attribute->productAttributeSet->slug }}"
                                                                                       value="{{ $attribute->id }}" type="radio" disabled>
                                                                                <span style="{{ $attribute->image ? 'background-image: url(' . RvMedia::getImageUrl($attribute->image) . ');' : 'background-color: ' . $attribute->color . ';' }}; cursor: default;"></span>
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                            @endif
                                        @else
                                            <td>&mdash;</td>
                                        @endif
                                    @endforeach
                                </tr>
                            @endif
                        @endforeach

                        @if (EcommerceHelper::isCartEnabled())
                            <tr class="pr_add_to_cart">
                                <td class="text-muted font-md fw-600">{{ __('Buy now') }}</td>
                                @foreach($products as $product)
                                    <td class="row_btn">
                                        <a href="#" class="btn--custom btn--outline btn--rounded btn--sm add-to-cart-button" data-id="{{ $product->id }}" data-url="{{ route('public.cart.add-to-cart') }}">
                                            {{ __('Add To Cart') }}
                                        </a>
                                    </td>
                                @endforeach
                            </tr>
                        @endif

                        <tr class="pr_remove text-muted">
                            <td class="text-muted font-md fw-600">&nbsp;</td>
                            @foreach($products as $product)
                                <td class="row_remove">
                                    <a class="btn--custom btn--outline btn--rounded btn--sm btn-outline-danger js-remove-from-compare-button" href="#" data-url="{{ route('public.compare.remove', $product->id) }}">
                                        <span>{{ __('Remove') }}</span>
                                    </a>
                                </td>
                            @endforeach
                        </tr>

                    </tbody>
                </table>
            </div>
        @else
            <p class="text-center">{{ __('No products in compare list!') }}</p>
        @endif
    </div>
</section>

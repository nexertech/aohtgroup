@extends('frontend.layouts.app')

@section('content')

  <!-- HERO SLIDER -->
  <section class="hero-slider">
    <div class="slides" id="slides">
      @if(!empty($sliders) && $sliders->count())
        @foreach($sliders as $slide)
          <div class="slide"
            style="background-image: linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url('{{ $slide->image ? asset('storage/' . $slide->image) : '' }}'); background-size:cover; background-position:center;">
            <div class="overlay"></div>
            <div class="slide-content">
              <h2 class="title">{{ $slide->title ?? 'AOHT Group' }}</h2>
              <p class="subtitle">{{ $slide->subtitle ?? '' }}</p>
              @if(!empty($slide->button_text))
                <a class="btn btn-light mt-4" href="{{ $slide->button_link ?: '#' }}">{{ $slide->button_text }}</a>
              @endif
            </div>
          </div>
        @endforeach
      @else
        <!-- Slide 1 -->
        <div class="slide"
          style="background-image: linear-gradient(rgba(0,0,0,0.1), rgba(0,0,0,0.1)), url('{{ asset('assets/slider1.png') }}'); background-size:cover; background-position:center;">
          <div class="overlay"></div>
          <div class="slide-content">
            <h2 class="title">Welcome to AOHT Group</h2>
            <p class="subtitle">Integrated business solutions across Hospitality, Technology, Real Estate, HR, and
              Consultancy</p>
            <a class="btn btn-light mt-4" href="#">Learn More</a>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="slide"
          style="background-image: linear-gradient(rgba(0,0,0,0.1), rgba(0,0,0,0.1)), url('{{ asset('assets/slider2.png') }}'); background-size:cover; background-position:center;">
          <div class="overlay"></div>
          <div class="slide-content">
            <h2 class="title">Innovation & Excellence</h2>
            <p class="subtitle">Delivering cutting-edge solutions with over a decade of industry expertise and commitment to
              quality</p>
            <a class="btn btn-light mt-4" href="#">Our Services</a>
          </div>
        </div>

        <!-- Slide 3 -->
        <div class="slide"
          style="background-image: linear-gradient(rgba(0,0,0,0.1), rgba(0,0,0,0.1)), url('{{ asset('assets/slider3.png') }}'); background-size:cover; background-position:center;">
          <div class="overlay"></div>
          <div class="slide-content">
            <h2 class="title">Transforming Businesses</h2>
            <p class="subtitle">Empowering organizations with comprehensive technology, hospitality, and consultancy
              solutions</p>
            <a class="btn btn-light mt-4" href="#">Contact Us</a>
          </div>
        </div>
      @endif
    </div>

    @if(($sliders && $sliders->count() > 1) || (!$sliders || $sliders->count() == 0))
      <div id="prev" class="slider-arrow arrow-left">❮</div>
      <div id="next" class="slider-arrow arrow-right">❯</div>

      <div class="dots" id="dots">
        @if($sliders && $sliders->count() > 0)
          @foreach($sliders as $index => $slide)
            <div class="dot {{ $index == 0 ? 'active' : '' }}" data-index="{{ $index }}"></div>
          @endforeach
        @else
          <div class="dot active" data-index="0"></div>
          <div class="dot" data-index="1"></div>
          <div class="dot" data-index="2"></div>
        @endif
      </div>
    @endif
  </section>

  <!-- CATEGORIES/SALE SECTION -->
  <section class="categories-section">
    <div class="container-custom">
      <div class="section-header">
        <h2 class="section-title">Popular Categories</h2>
      </div>
      <div class="categories-grid">
        @if(isset($categories) && $categories->count() > 0)
          <!-- Column 1: Item 1 -->
          @if(isset($categories[0]))
            <div class="category-column">
              <a href="{{ route('frontend.category.detail', $categories[0]->slug) }}"
                class="category-card category-auto block">
                <div class="category-image">
                  @if($categories[0]->image)
                    <img src="{{ asset('storage/' . $categories[0]->image) }}" alt="{{ $categories[0]->category_name }}">
                  @else
                    <div class="image-placeholder"><span>{{ substr($categories[0]->category_name, 0, 1) }}</span></div>
                  @endif
                </div>
                <div class="category-label">{{ strtoupper($categories[0]->category_name) }}</div>
              </a>
            </div>
          @endif

          <!-- Column 2: Item 2 & 3 -->
          @if(isset($categories[1]) || isset($categories[2]))
            <div class="category-column">
              @if(isset($categories[1]))
                <a href="{{ route('frontend.category.detail', $categories[1]->slug) }}"
                  class="category-card category-half block">
                  <div class="category-image">
                    @if($categories[1]->image)
                      <img src="{{ asset('storage/' . $categories[1]->image) }}" alt="{{ $categories[1]->category_name }}">
                    @else
                      <div class="image-placeholder"><span>{{ substr($categories[1]->category_name, 0, 1) }}</span></div>
                    @endif
                  </div>
                  <div class="category-label">{{ strtoupper($categories[1]->category_name) }}</div>
                </a>
              @endif
              @if(isset($categories[2]))
                <a href="{{ route('frontend.category.detail', $categories[2]->slug) }}"
                  class="category-card category-half block">
                  <div class="category-image">
                    @if($categories[2]->image)
                      <img src="{{ asset('storage/' . $categories[2]->image) }}" alt="{{ $categories[2]->category_name }}">
                    @else
                      <div class="image-placeholder"><span>{{ substr($categories[2]->category_name, 0, 1) }}</span></div>
                    @endif
                  </div>
                  <div class="category-label">{{ strtoupper($categories[2]->category_name) }}</div>
                </a>
              @endif
            </div>
          @endif

          <!-- Column 3: Item 4 (Center Large) -->
          @if(isset($categories[3]))
            <div class="category-column">
              <a href="{{ route('frontend.category.detail', $categories[3]->slug) }}"
                class="category-card category-full block">
                <div class="category-image">
                  @if($categories[3]->image)
                    <img src="{{ asset('storage/' . $categories[3]->image) }}" alt="{{ $categories[3]->category_name }}">
                  @else
                    <div class="image-placeholder"><span>{{ substr($categories[3]->category_name, 0, 1) }}</span></div>
                  @endif
                </div>
                <div class="category-label">{{ strtoupper($categories[3]->category_name) }}</div>
              </a>
            </div>
          @endif

          <!-- Column 4: Item 5 & 6 -->
          @if(isset($categories[4]) || isset($categories[5]))
            <div class="category-column">
              @if(isset($categories[4]))
                <div class="category-card category-half">
                  <div class="category-image">
                    @if($categories[4]->image)
                      <img src="{{ asset('storage/' . $categories[4]->image) }}" alt="{{ $categories[4]->category_name }}">
                    @else
                      <div class="image-placeholder"><span>{{ substr($categories[4]->category_name, 0, 1) }}</span></div>
                    @endif
                  </div>
                  <div class="category-label">{{ strtoupper($categories[4]->category_name) }}</div>
                </div>
              @endif
              @if(isset($categories[5]))
                <div class="category-card category-half">
                  <div class="category-image">
                    @if($categories[5]->image)
                      <img src="{{ asset('storage/' . $categories[5]->image) }}" alt="{{ $categories[5]->category_name }}">
                    @else
                      <div class="image-placeholder"><span>{{ substr($categories[5]->category_name, 0, 1) }}</span></div>
                    @endif
                  </div>
                  <div class="category-label">{{ strtoupper($categories[5]->category_name) }}</div>
                </div>
              @endif
            </div>
          @endif

          <!-- Column 5: Item 7 -->
          @if(isset($categories[6]))
            <div class="category-column">
              <div class="category-card category-auto">
                <div class="category-image">
                  @if($categories[6]->image)
                    <img src="{{ asset('storage/' . $categories[6]->image) }}" alt="{{ $categories[6]->category_name }}">
                  @else
                    <div class="image-placeholder"><span>{{ substr($categories[6]->category_name, 0, 1) }}</span></div>
                  @endif
                </div>
                <div class="category-label">{{ strtoupper($categories[6]->category_name) }}</div>
              </div>
            </div>
          @endif
        @else
          <!-- Fallback to static if no categories found (Optional: remove this else block if you want it empty) -->
          <div class="col-span-full text-center py-10 text-gray-400">No categories available.</div>
        @endif
      </div>

      @if(isset($totalCategories) && $totalCategories > 7)
        <div class="flex justify-center mt-12">
          <a href="{{ route('frontend.categories') }}"
            class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:py-4 md:text-lg md:px-10 transition duration-150 ease-in-out">
            Show More
            <svg class="ml-2 -mr-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd"
                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                clip-rule="evenodd" />
            </svg>
          </a>
        </div>
      @endif
    </div>
  </section>


  <!-- FEATURED PROJECTS -->
  @if(!empty($products) && $products->count())
    <section class="projects-section">
      <div class="container-custom">
        <div class="section-header">
          <h2 class="section-title"> Products</h2>
          <p class="section-subtitle">Showcasing our latest achievements and innovations</p>
        </div>
        <div class="projects-grid">
          @foreach($products as $product)
            <div class="project-card">
              <div class="project-image">
                @if($product->main_image)
                  <img src="{{ asset($product->main_image) }}" alt="{{ $product->product_name }}">
                @else
                  <div class="image-placeholder">
                    <span>📦</span>
                  </div>
                @endif
              </div>
              <div class="project-content">
                <h3 class="project-title">{{ $product->product_name }}</h3>
                <p class="project-description">{{ \Illuminate\Support\Str::limit(strip_tags($product->description), 120) }}
                </p>
                <a href="{{ route('frontend.products.detail', $product->slug) }}" class="project-link">View Details →</a>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>
  @endif

  <!-- SERVICES SECTION -->
  @if(!empty($services) && $services->count())
    <section class="services-section">
      <div class="container-custom">
        <div class="section-header">
          <h2 class="section-title">Our Services</h2>
          <p class="section-subtitle">Comprehensive solutions tailored to your business needs</p>
        </div>
        <div class="services-grid">
          @foreach($services as $service)
            <div class="service-card hover:shadow-xl transition-all duration-300" style="padding: 0;">
              @if($service->banner_image)
                <div class="h-40 w-full overflow-hidden rounded-t-2xl">
                  @if(\Illuminate\Support\Str::startsWith($service->banner_image, ['http://', 'https://']))
                    <img src="{{ $service->banner_image }}" alt="{{ $service->service_name }}"
                      class="w-full h-full object-cover transform hover:scale-110 transition-transform duration-500">
                  @else
                    <img src="{{ asset('storage/' . $service->banner_image) }}" alt="{{ $service->service_name }}"
                      class="w-full h-full object-cover transform hover:scale-110 transition-transform duration-500">
                  @endif
                </div>
              @endif

              <div class="p-8">
                <div class="service-icon">
                  @if($service->icon)
                    @if(\Illuminate\Support\Str::contains($service->icon, ['http://', 'https://']) || \Illuminate\Support\Str::contains($service->icon, ['.jpg', '.png', '.jpeg', '.svg', '.webp']))
                      @if(\Illuminate\Support\Str::startsWith($service->icon, ['http://', 'https://']))
                        <img src="{{ $service->icon }}" alt="{{ $service->service_name }}">
                      @else
                        <img src="{{ asset('storage/' . $service->icon) }}" alt="{{ $service->service_name }}">
                      @endif
                    @else
                      <!-- Assume FontAwesome Class -->
                      <i class="{{ $service->icon }}" style="font-size: 2rem; color: white;"></i>
                    @endif
                  @else
                    <div class="icon-placeholder">{{ strtoupper(substr($service->service_name, 0, 1)) }}</div>
                  @endif
                </div>
                <h3 class="service-title">{{ $service->service_name }}</h3>
                <p class="service-description">{{ \Illuminate\Support\Str::limit(strip_tags($service->description), 140) }}
                </p>
                <a href="{{ route('frontend.services.detail', $service->slug) }}" class="service-link">Learn More →</a>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>
  @endif


  <!-- STATISTICS SECTION -->
  <!-- <section class="stats-section"> -->
  <div class="container-custom">
    <div class="stats-grid">
      <div class="stat-card">
        <div class="stat-number">5000+</div>
        <div class="stat-label">Textile Products</div>
      </div>
      <div class="stat-card">
        <div class="stat-number">100+</div>
        <div class="stat-label">Global Partners</div>
      </div>
      <div class="stat-card">
        <div class="stat-number">50+</div>
        <div class="stat-label">Countries Served</div>
      </div>
      <div class="stat-card">
        <div class="stat-number">10M+</div>
        <div class="stat-label">Garments Delivered</div>
      </div>
    </div>
  </div>
  </section>

  <!-- TEAM MEMBERS SECTION -->
  @if(!empty($teamMembers) && $teamMembers->count())
    <section class="team-section">
      <div class="container-custom">
        <div class="section-header">
          <h2 class="section-title">Our Team</h2>
          <p class="section-subtitle">Meet the experts behind our success</p>
        </div>
        <div class="team-grid">
          @foreach($teamMembers as $member)
            <div class="team-card">
              <div class="team-image">
                @if($member->photo)
                  <img src="{{ asset($member->photo) }}" alt="{{ $member->name }}">
                @else
                  <div class="image-placeholder team-placeholder">
                    <span>{{ strtoupper(substr($member->name, 0, 1)) }}</span>
                  </div>
                @endif
              </div>
              <div class="team-content">
                <h3 class="team-name">{{ $member->name }}</h3>
                <p class="team-position">{{ $member->position }}</p>
                @if($member->bio)
                  <p class="team-bio">{{ \Illuminate\Support\Str::limit(strip_tags($member->bio), 100) }}</p>
                @endif
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>
  @endif

  <!-- LATEST BLOGS -->
  @if(!empty($blogs) && $blogs->count())
    <section class="blogs-section">
      <div class="container-custom">
        <div class="section-header">
          <h2 class="section-title">Latest News & Insights</h2>
          <p class="section-subtitle">Stay updated with our latest news and industry insights</p>
        </div>
        <div class="blogs-grid">
          @foreach($blogs as $blog)
            <div class="blog-card">
              <div class="blog-image">
                @if($blog->thumbnail)
                  <img src="{{ asset('storage/' . $blog->thumbnail) }}" alt="{{ $blog->title }}">
                @else
                  <div class="image-placeholder">
                    <span>📰</span>
                  </div>
                @endif
              </div>
              <div class="blog-content">
                <div class="blog-date">{{ $blog->published_at ? $blog->published_at->format('M d, Y') : '' }}</div>
                <h3 class="blog-title">{{ $blog->title }}</h3>
                <p class="blog-excerpt">
                  {{ \Illuminate\Support\Str::limit(strip_tags($blog->summary ?? $blog->content), 110) }}
                </p>
                <a href="{{ route('frontend.news.detail', $blog->id) }}" class="blog-link">Read More →</a>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>
  @endif


@endsection
@extends('frontend.layouts.app')

@section('content')

<!-- HERO SLIDER -->
<section class="hero-slider">
  <div class="slides" id="slides">
    @if(!empty($sliders) && $sliders->count())
      @foreach($sliders as $slide)
        <div class="slide" style="background-image: linear-gradient(90deg,rgba(124,58,237,0.7),rgba(6,182,212,0.7)), url('{{ $slide->image ? asset('storage/' . $slide->image) : '' }}'); background-size:cover; background-position:center;">
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
      <div class="slide" style="background-image: linear-gradient(rgba(0,0,0,0.1), rgba(0,0,0,0.1)), url('{{ asset('assets/slider1.png') }}'); background-size:cover; background-position:center;">
        <div class="overlay"></div>
        <div class="slide-content">
          <h2 class="title">Welcome to AOHT Group</h2>
          <p class="subtitle">Integrated business solutions across Hospitality, Technology, Real Estate, HR, and Consultancy</p>
          <a class="btn btn-light mt-4" href="#">Learn More</a>
        </div>
      </div>

      <!-- Slide 2 -->
      <div class="slide" style="background-image: linear-gradient(rgba(0,0,0,0.1), rgba(0,0,0,0.1)), url('{{ asset('assets/slider2.png') }}'); background-size:cover; background-position:center;">
        <div class="overlay"></div>
        <div class="slide-content">
          <h2 class="title">Innovation & Excellence</h2>
          <p class="subtitle">Delivering cutting-edge solutions with over a decade of industry expertise and commitment to quality</p>
          <a class="btn btn-light mt-4" href="#">Our Services</a>
        </div>
      </div>

      <!-- Slide 3 -->
      <div class="slide" style="background-image: linear-gradient(rgba(0,0,0,0.1), rgba(0,0,0,0.1)), url('{{ asset('assets/slider3.png') }}'); background-size:cover; background-position:center;">
        <div class="overlay"></div>
        <div class="slide-content">
          <h2 class="title">Transforming Businesses</h2>
          <p class="subtitle">Empowering organizations with comprehensive technology, hospitality, and consultancy solutions</p>
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
      <h2 class="section-title">Sale</h2>
    </div>
    <div class="categories-grid">
      <!-- Column 1: Kids -->
      <div class="category-column">
        <div class="category-card category-auto">
          <div class="category-image">
            <img src="{{ asset('assets/categories/kids.webp') }}" alt="Kids">
          </div>
          <div class="category-label">KIDS</div>
        </div>
      </div>

      <!-- Column 2: Ready to Wear & Ideas Home -->
      <div class="category-column">
        <div class="category-card category-half">
          <div class="category-image">
            <img src="{{ asset('assets/categories/Ready.webp') }}" alt="Ready to Wear">
          </div>
          <div class="category-label">READY TO WEAR</div>
        </div>
        <div class="category-card category-half">
          <div class="category-image">
            <img src="{{ asset('assets/categories/home.webp') }}" alt="AOHT Home">
          </div>
          <div class="category-label">AOHT HOME</div>
        </div>
      </div>

      <!-- Column 3: Salt by Ideas (Center Large) -->
      <div class="category-column">
        <div class="category-card category-full">
          <div class="category-image">
            <img src="{{ asset('assets/categories/salt.webp') }}" alt="Salt by Aoht">
          </div>
          <div class="category-label">SALT BY AOHT</div>
        </div>
      </div>

      <!-- Column 4: Women's Unstitched & Accessories -->
      <div class="category-column">
        <div class="category-card category-half">
          <div class="category-image">
            <img src="{{ asset('assets/categories/womens-women.webp') }}" alt="Women's Unstitched">
          </div>
          <div class="category-label">WOMEN'S UNSTITCHED</div>
        </div>
        <div class="category-card category-half">
          <div class="category-image">
            <img src="{{ asset('assets/categories/accessories.jpg') }}" alt="Accessories">
          </div>
          <div class="category-label">ACCESSORIES</div>
        </div>
      </div>

      <!-- Column 5: Men Eastern -->
      <div class="category-column">
        <div class="category-card category-auto">
          <div class="category-image">
            <img src="{{ asset('assets/categories/men-eastern.jpg') }}" alt="Men Eastern">
          </div>
          <div class="category-label">MEN EASTERN</div>
        </div>
      </div>
    </div>
  </div>
</section>

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
        <div class="service-card">
          <div class="service-icon">
            @if($service->icon)
              <img src="{{ asset('storage/' . $service->icon) }}" alt="{{ $service->service_name }}">
            @else
              <div class="icon-placeholder">{{ strtoupper(substr($service->service_name, 0, 1)) }}</div>
            @endif
          </div>
          <h3 class="service-title">{{ $service->service_name }}</h3>
          <p class="service-description">{{ \Illuminate\Support\Str::limit(strip_tags($service->description), 140) }}</p>
          <a href="#" class="service-link">Learn More →</a>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endif

<!-- FEATURED PROJECTS -->
@if(!empty($products) && $products->count())
<section class="projects-section">
  <div class="container-custom">
    <div class="section-header">
      <h2 class="section-title">Featured Projects</h2>
      <p class="section-subtitle">Showcasing our latest achievements and innovations</p>
    </div>
    <div class="projects-grid">
      @foreach($products as $product)
        <div class="project-card">
          <div class="project-image">
            @if($product->main_image)
              <img src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->product_name }}">
            @else
              <div class="image-placeholder">
                <span>📦</span>
              </div>
            @endif
          </div>
          <div class="project-content">
            <h3 class="project-title">{{ $product->product_name }}</h3>
            <p class="project-description">{{ \Illuminate\Support\Str::limit(strip_tags($product->description), 120) }}</p>
            <a href="#" class="project-link">View Details →</a>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endif

<!-- STATISTICS SECTION -->
<section class="stats-section">
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
              <img src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }}">
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
            <p class="blog-excerpt">{{ \Illuminate\Support\Str::limit(strip_tags($blog->summary ?? $blog->content), 110) }}</p>
            <a href="#" class="blog-link">Read More →</a>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endif

<!-- CTA SECTION -->
<section class="cta-section">
  <div class="container-custom">
    <div class="cta-content">
      <h2 class="cta-title">{{ $company->company_name ?? 'AOHT Group' }}</h2>
      <p class="cta-text">{{ $company->tagline ?? 'Integrated business solutions across Hospitality, Technology, Real Estate, HR, and Consultancy.' }}</p>
    </div>
    <div class="cta-contact">
      <p class="cta-label">Get in Touch</p>
      <p class="cta-details">
        <span>📞 {{ $company->phone ?? '+92 300 1234567' }}</span>
        <span>✉️ {{ $company->email ?? 'info@aohtgroup.com' }}</span>
      </p>
      <a href="#" class="btn btn-light">Contact Us</a>
    </div>
  </div>
</section>

@endsection

<footer class="site-footer">
  <div class="container">
    <div class="grid">

      <div>
        @if(isset($company) && $company->logo)
          <img src="{{ asset('storage/' . $company->logo) }}" style="width:160px; margin-bottom:1rem;" alt="{{ $company->company_name ?? 'AOHT' }}">
        @else
          <div style="font-size: 1.5rem; font-weight: 800; color: white; margin-bottom: 1rem;">AOHT GROUP</div>
        @endif
        <p style="line-height: 1.6;">{{ $company->about ?? 'AOHT Group provides integrated business solutions across Hospitality, Technology, Real Estate, HR, and Consultancy with over a decade of excellence and innovation.' }}</p>
      </div>

      <div>
        <h3>Company</h3>
        <ul>
          <li><a href="#">About Us</a></li>
          <li><a href="#">Leadership</a></li>
          <li><a href="#">Group Businesses</a></li>
          <li><a href="#">Careers</a></li>
          <li><a href="#">News & Updates</a></li>
        </ul>
      </div>

      <div>
        <h3>Services</h3>
        <ul>
          <li><a href="#">IT Solutions</a></li>
          <li><a href="#">Real Estate Services</a></li>
          <li><a href="#">HR Outsourcing</a></li>
          <li><a href="#">Hospitality Management</a></li>
          <li><a href="#">Consultancy</a></li>
        </ul>
      </div>

      <div>
        <h3>Contact</h3>
        <p style="line-height: 1.8;">
          <b>Address:</b><br>{{ $company->address ?? 'Karachi, Pakistan' }}<br><br>
          <b>Email:</b><br>{{ $company->email ?? 'info@aohtgroup.com' }}<br><br>
          <b>Phone:</b><br>{{ $company->phone ?? '+92 300 1234567' }}
        </p>
      </div>

    </div>

    <div class="copyright">
      © {{ now()->year }} {{ $company->company_name ?? 'AOHT Group' }} — All rights reserved | <a href="#">Privacy Policy</a> | <a href="#">Terms of Use</a>
    </div>
  </div>
</footer>

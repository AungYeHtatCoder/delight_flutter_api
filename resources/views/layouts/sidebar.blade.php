<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
 {{-- @foreach (Auth::user()->roles as $role)
 @if ($role->title === "Admin") --}}
 <li class=""><a href="{{ url('/home') }}"><i class="la la-home"></i><span class="menu-title"
    data-i18n="eCommerce Dashboard">Dashboard</span></a>
 </li>
 {{-- <li class=" navigation-header"><span data-i18n="Ecommerce">Delight</span><i class="la la-ellipsis-h"
   data-toggle="tooltip" data-placement="right" data-original-title="Ecommerce"></i>
 </li>
 <li class=" nav-item"><a href="#"><i class="la la-calendar"></i><span class="menu-title" data-i18n="Shop">My Content
    Calendar</span></a>
 </li>
 <li class=" nav-item"><a href="#"><i class="la la-calendar"></i><span class="menu-title" data-i18n="Shop">Client
    Calendar</span></a>
 </li> --}}

 <li class=" navigation-header"><span data-i18n="User Interface">User Interface</span><i class="la la-ellipsis-h"
   data-toggle="tooltip" data-placement="right" data-original-title="User Interface"></i>
 </li>
 @can('user_management_access')
 <li class=" nav-item">
  <a href="#">
   <i class="la la-server"></i>
   <span class="menu-title" data-i18n="Components">UserManagement</span>
  </a>
  <ul class="menu-content">
   @can('permission_access')
   <li><a class="menu-item" href="{{ route('admin.permissions.index') }}"><i></i><span
      data-i18n="Alerts">Permission</span></a>
   </li>
   @endcan
   @can('role_access')
   <li><a class="menu-item" href="{{ route('admin.roles.index') }}"><i></i><span data-i18n="Callout">Role</span></a>
   </li>
   @endcan
   @can('user_access')
   <li><a class="menu-item" href="{{ route('admin.users.index') }}"><i></i><span data-i18n="Basic Buttons">Users
     </span></a>
   </li>
   @endcan
   @can('user_access')
   <li><a class="menu-item" href="{{ route('admin.logActivity') }}"><i></i><span data-i18n="Basic Buttons">Users
      LogActivities
     </span></a>
   </li>
   @endcan
   <!-- <li><a class="menu-item" href="#"><i></i><span data-i18n="Basic Buttons">Our
      Clients
     </span></a>
   </li>
   <li><a class="menu-item" href="#"><i></i><span data-i18n="Basic Buttons">Our
      Teams
     </span></a>
   </li> -->
  </ul>
 </li>
 @endcan

 <li class=" nav-item"><a href="#"><i class="la la-clipboard"></i><span class="menu-title"
    data-i18n="Invoice">User Interface</span></a>
  <ul class="menu-content">
   <li><a class="menu-item" href="{{ url('/admin/banners/') }}"><i></i><span data-i18n="Invoice Summary">Ads Banner</span></a>
   </li>
   <li><a class="menu-item" href="{{ url('/admin/blogs/') }}"><i></i><span data-i18n="Invoice Template">Blog</span></a>
   </li>
   {{-- <li><a class="menu-item" href="invoice-list.html"><i></i><span data-i18n="Invoice List"></span></a> --}}
   </li>
  </ul>
 </li>


 {{-- <li class=" nav-item"><a href="#"><i class="la la-file-text"></i><span class="menu-title"
    data-i18n="Form Layouts">ArtManagenment</span></a>
  <ul class="menu-content">
   <li><a class="menu-item" href=""><i></i><span data-i18n="Basic Forms">Plans</span></a>
   </li>
   <li><a class="menu-item" href=""><i></i><span data-i18n="Basic Forms">Services</span></a>
   </li>
   <li><a class="menu-item" href=""><i></i><span data-i18n="Hidden Labels">Service
      Samples</span></a>
   </li>
  </ul>
 </li> --}}
 @can('product_management_access')
 <li class=" nav-item"><a href="#"><i class="la la-file-text"></i><span class="menu-title"
    data-i18n="Form Layouts">ProductManagenment</span></a>
  <ul class="menu-content">
   @can('brand_access')
   <li><a class="menu-item" href="{{ route('admin.brands.index') }}"><i></i><span
      data-i18n="Basic Forms">ProductBrand</span></a>
   </li>
   @endcan
   @can('scent_access')
   <li><a class="menu-item" href="{{ route('admin.scents.index') }}"><i></i><span
      data-i18n="Basic Forms">PerfumeScent</span></a>
   </li>
   @endcan
   @can('perfume_size_access')
   <li><a class="menu-item" href="{{ route('admin.sizes.index') }}"><i></i><span
      data-i18n="Basic Forms">PerfumeSize</span></a>
   </li>
   @endcan
   @can('product_access')
   <li><a class="menu-item" href="{{ route('admin.products.index') }}"><i></i><span
      data-i18n="Basic Forms">Product</span></a>
   </li>
   @endcan
  </ul>
 </li>
 @endcan

 {{-- <li class=" nav-item">
  <a href="#">
   <i class="la la-server"></i>
   <span class="menu-title" data-i18n="Components">Samples Details</span>
  </a>
  <ul class="menu-content">
   <li><a class="menu-item" href=""><i></i><span data-i18n="Alerts">Motion
      Video</span></a>
   </li>
   <li><a class="menu-item" href=""><i></i><span data-i18n="Alerts">Art
      Photo/Comic</span></a>
   </li>
   <li><a class="menu-item" href=""><i></i><span data-i18n="Alerts">Graphic
      Photo</span></a>
   </li>
   <li><a class="menu-item" href=""><i></i><span data-i18n="Alerts">Content</span></a>
   </li>

  </ul>
 </li> --}}
 {{-- @endif
 @endforeach --}}

 <!-- brand category -->
 @can('brand_category_access')
 <li class=" nav-item"><a href="{{ route('admin.brand_categories.index') }}"><i class="la la-list"></i><span
    class="menu-title" data-i18n="Product Detail">BrandCategory</span></a>
 </li>
 @endcan
 <!-- brand category  -->

 <!-- brand category -->
 @can('brand_access')
 <li class=" nav-item"><a href="{{ route('admin.brands.index') }}"><i class="la la-list"></i><span class="menu-title"
    data-i18n="Product Detail">Brand</span></a>
 </li>
 @endcan
 <!-- brand category  -->

 <li class=" nav-item"><a href="ecommerce-product-detail.html"><i class="la la-list"></i><span class="menu-title"
    data-i18n="Product Detail">Product Detail</span></a>
 </li>
 <li class=" nav-item"><a href="ecommerce-shopping-cart.html"><i class="la la-shopping-cart"></i><span
    class="menu-title" data-i18n="Shopping Cart">Shopping Cart</span></a>
 </li>
 <li class=" nav-item"><a href="ecommerce-checkout.html"><i class="la la-credit-card"></i><span class="menu-title"
    data-i18n="Checkout">Checkout</span></a>
 </li>
 <li class=" nav-item"><a href="ecommerce-order.html"><i class="la la-check-circle-o"></i><span class="menu-title"
    data-i18n="Order">Order</span></a>
 </li>
 <li class=" nav-item"><a href="#"><i class="la la-clipboard"></i><span class="menu-title"
    data-i18n="Invoice">Invoice</span></a>
  <ul class="menu-content">
   <li><a class="menu-item" href="invoice-summary.html"><i></i><span data-i18n="Invoice Summary">Invoice
      Summary</span></a>
   </li>
   <li><a class="menu-item" href="invoice-template.html"><i></i><span data-i18n="Invoice Template">Invoice
      Template</span></a>
   </li>
   <li><a class="menu-item" href="invoice-list.html"><i></i><span data-i18n="Invoice List">Invoice List</span></a>
   </li>
  </ul>
 </li>

 {{-- <li class=" nav-item"><a href="#"><i class="la la-unlock"></i><span class="menu-title"
    data-i18n="Authentication">Authentication</span></a>
  <ul class="menu-content">
   <li><a class="menu-item" href="login-with-bg-image.html" target="_blank"><i></i><span>Login</span></a>
   </li>
   <li><a class="menu-item" href="register-with-bg-image.html" target="_blank"><i></i><span>SignIn</span></a>
   </li>
   <li><a class="menu-item" href="recover-password.html" target="_blank"><i></i><span>Forgot Password</span></a>
   </li>
  </ul>
 </li> --}}

 {{-- <li class=" nav-item"><a href="#"><i class="la la-paste"></i><span class="menu-title" data-i18n="Form Wizard">Form
    Wizard</span></a>
  <ul class="menu-content">
   <li><a class="menu-item" href="form-wizard-circle-style.html"><i></i><span data-i18n="Circle Style">Circle
      Style</span></a>
   </li>
   <li><a class="menu-item" href="form-wizard-notification-style.html"><i></i><span
      data-i18n="Notification Style">Notification Style</span></a>
   </li>
  </ul>
 </li> --}}
</ul>

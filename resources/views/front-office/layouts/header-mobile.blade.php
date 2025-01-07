 <!-- mobile menu -->
 <div class="offcanvas offcanvas-start canvas-mb" id="mobileMenu">
     <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
     <div class="mb-canvas-content">
         <div class="mb-body">
             <ul class="nav-ul-mb" id="wrapper-menu-navigation">
                 <li class="nav-mb-item">
                     <a href="/" class="item-link">Home</a>
                 </li>
                 <li class="nav-mb-item">
                     <a href="/shop" class="item-link">Products</a>
                 </li>
                 <li class="nav-mb-item">
                     <a href="#dropdown-menu-three" class="collapsed mb-menu-link current"
                         data-bs-toggle="collapse" aria-expanded="true" aria-controls="dropdown-menu-three">
                         <span>Categories</span>
                         <span class="btn-open-sub"></span>
                     </a>
                     <div id="dropdown-menu-three" class="collapse">
                         <ul class="sub-nav-menu" id="sub-menu-navigation">
                             @foreach($categories as $category)
                             <li><a href="/shop/{{ $category->slug}}" class="menu-link-text link text_black-2">{{ $category->name}}</a></li>
                             @endforeach
                         </ul>
                     </div>
                 </li>
                 <li class="nav-mb-item"><a href="/contact" class="item-link">Contact</a></li>
             </ul>
         </div>
     </div>
 </div>
 <!-- /mobile menu -->
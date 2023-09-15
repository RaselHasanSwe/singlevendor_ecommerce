<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">Main</li>
                <li>
                    <a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fa fa-user"></i> <span> Categories </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a class="{{ request()->routeIs('admin.category.*') ? 'active' : '' }}" href="{{ route('admin.category.index') }}">Category</a></li>
                        <li><a class="{{ request()->routeIs('admin.sub-category.*') ? 'active' : '' }}" href="{{ route('admin.sub-category.index') }}">Sub Category</a></li>
                        <li><a class="{{ request()->routeIs('admin.inner-category.*') ? 'active' : '' }}" href="{{ route('admin.inner-category.index') }}">Inner Category</a></li>
                    </ul>
                </li>

                <li>
                    <a class="{{ request()->routeIs('admin.size.*') ? 'active' : '' }}" href="{{ route('admin.size.index') }}"><i class="fa fa-user-md"></i> <span>Manage Size</span></a>
                </li>
                <li>
                    <a class="{{ request()->routeIs('admin.color.*') ? 'active' : '' }}" href="{{ route('admin.color.index') }}"><i class="fa fa-user-md"></i> <span>Manage Color</span></a>
                </li>
                <li>
                    <a class="{{ request()->routeIs('admin.shipping.*') ? 'active' : '' }}" href="{{ route('admin.shipping.index') }}"><i class="fa fa-user-md"></i> <span>Manage Shipping</span></a>
                </li>

                <li>
                    <a class="{{ request()->routeIs('admin.product.*') ? 'active' : '' }}" href="{{ route('admin.product.index') }}"><i class="fa fa-user-md"></i> <span>Manage Product</span></a>
                </li>

                <li>
                    <a class="{{ request()->routeIs('admin.admin-setting.*') ? 'active' : '' }}" href="{{ route('admin.admin-setting') }}"><i class="fa fa-user-md"></i> <span>Admin Setting</span></a>
                </li>
                <li>
                    <a class="{{ request()->routeIs('admin.website-setting.*') ? 'active' : '' }}" href="{{ route('admin.website-setting') }}"><i class="fa fa-user-md"></i> <span>Website Setting</span></a>
                </li>
                <li>
                    <a class="{{ request()->routeIs('admin.website-policy.*') ? 'active' : '' }}" href="{{ route('admin.website-policy') }}"><i class="fa fa-user-md"></i> <span>Website Policies</span></a>
                </li>
                <li>
                    <a class="{{ request()->routeIs('admin.coupon.*') ? 'active' : '' }}" href="{{ route('admin.coupon.index') }}"><i class="fa fa-user-md"></i> <span>Manage Coupon</span></a>
                </li>
                <li>
                    <a class="{{ request()->routeIs('admin.slider.*') ? 'active' : '' }}" href="{{ route('admin.slider.index') }}"><i class="fa fa-user-md"></i> <span>Manage Slider</span></a>
                </li>

                <li>
                    <a class="{{ request()->routeIs('admin.faq.*') ? 'active' : '' }}" href="{{ route('admin.faq.index') }}"><i class="fa fa-user-md"></i> <span>Manage FAQ</span></a>
                </li>
                <li>
                    <a class="{{ request()->routeIs('admin.team.*') ? 'active' : '' }}" href="{{ route('admin.team.index') }}"><i class="fa fa-user-md"></i> <span>Manage Team</span></a>
                </li>
                <li>
                    <a class="{{ request()->routeIs('admin.happy-customer.*') ? 'active' : '' }}" href="{{ route('admin.happy-customer.index') }}"><i class="fa fa-user-md"></i> <span>Happy Customer</span></a>
                </li>

                <li>
                    <a href="{{ route('admin.contact') }}"><i class="fa fa-user-md"></i> <span>Contact Message</span></a>
                </li>

            </ul>
        </div>
    </div>
</div>

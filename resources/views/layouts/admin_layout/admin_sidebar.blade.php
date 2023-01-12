<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('admin/dashboard') }}" class="brand-link">
      
      <span class="brand-text font-weight-light">MyProject</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
    

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

         
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
       
          <li class="nav-item">
            @if(Session::get('page')=="dashboard")
            <?php $active ="active";?>
            @else 
            <?php $active ="";?>@endif 
            <a href="{{ url('admin/dashboard') }}" class="nav-link {{ $active }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Панель управления
                
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
               CRM
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/layout/top-nav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Лиды</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Сделки</p>
                </a>
              </li>

   @if(Session::get('page')=="customers")
            <?php $active ="active";?>
            @else 
            <?php $active ="";?>
            @endif


              <li class="nav-item">
                <a href="{{url('admin/customers') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Контакты</p>
                </a>
              </li>
              
         
            </ul>
          </li>
           @if(Session::get('page')=="sections")
            <?php $active ="active";?>
            @else 
            <?php $active ="";?>
            @endif 
          <li class="nav-item has-treeview">




            <a href="#" class="nav-link {{ $active }}">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Сайт
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                      @if(Session::get('page')=="sections")
            <?php $active ="active";?>
            @else 
            <?php $active ="";?>
            @endif
              <li class="nav-item">

                <a href="{{ url('admin/sections') }}" class="nav-link {{ $active }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Разделы</p>
                </a>
              </li>

               @if(Session::get('page')=="categories")
            <?php $active ="active";?>
            @else 
            <?php $active ="";?>
            @endif
              <li class="nav-item">
                <a href="{{url('admin/categories') }}" class="nav-link {{ $active }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Категории</p>
                </a>
              </li>
               @if(Session::get('page')=="products")
            <?php $active ="active";?>
            @else 
            <?php $active ="";?>
            @endif
              <li class="nav-item">
                <a href="{{url('admin/products') }}" class="nav-link {{ $active }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Товары</p>
                </a>
              </li>
              @if(Session::get('page')=="brands")
            <?php $active ="active";?>
            @else 
            <?php $active ="";?>
            @endif
              <li class="nav-item">
                <a href="{{url('admin/brands') }}" class="nav-link {{ $active }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Производители</p>
                </a>
              </li>
               @if(Session::get('page')=="banners")
            <?php $active ="active";?>
            @else 
            <?php $active ="";?>
            @endif
              <li class="nav-item">
                <a href="{{url('admin/banners') }}" class="nav-link {{ $active }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Баннеры</p>
                </a>
              </li>

              
             
            </ul>
          </li>
         
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Складской учет
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            	   @if(Session::get('page')=="suppliers")
            <?php $active ="active";?>
            @else 
            <?php $active ="";?>
            @endif
              <li class="nav-item">
                <a href="{{url('admin/suppliers') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Поставщики</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="salesinvoices" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Расходные накладные</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="receipts" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Приходные накладные</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="invoices" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Счета на оплату</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="adjustments" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Списание остатков</p>
                </a>
              </li>
            </ul>
          </li>




<li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
              Настройки
                <i class="fas fa-angle-left right"></i>
              
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="currency" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Валюты</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="warehouses" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Склады</p>
                </a>
              </li>     
              <li class="nav-item">
                <a href="admins" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Пользователи</p>
                </a>
              </li>
             <li class="nav-item">
                <a href="roles" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Роли пользователей</p>
                </a>
              </li>

              
             
            </ul>
          </li>


          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Аналитика
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/tables/simple.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Simple Tables</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/data.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>DataTables</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/jsgrid.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>jsGrid</p>
                </a>
              </li>
            </ul>
          </li>
         
          <li class="nav-item">
            <a href="pages/calendar.html" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Календарь
                <span class="badge badge-info right">2</span>
              </p>
            </a>
          </li>
        
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Почта
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/mailbox/mailbox.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inbox</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/mailbox/compose.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Compose</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/mailbox/read-mail.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Read</p>
                </a>
              </li>
            </ul>
          </li>
          
          </li>
         
          
          <li class="nav-header">LABELS</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p class="text">Important</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-warning"></i>
              <p>Warning</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Informational</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

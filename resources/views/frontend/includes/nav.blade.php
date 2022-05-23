<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container-xxl">
        
         <a href="{{route('frontend.index')}}" class="navbar-brand"><img style="max-height:250px;" src="{{ Storage::url(App\Models\Setting::find('app_logo')->value)}}"></a>  

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="@lang('Toggle navigation')">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                @if(config('boilerplate.locale.status') && count(config('boilerplate.locale.languages')) > 1)
                    <li class="nav-item dropdown">
                        <x-utils.link
                            :text="__(getLocaleName(app()->getLocale()))"
                            class="nav-link dropdown-toggle"
                            id="navbarDropdownLanguageLink"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false" />

                        @include('includes.partials.lang')
                    </li>
                @endif
                <li class="nav-item">
                    <x-utils.link
                        :href="route('frontend.index')"
                        :active="activeClass(Route::is('frontend.index'))"
                        :text="__('Home')"
                        icon="fas fa-home"
                        class="nav-link" />
                </li>
                <li class="nav-item">
                    <x-utils.link
                        :href="route('frontend.visit')"
                        :active="activeClass(Route::is('frontend.visit'))"
                        :text="__('Visita')"
                        icon="fas fa-eye"
                        class="nav-link" />
                </li>
                <li class="nav-item">
                    <x-utils.link
                        :href="route('frontend.order')"
                        :active="activeClass(Route::is('frontend.order'))"
                        :text="__('Ordina')"
                        icon="fas fa-shopping-basket"
                        class="nav-link" />
                </li>
              
                {{--<li class="nav-item">
                    <x-utils.link
                        :href="route('frontend.auth.login')"
                        :active="activeClass(Route::is('frontend.auth.login'))"
                        :text="__('Contatti')"
                        icon="fas fa-book"
                        class="nav-link" />
                </li>--}}
              
               
                @guest
                    <li class="nav-item">
                        <x-utils.link
                            :href="route('frontend.auth.login')"
                            :active="activeClass(Route::is('frontend.auth.login'))"
                            icon="fas fa-lock"
                           
                            class="nav-link btn btn-primary text-white p-2 btn-rotondo" />
                    </li>

                    @if (config('boilerplate.access.user.registration'))
                        <li class="nav-item">
                            <x-utils.link
                                :href="route('frontend.auth.register')"
                                :active="activeClass(Route::is('frontend.auth.register'))"
                                :text="__('Register')"
                                class="nav-link" />

                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <x-utils.link
                            href="#"
                            id="navbarDropdown"
                            class="nav-link dropdown-toggle"
                            role="button"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                            v-pre
                        >
                            <x-slot name="text">
                                <img class="rounded-circle" style="max-height: 20px" src="{{ $logged_in_user->avatar }}" />
                                <span class="caret"></span>
                            </x-slot>
                        </x-utils.link>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <span class="dropdown-item">{{ $logged_in_user->name }}</span>
                            @if ($logged_in_user->isAdmin())
                                <x-utils.link
                                    :href="route('admin.dashboard')"
                                    :text="__('Administration')"
                                    class="dropdown-item" />
                            @endif

                            @if ($logged_in_user->isUser())
                                <x-utils.link
                                    :href="route('frontend.user.dashboard')"
                                    :active="activeClass(Route::is('frontend.user.dashboard'))"
                                    :text="__('Dashboard')"
                                    class="dropdown-item"/>
                            @endif

                            <x-utils.link
                                :href="route('frontend.user.account')"
                                :active="activeClass(Route::is('frontend.user.account'))"
                                :text="__('My Account')"
                                class="dropdown-item" />

                            <x-utils.link
                                :text="__('Logout')"
                                class="dropdown-item"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <x-slot name="text">
                                    @lang('Logout')
                                    <x-forms.post :action="route('frontend.auth.logout')" id="logout-form" class="d-none" />
                                </x-slot>
                            </x-utils.link>
                        </div>
                    </li>
                @endguest
              
            </ul>
        </div><!--navbar-collapse-->
    </div><!--container-->
</nav>

@if (config('boilerplate.frontend_breadcrumbs'))
    @include('frontend.includes.partials.breadcrumbs')
@endif

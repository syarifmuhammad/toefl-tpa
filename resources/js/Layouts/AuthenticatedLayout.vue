<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div class="h-screen overflow-hidden bg-gray-100 grid sm:grid-cols-[80px_auto]">
        <aside class="h-full overflow-hidden bg-merah-primary relative hidden sm:block">
            <div class="mb-36 flex justify-center py-4">
                <div>
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M9.48149 32L32 32L22.5185 22.5185L3.05176e-05 22.5185L9.48149 32ZM22.5185 22.5185L22.5185 0L32 9.48146V31.9999L22.5185 22.5185Z"
                            fill="white" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M22.5185 0H4.3869e-05L9.4815 9.48146H32L22.5185 0ZM9.48146 9.48156V32L0 22.5186V0.000100493L9.48146 9.48156Z"
                            fill="#CCCCCC" />
                    </svg>
                </div>
            </div>
            <nav class="flex flex-col">
                <Link :href="route('dashboard')" class="w-full hover:bg-merah-secondary flex justify-center py-8" :class="{
                    'bg-merah-secondary': route().current('dashboard') || route().current('index')
                }">
                <div>
                    <svg width="32" height="35" viewBox="0 0 32 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M4 31H10V19H22V31H28V13L16 4L4 13V31ZM4 35C2.9 35 1.958 34.608 1.174 33.824C0.390003 33.04 -0.00132994 32.0987 3.39559e-06 31V13C3.39559e-06 12.3667 0.142003 11.7667 0.426003 11.2C0.710003 10.6333 1.10134 10.1667 1.6 9.8L13.6 0.8C13.9667 0.533333 14.35 0.333333 14.75 0.2C15.15 0.0666664 15.5667 0 16 0C16.4333 0 16.85 0.0666664 17.25 0.2C17.65 0.333333 18.0333 0.533333 18.4 0.8L30.4 9.8C30.9 10.1667 31.292 10.6333 31.576 11.2C31.86 11.7667 32.0013 12.3667 32 13V31C32 32.1 31.608 33.042 30.824 33.826C30.04 34.61 29.0987 35.0013 28 35H18V23H14V35H4Z"
                            fill="#F8F8F8" />
                    </svg>
                </div>
                </Link>
                <Link :href="route('exam.history')" class="w-full hover:bg-merah-secondary flex justify-center py-8" :class="{
                    'bg-merah-secondary': route().current('exam.history')
                }">
                <div>
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M16 32C11.9111 32 8.34785 30.6441 5.31022 27.9324C2.27259 25.2207 0.532148 21.8358 0.0888888 17.7778H3.73333C4.14815 20.8593 5.51881 23.4074 7.84533 25.4222C10.1719 27.437 12.8901 28.4444 16 28.4444C19.4667 28.4444 22.4077 27.2367 24.8231 24.8213C27.2385 22.4059 28.4456 19.4655 28.4444 16C28.4444 12.5333 27.2367 9.5923 24.8213 7.17689C22.4059 4.76148 19.4655 3.55437 16 3.55556C13.9556 3.55556 12.0444 4.02963 10.2667 4.97778C8.48889 5.92593 6.99259 7.22963 5.77778 8.88889H10.6667V12.4444H0V1.77778H3.55556V5.95555C5.06667 4.05926 6.91141 2.59259 9.08978 1.55556C11.2681 0.518519 13.5716 0 16 0C18.2222 0 20.304 0.422519 22.2453 1.26756C24.1867 2.11259 25.8756 3.25274 27.312 4.688C28.7484 6.12563 29.8892 7.81452 30.7342 9.75467C31.5793 11.6948 32.0012 13.7766 32 16C32 18.2222 31.5775 20.304 30.7324 22.2453C29.8874 24.1867 28.7473 25.8756 27.312 27.312C25.8744 28.7484 24.1855 29.8892 22.2453 30.7342C20.3052 31.5793 18.2234 32.0012 16 32ZM20.9778 23.4667L14.2222 16.7111V7.11111H17.7778V15.2889L23.4667 20.9778L20.9778 23.4667Z"
                            fill="#F8F8F8" />
                    </svg>
                </div>

                </Link>
                <Link :href="route('profile.index')" class="w-full hover:bg-merah-secondary flex justify-center py-8"
                    :class="{
                        'bg-merah-secondary': route().current('profile.*')
                    }">
                <div>
                    <svg width="32" height="36" viewBox="0 0 32 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M23.1111 21.3333C25.4017 21.3335 27.6038 22.2178 29.2583 23.8021C30.9127 25.3863 31.8917 27.548 31.9911 29.8364L32 30.2222V32C32.0003 32.897 31.6615 33.761 31.0516 34.4188C30.4416 35.0765 29.6056 35.4794 28.7111 35.5467L28.4444 35.5556H3.55556C2.65853 35.5558 1.79455 35.2171 1.1368 34.6071C0.479059 33.9972 0.0761659 33.1612 0.00888909 32.2667L0 32V30.2222C0.000132342 27.9316 0.884519 25.7295 2.46873 24.0751C4.05294 22.4206 6.21467 21.4416 8.50311 21.3422L8.88889 21.3333H23.1111ZM23.1111 24.8889H8.88889C7.52851 24.8888 6.21953 25.4086 5.22976 26.3418C4.23999 27.2751 3.64425 28.5513 3.56444 29.9093L3.55556 30.2222V32H28.4444V30.2222C28.4445 28.8618 27.9248 27.5529 26.9915 26.5631C26.0582 25.5733 24.782 24.9776 23.424 24.8978L23.1111 24.8889ZM16 0C18.3575 0 20.6184 0.936505 22.2854 2.6035C23.9524 4.27048 24.8889 6.53141 24.8889 8.88889C24.8889 11.2464 23.9524 13.5073 22.2854 15.1743C20.6184 16.8413 18.3575 17.7778 16 17.7778C13.6425 17.7778 11.3816 16.8413 9.71461 15.1743C8.04762 13.5073 7.11111 11.2464 7.11111 8.88889C7.11111 6.53141 8.04762 4.27048 9.71461 2.6035C11.3816 0.936505 13.6425 0 16 0ZM16 3.55556C15.2996 3.55556 14.6061 3.69351 13.959 3.96153C13.312 4.22956 12.724 4.62241 12.2288 5.11765C11.7335 5.6129 11.3407 6.20084 11.0726 6.84791C10.8046 7.49498 10.6667 8.18851 10.6667 8.88889C10.6667 9.58927 10.8046 10.2828 11.0726 10.9299C11.3407 11.5769 11.7335 12.1649 12.2288 12.6601C12.724 13.1554 13.312 13.5482 13.959 13.8162C14.6061 14.0843 15.2996 14.2222 16 14.2222C17.4145 14.2222 18.771 13.6603 19.7712 12.6601C20.7714 11.6599 21.3333 10.3034 21.3333 8.88889C21.3333 7.4744 20.7714 6.11785 19.7712 5.11765C18.771 4.11746 17.4145 3.55556 16 3.55556Z"
                            fill="#F8F8F8" />
                    </svg>
                </div>

                </Link>
            </nav>
        </aside>
        <div class="min-h-full overflow-y-scroll">
            <header class="bg-white sticky top-0">
                <!-- Primary Navigation Menu -->
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">

                            <!-- Ganti breadcrum nanti -->
                            <slot name="breadcrumb" />
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                Hello, {{ $page.props.auth.user.name }}

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink :href="route('profile.index')"> Profile </DropdownLink>
                                        <DropdownLink :href="route('logout')" method="post" as="button">
                                            Log Out
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button @click="showingNavigationDropdown = !showingNavigationDropdown"
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{
                                        hidden: showingNavigationDropdown,
                                        'inline-flex': !showingNavigationDropdown,
                                    }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{
                                        hidden: !showingNavigationDropdown,
                                        'inline-flex': showingNavigationDropdown,
                                    }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }" class="sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Dashboard
                        </ResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800">
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('profile.index')"> Profile </ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>

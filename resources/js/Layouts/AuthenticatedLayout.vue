<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
// import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import DashboardIcon from '@/Components/IconMenu/Dashboard.vue';
import HistoryIcon from '@/Components/IconMenu/History.vue';
import ProfileIcon from '@/Components/IconMenu/Profile.vue';
import JadwalTesIcon from '@/Components/IconMenu/JadwalTes.vue';
import LegalisirIcon from '@/Components/IconMenu/Legalisir.vue';
import PembayaranIcon from '@/Components/IconMenu/Pembayaran.vue';
import SoalIcon from '@/Components/IconMenu/Soal.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
const sidebar_open = ref(false)
const is_admin = ref(true)
</script>

<template>
    <div class="h-screen overflow-hidden bg-gray-100 flex">
        <Teleport to="body">
            <div v-if="sidebar_open" class="w-full h-full bg-black/50 absolute top-0 left-0 z-20"></div>
        </Teleport>
        <aside
            class="fixed top-0 w-[350px] h-screen transition-all z-30 overflow-y-auto overflow-x-hidden bg-merah-primary sm:block"
            @mouseenter="sidebar_open = true" @mouseleave="sidebar_open = false"
            :class="sidebar_open ? 'w-[350px]' : 'w-[80px]'">
            <div class="mb-24 px-[24px] flex py-8">
                <div class="flex gap-x-6">
                    <ApplicationLogo />
                    <span class="text-white text-xl">Logo</span>
                </div>
            </div>
            <nav class="flex flex-col w-full">
                <template v-if="!is_admin">
                    <Link :href="route('dashboard')" class="w-[350px] h-[76px] hover:bg-merah-secondary flex py-5 px-[24px]" :class="{
                        'bg-merah-secondary': route().current('dashboard') || route().current('index') || route().current('exam.detail') || route().current('exam.payment'),

                    }">
                    <div class="flex items-center text-white font-medium text-md gap-x-6">
                        <DashboardIcon />
                        <span class="mt-1">Dashboard</span>
                    </div>
                    </Link>
                    <Link :href="route('exam.history')" class="w-[350px] h-[76px] hover:bg-merah-secondary flex py-5 px-[24px]"
                        :class="{
                            'bg-merah-secondary': route().current('exam.history') | route().current('exam.history.*'),
                        }">
                    <div class="flex items-center text-white font-medium text-md gap-x-6">
                        <HistoryIcon />
                        <span class="inline-block">Riwayat Ujian</span>
                    </div>

                    </Link>
                    <Link :href="route('profile.index')" class="w-[350px] h-[76px] hover:bg-merah-secondary flex py-5 px-[24px]"
                        :class="{
                            'bg-merah-secondary': route().current('profile.*'),
                        }">
                    <div class="flex items-center text-white font-medium text-md gap-x-6">
                        <ProfileIcon />
                        <span>Akun Profile</span>
                    </div>
                    </Link>
                </template>
                <template v-else>
                    <Link :href="route('admin.dashboard')" class="w-[350px] h-[76px] hover:bg-merah-secondary flex py-5 px-[24px]" :class="{
                        'bg-merah-secondary': route().current('admin.dashboard') || route().current('index'),

                    }">
                    <div class="flex items-center text-white font-medium text-md gap-x-6">
                        <DashboardIcon />
                        <span class="mt-1">Dashboard</span>
                    </div>
                    </Link>
                    <Link :href="route('admin.jadwal_tes.index')" class="w-[350px] h-[76px] hover:bg-merah-secondary flex py-5 px-[20px]"
                        :class="{
                            'bg-merah-secondary': route().current('admin.jadwal_tes.*'),
                        }">
                    <div class="flex items-center text-white font-medium text-md gap-x-6">
                        <JadwalTesIcon class="w-[40px] h-[40px]" />
                        <span class="inline-block">Jadwal Tes</span>
                    </div>

                    </Link>
                    <Link :href="route('admin.legalisir.index')" class="w-[350px] h-[76px] hover:bg-merah-secondary flex py-5 px-[17px]"
                        :class="{
                            'bg-merah-secondary': route().current('admin.legalisir.*'),
                        }">
                    <div class="flex items-center text-white font-medium text-md gap-x-6">
                        <LegalisirIcon class="w-[46px]" />
                        <span>Legalisir</span>
                    </div>
                    </Link>
                    <Link :href="route('profile.index')" class="w-[350px] h-[76px] hover:bg-merah-secondary flex py-5 px-[24px]"
                        :class="{
                            'bg-merah-secondary': route().current('profile.*'),
                        }">
                    <div class="flex items-center text-white font-medium text-md gap-x-6">
                        <PembayaranIcon class="w-[32px]" />
                        <span>Pembayaran</span>
                    </div>
                    </Link>
                    <Link :href="route('admin.bank_soal.index')" class="w-[350px] h-[76px] hover:bg-merah-secondary flex py-5 px-[22px]"
                        :class="{
                            'bg-merah-secondary': route().current('admin.bank_soal.*'),
                        }">
                    <div class="flex items-center text-white font-medium text-md gap-x-6">
                        <SoalIcon class="w-[36px]" />
                        <span>Soal</span>
                    </div>
                    </Link>
                </template>
            </nav>
        </aside>
        <div class="min-h-full overflow-y-scroll w-full ml-[80px]">
            <header class="bg-white sticky top-0 z-10">
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
                                                <!-- Hello, {{ $page.props.auth.user.name ?? 'Admin' }} -->

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
                                <!-- {{ $page.props.auth.user.name ?? "Admin" }} -->
                            </div>
                            <!-- <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div> -->
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

<style>
.tox-tinymce {
    z-index: 1;
}</style>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Modal from "@/Components/Modal.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import SecondaryButton2 from "@/Components/SecondaryButton2.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref, defineProps } from "vue";
import moment from 'moment/min/moment-with-locales'
moment.locale('id')

defineProps({
  schedules: Object,
  questionbanks: Array,
})


const formJadwalTes = useForm({
  id: null,
  tanggal: '',
  waktu: '',
  kuota: '',
  questionbank_id: null,
});

const message_errors = ref("");

const modal = ref(false);
const modal_delete = ref(false);

const editSchedule = (schedule, edit = true) => {
  formJadwalTes.id = schedule.id
  formJadwalTes.tanggal = moment(schedule.tanggal).format("YYYY-MM-DD")
  formJadwalTes.waktu = moment(schedule.tanggal).format("HH:mm")
  formJadwalTes.kuota = schedule.kuota
  formJadwalTes.questionbank_id = schedule.questionbank_id
  if (edit) {
    modal.value = true
  } else {
    modal_delete.value = true
    message_errors.value = "Anda yakin ingin menghapus Jadwal ini?"
  }
}

const submit = () => {
  if (formJadwalTes.id == null) {
    formJadwalTes.post(route('admin.jadwal_tes.store'), {
      onSuccess: () => {
        modal.value = false,
          formJadwalTes.reset()
      },
      onError: (errors) => {
        console.log(errors)
      }
    })
  } else {
    formJadwalTes.put(route('admin.jadwal_tes.update', formJadwalTes.id), {
      onSuccess: () => {
        modal.value = false,
          formJadwalTes.reset()
      },
      onError: (errors) => {
        console.log(errors)
      }
    })
  }
}

const closeModal = (is_delete = false) => {
  console.log(is_delete)
  if (is_delete) {
    modal_delete.value = false
  } else {
    modal.value = false
  }
  formJadwalTes.reset()
}

const remove = () => {
  formJadwalTes.delete(route('admin.jadwal_tes.destroy', formJadwalTes.id), {
    onSuccess: () => {
      modal_delete.value = false,
        formJadwalTes.reset()
    },
    onError: (errors) => {
      console.log(errors)
    }
  })
}

</script>

<template>
  <Head title="Jadwal Tes" />
  <AuthenticatedLayout>
    <template #breadcrumb>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dashboard > Jadwal Tes
      </h2>
    </template>
    <Modal :maxWidth="'xl'" :show="modal" @close="closeModal()">
      <form class="p-5" @submit.prevent="submit">
        <div>
          <InputLabel class="mb-2">Detail Jadwal</InputLabel>
          <div class="flex gap-x-2">
            <div class="w-6/12">
              <TextInput class="w-full" type="date" placeholder="hari/bulan/tahun" required
                v-model="formJadwalTes.tanggal">
              </TextInput>
              <InputError class="mt-2" :message="formJadwalTes.errors.tanggal" />
            </div>
            <div class="w-3/12">
              <TextInput class="w-full" type="time" placeholder="Waktu" required v-model="formJadwalTes.waktu">
              </TextInput>
              <InputError class="mt-2" :message="formJadwalTes.errors.waktu" />
            </div>
            <div class="w-3/12">
              <TextInput class="w-full" type="number" placeholder="Kuota" required v-model="formJadwalTes.kuota">
              </TextInput>
              <InputError class="mt-2" :message="formJadwalTes.errors.kuota" />
            </div>
          </div>
        </div>
        <div class="mt-4">
          <InputLabel class="mb-2">Bank Soal</InputLabel>
          <select requried class="border-abu-text rounded-md shadow-sm focus:border-2 focus:ring-0 w-full"
            :class="{ 'text-black/70': formJadwalTes.questionbank_id == '' }" v-model="formJadwalTes.questionbank_id">
            <option selected value="" disabled>Pilih bank soal</option>
            <option v-for="questionbank in questionbanks" :value="questionbank.id">{{ questionbank.category }} - {{
              questionbank.name }}</option>
          </select>
        </div>
        <div class="flex justify-between gap-x-4 mt-4">
          <PrimaryButton :disabled="formJadwalTes.processing" class="w-full flex justify-center">
            {{ formJadwalTes.id != null ? 'Ubah' : 'Tambah' }}
          </PrimaryButton>
          <SecondaryButton class="w-full flex justify-center" :type="'button'" @click="closeModal()">Batal
          </SecondaryButton>
        </div>
      </form>
    </Modal>

    <Modal :show="modal_delete" @close="closeModal(true)">
      <div class="p-8 flex flex-col justify-between items-center relative">
        <svg class="absolute right-8 cursor-pointer" @click="closeModal(true)" width="43" height="43" viewBox="0 0 86 86"
          fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M53.2942 32.7051L32.0986 53.9006M53.2942 53.9007L32.0986 32.7051" stroke="#5F6D7E"
            stroke-width="3.53966" stroke-linecap="round" />
        </svg>
        <svg width="45" height="45" viewBox="0 0 69 69" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M34.9115 48.9145V31.958M34.9115 23.4798V23.4515M65.9983 34.7841C65.9983 51.9529 52.0803 65.8709 34.9115 65.8709C17.7427 65.8709 3.82471 51.9529 3.82471 34.7841C3.82471 17.6153 17.7427 3.69727 34.9115 3.69727C52.0803 3.69727 65.9983 17.6153 65.9983 34.7841Z"
            stroke="#A22122" stroke-width="4.23911" stroke-linecap="round" />
        </svg>
        <div class="text-center mt-4">
          <h1 class="font-medium text-lg mb-3">Peringatan</h1>
          <p class="text-abu-text">{{ message_errors }}</p>
        </div>
        <PrimaryButton :disabled="formJadwalTes.processing" class="px-4 w-full flex justify-center mt-3" @click="remove">Continue</PrimaryButton>
      </div>
    </Modal>

    <section class="mt-8 px-4 sm:px-6 lg:px-8 w-full">
      <h1 class="font-semibold text-lg text-merah-component pb-1 border-merah-component">
        List Jadwal Tes
      </h1>
      <div class="bg-white rounded-lg mt-4 px-8 py-6">
        <table class="w-full border-b-2 border-abu-component text-medium">
          <thead class="text-merah-component">
            <tr class="border-b-2 border-abu-component">
              <th class="py-5">No. </th>
              <th class="py-5">Soal</th>
              <th class="py-5">Tanggal</th>
              <th class="py-5">Waktu</th>
              <th class="py-5">Maks. Peserta</th>
              <th class="py-5">Action</th>
            </tr>
          </thead>
          <tbody class="text-center">
            <tr v-for="(schedule, n) in schedules.data" class="border-b-2 border-abu-component">
              <td>{{ n + 1 }}</td>
              <td class="py-5">{{ schedule.questionbank.name }}</td>
              <td class="py-5">{{ moment(schedule.tanggal).format('DD MMMM YYYY') }}</td>
              <td class="py-5">{{ moment(schedule.tanggal).format('HH:mm') }} WIB</td>
              <td class="py-5">{{ schedule.kuota }}</td>
              <td class="py-5">
                <div class="flex gap-x-4 justify-center">
                  <PrimaryButton class="px-4" @click="editSchedule(schedule)">Ubah
                  </PrimaryButton>
                  <SecondaryButton2 class="px-4" @click="editSchedule(schedule, false)">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="24px" height="24px">
                      <path
                        d="M 15 4 C 14.476563 4 13.941406 4.183594 13.5625 4.5625 C 13.183594 4.941406 13 5.476563 13 6 L 13 7 L 7 7 L 7 9 L 8 9 L 8 25 C 8 26.644531 9.355469 28 11 28 L 23 28 C 24.644531 28 26 26.644531 26 25 L 26 9 L 27 9 L 27 7 L 21 7 L 21 6 C 21 5.476563 20.816406 4.941406 20.4375 4.5625 C 20.058594 4.183594 19.523438 4 19 4 Z M 15 6 L 19 6 L 19 7 L 15 7 Z M 10 9 L 24 9 L 24 25 C 24 25.554688 23.554688 26 23 26 L 11 26 C 10.445313 26 10 25.554688 10 25 Z M 12 12 L 12 23 L 14 23 L 14 12 Z M 16 12 L 16 23 L 18 23 L 18 12 Z M 20 12 L 20 23 L 22 23 L 22 12 Z" />
                    </svg>
                  </SecondaryButton2>
                </div>
              </td>
            </tr>
            <tr>
              <td class="py-5"><button class="border border-black w-7 aspect-square rounded-full" @click="modal = true">
                  +
                </button>
              </td>
              <td colspan="5" class="py-5"></td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>
</AuthenticatedLayout></template>

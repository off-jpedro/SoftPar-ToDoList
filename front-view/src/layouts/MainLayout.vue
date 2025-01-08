<template>
  <q-layout view="lHh Lpr lFf">
    <q-header elevated style="background-color: #003366;">
      <q-toolbar>
        <q-btn
          flat
          dense
          round
          icon="menu"
          aria-label="Menu"
          @click="toggleLeftDrawer"
        />

        <q-toolbar-title>
          To-Do-List
        </q-toolbar-title>


        <q-space />

        <!-- Botões Light e Dark -->
        <q-btn
          flat
          dense
          round
          icon="light_mode"
          @click="setLightTheme"
          aria-label="Light Theme"
          color="white"
        />
        <q-btn
          flat
          dense
          round
          icon="dark_mode"
          @click="setDarkTheme"
          aria-label="Dark Theme"
          color="white"
        />
      </q-toolbar>
    </q-header>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script setup lang="ts">
import { ref } from 'vue';

const leftDrawerOpen = ref(false);

function toggleLeftDrawer() {
  leftDrawerOpen.value = !leftDrawerOpen.value;
}

function setLightTheme() {
  document.body.classList.remove('q-dark');
  document.body.classList.add('q-light');
}

function setDarkTheme() {
  document.body.classList.remove('q-light');
  document.body.classList.add('q-dark');
}
</script>

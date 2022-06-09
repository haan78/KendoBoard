<script>
  //import logo from './assets/svelte.png'
  import { useRegisterSW } from "virtual:pwa-register/svelte";
  import { onMount } from "svelte/internal";
  import Board from './Board.svelte'
  const { updateServiceWorker } = useRegisterSW();
  onMount(()=>{
    updateServiceWorker();
  });
</script>

<main>
  <Board />
</main>

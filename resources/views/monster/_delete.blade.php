<form
  method="POST"
  action="{{ route('monster.destroy', $monster) }}"
  onsubmit="return confirm('Supprimer ce monstre ? Cette action est irréversible.')"
  class="inline"
>
  @csrf
  @method('DELETE')

  <button
    type="submit"
    class="inline-block text-white opacity-60 hover:opacity-100 rounded-full px-4 py-2 transition-colors duration-300"
  >
    Supprimer
  </button>
</form>

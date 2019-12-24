<script>
import axios from '@nuxtjs/axios'

export default {
  fetch({ redirect }) {
    redirect('/home/collections')
  },
  middleware: ['authenticated']
}
</script>


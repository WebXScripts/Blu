import './bootstrap';
import Alpine from 'alpinejs'
import '@fortawesome/fontawesome-free/scss/fontawesome.scss';
import '@fortawesome/fontawesome-free/scss/brands.scss';
import '@fortawesome/fontawesome-free/scss/regular.scss';
import '@fortawesome/fontawesome-free/scss/solid.scss';
import '@fortawesome/fontawesome-free/scss/v4-shims.scss'
import ToastComponent from '../../vendor/usernotnull/tall-toasts/resources/js/tall-toasts'

window.Alpine = Alpine

Alpine.data('ToastComponent', ToastComponent)
Alpine.start()

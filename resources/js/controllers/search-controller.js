import qs from "qs";
import { debounce } from "../util";
import Turbolinks from "turbolinks";
import { Controller } from 'stimulus';

export default class QueryController extends Controller {
    static targets = ['input', 'clear'];

    initialize() {
        this.debouncedSearch = debounce(this.search, 300);
    }

    connect() {
        window.addEventListener('turbolinks:render', () => {
            if (this.data.has('needsFocus')) {
                this.inputTarget.focus();
            }
        });

        window.addEventListener('turbolinks:load', () => {
            this.data.delete('needsFocus');
        });
    }

    submit(e) {
        e.preventDefault();

        this.debouncedSearch(this.inputTarget.value || undefined);

        this.data.set('needsFocus');
    }

    reset(e) {
        e.preventDefault();

        this.search(undefined);
    }

    search(query) {
        if (query === undefined) {
            this.inputTarget.value = '';
        }

        this.clearTarget.classList.toggle('hidden', query === undefined);

        Turbolinks.visit(`?${qs.stringify({ query })}`, { action: 'replace' });
    }
}

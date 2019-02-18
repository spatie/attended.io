import qs from "qs";
import { debounce } from "../util";
import Turbolinks from "turbolinks";
import { Controller } from 'stimulus';

export default class QueryController extends Controller {
    static targets = ['input'];

    submit(e) {
        e.preventDefault();

        this.search(this.inputTarget.value);
    }

    reset(e) {
        e.preventDefault();

        this.search(undefined);
    }

    search(query) {
        const currentQuery = qs.parse(window.location.search.substr(1));

        const newQueryString = qs.stringify({
            ...currentQuery,
            query,
        });

        Turbolinks.visit(`?${newQueryString}`);
    }
}

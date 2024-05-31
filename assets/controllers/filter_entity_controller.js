import { Controller } from '@hotwired/stimulus';

/*
 * This is an example Stimulus controller!
 *
 * Any element with a data-controller="hello" attribute will cause
 * this controller to be executed. The name "hello" comes from the filename:
 * hello_controller.js -> "hello"
 *
 * Delete this file or adapt it for your use!
 */
export default class extends Controller {
    static targets = ['select', 'input'];
    static values = {'url': String};

    connect() {

    }

    async update() {
        const response = await fetch(this.urlValue+'/'+this.inputTarget.value);
        const tShirts = await response.json();
        const length = this.selectTarget.options.length;
        for (let i = 0; i < length; i++) {
            this.selectTarget.options.remove(i)
        }
        let i = 0;
        for (const tShirt in tShirts) {
            this.selectTarget[i] = new Option(tShirt, tShirts[tShirt]);
            i++;
        }
    }
}

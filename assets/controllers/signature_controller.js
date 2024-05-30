import {Controller} from "@hotwired/stimulus";
import SignaturePad from 'signature_pad';

export default class extends Controller {
    static targets = ['canvas', 'button'];

    connect() {
        this.signaturePad = new SignaturePad(this.canvasTarget);
        // endStroke is SignaturePad event, not DOM...
        this.signaturePad.addEventListener('endStroke', () => {
            const totalPoints = this.signaturePad.toData().reduce((prev, stroke) => prev + stroke.points.length, 0);
            if (20 < totalPoints) {
                this.buttonTarget.disabled = false;
            }
        })
    }

    clear() {
        this.signaturePad.clear();
    }
}

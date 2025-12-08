import { Controller } from '@hotwired/stimulus';

export default class extends Controller {

    async submit(event) {
        event.preventDefault();

        const form = event.target;

        const response = await fetch(form.action, {
            method: "POST",
            body: new FormData(form)
        });

        const data = await response.json();

        const result = document.querySelector('#result');

        if (data.cadeaux) {
            result.innerHTML = `
            <h2 class="text-4xl font-bold text-heading">Idées de cadeaux :</h2>
            <ul class="max-w-md space-y-1 text-body list-disc list-inside mx-auto text-center">
            ${data.cadeaux.map(item => `<li>${item}</li>`).join("")}
            </ul>
            `
        } else {
            result.innerHTML = "<p>Erreur : JSON invalide.</p>";
        }
    }
}

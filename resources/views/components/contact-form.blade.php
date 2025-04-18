@props(['submitLabel' => 'Envoyer'])

<div class="contact-form-container" 
     x-data="{ 
        form: {
            nom: '',
            email: '',
            sujet: '',
            message: ''
        },
        errors: {},
        submitForm() {
            this.errors = {};
            
            if (!this.form.nom.trim()) this.errors.nom = 'Le nom est requis';
            
            if (!this.form.email.trim()) {
                this.errors.email = 'L\'email est requis';
            } else if (!/^\S+@\S+\.\S+$/.test(this.form.email)) {
                this.errors.email = 'L\'email n\'est pas valide';
            }
            
            if (!this.form.sujet.trim()) this.errors.sujet = 'Le sujet est requis';
            if (!this.form.message.trim()) this.errors.message = 'Le message est requis';
            
            if (Object.keys(this.errors).length === 0) {
                // Si aucune erreur, soumettre le formulaire
                $refs.contactForm.submit();
            }
        }
     }">
    
    <form x-ref="contactForm" method="POST" action="" @submit.prevent="submitForm" class="contact-form">
        @csrf
        <div class="row">
            <div class="col-lg-6 form-group">
                <label for="nom" class="form-label">Nom <span class="text-danger">*</span></label>
                <input 
                    type="text" 
                    id="nom" 
                    name="nom" 
                    x-model="form.nom"
                    class="form-control" 
                    :class="{'is-invalid': errors.nom}"
                >
                <div x-show="errors.nom" x-text="errors.nom" class="invalid-feedback"></div>
            </div>
            
            <div class="col-lg-6 form-group">
                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    x-model="form.email"
                    class="form-control" 
                    :class="{'is-invalid': errors.email}"
                >
                <div x-show="errors.email" x-text="errors.email" class="invalid-feedback"></div>
            </div>
            
            <div class="col-lg-12 form-group">
                <label for="sujet" class="form-label">Sujet <span class="text-danger">*</span></label>
                <input 
                    type="text" 
                    id="sujet" 
                    name="sujet" 
                    x-model="form.sujet"
                    class="form-control" 
                    :class="{'is-invalid': errors.sujet}"
                >
                <div x-show="errors.sujet" x-text="errors.sujet" class="invalid-feedback"></div>
            </div>
            
            <div class="col-lg-12 form-group">
                <label for="message" class="form-label">Message <span class="text-danger">*</span></label>
                <textarea 
                    id="message" 
                    name="message" 
                    x-model="form.message"
                    class="form-control" 
                    :class="{'is-invalid': errors.message}"
                    rows="5"
                ></textarea>
                <div x-show="errors.message" x-text="errors.message" class="invalid-feedback"></div>
            </div>
            
            <div class="col-lg-12">
                <button type="submit" class="theme-btn theme-btn-small">
                    {{ $submitLabel }}
                </button>
            </div>
        </div>
    </form>
</div> 
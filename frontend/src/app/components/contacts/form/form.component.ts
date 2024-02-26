import { CommonModule } from '@angular/common';
import { Component } from '@angular/core';
import {
  FormControl,
  FormGroup,
  ReactiveFormsModule,
  Validators,
} from '@angular/forms';
import { Subscription } from 'rxjs';
import { ContactService } from '../../../services/contact.service';
import { ToasterService } from '../../../services/toaster.service';
import { CityService } from '../../../services/city.service';

@Component({
  selector: 'app-form',
  standalone: true,
  imports: [ReactiveFormsModule, CommonModule],
  templateUrl: './form.component.html',
  styleUrl: './form.component.scss',
})
export class FormComponent {
  contactForm!: FormGroup;
  cities: any[] = [];
  private subscription: Subscription = new Subscription();

  constructor(
    private contactService: ContactService,
    private cityService: CityService,
    private toasterService: ToasterService
  ) {}

  ngOnInit() {
    this.createForm();

    this.cityService.getAll().subscribe((data) => {
      this.cities = data;
    });

    this.loadModel();
  }

  createForm() {
    this.contactForm = new FormGroup({
      id: new FormControl(''),
      name: new FormControl('', Validators.required),
      first_name: new FormControl('', Validators.required),
      email: new FormControl('', [Validators.required, Validators.email]),
      street: new FormControl(''),
      zip_code: new FormControl(''),
      city_id: new FormControl('', Validators.required),
    });
  }

  onCancel() {
    this.contactForm.reset();
    this.contactForm.patchValue({ city_id: '' });
    this.contactService.showContactForm(false);
  }

  hasError(field: string) {
    return (
      this.contactForm.get(field)?.invalid &&
      this.contactForm.get(field)?.touched
    );
  }

  onSubmit() {
    if (this.contactForm.valid) {
      if (this.contactForm.value.id) {
        this.updateModel();
      } else {
        this.addModel();
      }
    } else {
      this.contactForm.markAllAsTouched();
    }
  }

  loadModel() {
    this.subscription.add(
      this.contactService.currentContact$.subscribe((contact) => {
        if (contact) {
          this.contactForm.patchValue(contact);
        } else {
          this.contactForm.reset();
          this.contactForm.patchValue({ city_id: '' });
        }
      })
    );
  }
  addModel() {
    this.subscription.add(
      this.contactService
        .addContact(this.contactForm.value)
        .subscribe((res) => {
          if (res.data) {
            this.contactService.setContact(res.data);
            this.toasterService.show(res.message, {
              classname: 'bg-success text-light',
              delay: 5000,
            });
          }
        })
    );
  }

  updateModel() {
    this.subscription.add(
      this.contactService
        .updateContact(this.contactForm.value)
        .subscribe((res) => {
          if (res.data) {
            this.contactService.setContact(this.contactForm.value);
            this.toasterService.show(res.message, {
              classname: 'bg-success text-light',
              delay: 5000,
            });
          }
        })
    );
  }

  ngOnDestroy() {
    this.subscription.unsubscribe();
  }
}

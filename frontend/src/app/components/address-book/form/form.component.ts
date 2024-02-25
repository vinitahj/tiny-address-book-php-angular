import { CommonModule } from '@angular/common';
import { Component } from '@angular/core';
import {
  FormControl,
  FormGroup,
  ReactiveFormsModule,
  Validators,
} from '@angular/forms';
import { Subscription } from 'rxjs';
import { AddressBookService } from '../../../services/address-book.service';
import { ToasterService } from '../../../services/toaster.service';

@Component({
  selector: 'app-form',
  standalone: true,
  imports: [ReactiveFormsModule, CommonModule],
  templateUrl: './form.component.html',
  styleUrl: './form.component.scss',
})
export class FormComponent {
  entryForm!: FormGroup;
  cities: any[] = [];
  private subscription: Subscription = new Subscription();

  constructor(
    private addressBookService: AddressBookService,
    private toasterService: ToasterService
  ) {}

  ngOnInit() {
    this.createForm();

    this.addressBookService.getCities().subscribe((data) => {
      this.cities = data;
    });

    this.loadModel();
  }

  createForm() {
    this.entryForm = new FormGroup({
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
    this.entryForm.reset();
    this.entryForm.patchValue({ city_id: '' });
    this.addressBookService.showEntryForm(false);
  }

  hasError(field: string) {
    return (
      this.entryForm.get(field)?.invalid && this.entryForm.get(field)?.touched
    );
  }

  onSubmit() {
    if (this.entryForm.valid) {
      if (this.entryForm.value.id) {
        this.updateModel();
      } else {
        this.addModel();
      }
    } else {
      this.entryForm.markAllAsTouched();
    }
  }

  loadModel() {
    this.subscription.add(
      this.addressBookService.currentEntry$.subscribe((entry) => {
        if (entry) {
          this.entryForm.patchValue(entry);
        } else {
          this.entryForm.reset();
          this.entryForm.patchValue({ city_id: '' });
        }
      })
    );
  }
  addModel() {
    this.subscription.add(
      this.addressBookService
        .addEntry(this.entryForm.value)
        .subscribe((res) => {
          if (res.data) {
            this.addressBookService.setEntry(res.data);
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
      this.addressBookService
        .updateEntry(this.entryForm.value)
        .subscribe((res) => {
          if (res.data) {
            this.addressBookService.setEntry(this.entryForm.value);
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

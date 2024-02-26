import { Component, OnDestroy, OnInit } from '@angular/core';
import { FormComponent } from './form/form.component';
import { CommonModule } from '@angular/common';
import { ContactService } from '../../services/contact.service';
import { Subscription } from 'rxjs';
import { GridComponent } from './grid/grid.component';

@Component({
  selector: 'app-contacts',
  standalone: true,
  imports: [FormComponent, CommonModule, GridComponent],
  templateUrl: './contacts.component.html',
  styleUrl: './contacts.component.scss',
})
export class ContactsComponent implements OnInit, OnDestroy {
  showForm: boolean = false;
  private subscription: Subscription = new Subscription();

  constructor(private contactService: ContactService) {}

  ngOnInit(): void {
    //Observe showContactForm$ to show form whenever updated
    this.subscription.add(
      this.contactService.showContactForm$.subscribe((res) => {
        this.showForm = res;
      })
    );
  }

  addForm() {
    this.contactService.setContact(null);
    this.contactService.showContactForm(true);
  }

  exportAs(type: string) {
    this.contactService.exportAs(type).subscribe((data) => {
      this.contactService.downloadFile(data, `address-book.${type}`);
    });
  }

  ngOnDestroy() {
    this.subscription.unsubscribe();
  }
}

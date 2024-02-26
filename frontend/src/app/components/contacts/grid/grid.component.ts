import { Component, OnDestroy, OnInit } from '@angular/core';
import { Subscription } from 'rxjs';
import { ContactService } from '../../../services/contact.service';
import { ToasterService } from '../../../services/toaster.service';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-grid',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './grid.component.html',
  styleUrl: './grid.component.scss',
})
export class GridComponent implements OnInit, OnDestroy {
  contacts: any[] = [];
  selectedId!: any;
  private subscription: Subscription = new Subscription();

  private offset = 0;
  private limit = 5;
  allContactsLoaded = false; // Flag to indicate all contacts are loaded

  constructor(
    private contactService: ContactService,
    private toasterService: ToasterService
  ) {}

  ngOnInit() {
    this.loadContacts();
    this.subscription.add(
      this.contactService.currentContact$.subscribe((entry) => {
        if (entry) {
          this.loadContacts(entry.id);
        }
      })
    );
    this.subscription.add(
      this.contactService.showContactForm$.subscribe((res) => {
        if (!res) this.selectedId = '';
      })
    );
  }
  loadContacts(selectedId?: any) {
    if (selectedId) {
      this.offset = 0; // Reset offset
      this.contacts = []; // Reset contacts array
      this.allContactsLoaded = false; // Reset the flag
    }
    this.contactService.getAllContacts(this.offset, this.limit).subscribe(
      (data) => {
        if (data.length > 0) {
          this.contacts = [...this.contacts, ...data];
          this.offset += this.limit;
          if (selectedId) {
            this.selectedId = selectedId;
          }
          this.allContactsLoaded = data.length < this.limit;
        } else {
          this.allContactsLoaded = true;
        }
      },
      (error) => {
        this.toasterService.show('Error fetching contacts.', {
          classname: 'bg-danger text-light',
          delay: 5000,
        });
      }
    );
  }

  editContact(entry: any) {
    this.contactService.showContactForm(true);
    this.contactService.setContact(entry);
    this.selectedId = entry.id;
  }

  deleteContact(entry: any) {
    this.contactService.deleteContact(entry).subscribe((res) => {
      this.toasterService.show(res.message, {
        classname: 'bg-success text-light',
        delay: 5000,
      });
      this.contactService.setContact(null);
      this.contacts = this.contacts.filter((res) => res.id != entry.id);
    });
  }

  ngOnDestroy() {
    this.subscription.unsubscribe();
  }
}
